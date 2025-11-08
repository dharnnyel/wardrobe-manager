<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    //
    protected $fillable = [
        'name',
        'properties',
        'image',
    ];

    protected $casts = [
        'properties' => 'array',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
