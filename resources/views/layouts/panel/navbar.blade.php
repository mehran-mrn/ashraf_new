<!-- main navbar -->
<div class="navbar navbar-expand-md navbar-dark">
    <div class="navbar-brand p-1">
        <a href="{{route('dashboard')}}" class="d-inline-block">
            <img style="height: 2rem;" src="{{ URL::asset('/public/assets/global/images/logo-wide-white.png') }}"
                 alt="">
        </a>
    </div>

    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a href="{{route('home')}}" target="_blank" class="navbar-nav-link dropdown-toggle caret-0">
                    <i class="icon-safari"></i>
                    <span class="d-md-none ml-2">{{__('messages.show_site')}}</span>
                </a>
            </li>
        </ul>
        <span class="badge bg-success ml-md-3 mr-md-auto">Online</span>

{{--        {{dd(Auth::getUser())}}--}}
        <ul class="navbar-nav">
            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                    <img src="{{URL::asset(user_information('avatar'))}}" class="rounded-circle mr-2" height="34"
                         alt="">
                    <span>{{user_information('full')}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{route('global_profile')}}" class="dropdown-item"><i
                                class="icon-user-plus"></i> {{trans('messages.account')}}</a>
                    <div class="dropdown-divider"></div>
                    <a href="{{route('logout')}}" class="dropdown-item"><i
                                class="icon-exit2"></i> {{trans('messages.logout')}}</a>
                    <div class="dropdown-divider"></div>
                </div>

            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->

