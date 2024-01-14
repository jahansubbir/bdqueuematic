<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'SuperAdmin',
            'email' => 'eTokenSuperAdmin@maersk.com',
            'cnf_name'=>'maersk',
            'ain_no'=>'123456789',
            'contact_no'=>'01909108855',
            'password' => Hash::make('P@ssword'),
        ]);
        DB::table('role_user')->insert([
            'role_id'=>1,
            'user_id'=>1
        ]);
    }
}
