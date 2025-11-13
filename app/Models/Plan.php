<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //
    protected $fillable = [
        'name',
        'outfit_planning',
        'monthly_cost',
        'annual_cost',
        'number_of_clothing',
        'basic_recommendation',
        'ai_recommendation',
        'laundry_tracking',
        'support',
        'analytics',
    ];

    public function users(){
        return $this->hasMany(User::class);
    }
}
