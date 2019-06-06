@extends('layouts.panel.panel_layout')
@section('js')
    <!-- Theme JS files -->
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/tables/datatables/extensions/responsive.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/demo_pages/datatables_responsive.js') }}"></script>
    <!-- /theme JS files -->
@endsection
@section('content')
    <?php
    $active_sidbare = ['user_manager']
    ?>
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">

            </div>
        </div>
    </div>
    <!-- Content area -->
    <div class="content">
        <div class="row">

            <div class="col-md-5 ">
                <div class="card border-1 border-blue-400">
                    <div class="card-header alpha-blue text-blue-800 border-bottom-blue header-elements-inline justify-content-between">
                        <h6 class="card-title">{{__('messages.users')}}</h6>
                        <button class="btn bg-blue-700 btn-lg"><i class="icon-plus3"></i> </button>

                    </div>
                    <div class="card-body p-0">
                    </div>
                </div>
            </div>


            <div class="col-md-7 ">
                <div class="card border-1 border-blue-400">
                    <div class="card-header alpha-blue text-blue-800 border-bottom-blue header-elements-inline justify-content-between">
                        <h6 class="card-title">{{__('messages.roles')}}</h6>
                        <button class="btn bg-blue-700 btn-lg"><i class="icon-plus3"></i> </button>
                    </div>
                    <div class="card-body p-0">
                    </div>
                </div>
            </div>

        </div>
    </div>



@endsection