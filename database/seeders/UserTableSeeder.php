<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            'id' => '1',
            'name' => 'superadmin',
            'email' => 'super@yatayat.com',
            'is_active' => true,
        ]);
        
        DB::table('users')->insert([
            'id' => '1',
            'client_id' => '1',
            'name' => 'superadmin',
            'email' => 'super@yatayat.com',
            'password' => bcrypt('yatayat@1234'),
        ]);

        $user = new User();
        $superadmin =  DB::table('users')->where('name', 'superadmin')->pluck('id')->first();
        $user->assignRoleCustom("superadmin", $superadmin);
    }
}
