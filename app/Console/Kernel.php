<?php

namespace App\Console;

use App\Console\Commands\Schedule\Mio\SyncIntegration;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\SendEmailsCommand;
use App\Console\Commands\SendEmailsEveryHour;
use App\Console\Commands\SendEmailsEveryEvening;
use App\Jobs\ExportLoans;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        SyncIntegration::class,
		SendEmailsCommand::class,
        SendEmailsEveryHour::class,
        SendEmailsEveryEvening::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->job(new ExportLoans())
            ->cron('30 5,18 * * *')
            ->runInBackground();

        $schedule->command('mio:sync-integration')->everyTwoHours()->between('13:00', '19:00');
		$schedule->command('emails:send')->dailyAt('09:00');
        $schedule->command('emails:sendHour')->hourly();
        $schedule->command('emails:sendEvening')->dailyAt('22:00');

        $schedule->command('reports:ser-prt-business-stat-first')->dailyAt('22:00');
        $schedule->command('reports:ser-prt-business-stat-second')->dailyAt('22:10');
        $schedule->command('reports:ser-prt-industry')->dailyAt('22:20');
        $schedule->command('reports:ser-prt-investments')->dailyAt('22:30');
        $schedule->command('reports:prt')->dailyAt('22:40');
        $schedule->command('reports:ser-prt-trade')->dailyAt('22:50');

        $schedule->command('mio:import')->everyFiveMinutes()->between('7:00', '23:00');
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
