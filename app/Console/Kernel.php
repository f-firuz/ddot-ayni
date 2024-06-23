<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;


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
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('custom:task')->cron('21 8-18 * * *');

    $schedule->call(function () {
        $currentTime = now();

        $textColor = $currentTime->format('H:i') === '21' ? 'red' : 'default';

        // Сохраняем результат в базе данных
        DB::table('settings')->updateOrInsert(
            ['key' => 'text_color'],
            ['value' => $textColor, 'updated_at' => now()]
        );
    })->everyMinute();
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
