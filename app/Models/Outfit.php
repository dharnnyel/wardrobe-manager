<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Outfit extends Model
{
    //
    protected $fillable = [
        'user_id',
        'name',
        // 'description',
        // 'purpose',
        // 'purpose_date',
        // 'season',
    ];

    protected $casts = [
        'purpose_date' => 'datetime',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function clothings() {
        return $this->belongsToMany(Clothing::class, 'clothing_outfit');
    }
}
