<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laundry extends Model
{
    //
    protected $fillable = [
        'clothing_id',
        'user_id',
        'released_at',
        'expected_at',
    ];

    protected $casts = [
        'expected_at' => 'datetime',
        'released_at' => 'datetime',
    ];

    public function clothing(){
        return $this->belongsTo(Clothing::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
