<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $guardName='web';
        Permission::create(['name' => 'view users',
        'guard_name'=>$guardName]);
        Permission::create(['name' => 'create users',
        'guard_name'=>$guardName]);
        Permission::create(['name' => 'edit users',
        'guard_name'=>$guardName]);
        Permission::create(['name' => 'delete users',
        'guard_name'=>$guardName]);

        Permission::create(['name' => 'view all tokens',
        'guard_name'=>$guardName]);
        Permission::create(['name' => 'view my tokens',
        'guard_name'=>$guardName]);
        Permission::create(['name' => 'create tokens',
        'guard_name'=>$guardName]);
        
       // Permission::create(['name' => 'edit tokens']);
     //   Permission::create(['name' => 'delete tokens']);

        Permission::create(['name' => 'view counters',
        'guard_name'=>$guardName]);
        Permission::create(['name' => 'create counters',
        'guard_name'=>$guardName]);
        Permission::create(['name' => 'edit counters',
        'guard_name'=>$guardName]);
        Permission::create(['name' => 'delete counters',
        'guard_name'=>$guardName]);

        Permission::create(['name' => 'view booths',
        'guard_name'=>$guardName]);
        Permission::create(['name' => 'create booths',
        'guard_name'=>$guardName]);
        Permission::create(['name' => 'edit booths',
        'guard_name'=>$guardName]);
        Permission::create(['name' => 'delete booths',
        'guard_name'=>$guardName]);

        Permission::create(['name' => 'view token_types',
        'guard_name'=>$guardName]);
        Permission::create(['name' => 'create token_types',
        'guard_name'=>$guardName]);
        Permission::create(['name' => 'edit token_types',
        'guard_name'=>$guardName]);
        Permission::create(['name' => 'delete token_types',
        'guard_name'=>$guardName]);
        
        
    }
}
