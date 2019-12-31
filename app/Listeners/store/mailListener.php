<?php

namespace App\Listeners\store;

use App\Events\storePaymentConfirmation;
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
     * @param  storePaymentConfirmation  $event
     * @return void
     */
    public function handle(storePaymentConfirmation $event)
    {
        //
    }
}
