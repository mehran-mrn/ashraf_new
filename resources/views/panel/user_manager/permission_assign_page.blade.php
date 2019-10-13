@extends('layouts.panel.panel_layout')
@section('js')
    <!-- Theme JS files -->
    <script
        src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script
        src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/tables/datatables/extensions/responsive.min.js') }}"></script>
    <script
        src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script
        src="{{ URL::asset('/public/assets/panel/global_assets/js/demo_pages/datatables_responsive.js') }}"></script>

    <!-- /theme JS files -->
@endsection
@section('css')
    <link rel="stylesheet" href="{{URL::asset('node_modules/sweetalert2/dist/sweetalert2.min.css')}}">
@endsection
@section('content')
    <?php
    $active_sidbare = ['user_manager']
    ?>
    <section>
        <div class="content">
            <div class="container-fluid">
                <section>
                    <a href="{{route('permissions_list')}}" class="btn btn-outline-dark m-2 py-2 px-3 ">< {{trans('messages.add_new',['item'=>trans('messages.back')])}}</a>
                </section>
                <section>
                    <div class="card">
                        <div class="card-header bg-light">
                            <h4 class="card-title">{{$permission['display_name']}}</h4>
                            @if($permission['description'])
                            <span class="badge-flat text-muted">{{$permission['description']}}</span>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="card border-1 border-blue-400">
                                        <div class="card-header alpha-blue text-blue-800 border-bottom-blue header-elements-inline justify-content-between">
                                            <h6 class="card-title">{{__('messages.users_has_this_permission')}}</h6>
                                            <button type="button" class="btn bg-blue-700 btn-sm btn-lg modal-ajax-load"
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
                                                    <th></th>
                                                    <th>{{__('messages.delete')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($permission['users'] as $user)
                                                    <tr>
                                                        <td><b>{{$user['name']}}</b> </td>
                                                        <td>{{$user['email']}}  {{$user['phone']}}</td>
                                                        <td>
                                                            <button type="button"
                                                                    class="btn btn-outline-danger btn-sm legitRipple swal-alert"
                                                                    data-ajax-link="{{route('delete_user_from_permission',['permission_id'=>$permission['id'],'user_id'=>$user['id']])}}"
                                                                    data-method="POST"
                                                                    data-csrf="{{csrf_token()}}"
                                                                    data-title="{{trans('messages.delete_item',['item'=>trans('messages.user')])}}"
                                                                    data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.user')])}}"
                                                                    data-type="warning"
                                                                    data-cancel="true"
                                                                    data-confirm-text="{{trans('messages.delete')}}"
                                                                    data-cancel-text="{{trans('messages.cancel')}}">

                                                                <i class="icon-trash"></i>
                                                            </button>
                                                        </td>
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
                                            <h6 class="card-title">{{__('messages.roles_has_this_permission')}}</h6>
                                            <button type="button" class="btn btn-sm bg-blue-700 btn-lg modal-ajax-load"
                                                    data-ajax-link="{{route('assign_role_to_permission_form',['permission_id'=>$permission['id']])}}" data-toggle="modal"
                                                    data-method="POST"
                                                    data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.role')])}}"
                                                    data-modal-size="modal-lg"
                                                    data-target="#general_modal">
                                                <i class="icon-plus3"></i>
                                            </button>
                                        </div>
                                        <div class="card-body p-0">
                                            <table class="table table-bordered table-striped">
                                                <thead >
                                                <tr>
                                                    <th>{{__('messages.team')}}</th>
                                                    <th>{{__('messages.role')}}</th>
                                                    <th>{{__('messages.edit')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($teams_roles as $team => $roles)
                                                    <tr>
                                                        <td><b>{{get_team($team)['display_name']}}</b> </td>
                                                        <td>
                                                            @foreach($roles as $role)
                                                                <span class="badge bg-teal" >{{$role['display_name']}}</span>
                                                            @endforeach
                                                        </td>
                                                        <th>
                                                            <button type="button" class="btn btn-outline-success btn-sm legitRipple modal-ajax-load"
                                                                    data-ajax-link="{{route('assign_role_to_permission_form',['permission_id'=>$permission['id'],"old"=>"old",'team_id'=>$team])}}"
                                                                    data-toggle="modal"
                                                                    data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.role')])}}"
                                                                    data-modal-size="modal-lg"
                                                                    data-target="#general_modal">
                                                                <i class="icon-pencil"></i>
                                                            </button>


                                                            <button type="button"
                                                                    class="btn btn-outline-danger btn-sm legitRipple swal-alert"
                                                                    data-ajax-link="{{route('delete_role_from_permission',['permission_id'=>$permission['id'],'team_id'=>$team])}}"
                                                                    data-method="POST"
                                                                    data-csrf="{{csrf_token()}}"
                                                                    data-title="{{trans('messages.delete_item',['item'=>trans('messages.role')])}}"
                                                                    data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.role')])}}"
                                                                    data-type="warning"
                                                                    data-cancel="true"
                                                                    data-confirm-text="{{trans('messages.delete')}}"
                                                                    data-cancel-text="{{trans('messages.cancel')}}">
                                                                <i class="icon-trash"></i>
                                                            </button>

                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>

@endsection
