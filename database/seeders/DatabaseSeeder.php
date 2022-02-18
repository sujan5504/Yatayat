<?php

namespace Database\Seeders;

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
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(GenderTableSeeder::class);
        $this->call(EmployeeTypeTableSeeder::class);
        $this->call(VehicleTableSeeder::class);
        $this->call(DestinationTableSeeder::class);
    }
}
