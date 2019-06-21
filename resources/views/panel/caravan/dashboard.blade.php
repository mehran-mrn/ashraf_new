@extends('layouts.panel.panel_layout')
@section('js')
    <!-- Theme JS files -->
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/visualization/echarts/echarts.min.js') }}"></script>
    {{--<script src="{{ URL::asset('/public/assets/panel/global_assets/js/demo_pages/charts/echarts/areas.js') }}"></script>--}}

    <!-- /theme JS files -->
@endsection
@section('content')
    <?php
    $active_sidbare = ['caravans', 'caravans_dashboard']
    ?>
    <!-- Content area -->
    <div class="content">
        <div class="row">

            <!-- Basic responsive configuration -->
            <div class="col-md-4">
                <div class="card ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{route('add_caravan_page')}}"
                                   class="btn bg-danger btn-block btn-float btn-float-lg"
                                   data-popup="tooltip" title="" data-placement="bottom"
                                   data-container="body" data-original-title="{{trans('messages.add_caravan')}}">
                                    <i class="icon-folder-plus2 icon-3x"></i>
                                    <span>{{trans('messages.add_caravan')}}</span>
                                </a>

                                <a href="{{route('hosts_list')}}" class="btn bg-blue btn-block btn-float btn-float-lg"
                                   data-popup="tooltip" title="" data-placement="bottom"
                                   data-container="body" data-original-title="{{trans('messages.hosts_list')}}">
                                    <i class="icon-home2 icon-3x"></i>
                                    <span>{{trans('messages.hosts_list')}}</span>
                                </a>
                            </div>


                            <div class="col-md-6">

                                <a href="{{route('caravans_list')}}"
                                   class="btn bg-purple btn-block btn-float btn-float-lg"
                                   data-popup="tooltip" title="" data-placement="bottom"
                                   data-container="body" data-original-title="{{trans('messages.caravans_list')}}">
                                    <i class="icon-list2 icon-3x"></i>
                                    <span>{{trans('messages.caravans_list')}}</span>
                                </a>

                                <a href="{{route('caravans_list') . '?' . http_build_query(['status' => '1'])}}"
                                   class="btn bg-pink btn-block btn-float btn-float-lg"
                                   data-popup="tooltip" title="" data-placement="bottom"
                                   data-container="body" data-original-title="{{trans('messages.registering')}}">
                                    <i class="icon-spinner4 spinner icon-3x"></i>
                                    <span><b>{{get_caravans_statistics()['pending']}} </b>{{trans('messages.caravan')}} {{trans('messages.registering')}} </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card border-1 border-blue-400">
                    <div class="card-header alpha-blue text-blue-800 border-bottom-blue header-elements-inline">
                        <span> {{trans('messages.active_caravan')}}</span>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            @foreach($caravans as $caravan)
                                <tr>
                                    <td>{{get_cites($caravan['dep_city'])['name']}} </td>
                                    <td><span class="text-black">{{jdate('j F Y',strtotime($caravan['start']))}}</span>
                                    </td>
                                    <td> @switch($caravan['status'])
                                            @case("0")<span class="badge bg-danger font-size ">
                                {{trans('messages.canceled')}}</span>
                                            @break
                                            @case("1")<span class="badge bg-info font-size ">
                                {{trans('messages.registering')}}</span>
                                            @break
                                            @case("2")<span class="badge bg-violet font-size ">
                                {{trans('messages.ready')}}</span>
                                            @break
                                            @case("3")<span class="badge bg-success font-size ">
                                {{trans('messages.arrived')}}</span>
                                            @break
                                            @case("4")<span class="badge bg-indigo font-size ">
                                {{trans('messages.exited')}}</span>
                                            @break
                                            @case("5")<span class="badge bg-teal font-size ">
                                {{trans('messages.archived')}}</span>
                                            @break
                                        @endswitch
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

            <!-- Basic responsive configuration -->
            <div class="col-md-8">
                <!-- Basic area -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title"></h5>
                        <div class="header-elements">

                        </div>
                    </div>

                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" id="area_basic"></div>
                        </div>
                    </div>
                </div>
                <!-- /basic area -->
            </div>
        </div>
    </div>

@endsection

