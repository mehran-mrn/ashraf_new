<!-- Header -->
<header id="header" class="header ">
    <div class="header-top sm-text-center bg-theme-colored">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <nav>
                        <ul class="list-inline sm-text-center text-left flip mt-0">
                            <li> <a class="text-white" href="{{route('home')}}">{{__('messages.FAQ')}}</a> </li>
                            <li class="text-white">|</li>
                            <li> <a class="text-white" href="{{route('home')}}">{{trans('messages.support')}}</a> </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-6">
                    <div class="widget m-0 mt-5 no-border">
                        <ul class="list-inline text-right sm-text-center">
                            <li class="pl-10 pr-10 mb-0 pb-0">
                                <div class="header-widget text-white"><i class="fa fa-phone"></i> {{trans('site_info.phone')}} </div>
                            </li>
                            <li class="pl-10 pr-10 mb-0 pb-0">
                                <div class="header-widget text-white"><i class="fa fa-envelope-o"></i> {{trans('site_info.email')}} </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2 text-right flip sm-text-center">
                    <div class="widget m-0">
                        <ul class="styled-icons icon-dark icon-circled icon-theme-colored icon-sm">
                            <li class="mb-0 pb-0"><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li class="mb-0 pb-0"><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li class="mb-0 pb-0"><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li class="mb-0 pb-0"><a href="#"><i class="fa fa-linkedin text-white"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-nav">
        <div class="header-nav-wrapper  bg-lighter">
            <div class="container">
                <nav id="menuzord-right" class="menuzord default no-bg"> <a class="menuzord-brand pull-left flip" href="index-mp-layout1.html"><img src="images/logo-wide.png" alt=""></a>
                    <ul class="list-inline pull-right flip hidden-sm hidden-xs ">
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
                        @if(session()->get('cart'))
                            <li>
                                <a href="{{route('store_order')}}" class="btn btn-success  mt-15 ">{{__('messages.buy_basket')}}</a>
                            </li>
                        @endif
                    </ul>
                    <a class="menuzord-brand pull-left flip" href="{{route('home')}}"><img
                                src="{{ URL::asset('/public/assets/global/images/logo-wide@2x.png') }}" alt=""></a>
                    <ul class="menuzord-menu pull-left flip ">
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

                        <li><a href="{{route('blog')}}">{{trans('messages.blog')}}</a></li>


                        @if(session()->get('cart'))
                            <li><a href="{{route('store_order')}}">{{__('messages.buy_basket')}}</a></li>
                        @endif
                    </ul>                </nav>
            </div>
        </div>
    </div>
</header>



