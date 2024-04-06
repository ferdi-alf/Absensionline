<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\RefreshDataHarian::class,
        \App\Console\Commands\RefreshDataMingguan::class,
        // Tambahkan kelas-kelas command lainnya jika diperlukan
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('refresh:data-harian')
            ->timezone('Asia/Jakarta')
            ->dailyAt('00:00');

        $schedule->command('refresh:data-mingguan')
            ->timezone('Asia/Jakarta')
            ->weeklyOn(1, '00:00');

        $schedule->command('refresh:data-bulanan')
            ->timezone('Asia/Jakarta')
            ->monthlyOn(1, '00:00');
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
