<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laundry extends Model
{
    //
    protected $fillable = [
        'clothing_id',
        'created_at',
        'released_at',
        'updated_at',
        'duration',
    ];
}
