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
                'expire'          =>   2,  
                'profit'          =>   0.5,
                'plan_type'       =>   'investor', 
                'status'          =>   1,

            ],
            [
                'name'            =>   'Starter',
                'min_price'       =>   500,
                'max_price'       =>   999,
                'profit'          =>   0.75,
                'expire'          =>   2,  
                'profit'          =>   0.5,
                'plan_type'       =>   'investor', 
                'status'          =>   1,

            ],
            [
                'name'            =>   'Silver',
                'min_price'       =>   1000,
                'max_price'       =>   100000,
                'profit'          =>   1,
                'expire'          =>   2,  
                'profit'          =>   0.5,
                'plan_type'       =>   'investor', 
                'status'          =>   1,

            ],

            [
                'name'            =>   'Consultant',
                'min_price'       =>   1000,
                'max_price'       =>   2000,
                'min_ref'         =>   1,
                'max_ref'         =>   4,
                'ref_commission'  =>   1,
                'expire'          =>   2,  
                'profit'          =>   0.5,
                'plan_type'       =>   'referral', 
                'status'          =>   1,

            ],
            [
                'name'            =>   'Executive',
                'min_price'       =>   1000,
                'max_price'       =>   2000,
                'min_ref'         =>   5,
                'max_ref'         =>   20,
                'ref_commission'  =>   2,
                'expire'          =>   4,  
                'profit'          =>   0.5,
                'plan_type'       =>   'referral', 
                'status'          =>   0,

            ],

            // [
            //     'name'            =>   'Referral Silver',
            //     'min_price'       =>   1000,
            //     'max_price'       =>   2000,
            //     'min_ref'         =>   4,
            //     'max_ref'         =>   30,
            //     'ref_commission'  =>   3,
            //     'expire'          =>   4,  
            //     'profit'          =>   0.5,
            //     'plan_type'       =>   'referral', 
            //     'status'          =>   0,

            // ],
            // [
            //     'name'            =>   'Agent Basic',
            //     'min_price'       =>   1000,
            //     'max_price'       =>   2000,
            //     'min_ref'         =>   1,
            //     'max_ref'         =>   50,
            //     'ref_commission'  =>   4,
            //     'expire'          =>   2,  
            //     'profit'          =>   0.5,
            //     'plan_type'       =>   'high_agent', 
            //     'status'          =>   1,

            // ],

            // [
            //     'name'            =>   'Agent Starter',
            //     'min_price'       =>   1000,
            //     'max_price'       =>   2000,
            //     'min_ref'         =>   50,
            //     'max_ref'         =>   100,
            //     'ref_commission'  =>   5,
            //     'expire'          =>   2,  
            //     'profit'          =>   0.5,
            //     'plan_type'       =>   'high_agent', 
            //     'status'          =>   0,

            // ],

            
            // [
            //     'name'            =>   'Agent Silver',
            //     'min_price'       =>   1000,
            //     'max_price'       =>   2000,
            //     'min_ref'         =>   100,
            //     'max_ref'         =>   400,
            //     'ref_commission'  =>   6,
            //     'expire'          =>   2,  
            //     'profit'          =>   0.5,
            //     'plan_type'       =>   'high_agent', 
            //     'status'          =>   0,

            // ],

        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}
