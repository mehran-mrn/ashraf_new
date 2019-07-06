@extends('layouts.panel.panel_layout')
@section('js')
    <script
            src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/js/nestable/jquery.nestable-rtl.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/js/jquery_form.js') }}"></script>

    <!-- Theme JS files -->
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/visualization/echarts/echarts.min.js') }}"></script>
    <!-- /theme JS files -->
    <script>
        $(document).ready(function () {
            var UINestable = function () {
                var t = function (t) {
                    var e = t.length ? t : $(t.target), a = e.data("output");
                    window.JSON ? a.val(window.JSON.stringify(e.nestable("serialize"))) : a.val("JSON browser support required for this demo.")
                };
                return {
                    init: function () {
                        $("#nestable_ajax_1").nestable({group: 1, maxDepth: 5}).on("change", function (e) {
                            t($("#nestable_ajax_1").data("output", $("#nestable_list_ajax_output_1")));
                            $.ajax({
                                url: "{{route('update_nestable_teams')}}",
                                type: "post",
                                data: {sortval: $("#nestable_list_ajax_output_1").val(), table: 'building_type_itmes'},
                                headers: {
                                    'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                                },
                                success: function (response) {
                                    new PNotify({
                                        title: '',
                                        text: response.message,
                                        type: 'success'
                                    });
                                }, error: function () {
                                }
                            });
                        });

                        $("#list_ajax_menu").on("click", function (t) {
                            var e = $(t.target), a = e.data("action");
                        });
                    }
                }
            }();

            UINestable.init();
        });
    </script>
@endsection
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
    <link href="{{ URL::asset('/public/assets/panel/js/nestable/jquery.nestable.css') }}" rel="stylesheet"
          type="text/css">
@endsection
@section('content')
    @php
        $active_sidbare = ['building', 'collapse']
    @endphp
    <div class="content">
        <div class="row">

            <div class="col-md-7">
                <div class="card">
                    <div class="card-header bg-light">
                        <span class="card-title">{{$building_type['title']}}</span>
                    </div>
                    <div class="card-body">
                        @csrf
                        <button type="button" class="btn btn-light modal-ajax-load"
                                data-ajax-link="{{route('building_type_item_add_form',['type_id'=>$building_type['id']])}}"
                                data-toggle="modal"
                                data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.item')])}}"
                                data-target="#general_modal">
                            <i class="icon-pencil7"></i>
                            <span
                                    class="d-none d-lg-inline-block ml-2">{{trans('messages.add_new',['item'=>trans('messages.item')])}}</span>
                        </button>


                        {{--                <hr>--}}
                        {{--                <div class="dd" id="nestable_ajax_1">--}}
                        {{--                    {!! NestableTableGetData(1,0,'','','building_type_itmes')!!}--}}
                        {{--                </div>--}}
                        {{--                <div id="nestable_sort_result_1"></div>--}}
                        {{--                <textarea title="nestable_list_ajax_output_1" id="nestable_list_ajax_output_1"--}}
                        {{--                          class="d-none"></textarea>--}}
                        {{--                <hr>--}}

                        <div class="row pt-3">
                            @foreach($building_type['building_type_items'] as $cat)
                                <div class="col-12 col-md-12">
                                    <div class="card border-info-600 border-3px border-left-2">

                                        <div class="card-body p-0 ">
                                            <div class="row pr-2 pl-2">
                                                <div class="col-md-10 pt-2">
                                                    <div class="text-black bold card-title">{{$cat['title']}} {{$cat['percent']."%"}}</div>
                                                    <span class="text-muted  card-title">{{$cat['description']}}</span>
                                                </div>
                                                <div class="col-md-2 pt-1  border-1 border-right-2 border-left-2 border-info-600 bg-info-300">

                                                    <button type="button"
                                                            class="legitRipple float-right btn alpha-primary border-primary-400 text-primary-800 btn-icon rounded-round ml-2 modal-ajax-load"
                                                            data-ajax-link="{{route('building_type_item_add_form',['type_id'=>$building_type['id'],'item_id'=>$cat['id']])}}"
                                                            data-toggle="modal"
                                                            data-modal-title="{{trans('messages.edit',['item'=>trans('messages.store_category')])}}"
                                                            data-target="#general_modal">
                                                        <i class="icon-pencil7"></i>
                                                    </button>

                                                    <button
                                                            class="legitRipple swal-alert float-right btn alpha-pink border-pink-400 text-pink-800 btn-icon rounded-round ml-2"
                                                            data-ajax-link="{{route('delete_building_type_item',['building_type_item_id'=>$cat['id']])}}"
                                                            data-method="post"
                                                            data-csrf="{{csrf_token()}}"
                                                            data-title="{{trans('messages.delete_item',['item'=>trans('messages.item')])}}"
                                                            data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.item')])}}"
                                                            data-type="warning"
                                                            data-cancel="true"
                                                            data-confirm-text="{{trans('messages.delete')}}"
                                                            data-cancel-text="{{trans('messages.cancel')}}">
                                                        <i class="icon-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <!-- Nested and infographic -->
                <!-- Nested pie chart -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">{{$building_type['title']}}</h5>

                    </div>

                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" id="pie_nested"></div>
                        </div>
                    </div>
                </div>
                <!-- /nested pie chart -->
                <!-- /nested and infographic -->
            </div>
        </div>
    </div>
@endsection

@section('footer_js')
    <script>


        // Setup module
        // ------------------------------

        var EchartsPiesDonuts = function () {


            //
            // Setup module components
            //

            // Pie and donut charts
            var _piesDonutsExamples = function () {
                if (typeof echarts == 'undefined') {
                    console.warn('Warning - echarts.min.js is not loaded.');
                    return;
                }

                // Define elements
                var pie_nested_element = document.getElementById('pie_nested');


                // Nested

                if (pie_nested_element) {

                    // Initialize chart
                    var pie_nested = echarts.init(pie_nested_element);


                    //
                    // Chart config
                    //

                    // Options
                    pie_nested.setOption({

                        // Colors
                        color: [
                            '#2ec7c9', '#b6a2de', '#5ab1ef', '#ffb980', '#d87a80',
                            '#8d98b3', '#e5cf0d', '#97b552', '#95706d', '#dc69aa',
                            '#07a2a4', '#9a7fd1', '#588dd5', '#f5994e', '#c05050',
                            '#59678c', '#c9ab00', '#7eb00a', '#6f5553', '#c14089'
                        ],

                        // Global text styles
                        textStyle: {
                            fontFamily: 'Samim, Roboto, Arial, Verdana, sans-serif',
                            fontSize: 13
                        },

                        // Add tooltip
                        tooltip: {
                            trigger: 'item',
                            backgroundColor: 'rgba(0,0,0,0.75)',
                            padding: [10, 15],
                            textStyle: {
                                fontSize: 13,
                                fontFamily: 'Samim, Roboto, sans-serif'
                            },
                            formatter: '{a} <br/>{b}: {c} ({d}%)'
                        },

                        // Add legend
                        legend: {
                            orient: 'vertical',
                            top: 'center',
                            left: 0,
                            data: [
                                @foreach($building_type['building_type_items'] as $cat)
                                    '{{$cat['title']}}',
                                @endforeach
                            ],
                            itemHeight: 8,
                            itemWidth: 8
                        },

                        // Add series
                        series: [

                            // Inner
                            // {
                            //     name: 'Countries',
                            //     type: 'pie',
                            //     selectedMode: 'single',
                            //     radius: [0, '50%'],
                            //     itemStyle: {
                            //         normal: {
                            //             borderWidth: 1,
                            //             borderColor: '#fff',
                            //             label: {
                            //                 position: 'inner'
                            //             },
                            //             labelLine: {
                            //                 show: false
                            //             }
                            //         }
                            //     },
                            //     data: [
                            //         {value: 535, name: 'Italy'},
                            //         {value: 679, name: 'Spain'},
                            //         {value: 1548, name: 'Austria'}
                            //     ]
                            // },

                            // Outer
                            {
                                name: '{{trans('messages.item')}}',
                                type: 'pie',
                                radius: ['60%', '85%'],
                                itemStyle: {
                                    normal: {
                                        borderWidth: 1,
                                        borderColor: '#fff'
                                    }
                                },
                                data: [
                                        @foreach($building_type['building_type_items'] as $cat)
                                    {
                                        value: {{$cat['percent']}}, name: '{{$cat['title']}}'
                                    },
                                    @endforeach

                                ]
                            }
                        ]
                    });
                }


                //
                // Resize charts
                //

                // Resize function
                var triggerChartResize = function () {
                    pie_nested_element && pie_nested.resize();

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
                    _piesDonutsExamples();
                }
            }
        }();


        // Initialize module
        // ------------------------------

        document.addEventListener('DOMContentLoaded', function () {
            EchartsPiesDonuts.init();
        });
    </script>
@endsection
