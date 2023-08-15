<?php

namespace App\Console;

use Illuminate\Support\Facades\DB;
use App\Console\Commands\JadwalRkpdCommand;
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
        $schedule->command(JadwalRkpdCommand::class)->everyMinute();
        // $schedule->call(function () {
        //     DB::table('jadwal_rkpds')->truncate();
        // });
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
