@extends('layouts.panel.panel_layout')
@section('js')
    <!-- Theme JS files -->
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/extensions/rowlink.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/demo_pages/mail_list.js') }}"></script>
    <!-- /theme JS files -->
@endsection
@section('content')
    <?php
    $active_sidbare = ['user_manager', 'roles_list']
    ?>
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <button type="button" class="btn btn-outline-info btn-lg modal-ajax-load"
                        data-ajax-link="{{route('panel_register_role_form')}}" data-toggle="modal"
                        data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.role')])}}"
                        data-target="#general_modal"><i
                            class="icon-user-plus mr-2"></i> {{trans('messages.add_new',['item'=>trans('messages.role')])}}
                </button>
            </div>
        </div>
    </div>
    <!-- Content area -->
    <div class="content">
        <!-- Basic responsive configuration -->
        <div class="card">

            <div class="card-body">


                <!-- Table -->
                <div class="table-responsive">


                    <div class="card border-x-2 rounded-0">
                        <div class="card-header bg-light d-flex justify-content-between">
                            <span class="font-size-sm text-uppercase font-weight-semibold">{{__('messages.name')}} <i class="icon-arrow-down32"></i> </span>
                            <span class="font-size-sm text-uppercase font-weight-semibold">{{__('messages.description')}} <i class="icon-arrow-down32"></i> </span>
                            <span class="font-size-sm text-uppercase font-weight-semibold">{{__('messages.key')}} <i class="icon-arrow-down32"></i> </span>
                        </div>
                    </div>
                    @foreach($roles as $role)
                        <div class="card border-x-1 m-0 border-left-indigo-400 border-right-indigo-400 rounded-0">
                            <div class="card-header  bg-light d-flex justify-content-between">
                                <span class="font-size-sm text-uppercase font-weight-bold"> <i class="icon-move text-muted"></i> {{$role['display_name']}} </span>
                                <span class="font-size-sm text-uppercase font-weight-semibold text-muted">{{$role['description']}} </span>
                                <span class="font-size-sm text-uppercase text-success font-weight-semibold">{{$role['name']}}</span>
                            </div>


                        </div>

                    @endforeach
                </div>
                <!-- /table -->

            </div>
            <!-- /basic responsive configuration -->
        </div>
    </div>
    <!-- /content area -->

@endsection