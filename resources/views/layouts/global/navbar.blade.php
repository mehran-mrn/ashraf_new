<!-- Header -->
<header id="header" class="header">
    <div class="header-top p-0 bg-theme-colored xs-text-center"
         data-bg-img="{{ URL::asset('/public/assets/global/images/footer-bg.png') }}">
        <div class="container pt-20 pb-20">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="widget no-border m-0">
                        <a class="menuzord-brand pull-left flip xs-pull-center mb-15" href="{{route('home')}}"><img
                                    src="{{ URL::asset('/public/assets/global/images/logo-wide-white.png') }}"
                                    alt=""></a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="widget no-border clearfix m-0 mt-5">
                        <ul class="list-inline pull-right flip sm-pull-none sm-text-center mt-5">
                            <li>
                                <a class="text-white" href="#">{{__('messages.FAQ')}}</a>
                            </li>
                            <li class="text-white">|</li>
                            <li>
                                <a class="text-white" href="#">{{trans('messages.help_desk')}}</a>
                            </li>
                            <li class="text-white">|</li>
                            <li>
                                <a class="text-white" href="#">{{trans('messages.support')}}</a>
                            </li>
                            <li class="text-white">|</li>
                            <li>
                                <button class="btn btn-default btn-xs">{{__('messages.buy_basket')}}</button>
                            </li>
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
                    <ul class="menuzord-menu">
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
                                <li><a href="#">{{__("messages.financial_aids")}}</a></li>
                                <li><a href="#">{{__("messages.Periodic_assistance")}}</a></li>
                            </ul>
                        </li>

                        <li><a href="#">Mega Menu</a>
                            <div class="megamenu">
                                <div class="megamenu-row">
                                    <div class="col3">
                                        <ul class="list-unstyled list-dashed">
                                            <li>
                                                <h5 class="pl-10"><strong>Quick Links:</strong></h5>
                                            </li>
                                            <li><a href="#">Privacy Policy</a></li>
                                            <li><a href="#">Donor Privacy Policy</a></li>
                                            <li><a href="#">Disclaimer</a></li>
                                            <li><a href="#">Terms of Use</a></li>
                                            <li><a href="#">Copyright Notice</a></li>
                                            <li><a href="#">Media Center</a></li>
                                            <li><a href="#">Privacy Policy</a></li>
                                            <li><a href="#">Donor Privacy Policy</a></li>
                                        </ul>
                                    </div>
                                    <div class="col5">
                                        <h5 class=""><strong>Featured News:</strong></h5>
                                        <article class="post clearfix">
                                            <div class="entry-header">
                                                <div class="post-thumb"><img class="img-fullwidth"
                                                                             src="images/blog/mega-menu.jpg" alt="">
                                                </div>
                                            </div>
                                            <div class="post-details">
                                                <h4 class="entry-title mt-10"><a href="#">Featured News Title Here</a>
                                                </h4>
                                                <p class="">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                                    do eiusmod tempor incididunt ut labore et dolore magna et sed aliqua<a
                                                            class="text-theme-colored" href="#"> read more →</a></p>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="col4">
                                        <h5 class=""><strong>Latest News:</strong></h5>
                                        <div class="list-dashed">
                                            <article class="post media-post clearfix pb-0 mb-10"><a href="#"
                                                                                                    class="post-thumb"><img
                                                            alt="" src="images/blog/square1.jpg"></a>
                                                <div class="post-right">
                                                    <h5 class="post-title mt-0"><a href="#">Bankruptcy Rights
                                                            Proceedings</a></h5>
                                                    <p>Oct 23, 2015</p>
                                                </div>
                                            </article>
                                            <article class="post media-post clearfix pb-0 mb-10"><a href="#"
                                                                                                    class="post-thumb"><img
                                                            alt="" src="images/blog/square2.jpg"></a>
                                                <div class="post-right">
                                                    <h5 class="post-title mt-0"><a href="#">Assertive and Persistent
                                                            Advocacy</a></h5>
                                                    <p>Jun 23, 2015</p>
                                                </div>
                                            </article>
                                            <article class="post media-post clearfix pb-0 mb-10"><a href="#"
                                                                                                    class="post-thumb"><img
                                                            alt="" src="images/blog/square3.jpg"></a>
                                                <div class="post-right">
                                                    <h5 class="post-title mt-0"><a href="#">Government Contracts
                                                            Procurement</a></h5>
                                                    <p>Apr 15, 2015</p>
                                                </div>
                                            </article>
                                            <article class="post media-post clearfix pb-0 mb-10"><a href="#"
                                                                                                    class="post-thumb"><img
                                                            alt="" src="images/blog/square2.jpg"></a>
                                                <div class="post-right">
                                                    <h5 class="post-title mt-0"><a href="#">Criminal Defence
                                                            Advocacy</a></h5>
                                                    <p>Mar 08, 2015</p>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li><a href="#">Shortcodes <span class="label label-info">New</span></a>
                            <div class="megamenu">
                                <div class="megamenu-row">
                                    <div class="col3">
                                        <ul class="list-unstyled list-dashed">
                                            <li><a href="shortcode-accordion.html"><i class="fa fa-list-ul"></i>
                                                    Accordion</a></li>
                                            <li><a href="shortcode-alerts.html"><i class="fa fa-exclamation-circle"></i>
                                                    Alerts</a></li>
                                            <li><a href="shortcode-animations.html"><i class="fa fa-magic"></i>
                                                    Animations</a></li>
                                            <li><a href="shortcode-background-html5-video.html"><i
                                                            class="fa fa-video-camera"></i> HTML5 Background Video</a>
                                            </li>
                                            <li><a href="shortcode-blockquotes.html"><i class="fa fa-quote-right"></i>
                                                    Blockquotes</a></li>
                                            <li><a href="shortcode-button-groups-and-dropdowns.html"><i
                                                            class="fa fa-link"></i> Button Groups</a></li>
                                            <li><a href="shortcode-button-hover-effect.html"><i
                                                            class="fa fa-flag-o"></i> Button Hover Effect</a></li>
                                            <li><a href="shortcode-buttons.html"><i class="fa fa-external-link"></i>
                                                    Buttons</a></li>
                                            <li><a href="shortcode-call-to-actions.html"><i
                                                            class="fa fa-plus-square"></i> Call To Actions</a></li>
                                            <li><a href="shortcode-charts.html"><i class="fa fa-pie-chart"></i>
                                                    Charts</a></li>
                                            <li><a href="shortcode-columns-grids.html"><i class="fa fa-columns"></i>
                                                    Columns Grids</a></li>
                                            <li><a href="shortcode-divider.html"><i class="fa fa-indent"></i>
                                                    Divider</a></li>
                                            <li><a href="shortcode-dropcaps.html"><i class="fa fa-bold"></i>
                                                    Dropcaps</a></li>
                                            <li><a href="shortcode-datetime-datepicker.html"><i
                                                            class="fa fa-calendar"></i> Date Picker</a></li>
                                            <li><a href="shortcode-datetime-timepicker.html"><i
                                                            class="fa fa-calendar"></i> Time Picker</a></li>
                                        </ul>
                                    </div>
                                    <div class="col3">
                                        <ul class="list-unstyled list-dashed">
                                            <li><a href="shortcode-datetime-datetimepicker.html"><i
                                                            class="fa fa-calendar"></i> Bootstrap Date-Time Picker</a>
                                            </li>
                                            <li><a href="shortcode-datetime-datepair.html"><i
                                                            class="fa fa-calendar"></i> Date Pair</a></li>
                                            <li><a href="shortcode-flex-sliders.html"><i class="fa fa-sliders"></i> Flex
                                                    Sliders</a></li>
                                            <li><a href="shortcode-flipbox.html"><i class="fa fa-square"></i>
                                                    Flipbox</a></li>
                                            <li><a href="shortcode-forms.html"><i class="fa fa-align-justify"></i> Forms</a>
                                            </li>
                                            <li><a href="shortcode-iconbox.html"><i class="fa fa-unsorted"></i> Icon Box</a>
                                            </li>
                                            <li><a href="shortcode-icon-7stroke.html"><i class="fa fa-circle-o"></i>
                                                    Icons 7stroke</a></li>
                                            <li><a href="shortcode-icon-elegant-icons.html"><i
                                                            class="fa fa-eye-slash"></i> Icons Elegant</a></li>
                                            <li><a href="shortcode-icon-flat-color-icons.html"><i
                                                            class="fa fa-i-cursor"></i> Icons Flat Color</a></li>
                                            <li><a href="shortcode-icon-fontawesome.html"><i
                                                            class="fa fa-fort-awesome"></i> Icons FontAwesome</a></li>
                                            <li><a href="shortcode-icon-fontawesome-tutorial.html"><i
                                                            class="fa fa-fonticons"></i> Icons FontAwesome Tutorial</a>
                                            </li>
                                            <li><a href="shortcode-icon-strokegap.html"><i class="fa fa-anchor"></i>
                                                    Icons Strokegap</a></li>
                                            <li><a href="shortcode-image-box.html"><i class="fa fa-file-image-o"></i>
                                                    Image Box</a></li>
                                            <li><a href="shortcode-instagram.html"><i class="fa fa-instagram"></i>
                                                    Instagram Feed</a></li>
                                            <li><a href="shortcode-labels-badges.html"><i
                                                            class="fa fa-check-square-o"></i> Labels Badges</a></li>
                                        </ul>
                                    </div>
                                    <div class="col3">
                                        <ul class="list-unstyled list-dashed">
                                            <li><a href="shortcode-listgroup-panels.html"><i class="fa fa-th-list"></i>
                                                    Listgroup Panels</a></li>
                                            <li><a href="shortcode-lists.html"><i class="fa fa-list"></i> Lists</a></li>
                                            <li><a href="shortcode-maps.html"><i class="fa fa-map-o"></i> Maps</a></li>
                                            <li><a href="shortcode-media-embed.html"><i class="fa fa-play-circle-o"></i>
                                                    Media Embed</a></li>
                                            <li><a href="shortcode-modal-bootstrap.html"><i
                                                            class="fa fa-search-plus"></i> Modal</a></li>
                                            <li><a href="shortcode-modal-lightbox.html"><i class="fa fa-expand"></i>
                                                    Lightbox</a></li>
                                            <li><a href="shortcode-navigation.html"><i class="fa fa-navicon"></i>
                                                    Navigation</a></li>
                                            <li><a href="shortcode-owl-carousel.html"><i class="fa fa-sliders"></i> Owl
                                                    Carousel</a></li>
                                            <li><a href="shortcode-pagination.html"><i
                                                            class="fa fa-arrow-circle-o-right"></i> Pagination</a></li>
                                            <li><a href="shortcode-progressbar.html"><i class="fa fa-tasks"></i>
                                                    Progress Bars</a></li>
                                            <li><a href="shortcode-responsive.html"><i class="fa fa-tablet"></i>
                                                    Responsive</a></li>
                                            <li><a href="shortcode-separator.html"><i class="fa fa-minus-square-o"></i>
                                                    Separator</a></li>
                                            <li><a href="shortcode-sitemap.html"><i class="fa fa-sitemap"></i>
                                                    Sitemap</a></li>
                                            <li><a href="shortcode-sliders.html"><i class="fa fa-sliders"></i>
                                                    Sliders</a></li>
                                            <li><a href="shortcode-smoothscrolling.html"><i
                                                            class="fa fa-binoculars"></i> Smoothscrolling</a></li>
                                        </ul>
                                    </div>
                                    <div class="col3">
                                        <ul class="list-unstyled list-dashed">
                                            <li><a href="shortcode-styled-icons.html"><i
                                                            class="fa fa-facebook-square"></i> Styled Icons</a></li>
                                            <li><a href="shortcode-subscribe.html"><i class="fa fa-user-plus"></i>
                                                    Subscribe</a></li>
                                            <li><a href="shortcode-tables.html"><i class="fa fa-table"></i> Tables</a>
                                            </li>
                                            <li><a href="shortcode-tabs.html"><i class="fa fa-indent"></i> Tabs</a></li>
                                            <li><a href="shortcode-textblock.html"><i class="fa fa-bold"></i> Textblock</a>
                                            </li>
                                            <li><a href="shortcode-thumbnails-carousels.html"><i
                                                            class="fa fa-sliders"></i> Thumbnails/carousels</a></li>
                                            <li><a href="shortcode-title.html"><i class="fa fa-text-height"></i>
                                                    Title</a></li>
                                            <li><a href="shortcode-timer-final-countdown.html"><i
                                                            class="fa fa-text-height"></i> Timer Final Countdown</a>
                                            </li>
                                            <li><a href="shortcode-timer-flipclock.html"><i
                                                            class="fa fa-text-height"></i> Timer Flipclock</a></li>
                                            <li><a href="shortcode-timer-slick-circular.html"><i
                                                            class="fa fa-text-height"></i> Timer Slick Circular</a></li>
                                            <li><a href="shortcode-twitter.html"><i class="fa fa-twitter-square"></i>
                                                    Twitter Feed</a></li>
                                            <li><a href="shortcode-typography.html"><i class="fa fa-font"></i>
                                                    Typography</a></li>
                                            <li><a href="shortcode-vertical-timeline.html"><i
                                                            class="fa fa-arrows-v"></i> Vertical Timeline</a></li>
                                            <li><a href="shortcode-widgets.html"><i class="fa fa-gift"></i> Widgets</a>
                                            </li>
                                            <li><a href="shortcode-working-process.html"><i class="fa fa-exchange"></i>
                                                    Working Process</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="list-inline pull-right flip hidden-sm hidden-xs">
                        @if (Auth::check())
                            <li>
                                <a class="btn btn-colored btn-flat btn-theme-colored mt-15"
                                   href="{{route('global_profile')}}">{{trans('messages.account')}}</a>
                            </li>
                            <li>
                                <a class="btn btn-colored btn-flat btn-theme-colored mt-15 ajaxload-popup"
                                   href="{{route('logout')}}">{{trans('messages.logout')}}</a>
                            </li>
                        @else
                            <li>
                                <a class="btn btn-colored btn-flat btn-theme-colored mt-15 ajaxload-popup"
                                   href="{{route('global_login_form')}}">{{trans('messages.login')}}</a>
                            </li>
                            <li>
                                <a class="btn btn-colored btn-flat btn-theme-colored mt-15 ajaxload-popup"
                                   href="{{route('global_register_form')}}"> {{trans('messages.register')}}</a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
