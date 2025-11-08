<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

// Extends Pivot since this is a pivot table model
class ClothingOutfit extends Pivot
{
    //
    protected $fillable = [
        'outfit_id',
        'clothing_id',
    ];
}
