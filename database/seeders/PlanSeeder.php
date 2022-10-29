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
                'name'            =>   'Agent Silver',
                'price'           =>   200000,
                'min_ref'         =>   100,
                'max_ref'         =>   400,
                'ref_commission'  =>   6,  
                'amount_returns'  =>   14,  
                'plan_type'       =>   'high_agent', 
                'status'          =>   0,

            ],

        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}
