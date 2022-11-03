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
                'min_price'       =>   100,
                'max_price'       =>   499,
                'profit'          =>   0.5,
                'amount_returns'  =>   14,  
                'plan_type'       =>   'investor', 
                'status'          =>   0,

            ],
            [
                'name'            =>   'Starter',
                'min_price'       =>   500,
                'max_price'       =>   999,
                'profit'          =>   0.75,
                'amount_returns'  =>   14,  
                'plan_type'       =>   'investor', 
                'status'          =>   0,

            ],
            [
                'name'            =>   'Silver',
                'min_price'       =>   1000,
                'max_price'       =>   100000,
                'profit'          =>   1,
                'amount_returns'  =>   14,  
                'plan_type'       =>   'investor', 
                'status'          =>   0,

            ],

            [
                'name'            =>   'Referral Basic',
                'min_price'       =>   1000,
                'max_price'       =>   2000,
                'min_ref'         =>   1,
                'max_ref'         =>   10,
                'ref_commission'  =>   1,
                'amount_returns'  =>   14,  
                'plan_type'       =>   'referral', 
                'status'          =>   1,

            ],
            [
                'name'            =>   'Referral Starter',
                'min_price'       =>   1000,
                'max_price'       =>   2000,
                'min_ref'         =>   11,
                'max_ref'         =>   20,
                'ref_commission'  =>   2,
                'amount_returns'  =>   14,  
                'plan_type'       =>   'referral', 
                'status'          =>   0,

            ],

            [
                'name'            =>   'Referral Silver',
                'min_price'       =>   1000,
                'max_price'       =>   2000,
                'min_ref'         =>   21,
                'max_ref'         =>   30,
                'ref_commission'  =>   3,
                'amount_returns'  =>   14,  
                'plan_type'       =>   'referral', 
                'status'          =>   0,

            ],
            [
                'name'            =>   'Agent Basic',
                'min_price'       =>   1000,
                'max_price'       =>   2000,
                'min_ref'         =>   1,
                'max_ref'         =>   50,
                'ref_commission'  =>   4,
                'amount_returns'  =>   14,  
                'plan_type'       =>   'high_agent', 
                'status'          =>   1,

            ],

            [
                'name'            =>   'Agent Starter',
                'min_price'       =>   1000,
                'max_price'       =>   2000,
                'min_ref'         =>   50,
                'max_ref'         =>   100,
                'ref_commission'  =>   5,
                'amount_returns'  =>   14,  
                'plan_type'       =>   'high_agent', 
                'status'          =>   0,

            ],

            
            [
                'name'            =>   'Agent Silver',
                'min_price'       =>   1000,
                'max_price'       =>   2000,
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
