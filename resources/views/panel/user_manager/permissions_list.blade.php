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
    $active_sidbare = ['user_manager', 'permissions_list']
    ?>

    <!-- Content area -->
    <div class="content">
        <!-- Basic responsive configuration -->
        <div class="card">
            <div class="card-header">
                <p>
                    <button type="button" class="btn btn-outline-info btn-lg modal-ajax-load"
                            data-ajax-link="{{route('panel_register_permission_form')}}" data-toggle="modal"
                            data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.permission')])}}"
                            data-target="#general_modal"><i
                                class="icon-user-plus mr-2"></i> {{trans('messages.add_new',['item'=>trans('messages.permission')])}}
                    </button>
                </p>
            </div>
        </div>

        <div class="row">

        @foreach($categories_permissions as $category => $permissions)
            <div class="col-md-6 ">
                <div class="card border-1 border-blue-400">
                    <div class="card-header alpha-blue text-blue-800 border-bottom-blue header-elements-inline">
                        <h6 class="card-title">{{$category}}</h6>
                    </div>
                    <div class="card-body">

                        <table class="table datatable-responsive">
                            <thead>
                            <tr>
                                <th>{{__('messages.name')}}</th>
                                <th>{{__('messages.key')}}</th>
                                <th>{{__('messages.description')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permissions as $permission)
                                <tr>
                                    <td><b>{{$permission['display_name']}}</b></td>
                                    <td>{{$permission['name']}}</td>
                                    <td>{{$permission['description']}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

    @endforeach
    </div>
    </div>



@endsection