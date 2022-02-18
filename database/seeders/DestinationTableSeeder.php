<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;

class DestinationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicle = [
            ['id' => 1,'client_id' => 1, 'name' => 'Kathmandu'],
            ['id' => 2,'client_id' => 1, 'name' => 'Pokhara'],
            ['id' => 3,'client_id' => 1, 'name' => 'Bhairahawa'],
            ['id' => 4,'client_id' => 1, 'name' => 'Lumbini'],
            ['id' => 5,'client_id' => 1, 'name' => 'Krishnanagar'],
            ['id' => 6,'client_id' => 1, 'name' => 'Butwal'],
            ['id' => 7,'client_id' => 1, 'name' => 'Palpa'],
            ['id' => 8,'client_id' => 1, 'name' => 'Kakadvitta'],
            ['id' => 9,'client_id' => 1, 'name' => 'Brittamod'],
            ['id' => 10,'client_id' => 1, 'name' => 'Simaltari'],
            ['id' => 11,'client_id' => 1, 'name' => 'Biratnagar'],
        ];
        Destination::insert($vehicle);
    }
}
