<?php

namespace App\Models;

use Brick\Math\BigInteger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Token extends Model
{
    use HasFactory;
    protected $fillable = [
        'counter_id',
        'token_type_id',
        'booth_id',
        'created_at',
        'appointment_start',
        'appointment_end',
        'token_no',
        'user_id'
        

    ];

   
    protected $casts=[
        'counter_id'=>'int',
        'token_type_id'=>'int',
        'booth_id'=>'int',
        'created_at' => 'datetime:H:i',
        'appointment_start'=>'datetime:H:i',
        'appointment_end'=>'datetime:H:i',
        'token_no'=>'string',
        'user_id'=> 'string',

    ];

    public function counter():BelongsTo{
        return $this->belongsTo(Counter::class,'foreign_key','owner_key');
    }
    
    public function boothType():BelongsTo{
        return $this->belongsTo(BoothType::class,'foreign_key','owner_key');
    }
    public function tokenType():BelongsTo{
        return $this->belongsTo(TokenType::class,'foreign_key','owner_key');
    }
}
