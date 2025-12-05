<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanCost extends Model
{
    protected $fillable = [
        'plan_id',
        'country_id',
        'monthly_cost',
        'annual_cost',
    ];
}