@section('footer_js')

    <script>
        /* ------------------------------------------------------------------------------
 *
 *  # Echarts - Area charts
 *
 *  Demo JS code for echarts_areas.html page
 *
 * ---------------------------------------------------------------------------- */


        // Setup module
        // ------------------------------
        var hosts_array = [];
        var xAxisData = [];
        var this_data = [];
        var SeriesData = {};

        var EchartsAreas = function() {

            //
            // Setup module components
            //

            // Area charts
            var _areaChartExamples = function() {
                if (typeof echarts == 'undefined') {
                    console.warn('Warning - echarts.min.js is not loaded.');
                    return;
                }

                // Define elements
                var area_basic_element = document.getElementById('area_basic');

                //
                // Charts configuration
                //

                // Basic area chart
                if (area_basic_element) {

                    // Initialize chart
                    var area_basic = echarts.init(area_basic_element);

                    $.ajax({
                        url: '/panel/ajax/caravans_echart_data',
                        type: 'GET',
                        contentType: false,
                        processData: false,
                        // data: $(this).serialize(),
                        // data: formData,

                        success: function (response) {
                            var hasLooped = false;
                            $.each(response, function (i, item) {

                                hosts_array.push(i);
                                if (!hasLooped) {
                                    $.each(item, function (key, value) {
                                        xAxisData.push(key);
                                    });
                                }
                                hasLooped = true;
                                $.each(item, function (key, value) {
                                    this_data.push(value);
                                });

                                SeriesData[i]=this_data;

                                this_data=[];
                            });

                            var seriesList = [];
                            $.each(SeriesData, function (host, counts) {
                                seriesList.push(
                                    {
                                        name: host,
                                        type: 'line',
                                        data: counts,
                                        areaStyle: {
                                            normal: {
                                                opacity: 0.25
                                            }
                                        },
                                        smooth: true,
                                        symbolSize: 7,
                                        itemStyle: {
                                            normal: {
                                                borderWidth: 2
                                            }
                                        }
                                    }
                                )
                            });
                            area_basic.setOption({

                                // Define colors
                                color: ['#2ec7c9','#b6a2de','#5ab1ef','#ffb980','#d87a80'],

                                // Global text styles
                                textStyle: {
                                    fontFamily: 'Samim, Roboto, Arial, Verdana, sans-serif',
                                    fontSize: 13
                                },

                                // Chart animation duration
                                animationDuration: 1750,

                                // Setup grid
                                grid: {
                                    left: 0,
                                    right: 40,
                                    top: 35,
                                    bottom: 0,
                                    containLabel: true
                                },

                                // Add legend
                                legend: {
                                    data: hosts_array,
                                    itemHeight: 18,
                                    itemGap: 20
                                },

                                // Add tooltip
                                tooltip: {
                                    trigger: 'axis',
                                    backgroundColor: 'rgba(0,0,0,0.75)',
                                    padding: [10, 15],
                                    textStyle: {
                                        fontSize: 13,
                                        fontFamily: 'Roboto, sans-serif'
                                    }
                                },

                                // Horizontal axis
                                xAxis: [{
                                    type: 'category',
                                    boundaryGap: false,
                                    data: xAxisData,
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
                                        lineStyle: {
                                            color: '#eee'
                                        }
                                    },
                                    splitArea: {
                                        show: true,
                                        areaStyle: {
                                            color: ['rgba(250,250,250,0.1)', 'rgba(0,0,0,0.01)']
                                        }
                                    }
                                }],

                                    // Add series
                                series: seriesList

                            });


                        },
                        error: function (response) {
                            var errors = response.responseJSON.errors;
                            $.each(errors, function (index, value) {
                                new PNotify({
                                    title: index,
                                    text: value,
                                    type: 'error'
                                });
                            });
                            setTimeout(function () {
                                $('[type="submit"]').prop('disabled', false);

                            }, 2500);

                        }
                    });



                    //
                    // Chart config
                    //

                    // Options

                }

                //
                // Resize charts
                //

                // Resize function
                var triggerChartResize = function() {
                    area_basic_element && area_basic.resize();

                };

                // On sidebar width change
                $(document).on('click', '.sidebar-control', function() {
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
                init: function() {
                    _areaChartExamples();
                }
            }
        }();


        // Initialize module
        // ------------------------------

        document.addEventListener('DOMContentLoaded', function() {
            EchartsAreas.init();
        });
    </script>
@endsection