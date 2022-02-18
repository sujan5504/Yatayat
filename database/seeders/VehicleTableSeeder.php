<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicle = [
            ['id' => 1,'client_id' => 1, 'name' => 'Car', 'is_active' => true],
            ['id' => 2,'client_id' => 1, 'name' => 'Bus', 'is_active' => true],
            ['id' => 3,'client_id' => 1, 'name' => 'Jeep', 'is_active' => true],
            ['id' => 4,'client_id' => 1, 'name' => 'Hiace', 'is_active' => true],
        ];
        Vehicle::insert($vehicle);
    }
}
