<?php

use App\Entities\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Super Admin User
        $superAdminUser = User::create([
            'name' => 'Super Administrator',
            'email' => 'superadmin@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('superadmin') //superadmin
        ]);

        $superAdminUser->assignRole('super-admin');

        //Admin User
        $adminUser = User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('admin') //admin
        ]);

        $adminUser->assignRole('admin');

        //Regular User
        $regularUser = User::create([
            'name' => 'Regular',
            'email' => 'regular@example.com',
            'email_verified_at' => now(),
            'password' =>  bcrypt('regular') //regular
        ]);

        $regularUser->assignRole('regular');
    }
}
