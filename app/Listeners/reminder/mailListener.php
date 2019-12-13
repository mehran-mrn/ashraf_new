<?php

namespace App\Listeners\reminder;

use App\Events\paymentReminder;
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
     * @param  paymentReminder  $event
     * @return void
     */
    public function handle(paymentReminder $event)
    {
        //
    }
}
