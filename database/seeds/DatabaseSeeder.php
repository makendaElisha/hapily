<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Seed permissions and users
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(AreasOfLifeSeeder::class);
        $this->call(SymptomsSeeder::class);
        $this->call(QuestionsSeeder::class);
    }
}
