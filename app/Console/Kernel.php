<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\ImportGoodsPrincipals::class,
        Commands\ImportGoodsLimit::class,
        Commands\ImportGoodsStore::class,
        Commands\ImportOrderExpress::class,
        Commands\CheckOrderExpress::class,
        Commands\ImportOrderDecision::class,
        Commands\SubscribeExpressTrace::class,
        Commands\UpdateExpressTraceMt::class,
        Commands\FormatExpressTrace::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            logger('xxxx', ['sddd'=>'xxx', 'time'=>date('Y-m-d H:i:s')]);
        })->everyMinute();

        // $schedule->command('inspire')
        //          ->hourly();
    }
}
