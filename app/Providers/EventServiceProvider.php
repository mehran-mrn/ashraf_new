<?php

namespace App\Providers;

use App\Events\userRegisterEvent;
use App\Listeners\userRegisterListener;
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
                \App\Listeners\userRegisterListener::class,
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
