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


Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');
Route::get('/home', 'HomeController@index')->name('home');

//=========================================
// ------------admin panel-----------------
//=========================================

Route::middleware('auth')->prefix('panel')->group(function () {

    //======================================
    //--------------Panel View-------------
    //======================================
    Route::get('dashboard', 'panel\panel_view@dashboard')->name('dashboard');
    Route::get('images/users/{media_id}', [
        'as' => 'images.show',
        'uses' => 'private_doc@show',
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
        Route::post('action_to_person_caravan_status', 'panel\caravan@action_to_person_caravan_status')->name('action_to_person_caravan_status');
        Route::post('/change_caravan_status', 'panel\caravan@change_caravan_status')->name('change_caravan_status');
        Route::post('/cancel_caravan_status', 'panel\caravan@cancel_caravan_status')->name('cancel_caravan_status');
        Route::post('/back_caravan_status', 'panel\caravan@back_caravan_status')->name('back_caravan_status');
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
        Route::get('gateway_edit/{gat_id}', 'panel\panel_view@gateway_edit')->name('gateway_edit');
        Route::post('gateway_update/{gat_id}', 'panel\setting@gateway_update')->name('gateway_update');
        Route::get('gateway_delete/{gateway_id}', 'panel\setting@gateway_delete')->name('gateway_delete');


        Route::get('setting_how_to_send', 'panel\panel_view@setting_how_to_send')->name('setting_how_to_send');
        Route::get('setting_how_to_send_add', 'panel\panel_view@setting_how_to_send_add')->name('setting_how_to_send_add');
        Route::post('setting_how_to_send_store', 'panel\setting@setting_how_to_send_store')->name('setting_how_to_send_store');

        Route::get('setting_how_to_send_edit', 'panel\panel_view@setting_how_to_send_edit')->name('setting_how_to_send_edit');
        Route::get('setting_how_to_send_delete', 'panel\setting@setting_how_to_send_delete')->name('setting_how_to_send_delete');
        Route::post('setting_how_to_send_update', 'panel\setting@setting_how_to_send_update')->name('setting_how_to_send_update');

    });
    Route::prefix('store')->group(function () {
        Route::get('product_add', 'panel\panel_view@product_add')->name('product_add');
        Route::post('store_product_add', 'panel\store@store_product_add')->name('store_product_add');
        Route::get('product_list', 'panel\panel_view@product_list')->name('product_list');
        Route::get('store_product_edit/{pro_id}', 'panel\panel_view@store_product_edit')->name('store_product_edit');
        Route::post('store_product_update/{pro_id}', 'panel\store@store_product_update')->name('store_product_update');
        Route::get('store_product_delete/{pro_id}', 'panel\store@store_product_delete')->name('store_product_delete');
        Route::get('store_items', 'panel\panel_view@store_items')->name('store_items');

        Route::get('store_category', 'panel\panel_view@store_category')->name('store_category');
        Route::post('store_category_add', 'panel\store@store_category_add')->name('store_category_add');
        Route::get('store_category_add_form', 'panel\panel_view@store_category_add')->name('store_category_add_form');
        Route::get('store_category_edit_form/{cat_id}', 'panel\panel_view@store_category_edit_form')->name('store_category_edit_form');
        Route::post('store_category_update/{cat_id}', 'panel\store@store_category_update')->name('store_category_update');
        Route::get('store_category_delete/{cat_id}', 'panel\store@store_category_delete')->name('store_category_delete');
        Route::post('store_category_check', 'panel\store@store_category_check')->name('store_category_check');


        Route::get('store_category_tree_view', 'panel\store@store_category_tree_view')->name('store_category_tree_view');
        Route::get('store_items_category_add_form', 'panel\panel_view@store_items_category_add_form')->name('store_items_category_add_form');
        Route::post('store_items_category_add', 'panel\store@store_items_category_add')->name('store_items_category_add');
        Route::get('store_items_add_form', 'panel\panel_view@store_items_add_form')->name('store_items_add_form');
        Route::post('store_items_add', 'panel\store@store_items_add')->name('store_items_add');
        Route::get('store_items_delete', 'panel\store@store_item_delete')->name('store_items_delete');
        Route::get('store_items_edit_form', 'panel\panel_view@store_items_edit_form')->name('store_items_edit_form');
        Route::post('store_items_update/{item_id}', 'panel\store@store_items_update')->name('store_items_update');
        Route::get('store_items_category_edit_form', 'panel\panel_view@store_items_category_edit_form')->name('store_items_category_edit_form');
        Route::get('store_items_category_delete/{cat_id}', 'panel\store@store_items_category_delete')->name('store_items_category_delete');


        Route::get('manage_orders', 'panel\panel_view@manage_orders')->name('manage_orders');
        Route::get('store_setting', 'panel\panel_view@store_setting')->name('store_setting');

        Route::get('discount_code', 'panel\panel_view@discount_code')->name('discount_code');
        Route::get('discount_add_form', 'panel\panel_view@discount_add_form')->name('discount_add_form');
        Route::get('discount_code_edit_form/{dis_id}', 'panel\panel_view@discount_code_edit_form')->name('discount_code_edit_form');
        Route::post('discount_update/{dis_id}', 'panel\store@discount_code_update')->name('discount_update');
        Route::get('discount_code_delete/{dis_id}', 'panel\store@discount_code_delete')->name('discount_code_delete');
        Route::post('discount_add', 'panel\store@discount_add')->name('discount_add');
        Route::post('discount_code_check', 'panel\store@discount_code_check')->name('discount_code_check');


    });
    Route::prefix('building')->group(function () {
        Route::get('dashboard', 'panel\panel_view@building_dashboard')->name('building_dashboard');
        Route::get('building_project/{project_id}', 'panel\panel_view@building_project')->name('building_project');
        Route::get('building_types', 'panel\panel_view@building_types')->name('building_types');
        Route::get('building_archive', 'panel\panel_view@building_archive')->name('building_archive');
        Route::post('submit_project_data', 'panel\building@submit_project_data')->name('submit_project_data');
        Route::post('submit_project_type_data', 'panel\building@submit_project_type_data')->name('submit_project_type_data');
        Route::get('building_type_page/{building_type_id}', 'panel\panel_view@building_type_page')->name('building_type_page');
        Route::get('building_type_item_add_form/{type_id}/{item_id?}', 'panel\panel_view@building_type_item_add_form')->name('building_type_item_add_form');
        Route::post('submit_building_type_item', 'panel\building@submit_building_type_item')->name('submit_building_type_item');
        Route::post('delete_building_type_item/{building_type_item_id}', 'panel\building@delete_building_type_item')->name('delete_building_type_item');
        Route::get('load_new_building_form/{project_id?}', 'panel\panel_view@load_new_building_form')->name('load_new_building_form');
//        Route::get('ticket/{project_id?}', 'panel\panel_view@project_ticket')->name('project_ticket');
        Route::get('load_building_items_form/{project_id}', 'panel\panel_view@load_building_items_form')->name('load_building_items_form');
        Route::post('edit_project_items/{project_id}', 'panel\building@edit_project_items')->name('edit_project_items');
        Route::post('/delete_project_item/{project_id}/{item_id}', 'panel\building@delete_project_item')->name('delete_project_item');
        Route::get('/new_ticket/{project_id}', 'panel\panel_view@new_ticket')->name('building_new_ticket');
        Route::post('/new_ticket/{project_id}', 'panel\building@new_ticket')->name('building_new_ticket_submit');
        Route::get('/ticket/{ticket_id}', 'panel\panel_view@ticket_page')->name('ticket_page');
        Route::post('/ticket_note/{ticket_id}', 'panel\building@add_ticket_note')->name('add_ticket_note');
        Route::get('load_building_users_form/{project_id}', 'panel\panel_view@load_building_users_form')->name('load_building_users_form');
        Route::post('edit_project_users/{project_id}', 'panel\building@edit_project_users')->name('edit_project_users');
        Route::get('load_building_ticket_close_form/{ticket_id}', 'panel\panel_view@load_building_ticket_close_form')->name('load_building_ticket_close_form');
        Route::post('close_building_ticket/{ticket_id}', 'panel\building@close_building_ticket')->name('close_building_ticket');

    });
    Route::prefix('charity')->group(function () {
        Route::get('charity_payment_title', 'panel\panel_view@charity_payment_title')->name('charity_payment_title');
        Route::get('charity_payment_title_add/{payment_pattern_id?}/{payment_title_id?}', 'panel\panel_view@charity_payment_title_add')->name('charity_payment_title_add');
        Route::post('charity_payment_title_add/{payment_pattern_id?}/{payment_title_id?}', 'panel\charity@charity_payment_title_add')->name('charity_payment_title_add');
        Route::post('charity_payment_title_delete/{payment_pattern_id}/{payment_title_id}', 'panel\charity@charity_payment_title_delete')->name('charity_payment_title_delete');
        Route::get('charity_payment_title_recover/{payment_pattern_id?}/{payment_title_id?}', 'panel\panel_view@charity_payment_title_recover')->name('charity_payment_title_recover');
        Route::post('charity_payment_title_recover/{payment_pattern_id?}/{payment_title_id?}', 'panel\charity@charity_payment_title_recover')->name('charity_payment_title_recover');
        Route::get('charity_payment_pattern_add/{payment_pattern_id?}', 'panel\panel_view@charity_payment_pattern_add')->name('charity_payment_pattern_add');
        Route::post('charity_payment_pattern_add/{payment_pattern_id?}', 'panel\charity@charity_payment_pattern_add')->name('charity_payment_pattern_add');
        Route::post('charity_payment_pattern_delete/{payment_pattern_id}', 'panel\charity@charity_payment_pattern_delete')->name('charity_payment_pattern_delete');
        Route::get('charity/payment_list/', 'panel\panel_view@charity_payment_list')->name('charity_payment_list');
        Route::get('periods/list', 'panel\charity@charity_periods_list')->name('charity_periods_list');
        Route::get('periods/show/{id}/{user_id}', 'panel\charity@charity_periods_show')->name('charity_periods_show');
        Route::post('periods/show/approve/{id}', 'panel\charity@charity_payment_approve')->name('charity_payment_approve');

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
        Route::get('register_to_caravan/{caravan_id}/{person_caravan_id?}', 'panel\panel_view@register_to_caravan')->name('register_to_caravan');
        Route::post('register_to_caravan}', 'panel\panel_view@register_to_caravan_post')->name('register_to_caravan_post');
        Route::post('/validate_national_code', 'panel\caravan@validate_national_code')->name('validate_national_code');
        Route::get('/change_caravan_status/{caravan_id}/{status}', 'panel\panel_view@change_caravan_status_form')->name('change_caravan_status_form');
        Route::get('/caravans_echart_data', 'panel\panel_view@caravans_echart_data')->name('caravans_echart_data');
        Route::get('/building_type_form/{building_type_id?}', 'panel\panel_view@load_building_type_form')->name('load_building_type_form');
        Route::post('/delete_building_type/{building_type_id}', 'panel\building@delete_building_type')->name('delete_building_type');

//        Route::get('/form_notification', 'panel\panel_view@form_notification')->name('panel_form_notification');

    });
    Route::prefix('media')->group(function () {
        Route::post('/upload_files', 'panel\Media@upload_files')->name('upload_files');
        Route::post('/upload_files_category/', 'panel\Media@upload_files_category')->name('upload_files_category');
    });

    Route::prefix('gallery')->group(function () {
        Route::get('list_video_galleries', 'panel\panel_view@list_video_galleries')->name('list_video_galleries');
        Route::get('video/add_modal', 'panel\panel_view@add_video_galleries_modal')->name('add_video_galleries_modal');
        Route::post('video/add', 'panel\Media@add_video')->name('add_video');
        Route::delete('video_remove/{id}', 'panel\Media@video_remove')->name('video_remove');

        Route::get('list', 'panel\panel_view@gallery_add')->name('gallery_add');
        Route::get('category/add', 'panel\panel_view@gallery_add_modal')->name('gallery_add_modal');
        Route::post('category/add', 'panel\Media@gallery_category_add')->name('gallery_category_add');
        Route::get('category/{id}', 'panel\panel_view@gallery_category_view')->name('gallery_category_view');
        Route::delete('category/{id}', 'panel\Media@gallery_category_remove')->name('gallery_category_remove');
        Route::delete('category/image/{id}', 'panel\Media@gallery_category_image_remove')->name('gallery_category_image_remove');
        Route::POST('media/info', 'panel\Media@gallery_media_info')->name('gallery_media_info');
        Route::post('media/edit', 'panel\Media@gallery_media_edit')->name('gallery_media_edit');
        Route::get('media/default/{cat_id}/{media_id}', 'panel\Media@gallery_category_image_default')->name('gallery_category_image_default');
    });

    Route::group(['prefix' => 'blog_setting'], function () {
        Route::get('/display_statistics',
            'panel\panel_view@display_statistics')
            ->name('display_statistics');
        Route::get('/display_statistics_form/{option_id?}', 'panel\panel_view@load_display_statistics_form')->name('load_display_statistics_form');
        Route::post('/submit_display_statistics', 'panel\setting@submit_display_statistics')->name('submit_display_statistics');
        Route::post('/delete_display_statistics/{option_id}', 'panel\setting@delete_display_statistics')->name('delete_display_statistics');
        Route::get('/adv_links', 'panel\panel_view@adv_links')->name('adv_links');
        Route::get('/adv_bar_form/{option_id?}', 'panel\panel_view@load_adv_bar_form')->name('adv_bar_form');
        Route::post('/submit_adv_bar', 'panel\setting@submit_adv_bar')->name('submit_adv_bar');
        Route::post('/delete_adv_bar/{option_id}', 'panel\setting@delete_adv_bar')->name('delete_adv_bar');
        Route::get('/adv_card_form/{option_id?}', 'panel\panel_view@load_adv_card_form')->name('adv_card_form');
        Route::post('/submit_adv_card', 'panel\setting@submit_adv_card')->name('submit_adv_card');
        Route::post('/delete_adv_card/{option_id}', 'panel\setting@delete_adv_card')->name('delete_adv_card');

    });
    //======================================
    //-----------End Panel View------------
    //======================================


    //======================================
    //--------------Global View-------------
    //======================================
    Route::get('/profile', 'globals\global_view@profile_page')->name('global_profile');
    Route::get('/change_password', 'globals\global_view@change_password')->name('global_profile_change_password');
    Route::get('/edit_information', 'globals\global_view@edit_information')->name('global_profile_edit_information');
    //======================================
    //-----------End Global View------------
    //======================================
});
//=========================================

