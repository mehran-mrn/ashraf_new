<?php

namespace App\Providers;

use App\Events\paymentReminder;
use App\Events\payToCharityMoney;
use App\Events\userRegisterEvent;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        userRegisterEvent::class =>
            [
                \App\Listeners\register\mailListener::class,
                \App\Listeners\register\smsListener::class,
            ],
        paymentReminder::class =>
            [
                \App\Listeners\reminder\mailListener::class,
                \App\Listeners\reminder\smsListener::class,
            ],
        payToCharityMoney::class =>
            [
                \App\Listeners\payment\mailListener::class,
                \App\Listeners\payment\smsListener::class,
            ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
