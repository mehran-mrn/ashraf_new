@extends('layouts.panel.panel_layout')
@section('js')
    <?php


    ?>

    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/visualization/echarts/echarts.min.js')}}"></script>

    <script>
        var hosts_array = [];
        var xAxisData = [];
        var this_data = [];
        var SeriesData = {};
        var EchartsLines = function () {
            var _lineChartExamples = function () {
                if (typeof echarts == 'undefined') {
                    console.warn('Warning - echarts.min.js is not loaded.');
                    return;
                }
                var line_zoom_element = document.getElementById('line_zoom');
                var area_basic_element = document.getElementById('area_basic');

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

                                SeriesData[i] = this_data;

                                this_data = [];
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
                                color: ['#2ec7c9', '#b6a2de', '#5ab1ef', '#ffb980', '#d87a80'],

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
                if (line_zoom_element) {
                    var line_zoom = echarts.init(line_zoom_element);
                    line_zoom.setOption({
                        color: ["#424956", "#d74e67", '#0092ff'],
                        textStyle: {
                            fontFamily: 'IRANSans,Roboto, Arial, Verdana, sans-serif',
                            fontSize: 13
                        },
                        animationDuration: 750,
                        grid: {
                            left: 0,
                            right: 40,
                            top: 35,
                            bottom: 60,
                            containLabel: true
                        },
                        legend: {
                            data: [{!! $legend !!}],
                            itemHeight: 8,
                            itemGap: 20
                        },
                        tooltip: {
                            trigger: 'axis',
                            backgroundColor: 'rgba(0,0,0,0.75)',
                            padding: [10, 15],
                            textStyle: {
                                fontSize: 13,
                                fontFamily: 'Roboto, sans-serif'
                            }
                        },
                        xAxis: [{
                            type: 'category',
                            boundaryGap: false,
                            axisLabel: {
                                color: '#333'
                            },
                            axisLine: {
                                lineStyle: {
                                    color: '#999'
                                }
                            },
                            data: [{!! $date !!}]
                        }],
                        yAxis: [{
                            type: 'value',
                            axisLabel: {
                                formatter: '{value} ',
                                color: '#333'
                            },
                            axisLine: {
                                lineStyle: {
                                    color: '#999'
                                }
                            },
                            splitLine: {
                                lineStyle: {
                                    color: ['#eee']
                                }
                            },
                            splitArea: {
                                show: true,
                                areaStyle: {
                                    color: ['rgba(250,250,250,0.1)', 'rgba(0,0,0,0.01)']
                                }
                            }
                        }],
                        dataZoom: [
                            {
                                type: 'inside',
                                start: 30,
                                end: 70
                            },
                            {
                                show: true,
                                type: 'slider',
                                start: 30,
                                end: 70,
                                height: 40,
                                bottom: 0,
                                borderColor: '#ccc',
                                fillerColor: 'rgba(0,0,0,0.05)',
                                handleStyle: {
                                    color: '#585f63'
                                }
                            }
                        ],


                        series: [
                                @foreach($final as $key=>$val)
                            {
                                name: '{{__("messages.".$key)}}',
                                type: 'line',
                                smooth: true,
                                symbolSize: 6,
                                itemStyle: {
                                    normal: {
                                        borderWidth: 2
                                    }
                                },
                                data: [{!! $val !!}]
                            },
                            @endforeach
                        ]
                    });
                }
                var triggerChartResize = function () {
                    line_zoom_element && line_zoom.resize();
                    area_basic_element && area_basic.resize();

                };
                $(document).on('click', '.sidebar-control', function () {
                    setTimeout(function () {
                        triggerChartResize();
                    }, 0);
                });

                var resizeCharts;
                window.onresize = function () {
                    clearTimeout(resizeCharts);
                    resizeCharts = setTimeout(function () {
                        triggerChartResize();
                    }, 200);

                };
            };
            return {
                init: function () {
                    _lineChartExamples();
                }
            }
        }();

        document.addEventListener('DOMContentLoaded', function () {
            EchartsLines.init();
        });

    </script>
