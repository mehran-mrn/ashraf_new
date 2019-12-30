<?php

namespace App\Console\Commands;

use App\charity_periods_transaction;
use App\notification_template;
use App\User;
use Illuminate\Console\Command;

class notifyPeriodCration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:periodCreation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'sms notice to periodic creation';

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
        $periodicTransaction = charity_periods_transaction::where('status','unpaid')
            ->where('payment_date','>=',date('Y-m-d',strtotime(date('Y-m-d')." -1 day")))
            ->where('payment_date','<',date('Y-m-d'))
            ->get();
        $smsText = notification_messages('sms','reminder');

        foreach ($periodicTransaction as $value){
            $user = User::with('people')->find($value['user_id']);
            $variables = [];
            $name='';
            $gender='';
            if ($user and $user['people'] and $user['people']['name'] and $user['people']['family']){
                $gender = ($user['people']['gender'] == '2'?"خانم":"آقای");
                $name = $gender . " " . $user['people']['name']." ".$user['people']['family'];
                $variables['name'] = $name;
                $smsText = notification_messages('sms','reminder',$variables);
            }
            else{
                $smsText = notification_messages('sms','reminder');

            }
            $phone = $user['phone'];
            if ($phone){
                sendSms($phone,$smsText['text']);
            }
        }
    }
}
