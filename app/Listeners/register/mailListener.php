<?php

namespace App\Listeners\register;

use App\Events\userRegisterEvent;
use App\Mail\userRegisterMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

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
     * @param  userRegisterEvent  $event
     * @return void
     */
    public function handle(userRegisterEvent $event)
    {
        if ($event->user->email){
        Mail::to($event->user->email)->send(new userRegisterMail($event->user));
        }
    }
}
