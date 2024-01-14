<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    use HasFactory;
   // use HasUuids;
    //protected $table = 'counters';
    protected $fillable = [
        'name',
        'opening_hour',
        'lunch_start',
        'lunch_end',
        'closing_hour'
    ];
    protected $casts=[
        'name'=>'string',
        'lunch_start'=> 'datetime:H:i',
        'lunch_end'=> 'datetime:H:i',
        'opening_hour'=>'datetime:H:i',
        'closing_hour'=>'datetime:H:i'


    ];
}