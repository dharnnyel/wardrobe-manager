<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clothing extends Model
{
    //
    protected $fillable = [
        'user_id',
        'name',
        'brand',
        'color',
        'size',
        'material',
        'care_instructions',
        'price',
        'notes',
        'image',
        'status',
        'purchase_date',
    ];
}
