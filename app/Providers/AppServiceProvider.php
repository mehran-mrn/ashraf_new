<?php

namespace App\Providers;

use App\charity_payment_patern;
use App\charity_payment_title;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use WebDevEtc\BlogEtc\Models\BlogEtcCategory;
use WebDevEtc\BlogEtc\Models\BlogEtcSpecificPages;

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
            $view->with([
                'menu'=> charity_payment_patern::get(),
                'menu_blog'=> BlogEtcCategory::orderBy("category_name")->get(),
                'menu_special'=> BlogEtcSpecificPages::orderBy("category_name")->get(),
            ]);
        });
        Schema::defaultStringLength(191);
    }
}
