<?php

namespace Database\Seeders;

use App\Models\Reward;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rewards = [
            [
                'user_id'         =>   3,
                'plan_id'         =>   4,
                'reward_amount'   =>   5,

            ],

            [
                'user_id'         =>   2,
                'plan_id'         =>   4,
                'reward_amount'   =>   4,

            ],

            [
                'user_id'         =>   3,
                'plan_id'         =>   4,
                'reward_amount'   =>   2,

            ],

        ];

        foreach ($rewards as $reward) {
            Reward::create($reward);
        }
    }
}
