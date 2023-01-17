<?php

namespace App\Console\Commands;

use Exception;
use App\Models\User;
use App\Models\Reward;
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
            })->whereStatus('active')->where('plan_id', 5)->where('user_type', 'user')->get();
            foreach($users as $user){
                $reward = Reward::where('total_investment', '<=', $user->referrals_sum_investment)->orderBy('id', 'desc')->first();
                if($reward){
                    $user->reward = $reward->amount;
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

            DB::commit();
            Log::info("Reward added successfully for the data: " . now());
            return Command::SUCCESS;
        }catch(Exception $e){
            DB::rollBack();
            Log::error($e->getMessage());
            return Command::FAILURE;
        }
    }
}
