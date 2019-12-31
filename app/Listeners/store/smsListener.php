<?php

namespace App\Listeners\store;

use App\Events\storePaymentConfirmation;
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
     * @param storePaymentConfirmation $event
     * @return void
     */
    public function handle(storePaymentConfirmation $event)
    {
        //
        if ($event->user->phone) {
            $message = notification_messages('sms', 'storeConfirmation');
            sendSms($event->user->phone, strip_tags($message['text']));
        }
    }
}
