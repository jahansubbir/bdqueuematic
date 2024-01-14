<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booth extends Model
{
    use HasFactory;

    protected $fillable = [
        'counter_id',
        'booth_no',
        'booth_type_id'

    ];

    public function counter():BelongsTo{
        return $this->belongsTo(Counter::class,'foreign_key','owner_key');
    }
    
    public function boothType():BelongsTo{
        return $this->belongsTo(BoothType::class,'foreign_key','owner_key');
    }
    protected $casts=[
        'counter_id'=>'int',
        'booth_no'=> 'int',
        'booth_type_id'=> 'int'

    ];

    
}
