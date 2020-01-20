<?php

namespace App\Listeners\charity;

use App\Events\charityPaymentConfirmation;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class mailListener
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
     * @param  charityPaymentConfirmation  $event
     * @return void
     */
    public function handle(charityPaymentConfirmation $event)
    {
        //
    }
}