@stop
@section('content')
    <div class="content-wrapper">
        <div class="sidebar-user-material category-content" id="dashboardCon"
             style="background-color: #5d4768 !important">
            <div class="p-3">
                <h4 class="text-center text-white"><span
                            class="text-warning"> {{$info['people']['name']}} </span>{{__('messages.welcome')}}
                </h4>
                <h6 class="text-center text-white p-20">{{__('messages.ashraf')}}</h6>
            </div>
            <div class="row m-1">
                <div class="col-12 col-sm-3 col-xl-3">
                    <div class="card card-body bg-primary-400 has-bg-image">
                        <div class="media">
                            <div class="mr-3 align-self-center">
                                <i class="icon-blog icon-3x opacity-75"></i>
                            </div>
                            <div class="media-body text-right">
                                <h3 class="mb-0">{{number_format($postCount)}}</h3>
                                <span class="text-uppercase font-size-xs">{{__('messages.blog_posts')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-3 col-xl-3">
                    <div class="card card-body bg-danger-400 has-bg-image">
                        <div class="media">
                            <div class="mr-3 align-self-center">
                                <i class="icon-users icon-3x opacity-75"></i>
                            </div>

                            <div class="media-body text-right">
                                <h3 class="mb-0">{{number_format($userCount)}}</h3>
                                <span class="text-uppercase font-size-xs">{{__('messages.users')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-3 col-xl-3">
                    <div class="card card-body bg-indigo has-bg-image">
                        <div class="media">
                            <div class="mr-3 align-self-center">
                                <i class="icon-paypal icon-3x opacity-75"></i>
                            </div>

                            <div class="media-body text-right">
                                <h3 class="mb-0">{{number_format($commentCount)}}</h3>
                                <span class="text-uppercase font-size-xs">{{__('messages.comment')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-3 col-xl-3">
                    <div class="card card-body bg-light has-bg-image">
                        <div class="media">
                            <div class="mr-3 align-self-center">
                                <i class="icon-pointer icon-3x opacity-75"></i>
                            </div>

                            <div class="media-body text-right">
                                <h3 class="mb-0">{{number_format($caravansCount)}}</h3>
                                <span class="text-uppercase font-size-xs">{{__('messages.caravan')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-2 m-1">
                <a href="{{route('blogetc.admin.create_post')}}" class="btn btn-light btn-float m-0 col-md-2 col-6 col-sm-4">
                    <i class="icon-file-plus icon-2x"></i>
                    <span>{{__('messages.post_add')}}</span>
                </a>
                <a href="{{route('blogetc.admin.index')}}" class="btn btn-light btn-float m-0 col-md-2 col-6 col-sm-4">
                    <i class="icon-blogger text-blue-400 icon-2x"></i>
                    <span>{{__('messages.post_list')}}</span>
                </a>
                <a href="{{route('caravans_list')}}" class="btn btn-light btn-float m-0 col-md-2 col-6 col-sm-4">
                    <i class="icon-train2 text-danger-400 icon-2x"></i>
                    <span>{{__('messages.caravans_list')}}</span>
                </a>
                <a href="{{route('building_dashboard')}}" class="btn btn-light btn-float m-0 col-md-2 col-6 col-sm-4">
                    <i class="icon-quill4 text-violet-400 icon-2x"></i>
                    <span>{{__('messages.building_projects')}}</span>
                </a>
                <a href="{{route('charity_period_list')}}" class="btn btn-light btn-float m-0 col-md-2 col-6 col-sm-4">
                    <i class="icon-chart text-brown-400 icon-2x"></i>
                    <span>{{__('messages.periodic_payment')}}</span>
                </a>
                <a href="{{route('charity_payment_list')}}" class="btn btn-light btn-float m-0 col-md-2 col-6 col-sm-4">
                    <i class="icon-paypal text-primary icon-2x"></i>
                    <span>{{__('messages.other_payments')}}</span>
                </a>
        </div>
        <div class="row pt-2 m-1">
            <div class="col-12 col-md-6 border-dark border-rounded rounded">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">{{__('messages.payment_chart')}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" id="line_zoom"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 border-dark border-rounded rounded">

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
            </div>
        </div>
    </div>
@endsection