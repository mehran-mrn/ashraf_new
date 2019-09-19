<!-- Header -->
<header id="header" class="header">
    <div class="header-top p-0 bg-theme-colored xs-text-center" data-bg-img="{{ URL::asset('/public/assets/global/images/footer-bg.png') }}">
        <div class="container pt-20 pb-20">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="widget no-border m-0">
                        <a class="menuzord-brand pull-right sm-text-center xs-text-center xs-pull-center"
                           href="{{route('home')}}">
                            <img class="img img-responsive sm-text-center xs-text-center"
                                 src="{{ URL::asset('/public/assets/global/images/logo-wide@2x.png') }}" alt=""></a>

                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="widget no-border clearfix m-0 mt-5">
                        <ul class="list-inline pull-right flip sm-pull-none sm-text-center mt-5">
                            @if (Auth::check())
                            <li>
                                <a class="text-white" href="{{route('global_profile')}}">{{trans('messages.account')}}</a>
                            </li>
                                <li class="text-white">|</li>
                            <li>
                                <a class="text-white" href="{{route('logout')}}">{{trans('messages.logout')}}</a>
                            </li>
                            @else
                                <li class="hidden-sm hidden-xs">
                                    <a class="text-white ajaxload-popup" href="{{route('global_login_form')}}">{{trans('messages.login')}}</a>
                                </li>
                                <li class="hidden-lg hidden-md">
                                    <a class="text-white" href="{{route('global_login_form')}}">{{trans('messages.login')}}</a>
                                </li>
                                <li class="text-white">|</li>
                                <li class="hidden-sm  hidden-xs">
                                    <a class="text-white ajaxload-popup" href="{{route('global_register_form')}}">{{trans('messages.register')}}</a>
                                </li>
                                <li class="hidden-lg hidden-md">
                                    <a class="text-white " href="{{route('global_register_form')}}">{{trans('messages.register')}}</a>
                                </li>
                            @endif
                                @if(session()->get('cart'))
                                    <li class="text-white">|</li>
                                    <li>
                                        <a class="text-white" href="{{route('store_order')}}">{{__('messages.buy_basket')}}</a>
                                    </li>
                                @endif
                                @if(has_caravan())
                                    <li class="text-white">|</li>
                                    <li>
                                        <a class="text-white" href="{{route('global_caravan')}}">{{__('messages.caravan')}}</a>
                                    </li>
                                @endif
                        </ul>
                    </div>
                    <div class="widget no-border clearfix m-0 mt-5">
                        <ul class="styled-icons icon-gray icon-theme-colored icon-circled icon-sm pull-right flip sm-pull-none sm-text-center mt-sm-15">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-nav">
        <div class="header-nav-wrapper navbar-scrolltofixed bg-silver-light">
            <div class="container">
                <nav id="menuzord" class="menuzord default bg-silver-light">
                    <ul class="menuzord-menu pull-right">
                        <li><a href="{{route('index')}}">{{trans('messages.home')}}</a></li>
                        <li><a href="#home">{{trans('messages.cooperation')}}</a>
                            <ul class="dropdown">
                                <li><a href="{{route('global_shop')}}">{{__("messages.tableau_and_wreath")}}</a></li>
                                <li><a href="#">{{__("messages.vows")}}</a>
                                    <ul class="dropdown">
                                        @foreach($menu as $m)
                                            @if($m['type']=="vow")
                                                <li><a href="{{route('vows',['id'=>$m['id']])}}">{{$m['title']}}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="{{route('vow_donate')}}">{{__("messages.financial_aids")}}</a></li>
                                <li><a href="{{route('vow_periodic')}}">{{__("messages.Periodic_assistance")}}</a></li>
                            </ul>
                        </li>
                        <li><a href="{{route('gallery')}}">{{__('messages.gallery')}}</a></li>
                        <li><a href="{{route('blog')}}">{{trans('messages.blog')}}</a>


                        </li>
                        @if(session()->get('cart'))
                            <li><a href="{{route('store_order')}}">{{__('messages.buy_basket')}}</a></li>
                        @endif
                        @if(has_caravan())
                            <li><a href="{{route('global_caravan')}}">{{__('messages.caravan')}}</a></li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>





