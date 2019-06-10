<?php
if (!isset($active_sidbare)) {
    $active_sidbare = [];
}
?>
<!-- Main sidebar -->
<div class="sidebar sidebar-light sidebar-main sidebar-expand-md">

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
        <div class="sidebar-user-material">
            <div class="sidebar-user-material-body">
                <div class="card-body text-center">
                    <a href="#">
                        <img
                            src="{{ URL::asset(user_information('avatar')) }}"
                            class="img-fluid rounded-circle shadow-1 mb-3" width="80" height="80" alt="">
                    </a>
                    <h6 class="mb-0 text-white text-shadow-dark">{{user_information('full')}}</h6>
                    <span class="font-size-sm text-white text-shadow-dark">Role - Team</span>
                </div>

                <div class="sidebar-user-material-footer">
                    <a href="#user-nav"
                       class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle"
                       data-toggle="collapse"><span>{{__('messages.account')}}</span></a>
                </div>
            </div>

            <div class="collapse" id="user-nav">
                <ul class="nav nav-sidebar">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="icon-user-plus"></i>
                            <span>{{__('messages.my_profile')}}</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('logout')}}" class="nav-link">
                            <i class="icon-switch2"></i>
                            <span>{{__('messages.logout')}}</span>
                        </a>
                    </li>
                </ul>
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
                        <span>{{__('messages.dashboard')}}<span class="d-block font-weight-normal opacity-50"></span></span>
                    </a>
                </li>

                <li class="nav-item nav-item-submenu {{in_array("user_manager", $active_sidbare) ? 'nav-item-expanded nav-item-open' : '' }}">
                    <a href="#" class=" nav-link"><i class="icon-users4"></i>
                        <span>{{trans('messages.users_management')}}</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
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





                <li class="nav-item nav-item-submenu {{in_array("blog", $active_sidbare) ? 'nav-item-expanded nav-item-open' : '' }}">
                    <a href="#" class=" nav-link"><i class="icon-users4"></i>
                        <span>{{trans('messages.blog')}}</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="{{route('add_post')}}"
                                                class="nav-link {{in_array("add_post", $active_sidbare) ? 'active' : '' }}">{{trans('messages.add_post')}}</a>
                        </li>
                        <li class="nav-item"><a href="{{route('post_list')}}"
                                                class="nav-link {{in_array("post_list", $active_sidbare) ? 'active' : '' }}">{{trans('messages.post_list')}}</a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item nav-item-submenu {{in_array("msd_house", $active_sidbare) ? 'nav-item-expanded nav-item-open' : '' }}">
                    <a href="#" class=" nav-link"><i class="icon-home9"></i>
                        <span>{{trans('messages.msd_house')}}</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        <li class="nav-item"><a href="{{route('add_post')}}"
                                                class="nav-link {{in_array("add_caravan", $active_sidbare) ? 'active' : '' }}">{{trans('messages.add_caravan')}}</a>
                        </li>
                        <li class="nav-item"><a href="{{route('post_list')}}"
                                                class="nav-link {{in_array("caravan_list", $active_sidbare) ? 'active' : '' }}">{{trans('messages.caravan_list')}}</a>
                        </li>

                    </ul>
                </li>

            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>
<!-- /main sidebar -->
