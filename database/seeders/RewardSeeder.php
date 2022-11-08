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
        $users = User::withSum(
            ['referrals' => function ($query){
                $query->where('investment', '>=', 5000);
            }], 'investment')
        ->whereHas('referrals', function($query){
            $query->where('investment', '>=', 5000);
        })->whereStatus('active')->where('user_type', 'user')->get();
        foreach($users as $user){
            $reward = (intval($user->referrals_sum_investment / 5000)) * 5000 * 0.02;
            $user->reward += $reward;
            $user->save();
            $user->transactions()->create([
                'amount' => $reward,
                'trx' => getTrx(),
                'trx_type' => '+',
                'details' => "Received reward from referrals",
                'remark' => 'reward'
            ]);
        }

    }
}
