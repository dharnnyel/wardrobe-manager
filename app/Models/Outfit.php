<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Outfit extends Model
{
    //
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'purpose',
        'purpose_date',
        'season',
        'last_worn',
    ];
}
