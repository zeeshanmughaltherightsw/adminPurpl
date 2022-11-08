<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Reward;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
                'name' => 'Sapphare',
                'total_investment' => 5000,
                'amount' => 100
            ],
            [
                'name' => 'Ruby',
                'total_investment' => 10000,
                'amount' => 200
            ],
            [
                'name' => 'Emerald',
                'total_investment' => 50000,
                'amount' => 1000
            ],
            [
                'name' => 'Diamond',
                'total_investment' => 100000,
                'amount' => 2000
            ],
            [
                'name' => 'Crown diamond',
                'total_investment' => 500000,
                'amount' => 10000
            ],
            [
                'name' => 'Royal crown diamond',
                'total_investment' => 1000000,
                'amount' => 20000
            ],
            [
                'name' => 'Vise president',
                'total_investment' => 5000000,
                'amount' => 100000
            ],
            [
                'name' => 'President',
                'total_investment' => 10000000,
                'amount' => 200000
            ],
        ];

        Reward::insert($rewards);

        $users = User::withSum(
            ['referrals' => function ($query){
                $query->where('investment', '>=', 5000);
            }], 'investment')
        ->whereHas('referrals', function($query){
            $query->where('investment', '>=', 5000);
        })->whereStatus('active')->whereNotNull('plan_id')->where('user_type', 'user')->get();
        foreach($users as $user){
            $reward = Reward::where('total_investment', '<=', $user->referrals_sum_investment)->orderBy('id', 'desc')->first();
            if($reward){
                $user->reward += $reward->amount;
                $user->reward_title = $reward->name;
            }
            $user->save();
            $user->transactions()->create([
                'amount' => $reward->amount,
                'trx' => getTrx(),
                'trx_type' => '+',
                'details' => "Received reward from referrals",
                'remark' => 'reward'
            ]);
        }

    }
}
