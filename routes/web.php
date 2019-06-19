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

    Route::get('images/users/{media_id}', [
        'as'         => 'images.show',
        'uses'       => 'private_doc@show',
        'middleware' => 'auth',
    ]);
    Route::prefix('user_manager')->group(function () {

        Route::get('users_list', 'panel\panel_view@users_list')->name('users_list');
        Route::post('register', 'panel\user_manager@register')->name('panel_register_user');

        Route::get('permission/{permission_id}', 'panel\panel_view@permission_assign')->name('permission_assign_page');
        Route::post('assign_user_to_permission', 'panel\user_manager@assign_user_to_permission')->name('assign_user_to_permission');
        Route::post('assign_role_to_permission', 'panel\user_manager@assign_role_to_permission')->name('assign_role_to_permission');
        Route::get('user_permissions/{user_id}', 'panel\panel_view@user_permission_assign')->name('user_permission_assign_page');//***
        Route::post('assign_role_to_user', 'panel\user_manager@assign_role_to_user')->name('assign_role_to_user');
        Route::post('assign_permission_to_user', 'panel\user_manager@assign_permission_to_user')->name('assign_permission_to_user');

        Route::get('permissions_list', 'panel\panel_view@permissions_list')->name('permissions_list');
        Route::post('register_permission', 'panel\user_manager@register_permission')->name('panel_register_permission');

        Route::get('roles_list', 'panel\panel_view@roles_list')->name('roles_list');
        Route::post('register_role', 'panel\user_manager@register_role')->name('panel_register_role');

        Route::get('teams_list', 'panel\panel_view@teams_list')->name('teams_list');
        Route::get('teams_list/{team_id}', 'panel\panel_view@permissions_team_list')->name('permissions_team_list');

        Route::post('update', 'panel\user_manager@teams_list_update')->name('update_nestable_teams');

        Route::post('register_team', 'panel\user_manager@register_team')->name('panel_register_team');

    });

    Route::prefix('caravan')->group(function () {
        Route::get('dashboard', 'panel\panel_view@caravan_dashboard')->name('caravan_dashboard');
        Route::get('hosts_list', 'panel\panel_view@hosts_list')->name('hosts_list');
        Route::post('host_data', 'panel\caravan@host_data')->name('host_data');
        Route::get('add_caravan_page', 'panel\panel_view@add_caravan_page')->name('add_caravan_page');
        Route::get('caravans_list', 'panel\panel_view@caravans_list')->name('caravans_list');
        Route::get('caravan/{caravan_id}', 'panel\panel_view@caravan')->name('caravan');
        Route::post('caravan_data', 'panel\caravan@caravan_data')->name('caravan_data');
        Route::post('add_person_to_caravan', 'panel\caravan@add_person_to_caravan')->name('add_person_to_caravan');
    });

    Route::prefix('blog')->group(function () {
        Route::get('post_add', 'panel\panel_view@post_add')->name('post_add');
        Route::post('post_add', 'panel\blogs@post_add_store')->name('post_add_store');

        Route::get('post_list', 'panel\panel_view@post_list')->name('post_list');
        Route::get('post_edit_form/{post_id}', 'panel\panel_view@post_edit_form')->name('post_edit_form');
        Route::post('post_update/{post_id}', 'panel\blogs@post_update')->name('post_update');
        Route::get('post_delete', 'panel\blogs@post_delete')->name('post_delete');

        Route::get('category_list', 'panel\panel_view@category_list')->name('category_list');
        Route::get('category_add_form', 'panel\panel_view@category_add_form')->name('category_add_form');
        Route::post('category_add', 'panel\blogs@category_add')->name('category_add');
        Route::get('category_delete', 'panel\blogs@category_delete')->name('category_delete');
        Route::get('category_edit_form/{cat_id}', 'panel\panel_view@category_edit_form')->name('category_edit_form');
        Route::post('category_update/{cat_id}', 'panel\blogs@category_update')->name('category_update');
    });

    Route::prefix('setting')->group(function () {
        Route::get('cities', 'panel\panel_view@cities_list')->name('cities_list');
        Route::get('gateway_setting', 'panel\panel_view@gateway_setting')->name('gateway_setting');
        Route::get('gateway_add', 'panel\panel_view@gateway_add')->name('gateway_add');
        Route::post('gateway_add', 'panel\setting@gateway_add')->name('gateway_add_store');
        Route::get('gateway_edit', 'panel\panel_view@gateway_edit')->name('gateway_edit');
        Route::post('gateway_update', 'panel\setting@gateway_update')->name('gateway_update');
        Route::get('gateway_delete/{gateway_id}', 'panel\setting@gateway_delete')->name('gateway_delete');
    });



    Route::prefix('store')->group(function () {
        Route::get('product_add', 'panel\panel_view@product_add')->name('product_add');
        Route::get('product_list', 'panel\panel_view@product_list')->name('product_list');
        Route::get('product_category', 'panel\panel_view@product_category')->name('product_category');
        Route::get('manage_orders', 'panel\panel_view@manage_orders')->name('manage_orders');
        Route::get('store_setting', 'panel\panel_view@store_setting')->name('store_setting');

        Route::get('discount_code', 'panel\panel_view@discount_code')->name('discount_code');
        Route::get('discount_add_form', 'panel\panel_view@discount_add_form')->name('discount_add_form');
        Route::post('discount_add', 'panel\store@discount_add')->name('discount_add');
        Route::post('check_discount_code', 'panel\store@check_discount_code')->name('check_discount_code');


    });

    Route::prefix('ajax')->group(function () {
        Route::get('/register', 'panel\panel_view@register_form')->name('panel_register_form');
        Route::get('/register_permission', 'panel\panel_view@register_permission_form')->name('panel_register_permission_form');
        Route::get('/register_role', 'panel\panel_view@register_role_form')->name('panel_register_role_form');
        Route::get('/register_team', 'panel\panel_view@register_team_form')->name('panel_register_team_form');
        Route::get('/assign_user_to_permission_form/{permission_id}', 'panel\panel_view@assign_user_to_permission_form')->name('assign_user_to_permission_form');
        Route::get('/assign_role_to_permission_form/{permission_id}/{old?}/{team_id?}', 'panel\panel_view@assign_role_to_permission_form')->name('assign_role_to_permission_form');
        Route::get('/assign_role_to_user_form/{user_id}', 'panel\panel_view@assign_role_to_user_form')->name('assign_role_to_user_form');
        Route::post('/delete_role_from_permission/{permission_id}/{team_id?}', 'panel\user_manager@delete_role_from_permission')->name('delete_role_from_permission');
        Route::post('/delete_user_from_permission/{permission_id}/{user_id}', 'panel\user_manager@delete_user_from_permission')->name('delete_user_from_permission');
        Route::post('/delete_role_from_user/{role_id}/{user_id}', 'panel\user_manager@delete_role_from_user')->name('delete_role_from_user');
        Route::get('/host_form/{host_id?}', 'panel\panel_view@load_host_form')->name('load_host_form');
        Route::post('/delete_caravan_host/{host_id}', 'panel\caravan@delete_caravan_host')->name('delete_caravan_host');
        Route::get('register_to_caravan/{caravan_id}', 'panel\panel_view@register_to_caravan')->name('register_to_caravan');
        Route::post('register_to_caravan}', 'panel\panel_view@register_to_caravan_post')->name('register_to_caravan_post');
        Route::post('/validate_national_code', 'panel\caravan@validate_national_code')->name('validate_national_code');

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


