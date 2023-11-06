<?php

namespace App\Console;

use App\Jobs\FetchFromGuardianJob;
use App\Jobs\FetchFromNewsAPIJob;
use App\Jobs\FetchFromNYTimesJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->job(new FetchFromGuardianJob)->daily();
        $schedule->job(new FetchFromNewsAPIJob())->daily();
        $schedule->job(new FetchFromNYTimesJob())->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
