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
                'commission'      =>   1,

            ],

        ];

        foreach ($planlevels as $planlevel) {
            PlanLevel::create($planlevel);
        }
    }
}
