<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Counter;
use Illuminate\Support\Facades\DB;

class CounterSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
     public function run()
    {
        $start_time='10:00:00';
        $end_time='18:00:00';
        //
         // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        DB::table('counters')->insert([
            'name'=>'GCP',
            'lunch_start'=>$start_time,
            'lunch_end'=>$end_time
        ]);

    }
}
