<?php

namespace App\Models;

use Brick\Math\BigInteger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TokenDetails extends Model
{
    use HasFactory;
    protected $fillable = 
    [

        'token_id',
        'bl_no',
        'be_no',
    ];
    protected $casts = [

        'token_id'=> 'int',
        'bl_no'=>'string',
        'be_no'=>'string'
    ];

    public function token():BelongsTo{
        return $this->belongsTo(Token::class,'foreign_key','owner_key');
    }
    
}