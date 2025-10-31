<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $plans = [
            [
                'name' => 'Free',
                'monthly_cost' => 0,
                'annual_cost' => 0,
                'number_of_clothing' => 500,
                'outfit_planning' => 'basic',
                'basic_recommendation' => false,
                'ai_recommendation' => false,
                'laundry_tracking' => 'manual',
                'support' => 'standard',
                'analytics' => false,
            ],
            [
                'name' => 'Pro',
                'monthly_cost' => 500,
                'annual_cost' => 5000,
                'number_of_clothing' => 2000,
                'outfit_planning' => 'advanced',
                'basic_recommendation' => true,
                'ai_recommendation' => false,
                'laundry_tracking' => 'automated',
                'support' => 'priority',
                'analytics' => true,
            ],
            [
                'name' => 'Premium',
                'monthly_cost' => 2000,
                'annual_cost' => 20000,
                'number_of_clothing' => 1000000,
                'outfit_planning' => 'advanced',
                'basic_recommendation' => false,
                'ai_recommendation' => true,
                'laundry_tracking' => 'automated',
                'support' => 'priority',
                'analytics' => true,
            ],
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}
