<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laundry extends Model
{
    //
    protected $fillable = [
        'clothing_id',
        // 'expected_at',
        // 'released_at',
    ];

    protected $casts = [
        'expected_at' => 'datetime',
        'released_at' => 'datetime',
    ];

    public function clothing() {
        return $this->belongsTo(Clothing::class);
    }

    // Can be reomved as the clothing has the user id attached to it's table
    public function user() {
        return $this->belongsTo(User::class);
    }
}
