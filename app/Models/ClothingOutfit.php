<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ClothingOutfit extends Pivot
{
    //
    protected $fillable = [
        'outfit_id',
        'clothing_id',
    ];
}
