@extends('layouts.panel.panel_layout')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('js')
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/visualization/echarts/echarts.min.js') }}"></script>
    {{--    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/demo_pages/charts/echarts/bars_tornados.js') }}"></script>--}}

    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/visualization/d3/d3.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/visualization/d3/d3_tooltip.js') }}"></script>

    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/visualization/d3/d3_tooltip.js') }}"></script>
    <script src="{{ URL::asset('/public/js/jssor.slider-27.5.0.min.js') }}"></script>

    <!-- Theme JS files -->
    {{--    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/notifications/pnotify.min.js') }}"></script>--}}
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    {{--    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/demo_pages/form_multiselect.js') }}"></script>--}}

    <!-- /theme JS files -->
    <script>
        var BootstrapMultiselect = function () {
            // Default file input style
            var _componentMultiselect = function () {
                if (!$().multiselect) {
                    console.warn('Warning - bootstrap-multiselect.js is not loaded.');
                    return;
                }

                // Basic initialization
                $('.multiselect').multiselect();

            };
            // Uniform
            var _componentUniform = function (element) {
                if (!$().uniform) {
                    console.warn('Warning - uniform.min.js is not loaded.');
                    return;
                }

                // Default initialization
                $('.form-control-styled').uniform();
            };

            return {
                init: function () {
                    _componentMultiselect();
                    _componentUniform();
                }
            }
        }();

        document.addEventListener('DOMContentLoaded', function () {
            BootstrapMultiselect.init();
        });
    </script>

    <script type="text/javascript">
        jssor_1_slider_init = function () {

            var jssor_1_SlideshowTransitions = [
                {
                    $Duration: 800,
                    x: 0.3,
                    $During: {$Left: [0.3, 0.7]},
                    $Easing: {$Left: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 800,
                    x: -0.3,
                    $SlideOut: true,
                    $Easing: {$Left: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 800,
                    x: -0.3,
                    $During: {$Left: [0.3, 0.7]},
                    $Easing: {$Left: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 800,
                    x: 0.3,
                    $SlideOut: true,
                    $Easing: {$Left: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 800,
                    y: 0.3,
                    $During: {$Top: [0.3, 0.7]},
                    $Easing: {$Top: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 800,
                    y: -0.3,
                    $SlideOut: true,
                    $Easing: {$Top: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 800,
                    y: -0.3,
                    $During: {$Top: [0.3, 0.7]},
                    $Easing: {$Top: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 800,
                    y: 0.3,
                    $SlideOut: true,
                    $Easing: {$Top: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 800,
                    x: 0.3,
                    $Cols: 2,
                    $During: {$Left: [0.3, 0.7]},
                    $ChessMode: {$Column: 3},
                    $Easing: {$Left: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 800,
                    x: 0.3,
                    $Cols: 2,
                    $SlideOut: true,
                    $ChessMode: {$Column: 3},
                    $Easing: {$Left: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 800,
                    y: 0.3,
                    $Rows: 2,
                    $During: {$Top: [0.3, 0.7]},
                    $ChessMode: {$Row: 12},
                    $Easing: {$Top: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 800,
                    y: 0.3,
                    $Rows: 2,
                    $SlideOut: true,
                    $ChessMode: {$Row: 12},
                    $Easing: {$Top: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 800,
                    y: 0.3,
                    $Cols: 2,
                    $During: {$Top: [0.3, 0.7]},
                    $ChessMode: {$Column: 12},
                    $Easing: {$Top: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 800,
                    y: -0.3,
                    $Cols: 2,
                    $SlideOut: true,
                    $ChessMode: {$Column: 12},
                    $Easing: {$Top: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 800,
                    x: 0.3,
                    $Rows: 2,
                    $During: {$Left: [0.3, 0.7]},
                    $ChessMode: {$Row: 3},
                    $Easing: {$Left: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 800,
                    x: -0.3,
                    $Rows: 2,
                    $SlideOut: true,
                    $ChessMode: {$Row: 3},
                    $Easing: {$Left: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 800,
                    x: 0.3,
                    y: 0.3,
                    $Cols: 2,
                    $Rows: 2,
                    $During: {$Left: [0.3, 0.7], $Top: [0.3, 0.7]},
                    $ChessMode: {$Column: 3, $Row: 12},
                    $Easing: {$Left: $Jease$.$InCubic, $Top: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 800,
                    x: 0.3,
                    y: 0.3,
                    $Cols: 2,
                    $Rows: 2,
                    $During: {$Left: [0.3, 0.7], $Top: [0.3, 0.7]},
                    $SlideOut: true,
                    $ChessMode: {$Column: 3, $Row: 12},
                    $Easing: {$Left: $Jease$.$InCubic, $Top: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 800,
                    $Delay: 20,
                    $Clip: 3,
                    $Assembly: 260,
                    $Easing: {$Clip: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 800,
                    $Delay: 20,
                    $Clip: 3,
                    $SlideOut: true,
                    $Assembly: 260,
                    $Easing: {$Clip: $Jease$.$OutCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 800,
                    $Delay: 20,
                    $Clip: 12,
                    $Assembly: 260,
                    $Easing: {$Clip: $Jease$.$InCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                },
                {
                    $Duration: 800,
                    $Delay: 20,
                    $Clip: 12,
                    $SlideOut: true,
                    $Assembly: 260,
                    $Easing: {$Clip: $Jease$.$OutCubic, $Opacity: $Jease$.$Linear},
                    $Opacity: 2
                }
            ];

            var jssor_1_options = {
                $AutoPlay: 1,
                $SlideshowOptions: {
                    $Class: $JssorSlideshowRunner$,
                    $Transitions: jssor_1_SlideshowTransitions,
                    $TransitionsOrder: 1
                },
                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$
                },
                $ThumbnailNavigatorOptions: {
                    $Class: $JssorThumbnailNavigator$,
                    $SpacingX: 5,
                    $SpacingY: 5
                }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*#region responsive code begin*/

            var MAX_WIDTH = 980;

            function ScaleSlider() {
                var containerElement = jssor_1_slider.$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;

                if (containerWidth) {

                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth)-10;

                    jssor_1_slider.$ScaleWidth(expectedWidth);
                } else {
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

@endsection

@section('css')
    <style>
        /*jssor slider loading skin spin css*/
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

        /*jssor slider arrow skin 106 css*/
        .jssora106 {
            display: block;
            position: absolute;
            cursor: pointer;
        }

        .jssora106 .c {
            fill: #fff;
            opacity: .3;
        }

        .jssora106 .a {
            fill: none;
            stroke: #000;
            stroke-width: 350;
            stroke-miterlimit: 10;
        }

        .jssora106:hover .c {
            opacity: .5;
        }

        .jssora106:hover .a {
            opacity: .8;
        }

        .jssora106.jssora106dn .c {
            opacity: .2;
        }

        .jssora106.jssora106dn .a {
            opacity: 1;
        }

        .jssora106.jssora106ds {
            opacity: .3;
            pointer-events: none;
        }

        /*jssor slider thumbnail skin 101 css*/
        .jssort101 .p {
            position: absolute;
            top: 0;
            left: 0;
            box-sizing: border-box;
            background: #000;
        }

        .jssort101 .p .cv {
            position: relative;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 2px solid #000;
            box-sizing: border-box;
            z-index: 1;
        }

        .jssort101 .a {
            fill: none;
            stroke: #fff;
            stroke-width: 400;
            stroke-miterlimit: 10;
            visibility: hidden;
        }

        .jssort101 .p:hover .cv, .jssort101 .p.pdn .cv {
            border: none;
            border-color: transparent;
        }

        .jssort101 .p:hover {
            padding: 2px;
        }

        .jssort101 .p:hover .cv {
            background-color: rgba(0, 0, 0, 6);
            opacity: .35;
        }

        .jssort101 .p:hover.pdn {
            padding: 0;
        }

        .jssort101 .p:hover.pdn .cv {
            border: 2px solid #fff;
            background: none;
            opacity: .35;
        }

        .jssort101 .pav .cv {
            border-color: #fff;
            opacity: .35;
        }

        .jssort101 .pav .a, .jssort101 .p:hover .a {
            visibility: visible;
        }

        .jssort101 .t {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
            opacity: .6;
        }

        .jssort101 .pav .t, .jssort101 .p:hover .t {
            opacity: 1;
        }
    </style>

@endsection
@section('content')
    @php
        $active_sidbare = ['building', 'collapse']
    @endphp
    <div class="content">
        <div class="row">

            <div class="col-md-8">
                <div class="card ">
                    <div class="row">
                        <div class="col-md-3 ">
                            <div class="col-md-12 border-bottom-1 border-bottom-pink text-center ">
                                <!-- Available hours -->
                                <!-- Progress counter -->
                                <div class="svg-center position-relative" id="hours-available-progress"></div>
                                <!-- /progress counter -->
                                <!-- Bars -->
                                <div id="hours-available-bars"></div>
                                <!-- /bars -->
                                <!-- /available hours -->
                            </div>
                        </div>

                        <div class="col-md-9 p-0">
                                <div class="m-0" id="jssor_1"
                                     style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:480px;overflow:hidden;visibility:hidden;">
                                    <!-- Loading Screen -->
                                    <div data-u="loading" class="jssorl-009-spin"
                                         style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                                        <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;"
                                             src="img/spin.svg"/>
                                    </div>
                                    <div data-u="slides"
                                         style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:380px;overflow:hidden;">
                                        <div>
                                            <img data-u="image" src="img/031.jpg"/>
                                            <img data-u="thumb" src="img/031-s190x90.jpg"/>
                                        </div>
                                        <div>
                                            <img data-u="image" src="img/032.jpg"/>
                                            <img data-u="thumb" src="img/032-s190x90.jpg"/>
                                        </div>
                                        <div>
                                            <img data-u="image" src="img/033.jpg"/>
                                            <img data-u="thumb" src="img/033-s190x90.jpg"/>
                                        </div>
                                        <div>
                                            <img data-u="image" src="img/034.jpg"/>
                                            <img data-u="thumb" src="img/034-s190x90.jpg"/>
                                        </div>
                                        <div>
                                            <img data-u="image" src="img/035.jpg"/>
                                            <img data-u="thumb" src="img/035-s190x90.jpg"/>
                                        </div>
                                        <div>
                                            <img data-u="image" src="img/036.jpg"/>
                                            <img data-u="thumb" src="img/036-s190x90.jpg"/>
                                        </div>
                                        <div>
                                            <img data-u="image" src="img/037.jpg"/>
                                            <img data-u="thumb" src="img/037-s190x90.jpg"/>
                                        </div>
                                        <div>
                                            <img data-u="image" src="img/038.jpg"/>
                                            <img data-u="thumb" src="img/038-s190x90.jpg"/>
                                        </div>
                                        <div>
                                            <img data-u="image" src="img/039.jpg"/>
                                            <img data-u="thumb" src="img/039-s190x90.jpg"/>
                                        </div>
                                        <div>
                                            <img data-u="image" src="img/040.jpg"/>
                                            <img data-u="thumb" src="img/040-s190x90.jpg"/>
                                        </div>
                                    </div>
                                    <!-- Thumbnail Navigator -->
                                    <div data-u="thumbnavigator" class="jssort101"
                                         style="position:absolute;left:0px;bottom:0px;width:980px;height:100px;background-color:#000;"
                                         data-autocenter="1" data-scale-bottom="0.75">
                                        <div data-u="slides">
                                            <div data-u="prototype" class="p" style="width:190px;height:90px;">
                                                <div data-u="thumbnailtemplate" class="t"></div>
                                                <svg viewbox="0 0 16000 16000" class="cv">
                                                    <circle class="a" cx="8000" cy="8000" r="3238.1"></circle>
                                                    <line class="a" x1="6190.5" y1="8000" x2="9809.5" y2="8000"></line>
                                                    <line class="a" x1="8000" y1="9809.5" x2="8000" y2="6190.5"></line>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Arrow Navigator -->
                                    <div data-u="arrowleft" class="jssora106"
                                         style="width:55px;height:55px;top:162px;left:30px;" data-scale="0.75">
                                        <svg viewbox="0 0 16000 16000"
                                             style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                            <circle class="c" cx="8000" cy="8000" r="6260.9"></circle>
                                            <polyline class="a"
                                                      points="7930.4,5495.7 5426.1,8000 7930.4,10504.3 "></polyline>
                                            <line class="a" x1="10573.9" y1="8000" x2="5426.1" y2="8000"></line>
                                        </svg>
                                    </div>
                                    <div data-u="arrowright" class="jssora106"
                                         style="width:55px;height:55px;top:162px;right:30px;" data-scale="0.75">
                                        <svg viewbox="0 0 16000 16000"
                                             style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                            <circle class="c" cx="8000" cy="8000" r="6260.9"></circle>
                                            <polyline class="a"
                                                      points="8069.6,5495.7 10573.9,8000 8069.6,10504.3 "></polyline>
                                            <line class="a" x1="5426.1" y1="8000" x2="10573.9" y2="8000"></line>
                                        </svg>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4">
                                <!-- Within a group with checkbox -->
                                <label class="label"> Item </label>
                                <div class="form-group">
                                    <div class="input-group">

                                <span class="input-group-prepend">
											<div class="input-group-text">
												<input type="checkbox" class="form-control-styled"
                                                       name="input-addon-checkbox" checked data-fouc>
											</div>
										</span>

                                        <select class="form-control multiselect" multiple="multiple" data-fouc>
                                            <option value="cheese">Cheese</option>
                                            <option value="tomatoes">Tomatoes</option>
                                            <option value="mozarella">Mozzarella</option>
                                            <option value="mushrooms">Mushrooms</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /within a group with checkbox -->
                            </div>
                            <div class="col-md-4">
                                <!-- Within a group with checkbox -->
                                <label class="label"> Status </label>

                                <div class="form-group">
                                    <div class="input-group">

                                <span class="input-group-prepend">
											<div class="input-group-text">
												<input type="checkbox" class="form-control-styled"
                                                       name="input-addon-checkbox" checked data-fouc>
											</div>
										</span>

                                        <select class="form-control multiselect" multiple="multiple" data-fouc>
                                            <option value="cheese">Cheese</option>
                                            <option value="tomatoes">Tomatoes</option>
                                            <option value="mozarella">Mozzarella</option>
                                            <option value="mushrooms">Mushrooms</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /within a group with checkbox -->
                            </div>
                            <div class="col-md-4">
                                <label class="label">&nbsp;</label>
                                <div class="form-group">
                                    <button class="btn-block btn btn-outline-danger"> filter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
            <div class="col-md-4">

                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-1">

                                <button class="btn bg-success btn-block btn-float btn-float-lg modal-ajax-load"
                                        data-toggle="modal"
                                        data-modal-title="{{trans('messages.register_form_title')}}"
                                        data-target="#general_modal"
                                        data-popup="tooltip"
                                        data-placement="bottom"
                                        data-container="body"
                                        data-original-title="{{trans('messages.new_register')}}">
                                    <i class="icon-user-plus icon-3x"></i>
                                    <span>{{trans('messages.new_register')}}</span>
                                </button>
                            </div>
                                <div class="col-md-6 mb-1">

                                    <button class="btn bg-info btn-block btn-float btn-float-lg modal-ajax-load"
                                            data-toggle="modal"
                                            data-modal-title="{{trans('messages.register_form_title')}}"
                                            data-target="#general_modal"
                                            data-popup="tooltip"
                                            data-placement="bottom"
                                            data-container="body"
                                            data-original-title="{{trans('messages.next_step')}}">
                                        <i class="icon-next icon-3x"></i>
                                        <span>{{trans('messages.next_step')}}</span>
                                    </button>
                                </div>
                                <div class="col-md-6 mb-1">

                                    <button class="btn bg-warning btn-block btn-float btn-float-lg modal-ajax-load"
                                            data-toggle="modal"
                                            data-modal-title="{{trans('messages.register_form_title')}}"
                                            data-target="#general_modal"
                                            data-popup="tooltip"
                                            data-placement="bottom"
                                            data-container="body"
                                            data-original-title="{{trans('messages.previous_step')}}">
                                        <i class="icon-reply icon-3x"></i>
                                        <span>{{trans('messages.previous_step')}}</span>
                                    </button>
                                </div>
                                <div class="col-md-6 mb-1">

                                    <button class="btn bg-danger btn-block btn-float btn-float-lg modal-ajax-load"
                                            data-toggle="modal"
                                            data-modal-title="{{trans('messages.register_form_title')}}"
                                            data-target="#general_modal"
                                            data-popup="tooltip"
                                            data-placement="bottom"
                                            data-container="body"

                                            data-original-title="{{trans('messages.cancel_caravan')}}">
                                        <i class="icon-database-remove icon-3x"></i>
                                        <span>{{trans('messages.cancel_caravan')}}</span>
                                    </button>
                                </div>

                        </div>
                    </div>
                </div>
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="chart-container">
                                    <div class="chart has-fixed-height" id="bars_stacked"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_js')
    <script type="text/javascript">
        jssor_1_slider_init();
    </script>

    <script>

        var Dashboard = function () {

            //
            // Charts configs
            //

            // Bar charts
            var _BarChart = function (element, barQty, height, animate, easing, duration, delay, color, tooltip) {
                if (typeof d3 == 'undefined') {
                    console.warn('Warning - d3.min.js is not loaded.');
                    return;
                }

                // Initialize chart only if element exsists in the DOM
                if ($(element).length > 0) {

                    // Add data set
                    var bardata = [];
                    $.each(barQty, function (index, value) {
                        bardata.push(value);
                    });

                    // Main variables
                    var d3Container = d3.select(element),
                        width = d3Container.node().getBoundingClientRect().width;


                    // Construct scales
                    // ------------------------------

                    // Horizontal
                    var x = d3.scale.ordinal()
                        .rangeBands([0, width], 0.3);

                    // Vertical
                    var y = d3.scale.linear()
                        .range([0, height]);


                    // Set input domains
                    // ------------------------------

                    // Horizontal
                    x.domain(d3.range(0, bardata.length));

                    // Vertical
                    y.domain([0, d3.max(bardata)]);


                    // Create chart
                    // ------------------------------

                    // Add svg element
                    var container = d3Container.append('svg');

                    // Add SVG group
                    var svg = container
                        .attr('width', width)
                        .attr('height', height)
                        .append('g');


                    //
                    // Append chart elements
                    //

                    // Bars
                    var bars = svg.selectAll('rect')
                        .data(bardata)
                        .enter()
                        .append('rect')
                        .attr('class', 'd3-random-bars')
                        .attr('width', x.rangeBand())
                        .attr('x', function (d, i) {
                            return x(i);
                        })
                        .style('fill', color);


                    // Tooltip
                    // ------------------------------

                    var tip = d3.tip()
                        .attr('class', 'd3-tip')
                        .offset([-10, 0]);

                    // Show and hide
                    if (tooltip == 'hours') {
                        bars.call(tip)
                            .on('mouseover', tip.show)
                            .on('mouseout', tip.hide);
                    }

                    // Daily meetings tooltip content
                    if (tooltip == 'hours') {
                        tip.html(function (d, i) {
                            return '<div class="text-center">' +
                                '<h6 class="m-0">' + d + '% </h6>' +
                                '</div>'
                        });
                    }


                    // Bar loading animation
                    // ------------------------------

                    // Choose between animated or static
                    if (animate) {
                        withAnimation();
                    } else {
                        withoutAnimation();
                    }

                    // Animate on load
                    function withAnimation() {
                        bars
                            .attr('height', 0)
                            .attr('y', height)
                            .transition()
                            .attr('height', function (d) {
                                return y(d);
                            })
                            .attr('y', function (d) {
                                return height - y(d);
                            })
                            .delay(function (d, i) {
                                return i * delay;
                            })
                            .duration(duration)
                            .ease(easing);
                    }

                    // Load without animateion
                    function withoutAnimation() {
                        bars
                            .attr('height', function (d) {
                                return y(d);
                            })
                            .attr('y', function (d) {
                                return height - y(d);
                            })
                    }


                    // Resize chart
                    // ------------------------------

                    // Call function on window resize
                    $(window).on('resize', barsResize);

                    // Call function on sidebar width change
                    $(document).on('click', '.sidebar-control', barsResize);

                    // Resize function
                    //
                    // Since D3 doesn't support SVG resize by default,
                    // we need to manually specify parts of the graph that need to
                    // be updated on window resize
                    function barsResize() {

                        // Layout variables
                        width = d3Container.node().getBoundingClientRect().width;


                        // Layout
                        // -------------------------

                        // Main svg width
                        container.attr('width', width);

                        // Width of appended group
                        svg.attr('width', width);

                        // Horizontal range
                        x.rangeBands([0, width], 0.3);


                        // Chart elements
                        // -------------------------

                        // Bars
                        svg.selectAll('.d3-random-bars')
                            .attr('width', x.rangeBand())
                            .attr('x', function (d, i) {
                                return x(i);
                            });
                    }
                }
            };

            // Rounded progress charts
            var _RoundedProgressChart = function (element, radius, border, color, end, iconClass, textTitle, textAverage) {
                if (typeof d3 == 'undefined') {
                    console.warn('Warning - d3.min.js is not loaded.');
                    return;
                }

                // Initialize chart only if element exsists in the DOM
                if ($(element).length > 0) {


                    // Basic setup
                    // ------------------------------

                    // Main variables
                    var d3Container = d3.select(element),
                        startPercent = 0,
                        iconSize = 32,
                        endPercent = end,
                        twoPi = Math.PI * 2,
                        formatPercent = d3.format('.0%'),
                        boxSize = radius * 2;

                    // Values count
                    var count = Math.abs((endPercent - startPercent) / 0.01);

                    // Values step
                    var step = endPercent < startPercent ? -0.01 : 0.01;


                    // Create chart
                    // ------------------------------

                    // Add SVG element
                    var container = d3Container.append('svg');

                    // Add SVG group
                    var svg = container
                        .attr('width', boxSize)
                        .attr('height', boxSize)
                        .append('g')
                        .attr('transform', 'translate(' + (boxSize / 2) + ',' + (boxSize / 2) + ')');


                    // Construct chart layout
                    // ------------------------------

                    // Arc
                    var arc = d3.svg.arc()
                        .startAngle(0)
                        .innerRadius(radius)
                        .outerRadius(radius - border);


                    //
                    // Append chart elements
                    //

                    // Paths
                    // ------------------------------

                    // Background path
                    svg.append('path')
                        .attr('class', 'd3-progress-background')
                        .attr('d', arc.endAngle(twoPi))
                        .style('fill', '#eee');

                    // Foreground path
                    var foreground = svg.append('path')
                        .attr('class', 'd3-progress-foreground')
                        .attr('filter', 'url(#blur)')
                        .style('fill', color)
                        .style('stroke', color);

                    // Front path
                    var front = svg.append('path')
                        .attr('class', 'd3-progress-front')
                        .style('fill', color)
                        .style('fill-opacity', 1);


                    // Text
                    // ------------------------------

                    // Percentage text value
                    var numberText = d3.select(element)
                        .append('h2')
                        .attr('class', 'pt-1 mt-2 mb-1');

                    // Icon
                    d3.select(element)
                        .append('i')
                        .attr('class', iconClass + ' counter-icon')
                        .attr('style', 'top: ' + ((boxSize - iconSize) / 2) + 'px');

                    // Title
                    d3.select(element)
                        .append('div')
                        .text(textTitle);

                    // Subtitle
                    d3.select(element)
                        .append('div')
                        .attr('class', 'font-size-sm text-muted mb-3')
                        .text(textAverage);


                    // Animation
                    // ------------------------------

                    // Animate path
                    function updateProgress(progress) {
                        foreground.attr('d', arc.endAngle(twoPi * progress));
                        front.attr('d', arc.endAngle(twoPi * progress));
                        numberText.text(formatPercent(progress));
                    }

                    // Animate text
                    var progress = startPercent;
                    (function loops() {
                        updateProgress(progress);
                        if (count > 0) {
                            count--;
                            progress += step;
                            setTimeout(loops, 20);
                        }
                    })();
                }
            };

            return {

                initCharts: function () {
                    // Progress charts
                    _RoundedProgressChart('#hours-available-progress', 60, 2, '#F06292', 0.68, 'icon-watch text-pink-400', '{{trans('messages.progress_percent')}}', '...');
                    // Bar charts
                    _BarChart('#hours-available-bars', [2, 3, 2, 1, 4, 5, 20, 24, 21], 40, true, 'elastic', 2200, 250, '#EC407A', 'hours');

                }
            }
        }();


        // Initialize module
        // ------------------------------

        document.addEventListener('DOMContentLoaded', function () {
            Dashboard.initCharts();
        });
    </script>

    <script>

        // Setup module
        // ------------------------------

        var EchartsBarsTornados = function () {

            // Bar and tornado charts
            var _barsTornadosExamples = function () {
                if (typeof echarts == 'undefined') {
                    console.warn('Warning - echarts.min.js is not loaded.');
                    return;
                }

                // Define elements
                var bars_stacked_element = document.getElementById('bars_stacked');


                // Stacked bar chart
                if (bars_stacked_element) {

                    // Initialize chart
                    var bars_stacked = echarts.init(bars_stacked_element);


                    //
                    // Chart config
                    //

                    // Options
                    bars_stacked.setOption({

                        // Global text styles
                        textStyle: {
                            fontFamily: 'samim, Roboto, Arial, Verdana, sans-serif',
                            fontSize: 13
                        },

                        // Chart animation duration
                        animationDuration: 750,

                        // Setup grid
                        grid: {
                            left: 0,
                            right: 30,
                            top: 35,
                            bottom: 0,
                            containLabel: true
                        },

                        // Add legend
                        legend: {
                            data: ['{{trans('messages.certain')}}', '{{trans('messages.not_verified')}}'],
                            itemHeight: 4,
                            itemGap: 20,
                            textStyle: {
                                padding: [0, 3]
                            }
                        },

                        // Add tooltip
                        tooltip: {
                            trigger: 'axis',
                            backgroundColor: 'rgba(0,0,0,0.75)',
                            padding: [10, 15],
                            textStyle: {
                                fontSize: 13,
                                fontFamily: 'samim, Roboto, sans-serif'
                            },
                            axisPointer: {
                                type: 'shadow',
                                shadowStyle: {
                                    color: 'rgba(0,0,0,0.025)'
                                }
                            }
                        },

                        // Horizontal axis
                        xAxis: [{
                            type: 'value',
                            axisLabel: {
                                color: '#333'
                            },
                            axisLine: {
                                lineStyle: {
                                    color: '#999'
                                }
                            },
                            splitLine: {
                                show: true,
                                lineStyle: {
                                    color: '#eee',
                                    type: 'dashed'
                                }
                            }
                        }],


                        // Vertical axis
                        yAxis: [{
                            type: 'category',
                            data: ['پی سازی', 'آرماتور', 'بتن ریزی', 'دیوار', 'سقف', 'در و پنجره'],
                            axisLabel: {
                                color: '#333'
                            },
                            axisLine: {
                                lineStyle: {
                                    color: '#999'
                                }
                            },
                            splitLine: {
                                show: true,
                                lineStyle: {
                                    color: ['#eee']
                                }
                            },
                            splitArea: {
                                show: true,
                                areaStyle: {
                                    color: ['rgba(250,250,250,0.1)', 'rgba(0,0,0,0.015)']
                                }
                            }
                        }],

                        // Add series
                        series: [
                            {
                                name: '{{trans('messages.certain')}}',
                                type: 'bar',
                                stack: 'Total',
                                barWidth: 15,
                                itemStyle: {
                                    normal: {
                                        color: '#1a81f5',
                                        label: {
                                            show: true,
                                            position: 'insideRight',
                                            padding: [0, 5],
                                            fontSize: 12
                                        }
                                    }
                                },
                                data: [20, 30, 5, 80, 50, 78]
                            },
                            {
                                name: '{{trans('messages.not_verified')}}',
                                type: 'bar',
                                stack: 'Total',
                                itemStyle: {
                                    normal: {
                                        color: '#6bc9f5',
                                        label: {
                                            show: true,
                                            position: 'insideLeft',
                                            padding: [0, 10],
                                            fontSize: 12
                                        }
                                    }
                                },
                                data: [5, 10, 40, 3, 0, 15]
                            },
                        ]
                    });
                }


                // Resize function
                var triggerChartResize = function () {
                    bars_stacked_element && bars_stacked.resize();

                };

                // On sidebar width change
                $(document).on('click', '.sidebar-control', function () {
                    setTimeout(function () {
                        triggerChartResize();
                    }, 0);
                });

                // On window resize
                var resizeCharts;
                window.onresize = function () {
                    clearTimeout(resizeCharts);
                    resizeCharts = setTimeout(function () {
                        triggerChartResize();
                    }, 200);
                };
            };


            //
            // Return objects assigned to module
            //

            return {
                init: function () {
                    _barsTornadosExamples();
                }
            }
        }();


        // Initialize module
        // ------------------------------

        document.addEventListener('DOMContentLoaded', function () {
            EchartsBarsTornados.init();
        });
    </script>
@endsection