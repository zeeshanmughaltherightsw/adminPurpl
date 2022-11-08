<?php

namespace App\Console\Commands;

use Exception;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AddProfitToUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:profit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add profit to all users';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try{
            DB::beginTransaction();
            $users = User::with('plan')
                    ->whereHas('plan', function($query){
                        $query->where('profit', '>', 0);
                    })
                    ->where('user_type', 'user')
                    ->whereNotNull('plan_id')
                    ->where('investment', '>', 0)
                    ->whereStatus('active')->get();
                foreach($users as $user){
                    $totalEarning = $user->profit + $user->commission + $user->reward;
                    $user->profit += ($user->investment * $user->plan->profit) / 100;
                    if($totalEarning >= $user->plan_expiry * $user->investment){
                        $user->plan_id = null;
                    }
                    $user->save();

                    $user->transactions()->create([
                        'amount' => ($user->investment * $user->plan->profit) / 100,
                        'trx' => getTrx(),
                        'trx_type' => '+',
                        'details' => "Received profit from investment"
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
