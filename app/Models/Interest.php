<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    //
    protected $fillable = [
        'name',
        'material',
        'size',
        'size_unit',
        'sleeves',
        'color',
        'collar',
        'design',
        'image',
    ];
}
