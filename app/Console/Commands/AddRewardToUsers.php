<?php

namespace App\Console\Commands;

use Exception;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AddRewardToUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:reward';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add Reward to users';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try{
            DB::beginTransaction();
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

            DB::commit();
            return Command::SUCCESS;
        }catch(Exception $e){
            DB::rollBack();
            Log::error($e->getMessage());
            return Command::FAILURE;
        }
    }
}
