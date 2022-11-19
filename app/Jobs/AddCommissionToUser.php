<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Models\CommissionRecord;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class AddCommissionToUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $commissionRecords = CommissionRecord::with(['transaction', 'user'])->where('day', '<', 30)->get();
        foreach($commissionRecords as $record){
            addCommissionToReferals($record->user, $record->transaction);
        }
    }
}
