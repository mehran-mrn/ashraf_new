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
                        <ul class="list-inline pull-right flip sm-pull-none sm-text-center mt-5 hidden-xs">
                            <?php $locals = get_all_locals(); ?>
                            @foreach($locals as $local)
                                @if($local != App()->getLocale())
                                    <li class="">
                                        <a class="text-black "
                                           href="/{{$local}}">{{trans("words.$local")}}</a>
                                    </li>
                                    <li class="text-black">|</li>
                                @endif
                            @endforeach
                            @if (Auth::check())
                                <li>
                                    <a class="text-black"
                                       href="{{route('global_profile')}}">{{trans('messages.account')}}</a>
                                </li>
                                <li class="text-black">|</li>
                                <li>
                                    <a class="text-black"
                                       href="{{route('logout')}}">{{trans('messages.logout')}}</a>
                                </li>
                            @else
                                <li class="">
                                    <a class="text-black ajaxload-popup"
                                       href="{{route('global_login_form')}}">{{trans('messages.login')}}</a>
                                </li>
                                <li class="text-black">|</li>
                                <li class="">
                                    <a class="text-black ajaxload-popup"
                                       href="{{route('global_register_form')}}">{{trans('messages.register')}}</a>
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
                                           class="form-control input-sm font-16" data-height="45px"
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
                    <div class="pt-10 hidden-sm hidden-md hidden-lg small">
                        @if(Auth::check())
                            <a class="text-white"
                               href="{{route('global_profile')}}">{{trans('messages.account')}}</a>
                            <span class="text-white">|</span>
                            <a class="text-white"
                               href="{{route('logout')}}">{{trans('messages.logout')}}</a>
                        @else
                            <a class="text-white"
                               href="{{route('global_login_page')}}">{{trans('messages.login')}}</a>
                            <span class="text-white">|</span>
                            <a class="text-white"
                               href="{{route('global_register_page')}}">{{trans('messages.register')}}</a>
                        @endif
                        @foreach($locals as $local)
                            @if($local != App()->getLocale())
                                <span class="text-white">|</span>
                                <a class="text-white"
                                   href="/{{$local}}">{{trans("words.$local")}}</a>
                            @endif
                        @endforeach
                    </div>
                    <ul class="menuzord-menu pull-right">
                        @foreach($menu as $item)
                            <li><a class="text-white-f6" href="{{$item['url']}}">{{$item['name']}}</a>
                                @if($item->subMenu()->exists())
                                    @include('layouts.global.nested_menu',['sub_menu'=>$item->subMenu])
                                @endif
                            </li>
                        @endforeach


                        @if(session()->get('cart'))
                            <li><a href="{{route('store_order')}}">{{__('messages.buy_basket')}}</a></li>
                        @endif
                        @if(has_caravan())
                            <li><a href="{{route('global_caravan')}}">{{__('messages.caravan')}}</a></li>
                        @endif
                            <li><a href="#menu"><span></span></a></li>

                    </ul>
                </nav>



            </div>
        </div>
    </div>
    <nav id="menu">
        <ul>
            @foreach($menu as $item)
                <li><a class="text-white-f6" href="{{$item['url']}}">{{$item['name']}}</a>
                    @if($item->subMenu()->exists())
                        @include('layouts.global.nested_menu',['sub_menu'=>$item->subMenu->sortBy('order')])
                    @endif
                </li>
            @endforeach
        </ul>
    </nav>

</header>


<script>
    var menu = new MmenuLight( document.querySelector( '#menu' ), {
         title: '{{trans('site_info.site_name')}}',
         theme: 'dark',// 'dark'
        // slidingSubmenus: true,// false
        // selected: 'Selected'
    });
    menu.enable( 'all' ); // '(max-width: 900px)'
    menu.offcanvas({
         position: 'right',// 'right'
        // move: true,// false
        // blockPage: true,// false / 'modal'
    });

    //	Open the menu.
    document.querySelector( 'a[href="#menu"]' )
        .addEventListener( 'click', ( evnt ) => {
            menu.open();

            //	Don't forget to "preventDefault" and to "stopPropagation".
            evnt.preventDefault();
            evnt.stopPropagation();
        });

</script>



