


<!-- Section: home -->
<section id="home">
    <div class="container-fluid p-0">

        <!-- Slider Revolution Start -->
        <div class="rev_slider_wrapper">
            <div class="rev_slider  rev_slider_fullscreen rev-slide " data-version="5.0">
                <ul>
                @forelse($sliders as $key=>$slider)
                    <!-- SLIDE 1 -->
                        <li data-index="rs-{{$key}}" data-transition="slidingoverlayhorizontal" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="{{ $slider['image_large'] }}" data-rotate="0" data-saveperformance="off" data-title="Slide 1" data-description="">
                            <!-- MAIN IMAGE -->
                            <img src="{{ $slider['image_large'] }}"  alt=""  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-bgparallax="10" data-no-retina>
                            <!-- LAYERS -->
                        @if($slider['text_1'])
                            <!-- LAYER NR. 1 -->
                                <div class="tp-caption tp-resizeme   bg-dark-transparent text-white  pl-20 pr-20"
                                     id="rs-{{$key}}-layer-1"

                                     data-x="['@switch($slider['text_1_dir'])
                                     @case('left'){{'left'}}@break
                                     @case('right'){{'right'}}@break
                                     @case('center'){{'middle'}}@break
                                     @default{{'middle'}}@break
                                     @endswitch']"
                                     data-hoffset="['0']"
                                     data-y="['middle']"
                                     data-voffset="['-200']"
                                     data-fontsize="['28']"
                                     data-lineheight="['54']"
                                     data-width="none"
                                     data-height="none"
                                     data-whitespace="nowrap"
                                     data-transform_idle="o:1;s:500"
                                     data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                                     data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                                     data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                                     data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                                     data-start="1000"
                                     data-splitin="none"
                                     data-splitout="none"
                                     data-responsive_offset="none"
                                     style="border-radius: 30px;"
                                >{!! $slider['text_1'] !!}
                                </div>
                        @endif
                        @if($slider['text_2'])

                            <!-- LAYER NR. 2 -->
                                <div class="tp-caption tp-resizeme text-white text-center"
                                     id="rs-{{$key}}-layer-2"

                                     data-x="['@switch($slider['text_2_dir'])
                                     @case('left'){{'left'}}@break
                                     @case('right'){{'right'}}@break
                                     @case('center'){{'middle'}}@break
                                     @default{{'middle'}}@break
                                     @endswitch']"
                                     data-hoffset="['0']"
                                     data-y="['middle']"
                                     data-voffset="['-40']"
                                     data-fontsize="['48']"
                                     data-lineheight="['70']"
                                     data-width="none"
                                     data-height="none"
                                     data-whitespace="nowrap"
                                     data-transform_idle="o:1;s:900"
                                     data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                                     data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                                     data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                                     data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                                     data-start="1000"
                                     data-splitin="none"
                                     data-splitout="none"
                                     data-responsive_offset="on"
                                     style="border-radius: 30px;">{!! $slider['text_2'] !!}
                                </div>
                        @endif
                        @if($slider['text_3'])
                            <!-- LAYER NR. 3 -->
                                <div class="tp-caption tp-resizeme text-white text-center"
                                     id="rs-{{$key}}-layer-3"

                                     data-x="['@switch($slider['text_3_dir'])
                                     @case('left'){{'left'}}@break
                                     @case('right'){{'right'}}@break
                                     @case('center'){{'middle'}}@break
                                     @default{{'middle'}}@break
                                     @endswitch']"
                                     data-hoffset="['0']"
                                     data-y="['middle']"
                                     data-voffset="['60']"
                                     data-fontsize="['16','18',24']"
                                     data-lineheight="['28']"
                                     data-width="none"
                                     data-height="none"
                                     data-whitespace="nowrap"
                                     data-transform_idle="o:1;s:500"
                                     data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                                     data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                                     data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                                     data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                                     data-start="1400"
                                     data-splitin="none"
                                     data-splitout="none"
                                     data-responsive_offset="on"
                                     style="border-radius: 30px;"
                                >{!!$slider['text_3']!!}
                                </div>
                        @endif
                        @if($slider['btn_text'])
                            <!-- LAYER NR. 4 -->
                                <div class="tp-caption tp-resizeme"
                                     id="rs-{{$key}}-layer-4"

                                     data-x="['@switch($slider['btn_dir'])
                                     @case('left'){{'left'}}@break
                                     @case('right'){{'right'}}@break
                                     @case('center'){{'middle'}}@break
                                     @default{{'middle'}}@break
                                     @endswitch']"
                                     data-hoffset="['0']"
                                     data-y="['middle']"
                                     data-voffset="['125']"
                                     data-width="none"
                                     data-height="none"
                                     data-whitespace="nowrap"
                                     data-transform_idle="o:1;"
                                     data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                                     data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                                     data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;"
                                     data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                                     data-start="1400"
                                     data-splitin="none"
                                     data-splitout="none"
                                     data-responsive_offset="on"
                                     style="z-index: 5; white-space: nowrap; letter-spacing:1px;"><a class="btn btn-default btn-circled btn-transparent pl-20 pr-20" href="{{$slider['btn_link']}}">{{$slider['btn_text']}}</a>
                                </div>
                            @endif

                        </li>

                @empty
                    <!-- SLIDE 1 -->
                        <li data-index="rs-1" data-transition="slidingoverlayhorizontal" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="{{ URL::asset('/public/assets/global/images/bg/bg14.jpg') }}" data-rotate="0" data-saveperformance="off" data-title="Slide 1" data-description="">
                            <!-- MAIN IMAGE -->
                            <img src="{{ URL::asset('/public/assets/global/images/bg/bg14.jpg') }}"  alt=""  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-bgparallax="10" data-no-retina>
                            <!-- LAYERS -->

                            <!-- LAYER NR. 1 -->
                            <div class="tp-caption tp-resizeme text-uppercase  bg-dark-transparent text-white font-raleway pl-30 pr-30"
                                 id="rs-1-layer-1"

                                 data-x="['center']"
                                 data-hoffset="['0']"
                                 data-y="['middle']"
                                 data-voffset="['-90']"
                                 data-fontsize="['28']"
                                 data-lineheight="['54']"
                                 data-width="none"
                                 data-height="none"
                                 data-whitespace="nowrap"
                                 data-transform_idle="o:1;s:500"
                                 data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                                 data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                                 data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                                 data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                                 data-start="1000"
                                 data-splitin="none"
                                 data-splitout="none"
                                 data-responsive_offset="on"
                                 style="z-index: 7; white-space: nowrap; font-weight:400; border-radius: 30px;">For the poor children
                            </div>

                            <!-- LAYER NR. 2 -->
                            <div class="tp-caption tp-resizeme text-uppercase bg-theme-colored-transparent text-white font-raleway pl-30 pr-30"
                                 id="rs-1-layer-2"

                                 data-x="['left']"
                                 data-hoffset="['0']"
                                 data-y="['middle']"
                                 data-voffset="['-20']"
                                 data-fontsize="['48']"
                                 data-lineheight="['70']"
                                 data-width="none"
                                 data-height="none"
                                 data-whitespace="nowrap"
                                 data-transform_idle="o:1;s:500"
                                 data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                                 data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                                 data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                                 data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                                 data-start="1000"
                                 data-splitin="none"
                                 data-splitout="none"
                                 data-responsive_offset="on"
                                 style="z-index: 7; white-space: nowrap; font-weight:700; border-radius: 30px;">raise your helping hand
                            </div>

                            <!-- LAYER NR. 3 -->
                            <div class="tp-caption tp-resizeme text-white text-center"
                                 id="rs-1-layer-3"

                                 data-x="['right']"
                                 data-hoffset="['0']"
                                 data-y="['middle']"
                                 data-voffset="['50']"
                                 data-fontsize="['16','18',24']"
                                 data-lineheight="['28']"
                                 data-width="none"
                                 data-height="none"
                                 data-whitespace="nowrap"
                                 data-transform_idle="o:1;s:500"
                                 data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                                 data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                                 data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                                 data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                                 data-start="1400"
                                 data-splitin="none"
                                 data-splitout="none"
                                 data-responsive_offset="on"
                                 style="z-index: 5; white-space: nowrap; letter-spacing:0px; font-weight:400;">Every day we bring hope to millions of children in the world's<br>  hardest places as a sign of God's unconditional love.
                            </div>

                            <!-- LAYER NR. 4 -->
                            <div class="tp-caption tp-resizeme"
                                 id="rs-1-layer-4"

                                 data-x="['center']"
                                 data-hoffset="['0']"
                                 data-y="['middle']"
                                 data-voffset="['115']"
                                 data-width="none"
                                 data-height="none"
                                 data-whitespace="nowrap"
                                 data-transform_idle="o:1;"
                                 data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                                 data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                                 data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;"
                                 data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                                 data-start="1400"
                                 data-splitin="none"
                                 data-splitout="none"
                                 data-responsive_offset="on"
                                 style="z-index: 5; white-space: nowrap; letter-spacing:1px;"><a class="btn btn-default btn-circled btn-transparent pl-20 pr-20" href="#">Donate Now</a>
                            </div>
                        </li>

                        <!-- SLIDE 2 -->
                        <li data-index="rs-2" data-transition="slidingoverlayhorizontal" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="{{ URL::asset('/public/assets/global/images/bg/bg5.jpg') }}" data-rotate="0" data-saveperformance="off" data-title="Slide 2" data-description="">
                            <!-- MAIN IMAGE -->
                            <img src="{{ URL::asset('/public/assets/global/images/bg/bg5.jpg') }}"  alt=""  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-bgparallax="10" data-no-retina>
                            <!-- LAYERS -->

                            <!-- LAYER NR. 1 -->
                            <div class="tp-caption tp-resizeme text-uppercase text-white font-raleway"
                                 id="rs-2-layer-1"

                                 data-x="['left']"
                                 data-hoffset="['30']"
                                 data-y="['middle']"
                                 data-voffset="['-110']"
                                 data-fontsize="['110']"
                                 data-lineheight="['120']"
                                 data-width="none"
                                 data-height="none"
                                 data-whitespace="nowrap"
                                 data-transform_idle="o:1;s:500"
                                 data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                                 data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                                 data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                                 data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                                 data-start="1000"
                                 data-splitin="none"
                                 data-splitout="none"
                                 data-responsive_offset="on"
                                 style="z-index: 7; white-space: nowrap; font-weight:700;">Donate
                            </div>

                            <!-- LAYER NR. 2 -->
                            <div class="tp-caption tp-resizeme text-uppercase text-white font-raleway bg-theme-colored-transparent pl-20 pr-20"
                                 id="rs-2-layer-2"

                                 data-x="['left']"
                                 data-hoffset="['35']"
                                 data-y="['middle']"
                                 data-voffset="['-25']"
                                 data-fontsize="['35']"
                                 data-lineheight="['54']"
                                 data-width="none"
                                 data-height="none"
                                 data-whitespace="nowrap"
                                 data-transform_idle="o:1;s:500"
                                 data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                                 data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                                 data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                                 data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                                 data-start="1000"
                                 data-splitin="none"
                                 data-splitout="none"
                                 data-responsive_offset="on"
                                 style="z-index: 7; white-space: nowrap; font-weight:600;">For the poor children
                            </div>

                            <!-- LAYER NR. 3 -->
                            <div class="tp-caption tp-resizeme text-white"
                                 id="rs-2-layer-3"

                                 data-x="['left']"
                                 data-hoffset="['35']"
                                 data-y="['middle']"
                                 data-voffset="['35','35','40']"
                                 data-fontsize="['16','18',24']"
                                 data-lineheight="['28']"
                                 data-width="none"
                                 data-height="none"
                                 data-whitespace="nowrap"
                                 data-transform_idle="o:1;s:500"
                                 data-transform_in="y:100;scaleX:1;scaleY:1;opacity:0;"
                                 data-transform_out="x:left(R);s:1000;e:Power3.easeIn;s:1000;e:Power3.easeIn;"
                                 data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                                 data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                                 data-start="1400"
                                 data-splitin="none"
                                 data-splitout="none"
                                 data-responsive_offset="on"
                                 style="z-index: 5; white-space: nowrap; letter-spacing:0px; font-weight:400;">Every day we bring hope to millions of children in the world's<br>  hardest places as a sign of God's unconditional love.
                            </div>

                            <!-- LAYER NR. 4 -->
                            <div class="tp-caption tp-resizeme"
                                 id="rs-2-layer-4"

                                 data-x="['left']"
                                 data-hoffset="['35']"
                                 data-y="['middle']"
                                 data-voffset="['95','105','110']"
                                 data-width="none"
                                 data-height="none"
                                 data-whitespace="nowrap"
                                 data-transform_idle="o:1;"
                                 data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                                 data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                                 data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;"
                                 data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                                 data-start="1400"
                                 data-splitin="none"
                                 data-splitout="none"
                                 data-responsive_offset="on"
                                 style="z-index: 5; white-space: nowrap; letter-spacing:1px;"><a class="btn btn-colored btn-lg btn-theme-colored pl-20 pr-20" href="#">Donate Now</a>
                            </div>
                        </li>

                    @endforelse
                </ul>
            </div>
            <!-- end .rev_slider -->
        </div>
        <!--  Revolution slider scriopt -->
        <script>
            $(document).ready(function(e) {
                $(".rev_slider_fullscreen").revolution({
                    sliderType:"standard",
                    sliderLayout: "auto",
                    dottedOverlay: "none",
                    delay: 5000,
                    navigation: {
                        keyboardNavigation: "off",
                        keyboard_direction: "horizontal",
                        mouseScrollNavigation: "off",
                        onHoverStop: "off",
                        touch: {
                            touchenabled: "on",
                            swipe_threshold: 75,
                            swipe_min_touches: 1,
                            swipe_direction: "horizontal",
                            drag_block_vertical: false
                        },
                        arrows: {
                            style:"zeus",
                            enable:true,
                            hide_onmobile:true,
                            hide_under:600,
                            hide_onleave:true,
                            hide_delay:200,
                            hide_delay_mobile:1200,
                            tmp:'<div class="tp-title-wrap">    <div class="tp-arr-imgholder"></div> </div>',
                            left: {
                                h_align:"left",
                                v_align:"center",
                                h_offset:30,
                                v_offset:0
                            },
                            right: {
                                h_align:"right",
                                v_align:"center",
                                h_offset:30,
                                v_offset:0
                            }
                        },
                        bullets: {
                            enable:true,
                            hide_onmobile:true,
                            hide_under:600,
                            style:"metis",
                            hide_onleave:true,
                            hide_delay:200,
                            hide_delay_mobile:1200,
                            direction:"horizontal",
                            h_align:"center",
                            v_align:"bottom",
                            h_offset:0,
                            v_offset:30,
                            space:5,
                            tmp:'<span class="tp-bullet-img-wrap">  <span class="tp-bullet-image"></span></span><span class="tp-bullet-title"></span>'
                        }
                    },
                    responsiveLevels: [1240, 1024, 778],
                    visibilityLevels: [1240, 1024, 778],
                    gridwidth: [1170, 1024, 778, 480],
                    gridheight: [600, 768, 960, 720],
                    lazyType: "none",
                    parallax: {
                        origo: "slidercenter",
                        speed: 1000,
                        levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 100, 55],
                        type: "scroll"
                    },
                    shadow: 0,
                    spinner: "off",
                    stopLoop: "on",
                    stopAfterLoops: 0,
                    stopAtSlide: -1,
                    shuffle: "off",
                    autoHeight: "off",
                    fullScreenAutoWidth: "off",
                    fullScreenAlignForce: "off",
                    fullScreenOffsetContainer: "",
                    fullScreenOffset: "0",
                    hideThumbsOnMobile: "off",
                    hideSliderAtLimit: 0,
                    hideCaptionAtLimit: 0,
                    hideAllCaptionAtLilmit: 0,
                    debugMode: false,
                    fallbacks: {
                        simplifyAll: "off",
                        nextSlideOnWindowFocus: "off",
                        disableFocusListener: false,
                    }
                });
            });
        </script>
        <!-- Slider Revolution Ends -->
    </div>
