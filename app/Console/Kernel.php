<?php

namespace App\Console;

use App\charity_period;
use App\charity_periods_transaction;
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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        $schedule->call(function () {
            $charity = charity_period::where(
                [
                    ['status', '=', 'active'],
                    ['next_date', '<=', date("Y-m-d")]
                ])->get();
            foreach ($charity as $item) {
                $nextDate = strtotime($item['next_date']);
                $now = time();
                if ($now >= $nextDate) {
                    charity_periods_transaction::create(
                        [
                            'user_id' => $item['user_id'],
                            'period_id' => $item['id'],
                            'payment_date' => $item['next_date'],
                            'amount' => $item['amount'],
                            'description' => "پرداخت دوره ای شماره " . $item['id'],
                            'status' => "unpaid",
                        ]
                    );
                    charity_period::where('id', $item['id'])->update(
                        [
                            'next_date' => date('Y-m-d', strtotime("+" . $item['period'] . " month", time()))
                        ]
                    );
                }
            }
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
