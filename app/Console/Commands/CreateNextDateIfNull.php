<?php

namespace App\Console\Commands;

use App\charity_period;
use Illuminate\Console\Command;

class CreateNextDateIfNull extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Create:NextDateIfNull';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Next Date If Null';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        sendSms('09365944410',"test");

        $charity = charity_period::whereNull('next_date')->get();
        foreach ($charity as $item) {
            $Day = date("d",strtotime($item['start_date']));
                $nextMonthStrTime = strtotime(date("Y-m-d")." +".$item['period'] ." months");
                $nextDate =  strtotime(date("Y-m",$nextMonthStrTime)."-01 +".$Day." days");
            charity_period::where('id',$item['id'])->update(['next_date'=>date("Y-m-d",$nextDate)]);
        }
        return true;

    }
}
