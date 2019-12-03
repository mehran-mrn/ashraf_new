<?php

namespace App\Providers;

use App\charity_payment_patern;
use App\charity_payment_title;
use App\menu;
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
                'menu'=> menu::where('local',App()->getLocale())->where('parent_id',0)->where('type','top')->orderBy('order')->get(),
                'side_menu'=> menu::where('local',App()->getLocale())->where('type','side')->orderBy('order')->get(),
//                'menu'=> charity_payment_patern::get(),
//                'menu_blog'=> BlogEtcCategory::where("lang",app()->getLocale())->orderBy("category_name")->get(),
//                'menu_special'=> BlogEtcSpecificPages::where("lang",app()->getLocale())->orderBy("category_name")->get(),
            ]);
        });
        Schema::defaultStringLength(191);
    }
}
