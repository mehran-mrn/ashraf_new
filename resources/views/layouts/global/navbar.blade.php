<!-- Header -->
<style>
    .menuzord-menu > li {
        padding: 14px 0 !important;
    }
</style>
<header id="header" class="header">

    <div class="header-top p-0 text-black bg-silver-light xs-text-center"
         data-bg-img="{{ URL::asset('/public/assets/global/images/footer-bg.png') }}">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="widget no-border m-0">
                        <a class="menuzord-brand pull-right sm-text-center xs-text-center xs-pull-center"
                           href="{{route('main')}}">
                            <img class="img img-responsive sm-text-center xs-text-center"
                                 src="{{ URL::asset('/public/assets/global/images/logo-wide@2x.png')}}?i=4" alt=""></a>

                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="widget no-border clearfix m-0 mt-5">
                        <ul class="list-inline pull-right flip sm-pull-none sm-text-center mt-5">

                            @if (Auth::check())
                                <li>
                                    <a class="text-black "
                                       href="{{route('global_profile')}}">{{trans('messages.account')}}</a>
                                </li>
                                <li class="text-black">|</li>
                                <li>
                                    <a class="text-black" href="{{route('logout')}}">{{trans('messages.logout')}}</a>
                                </li>
                            @else
                                <li class="hidden-sm hidden-xs">
                                    <a class="text-black ajaxload-popup"
                                       href="{{route('global_login_form')}}">{{trans('messages.login')}}</a>
                                </li>
                                <li class="hidden-lg hidden-md">
                                    <a class="text-black"
                                       href="{{route('global_login_page')}}">{{trans('messages.login')}}</a>
                                </li>
                                <li class="text-black">|</li>
                                <li class="hidden-sm  hidden-xs">
                                    <a class="text-black ajaxload-popup"
                                       href="{{route('global_register_form')}}">{{trans('messages.register')}}</a>
                                </li>
                                <li class="hidden-lg hidden-md">
                                    <a class="text-black "
                                       href="{{route('global_register_page')}}">{{trans('messages.register')}}</a>
                                </li>
                            @endif

                            @if(session()->get('cart'))
                                <li class="text-black">|</li>
                                <li>
                                    <a class="text-black"
                                       href="{{route('store_order')}}">{{__('messages.buy_basket')}}</a>
                                </li>
                            @endif
                            @if(has_caravan())
                                <li class="text-black">|</li>
                                <li>
                                    <a class="text-black"
                                       href="{{route('global_caravan')}}">{{__('messages.caravan')}}</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="widget no-border clearfix m-0 mt-5">
                        <div class='search-form-outer'>

                            <form method='get' action='{{route("blogetc.search")}}'
                                  id="mailchimp-subscription-form-footer" class="col-lg-offset-5 newsletter-form">
                                <div class="input-group">
                                    <input type="text" value="{{\Request::get("s")}}" name="s"
                                           placeholder="{{__('messages.search')}}"
                                           class="form-control input-lg font-16" data-height="45px"
                                           id="mce-EMAIL-footer" style="height: 45px;">
                                    <span class="input-group-btn">
                  <button data-height="45px" class="btn btn-colored bg-theme-colored-darker2 btn-xs m-0 font-14"
                          type="submit">
                      <i class="fa fa-search text-white-f6"></i></button>
                </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-nav ">
        <div class="header-nav-wrapper navbar-scrolltofixed bg-theme-colored-darker4">
            <div class="container">
                <nav id="menuzord" class="menuzord default bg-theme-colored-darker4">
                    <ul class="menuzord-menu pull-right">
                        <li><a class="text-white-f6" href="{{route('index')}}"> {{trans('messages.home')}}</a></li>
                        <li><a class="text-white-f6" href="#home">{{trans('messages.cooperation')}}</a>
                            <ul class="dropdown">
                                <li><a href="{{route('global_shop')}}">{{__("messages.tableau_and_wreath")}}</a></li>
                                @foreach($menu as $m)
                                    @if($m['type']=="vow")
                                        <li><a href="{{route('vows',['id'=>$m['id']])}}">{{$m['title']}} </a>
                                        </li>
                                    @endif
                                @endforeach
                                <li><a href="{{route('vow_donate')}}">{{__("messages.financial_aids")}}</a></li>
                                <li><a href="{{route('vow_periodic')}}">{{__("messages.Periodic_assistance")}}</a></li>
                            </ul>
                        </li>

                        <li><a class="text-white-f6" href="#home">{{trans('messages.Introducing_us')}}</a>
                            <ul class="dropdown">
                                @foreach($menu_special as $m_s)
                                    <li>
                                        <a href="{{route('blogetc.view_SpecificPages',['categorySlug'=>$m_s['slug']])}}">{{$m_s['category_name']}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a class="text-white-f6" href="#">{{__('messages.gallery')}}</a>
                            <ul class="dropdown">
                                <li><a href="{{route('gallery')}}">{{__('messages.photos')}}</a></li>
                                <li><a href="{{route('video_gallery')}}">{{__('messages.videos')}}</a></li>
                            </ul>
                        </li>
                        <li><a class="text-white-f6" href="#">{{trans('messages.blog')}}</a>
                            <ul class="dropdown">
                                @foreach($menu_blog as $m_b)
                                    <li>
                                        <a href="{{route('blogetc.view_category',['categorySlug'=>$m_b['slug']])}}">{{$m_b['category_name']}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a class="text-white-f6" href="{{route('faq')}}">{{trans('messages.faq')}}</a></li>
                        <li><a class="text-white-f6"
                               href="{{route('contact.create')}}">{{trans('messages.contact_to_we')}}</a>
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





