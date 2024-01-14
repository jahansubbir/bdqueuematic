<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'process_duration',
        'is_bulk_processable'
      
    ];

    protected $casts=[
        'name'=>'string',
        
        'process_duration'=>'datetime',
        'is_bulk_processable'=> 'bool'

    ];
}
