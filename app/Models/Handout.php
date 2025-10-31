<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Handout extends Model
{
    //
    protected $fillable = [
        'clothing_id',
        'handed_out_at',
        'handout_type',
    ];
}