//=========================================
// ------------Blog ETC -------------------
//=========================================

Route::group(['middleware' => ['web'], 'namespace' => 'blog'], function () {

    /** The main public facing blog routes - show all posts, view a category, rss feed, view a single post, also the add comment route */
    Route::group(['prefix' => config('blogetc.blog_prefix', 'blog')], function () {

        Route::get('/', 'BlogEtcReaderController@index')
            ->name('blogetc.index');

        Route::get('/search', 'BlogEtcReaderController@search')
            ->name('blogetc.search');

        Route::get('/feed', 'BlogEtcRssFeedController@feed')
            ->name('blogetc.feed'); //RSS feed

        Route::get('/category/{categorySlug}',
            'BlogEtcReaderController@view_category')
            ->name('blogetc.view_category');

        Route::get('/{blogPostSlug}',
            'BlogEtcReaderController@viewSinglePost')
            ->name('blogetc.single');


        // throttle to a max of 10 attempts in 3 minutes:
        Route::group(['middleware' => 'throttle:10,3'], function () {
            Route::post('save_comment/{blogPostSlug}',
                'BlogEtcCommentWriterController@addNewComment')
                ->name('blogetc.comments.add_new_comment');
        });

    });


    /* Admin backend routes - CRUD for posts, categories, and approving/deleting submitted comments */
    Route::group(['prefix' => config('blogetc.admin_prefix', 'blog_admin')], function () {

        Route::get('/', 'BlogEtcAdminController@index')
            ->name('blogetc.admin.index');

        Route::get('/blog_slider', 'BlogEtcAdminController@slider')
            ->name('blog_slider');
        Route::get('/slider_page/{slider_id?}', 'BlogEtcAdminController@slider_page')
            ->name('slider_page');
        Route::post('/slider_page/{slider_id?}', 'BlogEtcAdminController@save_slider')
            ->name('slider_page');
        Route::post('/delete_slider/{slider_id?}', 'BlogEtcAdminController@delete_slider')
            ->name('delete_blog_slider');

        Route::get('/blog_gallery', 'BlogEtcAdminController@gallery')
            ->name('blog_gallery');
        Route::get('/blog_gallery/{gallery_id?}', 'BlogEtcAdminController@gallery_page')
            ->name('blog_gallery');
        Route::post('/gallery_page/{gallery_id?}', 'BlogEtcAdminController@save_gallery')
            ->name('gallery_page');
        Route::post('/delete_gallery/{gallery_id?}', 'BlogEtcAdminController@delete_gallery')
            ->name('delete_blog_gallery');

        Route::get('/add_post',
            'BlogEtcAdminController@create_post')
            ->name('blogetc.admin.create_post');


        Route::post('/add_post',
            'BlogEtcAdminController@store_post')
            ->name('blogetc.admin.store_post');


        Route::get('/edit_post/{blogPostId}',
            'BlogEtcAdminController@edit_post')
            ->name('blogetc.admin.edit_post');

        Route::patch('/edit_post/{blogPostId}',
            'BlogEtcAdminController@update_post')
            ->name('blogetc.admin.update_post');


        Route::group(['prefix' => "image_uploads",], function () {

            Route::get("/", "BlogEtcImageUploadController@index")->name("blogetc.admin.images.all");

            Route::get("/upload", "BlogEtcImageUploadController@create")->name("blogetc.admin.images.upload");
            Route::post("/upload", "BlogEtcImageUploadController@store")->name("blogetc.admin.images.store");

        });


        Route::delete('/delete_post/{blogPostId}',
            'BlogEtcAdminController@destroy_post')
            ->name('blogetc.admin.destroy_post');

        Route::group(['prefix' => 'comments',], function () {

            Route::get('/',
                'BlogEtcCommentsAdminController@index')
                ->name('blogetc.admin.comments.index');

            Route::patch('/{commentId}',
                'BlogEtcCommentsAdminController@approve')
                ->name('blogetc.admin.comments.approve');
            Route::delete('/{commentId}',
                'BlogEtcCommentsAdminController@destroy')
                ->name('blogetc.admin.comments.delete');
        });

        Route::group(['prefix' => 'categories'], function () {

            Route::get('/',
                'BlogEtcCategoryAdminController@index')
                ->name('blogetc.admin.categories.index');

            Route::get('/add_category',
                'BlogEtcCategoryAdminController@create_category')
                ->name('blogetc.admin.categories.create_category');
            Route::post('/add_category',
                'BlogEtcCategoryAdminController@store_category')
                ->name('blogetc.admin.categories.store_category');

            Route::get('/edit_category/{categoryId}',
                'BlogEtcCategoryAdminController@edit_category')
                ->name('blogetc.admin.categories.edit_category');

            Route::patch('/edit_category/{categoryId}',
                'BlogEtcCategoryAdminController@update_category')
                ->name('blogetc.admin.categories.update_category');

            Route::delete('/delete_category/{categoryId}',
                'BlogEtcCategoryAdminController@destroy_category')
                ->name('blogetc.admin.categories.destroy_category');

        });

    });
});