</section>











<body style="padding:0px; margin:0px; background-color:#fff;font-family:arial,helvetica,sans-serif,verdana,'Open Sans'">

<!-- #region Jssor Slider Begin -->
<!-- Generator: Jssor Slider Maker -->
<!-- Source: https://www.jssor.com -->
<script src="{{ URL::asset('/public/js/jssor.slider-27.5.0.min.js') }}"></script>
<script type="text/javascript">
    jssor_1_slider_init = function() {

        var jssor_1_SlideoTransitions = [
            [{b:0,d:600,y:-290,e:{y:27}}],
            [{b:0,d:1000,y:185},{b:1000,d:500,o:-1},{b:1500,d:500,o:1},{b:2000,d:1500,r:360},{b:3500,d:1000,rX:30},{b:4500,d:500,rX:-30},{b:5000,d:1000,rY:30},{b:6000,d:500,rY:-30},{b:6500,d:500,sX:1},{b:7000,d:500,sX:-1},{b:7500,d:500,sY:1},{b:8000,d:500,sY:-1},{b:8500,d:500,kX:30},{b:9000,d:500,kX:-30},{b:9500,d:500,kY:30},{b:10000,d:500,kY:-30},{b:10500,d:500,c:{x:125.00,t:-125.00}},{b:11000,d:500,c:{x:-125.00,t:125.00}}],
            [{b:0,d:600,x:535,e:{x:27}}],
            [{b:-1,d:1,o:-1},{b:0,d:600,o:1,e:{o:5}}],
            [{b:-1,d:1,c:{x:250.0,t:-250.0}},{b:0,d:800,c:{x:-250.0,t:250.0},e:{c:{x:7,t:7}}}],
            [{b:-1,d:1,o:-1},{b:0,d:600,x:-570,o:1,e:{x:6}}],
            [{b:-1,d:1,o:-1,r:-180},{b:0,d:800,o:1,r:180,e:{r:7}}],
            [{b:0,d:1000,y:80,e:{y:24}},{b:1000,d:1100,x:570,y:170,o:-1,r:30,sX:9,sY:9,e:{x:2,y:6,r:1,sX:5,sY:5}}],
            [{b:2000,d:600,rY:30}],
            [{b:0,d:500,x:-105},{b:500,d:500,x:230},{b:1000,d:500,y:-120},{b:1500,d:500,x:-70,y:120},{b:2600,d:500,y:-80},{b:3100,d:900,y:160,e:{y:24}}],
            [{b:0,d:1000,o:-0.4,rX:2,rY:1},{b:1000,d:1000,rY:1},{b:2000,d:1000,rX:-1},{b:3000,d:1000,rY:-1},{b:4000,d:1000,o:0.4,rX:-1,rY:-1}]
        ];

        var jssor_1_options = {
            $AutoPlay: 1,
            $Idle: 2000,
            $CaptionSliderOptions: {
                $Class: $JssorCaptionSlideo$,
                $Transitions: jssor_1_SlideoTransitions,
                $Breaks: [
                    [{d:2000,b:1000}]
                ]
            },
            $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
            },
            $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$
            }
        };

        var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

        /*#region responsive code begin*/

        var MAX_WIDTH = 980;

        function ScaleSlider() {
            var containerElement = jssor_1_slider.$Elmt.parentNode;
            var containerWidth = containerElement.clientWidth;

            if (containerWidth) {

                var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                jssor_1_slider.$ScaleWidth(expectedWidth);
            }
            else {
                window.setTimeout(ScaleSlider, 30);
            }
        }

        ScaleSlider();

        $Jssor$.$AddEvent(window, "load", ScaleSlider);
        $Jssor$.$AddEvent(window, "resize", ScaleSlider);
        $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
        /*#endregion responsive code end*/
    };
