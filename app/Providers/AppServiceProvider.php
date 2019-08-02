<?php

namespace App\Providers;

use App\charity_payment_patern;
use App\charity_payment_title;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        //
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        \View::composer("*", function ($view) {
            $view->with('menu', charity_payment_patern::all());
        });
        Schema::defaultStringLength(191);
    }
}
