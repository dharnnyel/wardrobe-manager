<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Handout extends Model
{
    //
    protected $fillable = [
        'clothing_id',
    ];

    protected $casts = [
        'handed_out_at' => 'datetime',
    ];

    public function clothing(){
        return $this->belongsTo(Clothing::class);
    }
}
