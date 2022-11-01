<?php

namespace Database\Seeders;

use App\Models\PlanLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $planlevels = [
            [
                'plan_id'         =>   4,
                'key'             =>   'referral',
                'level'           =>   1,
                'commission'      =>   5,

            ],
            [
                'plan_id'         =>   4,
                'key'             =>   'referral',
                'level'           =>   2,
                'commission'      =>   2,

            ],
            [
                'plan_id'         =>   4,
                'key'             =>   'referral',
                'level'           =>   3,
                'commission'      =>   1,

            ],

            [
                'plan_id'         =>   4,
                'key'             =>   'referral',
                'level'           =>   4,
                'commission'      =>   1,

            ],

            [
                'plan_id'         =>   4,
                'key'             =>   'referral',
                'level'           =>   5,
                'commission'      =>   1,

            ],

            [
                'plan_id'         =>   4,
                'key'             =>   'referral',
                'level'           =>   6,
                'commission'      =>   0.5,

            ],

            [
                'plan_id'         =>   4,
                'key'             =>   'referral',
                'level'           =>   7,
                'commission'      =>   0.5,

            ],
            [
                'plan_id'         =>   4,
                'key'             =>   'referral',
                'level'           =>   8,
                'commission'      =>   0.5,

            ],

            [
                'plan_id'         =>   4,
                'key'             =>   'referral',
                'level'           =>   9,
                'commission'      =>   0.25,

            ],
            [
                'plan_id'         =>   4,
                'key'             =>   'referral',
                'level'           =>   10,
                'commission'      =>   0.25,

            ],

            [
                'plan_id'         =>   4,
                'key'             =>   'referral',
                'level'           =>   11,
                'commission'      =>   0.25,

            ],

            [
                'plan_id'         =>   4,
                'key'             =>   'referral',
                'level'           =>   12,
                'commission'      =>   0.25,

            ],

            [
                'plan_id'         =>   4,
                'key'             =>   'referral',
                'level'           =>   13,
                'commission'      =>   0.25,

            ],

            [
                'plan_id'         =>   4,
                'key'             =>   'referral',
                'level'           =>   14,
                'commission'      =>   0.25,

            ],

            [
                'plan_id'         =>   4,
                'key'             =>   'referral',
                'level'           =>   15,
                'commission'      =>   0.25,

            ],

        ];

        foreach ($planlevels as $planlevel) {
            PlanLevel::create($planlevel);
        }
    }
}
