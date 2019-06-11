@extends('layouts.panel.panel_layout')
@section('js')
    <!-- Theme JS files -->
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/visualization/echarts/echarts.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/demo_pages/charts/echarts/areas.js') }}"></script>

    <!-- /theme JS files -->
@endsection
@section('content')
    <?php
    $active_sidbare = ['caravan', 'caravan_dashboard']
    ?>
    <!-- Content area -->
    <div class="content">
        <div class="row">

            <!-- Basic responsive configuration -->
            <div class="col-md-4">
                <div class="card ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 ">
                                <button class="btn bg-pink btn-block btn-float btn-float-lg"
                                        type="button" data-popup="tooltip" title="" data-placement="bottom"
                                        data-container="body" data-original-title="{{trans('messages.add_caravan')}}">
                                    <i class="icon-folder-plus2 icon-3x"></i>
                                    <span>{{trans('messages.add_caravan')}}</span>
                                </button>

                                <button class="btn bg-blue btn-block btn-float btn-float-lg"
                                        type="button" data-popup="tooltip" title="" data-placement="bottom"
                                        data-container="body" data-original-title="{{trans('messages.add_caravan')}}">
                                    <i class="icon-home2 icon-3x"></i>
                                    <span>{{trans('messages.hosts_list')}}</span>
                                </button>
                            </div>

                            <div class="col-md-6">

                                <button class="btn bg-purple btn-block btn-float btn-float-lg"
                                        type="button" data-popup="tooltip" title="" data-placement="bottom"
                                        data-container="body" data-original-title="{{trans('messages.add_caravan')}}">
                                    <i class="icon-list2 icon-3x"></i>
                                    <span>{{trans('messages.caravan_list')}}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card border-1 border-blue-400">
                    <div class="card-header alpha-blue text-blue-800 border-bottom-blue header-elements-inline">
                        <span> {{trans('messages.active_caravan')}}</span>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>

            <!-- Basic responsive configuration -->
            <div class="col-md-8">
                <!-- Basic area -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Basic area</h5>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                                <a class="list-icons-item" data-action="reload"></a>
                                <a class="list-icons-item" data-action="remove"></a>
                            </div>
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