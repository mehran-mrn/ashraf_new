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
    <section>
        <div class="content">
            <div class="container-fluid">
                <section>
                    <button type="button" class="btn btn-outline-dark m-2 py-2 px-3 modal-ajax-load"
                            data-ajax-link="{{route('panel_register_permission_form')}}" data-toggle="modal"
                            data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.permission')])}}"
                            data-target="#general_modal"><i
                                class="icon-user-plus mr-2"></i> {{trans('messages.add_new',['item'=>trans('messages.permission')])}}
                    </button>
                </section>
                <section>
                    <div class="card">
                        <div class="card-header bg-light">
                            <h4 class="card-title">{{__('messages.permissions')}}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                            @foreach($categories_permissions as $category => $permissions)
                                <div class="col-md-6 ">
                                    <div class="card border-1 border-blue-400">
                                        <div class="card-header alpha-blue text-blue-800 border-bottom-blue header-elements-inline">
                                            <h6 class="card-title">{{$category}}</h6>
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
                                                @foreach($permissions as $permission)
                                                    <tr>
                                                        <td><a href="{{route('permission_assign_page',['permission'=>$permission->id])}}"><b>{{$permission['display_name']}}</b></a> </td>
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
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection