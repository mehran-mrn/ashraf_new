<?php

namespace App\Listeners;

use App\Mail\userRegisterMail;
use Illuminate\Support\Facades\Mail;

class mailListener
{
    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        Mail::to($event->user->email)->send(new userRegisterMail($event->user));
    }
}
