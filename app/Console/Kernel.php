<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\KirimNotifSP2DBank;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\StatusSpm::class,
        Commands\UpdateStatusSpmSelesai::class,
        Commands\KirimNotifDaily::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Run the task every day at midnight
        $schedule->command('status_spm_selesai:monthly')
            ->daily();
        
            // Run the task every day at 12 PM
        $schedule->command('kirim_notif:daily')
            ->dailyAt('12:00');

        // run kirimnotifsp2dbank job every five minutes (not fix)
        // $schedule->job(new KirimNotifSP2DBank($id))->everyFiveMinutes();

        // run all queue job every five minutes
        $schedule->command('queue:listen')->everyFiveMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
