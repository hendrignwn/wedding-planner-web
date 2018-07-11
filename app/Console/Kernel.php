<?php

namespace App\Console;

use App\Message;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        Log::useDailyFiles(storage_path() . '/logs/scheduler.log');
        Log::info('Running cron job');
        $schedule->call(function() {
            Message::sendPushNotification();
            Log::info('Scheduler is running: daily at 10:00');
        })->dailyAt('10:00');
        
        $schedule->call(function() {
            Message::sendPushNotification();
            Log::info('Scheduler is running: daily at 18:00');
        })->dailyAt('18:00');
        
        $schedule->call(function() {
            Message::sendPushNotification();
            Log::info('Scheduler is running: daily at 23:00');
        })->dailyAt('23:00');
        
        $schedule->call(function() {
            \App\ProcedurePreparation::sendPushNotification();
            Log::info('Scheduler is running: every 15 minutes');
        })->everyFifteenMinutes();
        
        $schedule->call(function() {
            \App\ProcedurePayment::sendPushNotification();
            Log::info('Scheduler is running: daily at 08:00');
        })->dailyAt('09:00');
        
        $schedule->call(function() {
            \App\ProcedurePayment::sendPushNotification();
            Log::info('Scheduler is running: daily at 14:00');
        })->dailyAt('14:00');
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
