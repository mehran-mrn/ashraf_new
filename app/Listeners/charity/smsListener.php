<?php

namespace App\Listeners\charity;

use App\Events\charityPaymentConfirmation;
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
     * @param charityPaymentConfirmation $event
     * @return void
     */
    public function handle(charityPaymentConfirmation $event)
    {
        //
        if ($event->mobile) {
            $message = notification_messages('sms', 'charityPayment');
            if ($event->type == "champion") {
                sendSms($event->mobile, strip_tags($message['text']));
            } elseif ($event->type == "period") {
                sendSms($event->mobile, strip_tags($message['text']));
            }
        }
    }
}
