<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoothType extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
      
    ];
    protected $casts=[
        'type'=>'string'
        

    ];
}