</script>
<link href="//fonts.googleapis.com/css?family=Oswald:200,300,regular,500,600,700&subset=latin-ext,vietnamese,latin,cyrillic" rel="stylesheet" type="text/css" />
<style>
    /* jssor slider loading skin spin css */
    .jssorl-009-spin img {
        animation-name: jssorl-009-spin;
        animation-duration: 1.6s;
        animation-iteration-count: infinite;
        animation-timing-function: linear;
    }

    @keyframes jssorl-009-spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }


    .jssorb052 .i {position:absolute;cursor:pointer;}
    .jssorb052 .i .b {fill:#000;fill-opacity:0.3;}
    .jssorb052 .i:hover .b {fill-opacity:.7;}
    .jssorb052 .iav .b {fill-opacity: 1;}
    .jssorb052 .i.idn {opacity:.3;}

    .jssora053 {display:block;position:absolute;cursor:pointer;}
    .jssora053 .a {fill:none;stroke:#fff;stroke-width:640;stroke-miterlimit:10;}
    .jssora053:hover {opacity:.8;}
    .jssora053.jssora053dn {opacity:.5;}
    .jssora053.jssora053ds {opacity:.3;pointer-events:none;}
</style>
<div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:380px;overflow:hidden;visibility:hidden;">
    <!-- Loading Screen -->
    <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
        <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/spin.svg" />
    </div>
    <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:380px;overflow:hidden;">

    @forelse($sliders as $key=>$slider)
        <!-- SLIDE 1 -->
            <div data-p="170">
                <img data-u="image" src="{{ $slider['image_large'] }}" />
                @if($slider['text_1'])
                    <div data-t="{{$key}}" style="position:absolute;top:320px;left:30px;width:500px;height:40px;font-family:Oswald,sans-serif;font-size:32px;font-weight:200;line-height:1.2;text-align:center;background-color:rgba(255,188,5,0.8);">
                        {{$slider['text_1']}}
                    </div>
                @endif
                @if($slider['text_2'])
                    <div data-t="{{$key}}" style="position:absolute;top:320px;left:30px;width:500px;height:40px;font-family:Oswald,sans-serif;font-size:32px;font-weight:200;line-height:1.2;text-align:center;background-color:rgba(255,188,5,0.8);">
                        {{$slider['text_2']}}
                    </div>
                @endif
                @if($slider['text_3'])
                    <div data-t="{{$key}}" style="position:absolute;top:320px;left:30px;width:500px;height:40px;font-family:Oswald,sans-serif;font-size:32px;font-weight:200;line-height:1.2;text-align:center;background-color:rgba(255,188,5,0.8);">
                        {{$slider['text_3']}}
                    </div>
                @endif
                @if($slider['btn_text'])
                    <div data-t="{{$key}}" style="position:absolute;top:320px;left:30px;width:500px;height:40px;font-family:Oswald,sans-serif;font-size:32px;font-weight:200;line-height:1.2;text-align:center;background-color:rgba(255,188,5,0.8);">
                        <a href="{{$slider['btn_link']}}">{{$slider['btn_text']}}</a>
                    </div>
                @endif

            </div>
        @empty
            <div data-p="170">
                <img data-u="image" src="img/001.jpg" />
                <div data-t="0" style="position:absolute;top:320px;left:30px;width:500px;height:40px;font-family:Oswald,sans-serif;font-size:32px;font-weight:200;line-height:1.2;text-align:center;background-color:rgba(255,188,5,0.8);">Mobile ready, touch swipe</div>
            </div>
            <div data-p="170">
                <img data-u="image" src="img/002.jpg" />
                <div data-t="1" style="position:absolute;top:-50px;left:125px;width:500px;height:40px;font-family:Oswald,sans-serif;font-size:32px;font-weight:200;line-height:1.2;text-align:center;background-color:rgba(255,188,5,0.8);">Time lined layer animation</div>
            </div>
            <div data-p="170">
                <img data-u="image" src="img/003.jpg" />
                <div data-t="2" style="position:absolute;top:30px;left:-505px;width:500px;height:40px;font-family:Oswald,sans-serif;font-size:32px;font-weight:200;line-height:1.2;text-align:center;background-color:rgba(255,188,5,0.8);">Finger catchable right to left</div>
            </div>
            <div data-p="170">
                <img data-u="image" src="img/004.jpg" />
                <div data-t="3" style="position:absolute;top:30px;left:30px;width:500px;height:40px;font-family:Oswald,sans-serif;font-size:32px;font-weight:200;line-height:1.2;text-align:center;background-color:rgba(255,188,5,0.8);">responsive, scale smoothly</div>
            </div>
            <div data-p="170">
                <img data-u="image" src="img/005.jpg" />
                <div data-t="4" style="position:absolute;top:30px;left:30px;width:500px;height:40px;font-family:Oswald,sans-serif;font-size:32px;font-weight:200;line-height:1.2;text-align:center;background-color:rgba(255,188,5,0.8);">image, text, and custom layers</div>
            </div>
            <div data-p="170">
                <img data-u="image" src="img/006.jpg" />
                <div data-t="5" style="position:absolute;top:30px;left:600px;width:500px;height:40px;font-family:Oswald,sans-serif;font-size:32px;font-weight:200;line-height:1.2;text-align:center;background-color:rgba(255,188,5,0.8);">tons of transition type</div>
            </div>
            <div data-p="170">
                <img data-u="image" src="img/007.jpg" />
                <div data-t="6" style="position:absolute;top:30px;left:30px;width:500px;height:40px;font-family:Oswald,sans-serif;font-size:32px;font-weight:200;line-height:1.2;text-align:center;background-color:rgba(255,188,5,0.8);">visual slider maker</div>
            </div>
            <div data-b="0" data-p="170">
                <img data-u="image" src="img/008.jpg" />
                <div data-t="7" style="position:absolute;top:-50px;left:30px;width:500px;height:40px;font-family:Oswald,sans-serif;font-size:32px;font-weight:200;line-height:1.2;text-align:center;background-color:rgba(255,188,5,0.8);">play in and play out</div>
            </div>
            <div data-p="170">
                <img data-u="image" src="img/009.jpg" />
                <div data-t="8" data-ts="preserve-3d" style="position:absolute;top:25px;left:150px;width:250px;height:250px;overflow:hidden;background-color:rgba(40,177,255,0.6);">
                    <div data-t="9" style="position:absolute;top:100px;left:25px;width:200px;height:50px;font-family:Oswald,sans-serif;font-size:24px;font-weight:200;line-height:2.08;">A Child Layer</div>
                </div>
            </div>
            <div data-p="170">
                <img data-u="image" src="img/010.jpg" />
                <div data-t="10" style="position:absolute;top:25px;left:100px;width:300px;height:260px;font-family:Oswald,sans-serif;font-size:24px;font-weight:200;line-height:1.25;padding:15px 15px 15px 15px;box-sizing:border-box;background-color:rgba(40,177,255,0.6);background-clip:padding-box;">This is full customized content layer.<br />​<br />

                    Everything is allowed.<br />​<br />You can insert

                    <a href="http://wwww.jssor.com">
                        a link
                    </a> or an image

                    <img src="img/icon_chrome.png" /> here.
                </div>
            </div>
        @endforelse
    </div>
    <!-- Bullet Navigator -->
    <div data-u="navigator" class="jssorb052" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
        <div data-u="prototype" class="i" style="width:16px;height:16px;">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <circle class="b" cx="8000" cy="8000" r="5800"></circle>
            </svg>
        </div>
    </div>
    <!-- Arrow Navigator -->
    <div data-u="arrowleft" class="jssora053" style="width:55px;height:55px;top:0px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
        <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
            <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
        </svg>
    </div>
    <div data-u="arrowright" class="jssora053" style="width:55px;height:55px;top:0px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
        <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
            <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
        </svg>
    </div>
</div>
<script type="text/javascript">jssor_1_slider_init();</script>
<!-- #endregion Jssor Slider End -->














