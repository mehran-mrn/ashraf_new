<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'globals\global_view@index');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//=========================================
// ------------admin panel-----------------
//=========================================
Route::prefix('panel')->group(function () {

    Route::get('dashboard', 'panel\panel_view@dashboard')->name('dashboard');


    Route::prefix('user_manager')->group(function () {
        Route::get('users_list', 'panel\panel_view@users_list')->name('users_list');
        Route::post('register', 'panel\user_manager@register')->name('panel_register_user');
    });

    Route::prefix('ajax')->group(function (){
        Route::get('/register', 'panel\panel_view@register_form')->name('panel_register_form');
        Route::get('/form_notification', 'panel\panel_view@form_notification')->name('panel_form_notification');

    });

});
//=========================================


//=========================================
// ------------Global View-----------------
//=========================================
Route::prefix('ajax')->group(function (){
    Route::get('/register', 'globals\global_view@register_form')->name('global_register_form');
    Route::post('/register', 'globals\global_view@register_form_store')->name('global_register_form_store');

});
//=========================================