//=========================================
// ------------End Blog ETC----------------
//=========================================


//=========================================
// ------------Global View-----------------
//=========================================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']

    ], function () {
    Route::prefix('ajax')->group(function () {
        Route::get('/register', 'globals\global_view@register_form')->name('global_register_form');
        Route::post('/register', 'globals\global_controller@register_form_store')->name('global_register_form_store');

        Route::get('/login', 'globals\global_view@login_form')->name('global_login_form');

        Route::post('/check_email', 'globals\global_controller@check_email')->name('check_email');
        Route::post('/update_information', 'globals\global_controller@update_information')->name('global_update_information');
        Route::post('/update_password', 'globals\global_controller@update_password')->name('global_update_password');

        Route::post('/product_size_info', 'globals\global_controller@product_size_info')->name('product_size_info');
    });

    Route::prefix('page')->group(function () {
        Route::get('/register', 'globals\global_view@register_page')->name('global_register_page');
        Route::get('/login', 'globals\global_view@login_page')->name('global_login_page');
    });
    Route::get('/', 'globals\global_view@index');
    Route::get('/post/{blogPostSlug}', 'globals\global_view@post_page')->name('post_page');
    Route::get('/store', 'globals\global_view@shop_page')->name('global_shop');
    Route::get('/store/detail/{pro_id}', 'globals\global_view@detail_product')->name('store_detail');
    Route::post('/add_to_cart', 'globals\global_controller@add_to_cart')->name('add_to_cart');
    Route::get('/order/cart', 'globals\global_view@store_cart')->name('store_cart');
    Route::get('/order/order', 'globals\global_view@store_order')->name('store_order');
    Route::get('/order/payment', 'globals\global_view@store_payment')->name('store_payment');
    Route::patch('/cart_update', 'globals\global_controller@cart_update')->name('cart_update');
    Route::delete('/cart_remove', 'globals\global_controller@cart_remove')->name('cart_remove');


//charity view
    Route::get('vow/donate', 'globals\global_view@vow_donate')->name('vow_donate');

    Route::middleware('global_auth')->group(function () {
        Route::get('vow/periodic', 'globals\global_view@vow_period')->name('vow_periodic');
    });

    Route::post('vow/periodic/add', 'globals\global_controller@add_charity_period')->name('add_charity_period');
    Route::get('vow/{id}', 'globals\global_view@vow_view')->name('vows');
    Route::POST('vow/payment', 'globals\global_view@vow_payment')->name('add_charity_transaction');
    Route::get('vow/cart/{id}', 'globals\global_view@vow_cart')->name('vow_cart');

    Route::post('panel/profile/period/delete', 'globals\global_controller@profile_period_delete')->name('global_profile_delete_period');
    Route::get('panel/profile/period/check', 'globals\global_controller@profile_period_check')->name('global_profile_check');

    //gallery view
    Route::get('gallery', 'globals\global_view@gallery')->name('gallery');
    Route::get('gallery/{id}', 'globals\global_view@gallery_view')->name('gallery_view');

    //blog view
    Route::get('blog', 'globals\global_view@blog')->name('blog');
});
//=========================================


