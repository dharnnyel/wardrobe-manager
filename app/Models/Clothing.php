<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clothing extends Model
{
    //
    protected $fillable = [
        'user_id',
        'name',
    ];

    protected $casts = [
        'purchase_date' => 'date',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function laundries() {
        return $this->hasMany(Laundry::class);
    }

    public function handout() {
        return $this->hasOne(Handout::class);
    }

    public function outfits() {
        return $this->belongsToMany(Outfit::class, 'clothing_outfit');
    }
}
