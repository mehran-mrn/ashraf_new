<?php

namespace App\Listeners\payment;

use App\Events\payToCharityMoney;
use App\notification_template;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class smsListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  payToCharityMoney  $event
     * @return void
     */
    public function handle(payToCharityMoney $event)
    {
        if ($event->user->phone){
            $template = notification_template::where('key','payConfirm')->first();
            $message = str_replace("{name}",$event->user->name,$template->text);
            sendSms($event->user->phone,$message);
        }
    }
}
