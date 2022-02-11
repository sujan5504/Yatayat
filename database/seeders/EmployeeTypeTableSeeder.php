<?php

namespace Database\Seeders;

use App\Models\EmployeeType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee_type = [
            ['id' => 1,'client_id' => 1,'name' => 'Driver'],
            ['id' => 2,'client_id' => 1,'name' => 'Conductor'],
        ];
        EmployeeType::insert($employee_type);
    }
}
