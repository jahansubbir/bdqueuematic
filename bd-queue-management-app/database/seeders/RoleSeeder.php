<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guardName='web';
        //
        $adminRole = Role::create(['name' => 'admin',
        'guard_name'=>$guardName
    ]);
        $operatorRole = Role::create(['name' => 'operator'
        ,
        'guard_name'=>$guardName]);
        $userRole = Role::create(['name' => 'user'
        ,
        'guard_name'=>$guardName]);

       // $adminRole->gi('all');
    }
}
