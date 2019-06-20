@extends('layouts.panel.panel_layout')
@section('js')
    <!-- Theme JS files -->
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/extensions/jquery_ui/widgets.min.js')}}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/tables/datatables/extensions/natural_sort.js')}}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/demo_pages/task_manager_list.js')}}"></script>

    <!-- /theme JS files -->
@endsection
@section('content')
    <?php
    $active_sidbare = ['caravans', 'caravans_list']
    ?>

    <!-- Content area -->
    <div class="content">

        <!-- Task manager table -->
        <div class="card">
            <div class="card-header bg-transparent header-elements-inline">
                <h6 class="card-title">{{trans('messages.caravans_list')}}</h6>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="reload"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <table class="table tasks-list table-lg">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Period</th>
                    <th>{{trans('messages.caravan')}}</th>
                    <th>{{trans('messages.person_count')}}</th>
                    <th>{{trans('messages.date')}} {{trans('messages.depart')}}</th>
                    <th>{{trans('messages.status')}}</th>
                    <th>{{trans('messages.duty')}}</th>
                    <th class="text-center text-muted" style="width: 30px;"><i class="icon-checkmark3"></i></th>
                </tr>
                </thead>
                <tbody>
                @foreach($caravans as $caravan)
                    <tr>
                        <td>#25</td>
                        <td>{{$caravan['caravan_host_id']['status']}}</td>
                        <td>
                            <div class="font-weight-semibold"><a
                                        href="{{route('caravan',['caravan_id'=>$caravan->id])}}">{{get_cites($caravan['dep_city'])['name']}}
                                    | {{get_provinces($caravan['dep_province'])['name']}}</a></div>
                            <div class="text-muted">{{get_hosts($caravan['caravan_host_id'])['name']." - ".get_hosts($caravan['caravan_host_id'])['city_name']}}</div>
                        </td>
                        <td>
                            <div class="btn-group">

                                <span class="badge badge-dark font-size-lg ">
                                    {{get_caravan_usage_status($caravan['id'])['capacity']}}
                                    /
                                    {{get_caravan_usage_status($caravan['id'])['pending'] + get_caravan_usage_status($caravan['id'])['accepted']}}

                                </span>
                            </div>
                        </td>
                        <td>
                            <div class="d-inline-flex align-items-center">
                                <i class="icon-calendar2 mr-2"></i>
                                <span class="text-black">{{jdate('j F Y',strtotime($caravan['start']))}}</span>
                            </div>
                        </td>
                        <td>
                            @switch($caravan['status'])
                                @case("0")<span class="badge bg-danger font-size ">
                                {{trans('messages.canceled')}}</span>
                                @break
                                @case("1")<span class="badge bg-info font-size ">
                                {{trans('messages.registering')}}</span>
                                @break
                                @case("2")<span class="badge bg-violet font-size ">
                                {{trans('messages.ready')}}</span>
                                @break
                                @case("3")<span class="badge bg-success font-size ">
                                {{trans('messages.arrived')}}</span>
                                @break
                                @case("4")<span class="badge bg-indigo font-size ">
                                {{trans('messages.exited')}}</span>
                                @break
                                @case("5")<span class="badge bg-teal font-size ">
                                {{trans('messages.archived')}}</span>
                                @break
                            @endswitch


                        </td>
                        <td>
                            <a href="#"><img src="../../../../global_assets/images/placeholders/placeholder.jpg"
                                             class="rounded-circle" width="32" height="32" alt=""></a>
                            <a href="#"><img src="../../../../global_assets/images/placeholders/placeholder.jpg"
                                             class="rounded-circle" width="32" height="32" alt=""></a>
                            <a href="#"
                               class="btn btn-icon bg-transparent btn-sm border-slate-300 text-slate rounded-round border-dashed"><i
                                        class="icon-person"></i></a>
                        </td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle caret-0"
                                       data-toggle="dropdown"><i
                                                class="icon-menu9"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-alarm-add"></i> Check in</a>
                                        <a href="#" class="dropdown-item"><i class="icon-attachment"></i> Attach
                                            screenshot</a>
                                        <a href="#" class="dropdown-item"><i class="icon-rotate-ccw2"></i> Reassign</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item"><i class="icon-pencil7"></i> Edit task</a>
                                        <a href="#" class="dropdown-item"><i class="icon-cross2"></i> Remove</a>
                                    </div>
                                    </li>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /task manager table -->

    </div>
    <!-- /content area -->

@endsection