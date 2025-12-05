<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Country;
use App\Models\PlanCost;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PlanCostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $selected_countries = [
            'US',
            'CA',
            'GB',
            'NG',
            'IN',
        ];

        foreach ($selected_countries as $countryIso) {
            $country = Country::where('iso2', $countryIso)->first();
            if ($country) {
                foreach (Plan::where('slug', '!=', 'free')->get() as $plan) {
                    PlanCost::create([
                        'plan_id' => $plan->id,
                        'country_id' => $country->id,
                        'monthly_cost' => rand(100, 1000),
                        'annual_cost' => rand(1000, 10000),
                    ]);
                }
            }
        }
    }
}
