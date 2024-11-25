<?php

namespace App\Console;

use App\Jobs\AvisoEmail;
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
     
        //$schedule->job(new AvisoEmail)->dailyAt('06:00');
        $schedule->command('send-invoice-reminder')->dailyAt('07:00');
        $schedule->command('assinar:renovar')->dailyAt('08:00');
      

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
