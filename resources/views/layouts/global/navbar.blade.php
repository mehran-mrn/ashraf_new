
<!-- Header -->
<header id="header" class="header">
    <div class="header-nav navbar-fixed-top header-dark navbar-white navbar-transparent bg-transparent-1 navbar-sticky-animated animated-active">
        <div class="header-nav-wrapper">
            <div class="container">
                <nav id="menuzord-right" class="menuzord default no-bg">
                    <ul class="list-inline pull-right flip hidden-sm hidden-xs">
                        @if (Auth::check())
                            <li>
                                <a class="btn btn-colored  btn-theme-colored mt-15"
                                   href="{{route('global_profile')}}">{{trans('messages.account')}}</a>
                            </li>
                            <li>
                                <a class="btn btn-colored  btn-theme-colored mt-15 ajaxload-popup"
                                   href="{{route('logout')}}">{{trans('messages.logout')}}</a>
                            </li>
                        @else
                            <li>
                                <a class="btn btn-colored  btn-theme-colored mt-15 ajaxload-popup"
                                   href="{{route('global_login_form')}}">{{trans('messages.login')}}</a>
                            </li>
                            <li>
                                <a class="btn btn-colored  btn-theme-colored mt-15 ajaxload-popup"
                                   href="{{route('global_register_form')}}"> {{trans('messages.register')}}</a>
                            </li>
                        @endif
                        <li>
                            <a class="btn btn-success  mt-15 ">{{__('messages.buy_basket')}}</a>
                        </li>
                    </ul>
                    <a class="menuzord-brand pull-left flip" href="{{route('home')}}"><img src="{{ URL::asset('/public/assets/global/images/logo-wide@2x.png') }}" alt=""></a>
                    <ul class="menuzord-menu pull-left flip">
                        <li><a href="{{route('home')}}">{{trans('messages.home')}}</a></li>

                        <li><a href="#home">{{trans('messages.cooperation')}}</a>
                            <ul class="dropdown">
                                <li><a href="{{route('global_shop')}}">{{__("messages.tableau_and_wreath")}}</a></li>
                                <li><a href="#">{{__("messages.vows")}}</a>
                                    <ul class="dropdown">
                                        @foreach($menu as $m)
                                            @if($m['type']=="vow")
                                                <li><a href="{{route('vows',['id'=>$m['id']])}}">{{$m['title']}}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="{{route('vow_donate')}}">{{__("messages.financial_aids")}}</a></li>
                                <li><a href="{{route('vow_periodic')}}">{{__("messages.Periodic_assistance")}}</a></li>


                            </ul>
                        </li>

                        <li><a href="{{route('home')}}">{{__('messages.FAQ')}}</a></li>

                        <li><a href="{{route('home')}}">{{trans('messages.help_desk')}}</a></li>

                        <li><a href="{{route('home')}}">{{trans('messages.support')}}</a></li>

                        <li><a href="{{route('home')}}">{{__('messages.buy_basket')}}</a></li>
                    </ul>


                </nav>
            </div>
        </div>
    </div>
</header>
