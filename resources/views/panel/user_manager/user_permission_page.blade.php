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


    <section>
        <div class="content">
            <div class="container-fluid">
                <section>

                </section>
                <section>
                    <div class="card">
                        <div class="card-header bg-light">
                            <h4 class="card-title">{{$user['people']['name']}} {{$user['people']['family']}}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="card border-1 border-blue">
                                        <div class="card-header alpha-blue text-blue-800 border-bottom-blue header-elements-inline justify-content-between">
                                            <span class="card-title">{{__('messages.roles_user_has')}}</span>
                                            <button type="button" class="btn bg-blue-700 btn-sm modal-ajax-load"
                                                    data-ajax-link="{{route('assign_role_to_user_form',['user_id'=>$user['id']])}}" data-toggle="modal"
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
                                                @foreach($user['roles'] as $role)
                                                    <tr>
                                                        <td><b>{{$role['display_name']}}   </b>

                                                            <button type="button"
                                                                    class="btn btn-outline-danger btn-sm legitRipple swal-alert float-right"
                                                                    data-ajax-link="{{route('delete_role_from_user',['role_id'=>$role['id'],'user_id'=>$user['id']])}}"
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
                                                        </td>

                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <form method="POST" id="" class="form-ajax-submit" action="{{route('assign_permission_to_user')}}">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{$user['id']}}">
                                        <div class="card border-1 border-blue-400">
                                            <div class="card-header alpha-blue text-blue-800 border-bottom-blue header-elements-inline justify-content-between">
                                                <span class="card-title">{{__('messages.permission_user_has')}}</span>
                                                <button type="submit" class="btn bg-blue-700 btn-sm">
                                                    <span class="text" >{{trans('messages.save')}} </span> <i class="icon-floppy-disk"></i>
                                                </button>
                                            </div>
                                            <div class="card-body">

                                                <div class="row">
                                                    @foreach($categories_permissions as $category => $permissions)
                                                        <div class="col-md-4">
                                                            <div class="card">
                                                                <div class="card-header header-elements-inline">
                                                                    <h6 class="card-title bold"><b>{{$category}}</b></h6>
                                                                </div>
                                                                <div class="card-body border-0">
                                                                    @foreach($permissions as $permission)
                                                                        <div class="custom-control custom-checkbox ">
                                                                            <input type="checkbox" class="custom-control-input " name="permissions_id[]"
                                                                                   value="{{$permission['id']}}"
                                                                                   id="permission_id_{{$permission['id']}}" {{in_array($permission['id'],$checked_permissions) ?"checked":""}} >
                                                                            <label class="custom-control-label"
                                                                                   for="permission_id_{{$permission['id']}}">{{$permission['display_name']}}</label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>

@endsection
