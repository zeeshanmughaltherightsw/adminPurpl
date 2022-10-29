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
                'min_profit'      =>   4,
                'max_profit'      =>   8,
                'amount_returns'  =>   14,  
                'plan_type'       =>   'investor', 
                'status'          =>   0,

            ],
            [
                'name'            =>   'Starter',
                'price'           =>   100,
                'min_profit'      =>   4,
                'max_profit'      =>   8,
                'amount_returns'  =>   14,  
                'plan_type'       =>   'investor', 
                'status'          =>   0,

            ],
            [
                'name'            =>   'Silver',
                'price'           =>   500,
                'min_profit'      =>   4,
                'max_profit'      =>   8,
                'amount_returns'  =>   14,  
                'plan_type'       =>   'investor', 
                'status'          =>   0,

            ],

            [
                'name'            =>   'Referral Basic',
                'price'           =>   1000,
                'min_ref'         =>   1,
                'max_ref'         =>   10,
                'ref_commission'  =>   1,
                'amount_returns'  =>   14,  
                'plan_type'       =>   'referral', 
                'status'          =>   0,

            ],
            [
                'name'            =>   'Referral Starter',
                'price'           =>   1500,
                'min_ref'         =>   11,
                'max_ref'         =>   20,
                'ref_commission'  =>   2,
                'amount_returns'  =>   14,  
                'plan_type'       =>   'referral', 
                'status'          =>   0,

            ],

            [
                'name'            =>   'Referral Silver',
                'price'           =>   2000,
                'min_ref'         =>   21,
                'max_ref'         =>   30,
                'ref_commission'  =>   3,
                'amount_returns'  =>   14,  
                'plan_type'       =>   'referral', 
                'status'          =>   0,

            ],
            [
                'name'            =>   'Agent Basic',
                'price'           =>   2500,
                'min_ref'         =>   1,
                'max_ref'         =>   50,
                'ref_commission'  =>   4,
                'amount_returns'  =>   14,  
                'plan_type'       =>   'high_agent', 
                'status'          =>   0,

            ],

            [
                'name'            =>   'Agent Starter',
                'price'           =>   10000,
                'min_ref'         =>   50,
                'max_ref'         =>   100,
                'ref_commission'  =>   5,
                'amount_returns'  =>   14,  
                'plan_type'       =>   'high_agent', 
                'status'          =>   0,

            ],

            
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
