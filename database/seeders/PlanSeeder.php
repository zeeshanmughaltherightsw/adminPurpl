<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            [
                'name'            =>   'Basic',
                'price'           =>   50,
                'estimated_profit'=>   5,
                'amount_returns'  =>   14,
                'status'          =>   0,

            ],

        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}
