<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //User Permissions
        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'view-users']);
        Permission::create(['name' => 'edit-users']);
        Permission::create(['name' => 'delete-users']);

        //Area of life Permissions
        Permission::create(['name' => 'create-areas']);
        Permission::create(['name' => 'view-areas']);
        Permission::create(['name' => 'edit-areas']);
        Permission::create(['name' => 'delete-areas']);

        //Symptoms Permission
        Permission::create(['name' => 'create-symptoms']);
        Permission::create(['name' => 'view-symptoms']);
        Permission::create(['name' => 'edit-symptoms']);
        Permission::create(['name' => 'delete-symptoms']);

        //Survey Result Permissions
        Permission::create(['name' => 'view-survey-results']);


        //Roles
        $superAdminRole     = Role::firstOrCreate(['name' => 'super-admin']);
        $adminRole          = Role::firstOrCreate(['name' => 'admin']);
        $regularRole        = Role::firstOrCreate(['name' => 'regular']);

        //Assigning Permissions To Role
        $superAdminRole->givePermissionTo(Permission::all());
        $adminRole->givePermissionTo([
            'create-users',
            'view-users',
            'edit-users',
            'delete-users',
            'create-areas',
            'view-areas',
            'edit-areas',
            'delete-areas',
            'create-symptoms',
            'view-symptoms',
            'edit-symptoms',
            'delete-symptoms',
            'view-survey-results'
        ]);
        $regularRole->givePermissionTo(['view-users','view-areas','view-symptoms']);
    }
}
