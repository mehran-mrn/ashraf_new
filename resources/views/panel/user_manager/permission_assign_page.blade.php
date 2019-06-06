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
                {{$permission['display_name']}}
            </div>

            <div class="header-elements d-none">

<span class="badge-flat text-muted">{{$permission['description']}}</span>
            </div>
        </div>
    </div>
    <!-- Content area -->
    <div class="content">
        <div class="row">

            <div class="col-md-6 ">
                <div class="card border-1 border-blue-400">
                    <div class="card-header alpha-blue text-blue-800 border-bottom-blue header-elements-inline justify-content-between">
                        <h6 class="card-title">{{__('messages.users')}}</h6>

                        <button type="button" class="btn bg-blue-700 btn-lg modal-ajax-load"
                                data-ajax-link="{{route('assign_user_to_permission_form',['permission_id'=>$permission['id']])}}" data-toggle="modal"
                                data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.user')])}}"
                                data-target="#general_modal">
                            <i class="icon-plus3"></i>
                        </button>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-bordered table-striped">
                            <thead >
                            <tr>
                                <th>{{__('messages.name')}}</th>
                                <th>{{__('messages.key')}}</th>
                                <th>{{__('messages.description')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permission['users'] as $user)
                                <tr>
                                    <td><b>{{$user['name']}}</b> </td>
                                    <td>{{$user['email']}}</td>
                                    <td>{{$user['phone']}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="col-md-6 ">
                <div class="card border-1 border-blue-400">
                    <div class="card-header alpha-blue text-blue-800 border-bottom-blue header-elements-inline justify-content-between">
                        <h6 class="card-title">{{__('messages.roles')}}</h6>

                        <button type="button" class="btn bg-blue-700 btn-lg modal-ajax-load"
                                data-ajax-link="{{route('assign_role_to_permission_form',['permission_id'=>$permission['id']])}}" data-toggle="modal"
                                data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.role')])}}"
                                data-target="#general_modal">
                            <i class="icon-plus3"></i>
                        </button>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-bordered table-striped">
                            <thead >
                            <tr>
                                <th>{{__('messages.name')}}</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permission['roles'] as $role)
                                <tr>
                                    <td><b>{{$role['display_name']}}</b> </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>



@endsection