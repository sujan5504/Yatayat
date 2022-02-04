<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;

class GenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genders = [
            ['id' => 1,'code' => 'M','name' => 'Male'],
            ['id' => 2,'code' => 'F','name' => 'Female'],
            ['id' => 3,'code' => 'O','name' => 'Others'],
        ];
        Gender::insert($genders);
    }
}
