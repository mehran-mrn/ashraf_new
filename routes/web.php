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
Route::get('logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');


//=========================================
// ------------admin panel-----------------
//=========================================

Route::middleware('auth')->prefix('panel')->group(function () {

    Route::get('dashboard', 'panel\panel_view@dashboard')->name('dashboard');

    Route::prefix('user_manager')->group(function () {

        Route::get('users_list', 'panel\panel_view@users_list')->name('users_list');
        Route::post('register', 'panel\user_manager@register')->name('panel_register_user');

        Route::get('permission/{permission_id}', 'panel\panel_view@permission_assign')->name('permission_assign_page');
        Route::post('assign_user_to_permission', 'panel\user_manager@assign_user_to_permission')->name('assign_user_to_permission');
        Route::post('assign_role_to_permission', 'panel\user_manager@assign_role_to_permission')->name('assign_role_to_permission');
        Route::get('user_permissions/{user_id}', 'panel\panel_view@user_permission_assign')->name('user_permission_assign_page');//***
        Route::post('assign_role_to_user', 'panel\user_manager@assign_role_to_user')->name('assign_role_to_user');

        Route::get('permissions_list', 'panel\panel_view@permissions_list')->name('permissions_list');
        Route::post('register_permission', 'panel\user_manager@register_permission')->name('panel_register_permission');

        Route::get('roles_list', 'panel\panel_view@roles_list')->name('roles_list');
        Route::post('register_role', 'panel\user_manager@register_role')->name('panel_register_role');

        Route::get('teams_list', 'panel\panel_view@teams_list')->name('teams_list');
        Route::get('teams_list/{team_id}', 'panel\panel_view@permissions_team_list')->name('permissions_team_list');

        Route::post('update', 'panel\user_manager@teams_list_update')->name('update_nestable_teams');

        Route::post('register_team', 'panel\user_manager@register_team')->name('panel_register_team');

    });
    Route::prefix('blog')->group(function () {
        Route::get('add_post', 'panel\panel_view@add_post')->name('add_post');
        Route::get('post_list', 'panel\panel_view@post_list')->name('post_list');
    });

    Route::prefix('ajax')->group(function () {
        Route::get('/register', 'panel\panel_view@register_form')->name('panel_register_form');
        Route::get('/register_permission', 'panel\panel_view@register_permission_form')->name('panel_register_permission_form');
        Route::get('/register_role', 'panel\panel_view@register_role_form')->name('panel_register_role_form');
        Route::get('/register_team', 'panel\panel_view@register_team_form')->name('panel_register_team_form');
        Route::get('/assign_user_to_permission_form/{permission_id}', 'panel\panel_view@assign_user_to_permission_form')->name('assign_user_to_permission_form');
        Route::get('/assign_role_to_permission_form/{permission_id}/{old?}/{team_id?}', 'panel\panel_view@assign_role_to_permission_form')->name('assign_role_to_permission_form');
        Route::get('/assign_role_to_user_form/{user_id}', 'panel\panel_view@assign_role_to_user_form')->name('assign_role_to_user_form');
        Route::get('/delete_role_from_permission/{permission_id}/{team_id}', 'panel\user_manager@delete_role_from_permission')->name('delete_role_from_permission');

//        Route::get('/form_notification', 'panel\panel_view@form_notification')->name('panel_form_notification');

    });

});
//=========================================


//=========================================
// ------------Global View-----------------
//=========================================
Route::prefix('ajax')->group(function () {
    Route::get('/register', 'globals\global_view@register_form')->name('global_register_form');
    Route::post('/register', 'globals\global_controller@register_form_store')->name('global_register_form_store');

    Route::get('/login', 'globals\global_view@login_form')->name('global_login_form');

    Route::post('/check_email', 'globals\global_controller@check_email')->name('check_email');
});

Route::prefix('page')->group(function () {
    Route::get('/register', 'globals\global_view@register_page')->name('global_register_page');
    Route::get('/login', 'globals\global_view@login_page')->name('global_login_page');

});
//=========================================

