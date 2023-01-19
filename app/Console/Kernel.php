<?php

namespace App\Console;

use App\Jobs\AddCommissionToUser;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->everyMinute();
        // $schedule->command('add:profit')->weekly()->timezone('Asia/Karachi');
        // $schedule->command('add:reward')->daily()->timezone('Asia/Karachi');
        // $schedule->job(new AddCommissionToUser())->weekdays()->timezone('Asia/Karachi');
        $schedule->command('add:profit')->everyMinute();
        $schedule->command('add:reward')->everyMinute();
        $schedule->job(new AddCommissionToUser())->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
