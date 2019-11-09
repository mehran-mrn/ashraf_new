<?php
if (!isset($active_sidbare)) {
    $active_sidbare = [];
}
?>
<!-- Main sidebar -->
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-right8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->

    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="card-body">
                <div class="media">
                    <div class="mr-3">
                        <a href="#"><img src="{{ URL::asset(user_information('avatar')) }}" width="38" height="38"
                                         class="rounded-circle" alt=""></a>
                    </div>

                    <div class="media-body">
                        <div class="media-title font-weight-semibold">{{user_information('full')}}</div>
                        <div class="font-size-xs opacity-50">
                            <i class="icon-pin font-size-sm"></i> &nbsp;Role - Team
                        </div>
                    </div>

                    <div class="ml-3 align-self-center">
                        <a href="#" class="text-white"><i class="icon-cog3"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->

        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs"></div>
                    <i class="icon-menu" title="Main"></i></li>
                <li class="nav-item">
                    <a href="{{route('dashboard')}}" class="nav-link">
                        <i class="icon-home4"></i>
                        <span>{{__('messages.dashboard')}}</span>
                    </a>
                </li>

                {{--                <li class="nav-item nav-item-submenu {{in_array("blog", $active_sidbare) ? ' nav-item-open' : '' }}">--}}
                {{--                    <a href="#" class=" nav-link"><i class="icon-blogger2"></i>--}}
                {{--                        <span>{{trans('messages.blog')}}</span></a>--}}

                {{--                    <ul class="nav nav-group-sub" data-submenu-title="{{trans('messages.blog')}}"--}}
                {{--                        style="display:{{in_array("blog", $active_sidbare) ? 'block' : 'none' }}">--}}
                {{--                        <li class="nav-item"><a href="{{route('post_add')}}"--}}
                {{--                                                class="nav-link {{in_array("post_add", $active_sidbare) ? 'active' : '' }}">{{trans('messages.post_add')}}</a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item"><a href="{{route('post_list')}}"--}}
                {{--                                                class="nav-link {{in_array("post_list", $active_sidbare) ? 'active' : '' }}">{{trans('messages.post_list')}}</a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item"><a href="{{route('category_list')}}"--}}
                {{--                                                class="nav-link {{in_array("category_list", $active_sidbare) ? 'active' : '' }}">{{trans('messages.category')}}</a>--}}
                {{--                        </li>--}}

                {{--                    </ul>--}}
                {{--                </li>--}}

                @permission('manage_weblog')
                <li class="nav-item nav-item-submenu {{in_array("blog", $active_sidbare) ? ' nav-item-open' : '' }}">
                    <a href="#" class=" nav-link"><i class="icon-blogger"></i>
                        <span>{{trans('messages.blog')}}</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="{{trans('messages.blog')}}"
                        style="display:{{in_array("blog", $active_sidbare) ? 'block' : 'none' }}">
                        <li class="nav-item nav-item-submenu {{in_array("blog_posts", $active_sidbare) ? ' nav-item-open' : '' }}">
                            <a href="#"
                               class="nav-link {{in_array("blog_posts", $active_sidbare) ? 'active' : '' }}">{{trans('messages.blog_posts')}}</a>
                            <ul class="nav nav-group-sub"
                                style="display:{{in_array("blog_posts", $active_sidbare) ? 'block' : 'none' }}">
                                <li class="nav-item {{in_array("blog_posts_list", $active_sidbare) ? ' nav-item-open' : '' }}">
                                    <a href="{{ route('blogetc.admin.index') }}"
                                       class="nav-link ">{{trans('messages.post_list')}}</a>
                                </li>
                                <li class="nav-item {{in_array("blog_posts_add", $active_sidbare) ? ' nav-item-open' : '' }}">
                                    <a href="{{ route('blogetc.admin.create_post') }}"
                                       class="nav-link ">{{trans('messages.post_add')}}</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item nav-item-submenu {{in_array("blog_comments", $active_sidbare) ? ' nav-item-open' : '' }}">
                            <a href="#"
                               class="nav-link {{in_array("blog_comments", $active_sidbare) ? 'active' : '' }}">{{trans('messages.blog_comments')}}</a>
                            <ul class="nav nav-group-sub"
                                style="display:{{in_array("blog_comments", $active_sidbare) ? 'block' : 'none' }}">
                                <li class="nav-item {{in_array("all_blog_comments", $active_sidbare) ? ' nav-item-open' : '' }}">
                                    <a href="{{ route('blogetc.admin.comments.index') }}"
                                       class="nav-link ">{{trans('messages.all_blog_comments')}}</a>
                                </li>
                                <li class="nav-item {{in_array("pending_blog_comments", $active_sidbare) ? ' nav-item-open' : '' }}">
                                    <a href='{{ route('blogetc.admin.comments.index') }}?waiting_for_approval=true'
                                       class="nav-link ">{{trans('messages.pending_blog_comments')}}</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item nav-item-submenu {{in_array("blog_categories", $active_sidbare) ? ' nav-item-open' : '' }}">
                            <a href="#"
                               class="nav-link {{in_array("blog_categories", $active_sidbare) ? 'active' : '' }}">{{trans('messages.blog_categories')}}</a>
                            <ul class="nav nav-group-sub"
                                style="display:{{in_array("blog_categories", $active_sidbare) ? 'block' : 'none' }}">
                                <li class="nav-item {{in_array("all_blog_categories", $active_sidbare) ? ' nav-item-open' : '' }}">
                                    <a href="{{ route('blogetc.admin.categories.index') }}"
                                       class="nav-link ">{{trans('messages.all_blog_categories')}}</a>
                                </li>

                            </ul>
                        </li>


                        <li class="nav-item nav-item-submenu {{in_array("blog_Specific_page", $active_sidbare) ? ' nav-item-open' : '' }}">
                            <a href="#"
                               class="nav-link {{in_array("blog_Specific_page", $active_sidbare) ? 'active' : '' }}">
                                {{trans('messages.Specific_page')}}</a>
                            <ul class="nav nav-group-sub"
                                style="display:{{in_array("blog_Specific_page", $active_sidbare) ? 'block' : 'none' }}">
                                <li class="nav-item {{in_array("list", $active_sidbare) ? ' nav-item-open' : '' }}">
                                    <a href="{{ route('blogetc.admin.SpecificPages.index') }}"
                                       class="nav-link ">{{trans('messages.specific_categories_list')}}</a>
                                </li>
                                <li class="nav-item {{in_array("pages", $active_sidbare) ? ' nav-item-open' : '' }}">
                                    <a href="{{ route('pages.index') }}"
                                       class="nav-link ">{{trans('messages.pages_list')}}</a>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-item nav-item-submenu {{in_array("blog_images", $active_sidbare) ? ' nav-item-open' : '' }}">
                            <a href="#"
                               class="nav-link {{in_array("blog_images", $active_sidbare) ? 'active' : '' }}">{{trans('messages.blog_images')}}</a>
                            <ul class="nav nav-group-sub"
                                style="display:{{in_array("blog_images", $active_sidbare) ? 'block' : 'none' }}">
                                <li class="nav-item {{in_array("blog_posts_list", $active_sidbare) ? ' nav-item-open' : '' }}">
                                    <a href="{{ route('blogetc.admin.images.all') }}"
                                       class="nav-link ">{{trans('messages.all_blog_images')}}</a>
                                </li>
                                <li class="nav-item {{in_array("add_blog_images", $active_sidbare) ? ' nav-item-open' : '' }}">
                                    <a href="{{ route('blogetc.admin.images.upload') }}"
                                       class="nav-link ">{{trans('messages.add_blog_images')}}</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item nav-item-submenu {{in_array("blog_setting", $active_sidbare) ? ' nav-item-open' : '' }}">
                            <a href="#"
                               class="nav-link {{in_array("blog_setting", $active_sidbare) ? 'active' : '' }}">{{trans('messages.blog_setting')}}</a>
                            <ul class="nav nav-group-sub"
                                style="display:{{in_array("blog_setting", $active_sidbare) ? 'block' : 'none' }}">
                                <li class="nav-item {{in_array("display_statistics", $active_sidbare) ? ' nav-item-open' : '' }}">
                                    <a href="{{ route('display_statistics') }}"
                                       class="nav-link ">{{trans('messages.display_statistics')}}</a>
                                </li>
                                <li class="nav-item {{in_array("adv_links", $active_sidbare) ? ' nav-item-open' : '' }}">
                                    <a href="{{ route('adv_links') }}"
                                       class="nav-link ">{{trans('messages.adv_links')}}</a>
                                </li>
                                <li class="nav-item {{in_array("faq", $active_sidbare) ? ' nav-item-open' : '' }}"><a
                                            href="{{ route('faq.index') }}"
                                            class="nav-link ">{{trans('messages.FAQ')}}</a>
                                </li>
                                <li class="nav-item {{in_array("menu", $active_sidbare) ? ' nav-item-open' : '' }}"><a
                                            href="{{ route('menu.index') }}"
                                            class="nav-link ">{{trans('messages.menu')}}</a>
                                </li>
                                <li class="nav-item {{in_array("more_blog_setting", $active_sidbare) ? ' nav-item-open' : '' }}">
                                    <a href="{{ route('more_blog_setting') }}"
                                       class="nav-link ">{{trans('messages.more_setting')}}</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item {{in_array("blog_slider", $active_sidbare) ? ' nav-item-open' : '' }}"><a
                                    class="nav-link "
                                    href="{{ route('blog_slider') }}"> {{trans('messages.blog_slider')}}</a>
                        </li>
                    </ul>
                </li>
                @endpermission
                @permission('manage_store')
                <li class="nav-item nav-item-submenu {{in_array("store", $active_sidbare) ? ' nav-item-open' : '' }}">
                    <a href="#" class=" nav-link"><i class="icon-cart"></i>
                        <span>{{trans('messages.store')}}</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="{{trans('messages.store')}}"
                        style="display:{{in_array("store", $active_sidbare) ? 'block' : 'none' }}">
                        <li class="nav-item"><a href="{{route('product_add')}}"
                                                class="nav-link {{in_array("product_add", $active_sidbare) ? 'active' : '' }}">{{trans('messages.product_add')}}</a>
                        </li>

                        <li class="nav-item"><a href="{{route('product_list')}}"
                                                class="nav-link {{in_array("product_list", $active_sidbare) ? 'active' : '' }}">{{trans('messages.product_list')}}</a>
                        </li>


                        <li class="nav-item"><a href="{{route('store_category')}}"
                                                class="nav-link {{in_array("store_category", $active_sidbare) ? 'active' : '' }}">{{trans('messages.store_category')}}</a>
                        </li>

                        <li class="nav-item"><a href="{{route('store_items')}}"
                                                class="nav-link {{in_array("store_items", $active_sidbare) ? 'active' : '' }}">{{trans('messages.store_items')}}</a>
                        </li>


                        <li class="nav-item"><a href="{{route('discount_code')}}"
                                                class="nav-link {{in_array("discount_code", $active_sidbare) ? 'active' : '' }}">{{trans('messages.discount_code')}}</a>
                        </li>

                        <li class="nav-item"><a href="{{route('manage_orders')}}"
                                                class="nav-link {{in_array("manage_orders", $active_sidbare) ? 'active' : '' }}">{{trans('messages.manage_orders')}}</a>
                        </li>

                        <li class="nav-item"><a href="{{route('store_setting')}}"
                                                class="nav-link {{in_array("store_setting", $active_sidbare) ? 'active' : '' }}">{{trans('messages.store_setting')}}</a>
                        </li>

                    </ul>
                </li>
                @endpermission
                @permission('manage_gallery')
                <li class="nav-item nav-item-submenu {{in_array("gallery", $active_sidbare) ? ' nav-item-open' : '' }}">
                    <a href="#" class=" nav-link"><i class="icon-gallery"></i>
                        <span>{{trans('messages.gallery')}}</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="{{trans('messages.gallery')}}"
                        style="display:{{in_array("gallery", $active_sidbare) ? 'block' : 'none' }}">
                        <li class="nav-item"><a href="{{route('gallery_add')}}"
                                                class="nav-link {{in_array("gallery_add", $active_sidbare) ? 'active' : '' }}">{{trans('messages.photos')}}</a>
                        </li>
                        <li class="nav-item"><a href="{{route('list_video_galleries')}}"
                                                class="nav-link {{in_array("list_video_galleries", $active_sidbare) ? 'active' : '' }}">{{trans('messages.videos')}}</a>
                        </li>

                    </ul>
                </li>
                @endpermission
                @permission('manage_carevan')
                <li class="nav-item nav-item-submenu {{in_array("caravans", $active_sidbare) ? ' nav-item-open' : '' }}">
                    <a href="#" class=" nav-link"><i class="icon-train2"></i>
                        <span>{{trans('messages.caravans')}}</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="{{trans('messages.caravans')}}"
                        style="display:{{in_array("caravans", $active_sidbare) ? 'block' : 'none' }}">
                        <li class="nav-item"><a href="{{route('caravan_dashboard')}}"
                                                class="nav-link {{in_array("caravans_dashboard", $active_sidbare) ? 'active' : '' }}">{{trans('messages.dashboard')}} {{trans('messages.caravans')}}</a>
                        </li>
                        <li class="nav-item"><a href="{{route('caravans_list')}}"
                                                class="nav-link {{in_array("caravans_list", $active_sidbare) ? 'active' : '' }}">{{trans('messages.caravans_list')}}</a>

                        </li>
                        <li class="nav-item"><a href="{{route('hosts_list')}}"
                                                class="nav-link {{in_array("hosts_list", $active_sidbare) ? 'active' : '' }}">{{trans('messages.hosts_list')}}</a>

                        </li>

                    </ul>
                </li>
                @endpermission
                @permission('manage_rezvan')
                <li class="nav-item nav-item-submenu {{in_array("building", $active_sidbare) ? ' nav-item-open' : '' }}">
                    <a href="#" class=" nav-link"><i class="icon-quill4"></i>
                        <span>{{trans('messages.building_projects')}}</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="{{trans('messages.building_projects')}}"
                        style="display:{{in_array("building", $active_sidbare) ? 'block' : 'none' }}">
                        <li class="nav-item"><a href="{{route('building_dashboard')}}"
                                                class="nav-link {{in_array("building_dashboard", $active_sidbare) ? 'active' : '' }}">{{trans('messages.building_dashboard')}}</a>
                        </li>
                        <li class="nav-item"><a href="{{route('building_types')}}"
                                                class="nav-link {{in_array("building_types", $active_sidbare) ? 'active' : '' }}">{{trans('messages.building_types')}}</a>
                        </li>
                        <li class="nav-item"><a href="{{route('building_archive')}}"
                                                class="nav-link {{in_array("building_archive", $active_sidbare) ? 'active' : '' }}">{{trans('messages.building_archive')}}</a>
                        </li>
                    </ul>
                </li>
                @endpermission
                @permission('manage_charity')
                <li class="nav-item nav-item-submenu {{in_array("charity", $active_sidbare) ? ' nav-item-open' : '' }}">
                    <a href="#" class=" nav-link"><i class="icon-umbrella"></i>
                        <span>{{trans('messages.Charity')}}</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="{{trans('messages.Charity')}}"
                        style="display:{{in_array("charity", $active_sidbare) ? 'block' : 'none' }}">
                        <li class="nav-item nav-item-submenu {{in_array("charity_period", $active_sidbare) ? ' nav-item-open' : '' }}">
                            <a href="#"
                               class="nav-link {{in_array("charity_period", $active_sidbare) ? 'active' : '' }}">
                                {{trans('messages.periodic_payment')}}</a>
                            <ul class="nav nav-group-sub"
                                style="display:{{in_array("charity_period", $active_sidbare) ? 'block' : 'none' }}">
                                <li class="nav-item">
                                    <a href="{{route('charity_period_list')}}"
                                       class="nav-link {{in_array("charity_period_list", $active_sidbare) ? 'active' : '' }}">
                                        {{trans('messages.period_payment_list')}}
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('charity_period_status')}}"
                                       class="nav-link {{in_array("charity_period_status", $active_sidbare) ? 'active' : '' }}">
                                        {{trans('messages.payment_status')}}
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('charity_payment_list')}}"
                               class="nav-link {{in_array("charity_list", $active_sidbare) ? 'active' : '' }}">{{trans('messages.other_payments')}}</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('charity_reports')}}"
                               class="nav-link {{in_array("charity_report", $active_sidbare) ? 'active' : '' }}">{{trans('messages.reports')}}</a>
                        </li>

                        {{--                        <li class="nav-item"><a href="{{route('building_types')}}"--}}
                        {{--                                                class="nav-link {{in_array("building_types", $active_sidbare) ? 'active' : '' }}">{{trans('messages.request_hook')}}</a>--}}
                        {{--                        </li>--}}
                        <li class="nav-item nav-item-submenu {{in_array("charity_setting", $active_sidbare) ? ' nav-item-open' : '' }}">
                            <a href="#"
                               class="nav-link {{in_array("charity_setting", $active_sidbare) ? 'active' : '' }}">{{trans('messages.charity_setting')}}</a>
                            <ul class="nav nav-group-sub"
                                style="display:{{in_array("charity_setting", $active_sidbare) ? 'block' : 'none' }}">
                                <li class="nav-item"><a href="{{route('charity_payment_title')}}"
                                       class="nav-link {{in_array("charity_payment_titles", $active_sidbare) ? 'active' : '' }}">{{trans('messages.payment_titles')}}</a>
                                </li>
                                {{--                                <li><a href="starters/3_col_double.html" class="nav-link {{in_array("building_types", $active_sidbare) ? 'active' : '' }}">{{trans('messages.hooks_types')}}</a></li>--}}
                            </ul>
                        </li>
                    </ul>
                </li>
                @endpermission
                @permission('manage_users')
                <li class="nav-item nav-item-submenu {{in_array("user_manager", $active_sidbare) ? 'nav-item-open' : '' }}">
                    <a href="#" class="nav-link"><i class="icon-users4"></i>
                        <span>{{trans('messages.users_management')}}</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="{{trans('messages.users_management')}}"
                        style="display:{{in_array("user_manager", $active_sidbare) ? 'block' : 'none' }}">
                        <li class="nav-item"><a href="{{route('users_list')}}"
                                                class="nav-link {{in_array("users_list", $active_sidbare) ? 'active' : '' }}">{{trans('messages.users_list')}}</a>
                        </li>
                        <li class="nav-item"><a href="{{route('permissions_list')}}"
                                                class="nav-link {{in_array("permissions_list", $active_sidbare) ? 'active' : '' }}">{{trans('messages.permissions_list')}}</a>
                        </li>
                        <li class="nav-item"><a href="{{route('roles_list')}}"
                                                class="nav-link {{in_array("roles_list", $active_sidbare) ? 'active' : '' }}">{{trans('messages.roles_list')}}</a>
                        </li>
                        <li class="nav-item"><a href="{{route('teams_list')}}"
                                                class="nav-link {{in_array("teams_list", $active_sidbare) ? 'active' : '' }}">{{trans('messages.teams_list')}}</a>
                        </li>
                    </ul>
                </li>
                @endpermission
                @permission('manage_setting')
                <li class="nav-item nav-item-submenu {{in_array("setting", $active_sidbare) ? ' nav-item-open' : '' }}">
                    <a href="#" class=" nav-link"><i class="icon-gear"></i>
                        <span>{{trans('messages.setting')}}</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="{{trans('messages.setting')}}"
                        style="display:{{in_array("setting", $active_sidbare) ? 'block' : 'none' }}">

                        <li class="nav-item">
                            <a href="{{route('contact.index')}}"
                               class="nav-link {{in_array("contact", $active_sidbare) ? 'active' : '' }}">{{trans('messages.contact_to_we')}}</a>
                        </li>


                        <li class="nav-item"><a href="{{route('notification_template.index')}}"
                                                class="nav-link {{in_array("notification_template", $active_sidbare) ? 'active' : '' }}">{{trans('messages.notification_template')}}</a>
                        </li>
                        <li class="nav-item"><a href="{{url(config('translation-manager.route.prefix'))}}"
                                                class="nav-link {{in_array("translations", $active_sidbare) ? 'active' : '' }}">{{trans('messages.translation_maganger')}}</a>
                        </li>
                        <li class="nav-item"><a href="{{route('cities.index')}}"
                                                class="nav-link {{in_array("cities_list", $active_sidbare) ? 'active' : '' }}">{{trans('messages.cities')}}</a>
                        </li>

                        <li class="nav-item"><a href="{{route('gateway_setting')}}"
                                                class="nav-link {{in_array("gateway_setting", $active_sidbare) ? 'active' : '' }}">{{trans('messages.gateway_pay')}}</a>
                        </li>
                        <li class="nav-item"><a href="{{route('setting_how_to_send')}}"
                                                class="nav-link {{in_array("setting_how_to_send", $active_sidbare) ? 'active' : '' }}">{{trans('messages.how_to_send')}}</a>
                        </li>

                    </ul>
                </li>
                @endpermission
                <!-- /main -->
            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->
</div>
<!-- /main sidebar -->
