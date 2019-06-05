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
    $active_sidbare=['user_manager','users_list']
    ?>

    <!-- Content area -->
    <div class="content">
    <!-- Basic responsive configuration -->
    <div class="card">
        {{--<div class="card-header header-elements-inline">--}}

        {{--</div>--}}

        <div class="card-body">
            <p><button type="button" class="btn btn-outline-info btn-lg modal-ajax-load" data-ajax-link="{{route('panel_register_form')}}" data-toggle="modal" data-modal-title="{{trans('messages.add_new_user')}}" data-target="#general_modal"><i class="icon-user-plus mr-2"></i> {{trans('messages.add_new_user')}}</button></p>

        </div>

        <table class="table datatable-responsive">
            <thead>
            <tr>
                <th>{{__('messages.username')}}</th>
                <th>{{__('messages.email')}}</th>
                <th>{{__('messages.phone')}}</th>
                <th>{{__('messages.register_date')}}</th>
                <th>{{__('messages.status')}}</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr>
                <td><b>{{$user['name']}}</b></td>
                <td><b>{{$user['email']}}</b></td>
                <td><b>{{$user['phone']}}</b></td>
                <td>{{$user['created_at']}}</td>
                <td><span class="badge badge-success">Active</span></td>
                <td class="text-center">
                    <div class="list-icons">
                        <div class="dropdown">
                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="#" class="dropdown-item"><i class="icon-file-pdf"></i> Export to .pdf</a>
                                <a href="#" class="dropdown-item"><i class="icon-file-excel"></i> Export to .csv</a>
                                <a href="#" class="dropdown-item"><i class="icon-file-word"></i> Export to .doc</a>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /basic responsive configuration -->
    </div>
    <!-- /content area -->

@endsection