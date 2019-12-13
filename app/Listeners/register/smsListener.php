<?php

namespace App\Listeners\register;

use App\Events\userRegisterEvent;
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
     * @param  userRegisterEvent  $event
     * @return void
     */
    public function handle(userRegisterEvent $event)
    {
        //
        if ($event->user->phone){
            $template = notification_template::where('key','new_register')->first();
            $message = str_replace("{name}",$event->user->name,$template->text);
            sendSms($event->user->phone,$message);
        }
    }
}
