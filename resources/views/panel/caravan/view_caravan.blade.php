@extends('layouts.panel.panel_layout')
@section('css')
    <link href="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.style.css') }}"
          rel="stylesheet" type="text/css">
@endsection

@section('js')
    <!-- Theme JS files -->
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/extensions/jquery_ui/widgets.min.js')}}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/tables/datatables/extensions/natural_sort.js')}}"></script>

    <script src="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.js') }}"></script>
    <!-- /theme JS files -->

    <script>
        var TaskManagerList = function () {


            //
            // Setup components
            //

            // Datatable
            var _componentDatatable = function () {
                if (!$().DataTable) {
                    console.warn('Warning - datatables.min.js is not loaded.');
                    return;
                }

                // Create an array with the values of all the input boxes in a column
                $.fn.dataTable.ext.order['dom-text'] = function (settings, col) {
                    return this.api().column(col, {order: 'index'}).nodes().map(function (td, i) {
                        return $('input', td).val();
                    });
                };

                // Create an array with the values of all the select options in a column
                $.fn.dataTable.ext.order['dom-select'] = function (settings, col) {
                    return this.api().column(col, {order: 'index'}).nodes().map(function (td, i) {
                        return $('select', td).val();
                    });
                };

                // Initialize data table
                $('.tasks-list').DataTable({
                    autoWidth: false,
                    columnDefs: [
                        {
                            type: "natural",
                            width: 20,
                            targets: 0
                        },
                        {
                            visible: false,
                            targets: 1
                        },
                        {
                            width: '15%',
                            targets: 2
                        },
                        {
                            width: '10%',
                            targets: 3
                        },
                        {
                            orderDataType: 'dom-text',
                            type: 'string',
                            targets: 4
                        },
                        {
                            orderDataType: 'dom-select',
                            type: 'string',
                            targets: 5
                        },
                        {
                            orderable: false,
                            targets: 6
                        },
                        {
                            width: '15%',
                            targets: [4, 5]
                        }
                    ],
                    order: [[0, 'desc']],
                    dom: '<"datatable-header"fl><"datatable-scroll-lg"t><"datatable-footer"ip>',
                    language: {
                        search: '<span>Filter:</span> _INPUT_',
                        searchPlaceholder: 'Type to filter...',
                        lengthMenu: '<span>Show:</span> _MENU_',
                        paginate: {
                            'first': 'First',
                            'last': 'Last',
                            'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;',
                            'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;'
                        }
                    },
                    lengthMenu: [15, 25, 50, 75, 100],
                    displayLength: 25,
                    drawCallback: function (settings) {
                        var api = this.api();
                        var rows = api.rows({page: 'current'}).nodes();
                        var last = null;

                        // Grouod rows
                        api.column(1, {page: 'current'}).data().each(function (group, i) {
                            if (last !== group) {
                                $(rows).eq(i).before(
                                    '<tr class="table-active table-border-double"><td colspan="8" class="font-weight-semibold">' + group + '</td></tr>'
                                );

                                last = group;
                            }
                        });

                    }
                });
            };
            return {
                init: function () {
                    _componentDatatable();
                }
            }
        }();
        document.addEventListener('DOMContentLoaded', function () {
            TaskManagerList.init();
        });
    </script>
@endsection

@section('content')
    <?php
    $active_sidbare = ['caravans']
    ?>
    <!-- Content area -->
    <div class="content">
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header bg-indigo">

                        <span class="card-title">
                            {{trans('messages.caravan_status')}} :
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
                        </span>
                    </div>
                    <div class="card-body">

                        <table class="table tasks-list table-lg">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Period</th>
                                <th>{{trans('messages.name')}}</th>
                                <th>{{trans('messages.national_code')}}</th>
                                <th>{{trans('messages.birth_date')}}</th>
                                <th>{{trans('messages.use_count')}}</th>
                                <th>{{trans('messages.status')}}</th>
                                <th class="text-center text-muted">
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($caravan['persons'] as $person_caravan)
                                <tr>
                                    <td></td>
                                    <td>{{$person_caravan['parent_id']}}</td>
                                    <td>{{$person_caravan['person']['name'] ." - ". $person_caravan['person']['family']}}</td>
                                    <td>{{$person_caravan['person']['national_code']}}</td>
                                    <td>{{miladi_to_shamsi_date($person_caravan['person']['birth_date'])}} </td>
                                    <td><span class="badge badge-success"><b>
                                           {{count_caravan_useage_history($person_caravan['person']['id'],$person_caravan['caravan_id'])}}
                                        </b> </span></td>
                                    <td>
                                        @if($person_caravan['accepted'] >='1')
                                            <span class="badge badge-success">{{trans('messages.accepted')}}</span>
                                        @elseif($person_caravan['accepted'] =='0')
                                            <span class="badge badge-danger">{{trans('messages.rejected')}}</span>
                                        @else
                                            <span class="badge badge-warning">{{trans('messages.pending')}}</span>
                                        @endif

                                    </td>
                                    <td>
                                        @if($caravan['status'] == 1)
                                            <button type="button" class="float-right btn alpha-info border-info-400 text-info-800 btn-icon rounded-round ml-2
                                             modal-ajax-load"
                                                    data-ajax-link="{{route('register_to_caravan',['caravan_id'=>$caravan['id'],'person_caravan_id'=>$person_caravan['id']])}}"
                                                    data-toggle="modal"
                                                    data-modal-title="{{trans('messages.view')}}"
                                                    data-target="#general_modal">
                                                <i class="icon-gear"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="col-md-3">
                <div class="row">
                    @if(in_array($caravan['status'],["1"]))

                        <div class="col-md-6 mb-1">

                            <button class="btn bg-success btn-block btn-float btn-float-lg modal-ajax-load"
                                    data-ajax-link="{{route('register_to_caravan',['caravan_id'=>$caravan['id']])}}"
                                    data-toggle="modal"
                                    data-modal-title="{{trans('messages.register_form_title')}}"
                                    data-target="#general_modal"
                                    data-popup="tooltip"
                                    data-placement="bottom"
                                    data-container="body"
                                    data-original-title="{{trans('messages.new_register')}}">
                                <i class="icon-user-plus icon-3x"></i>
                                <span>{{trans('messages.new_register')}}</span>
                            </button>
                        </div>
                    @endif
                    @if(in_array($caravan['status'],["1","2","3","4"]))
                        <div class="col-md-6 mb-1">

                            <button class="btn bg-info btn-block btn-float btn-float-lg modal-ajax-load"
                                    data-ajax-link="{{route('change_caravan_status_form',['caravan_id'=>$caravan['id'],'status'=>"next"])}}"
                                    data-toggle="modal"
                                    data-modal-title="{{trans('messages.register_form_title')}}"
                                    data-target="#general_modal"
                                    data-popup="tooltip"
                                    data-placement="bottom"
                                    data-container="body"
                                    data-original-title="{{trans('messages.next_step')}}">
                                <i class="icon-next icon-3x"></i>
                                <span>{{trans('messages.next_step')}}</span>
                            </button>
                        </div>
                    @endif
                    @if(in_array($caravan['status'],["0","2","3","4","5"]))
                        <div class="col-md-6 mb-1">

                            <button class="btn bg-warning btn-block btn-float btn-float-lg modal-ajax-load"
                                    data-ajax-link="{{route('change_caravan_status_form',['caravan_id'=>$caravan['id'],'status'=>"back"])}}"
                                    data-toggle="modal"
                                    data-modal-title="{{trans('messages.register_form_title')}}"
                                    data-target="#general_modal"
                                    data-popup="tooltip"
                                    data-placement="bottom"
                                    data-container="body"
                                    data-original-title="{{trans('messages.previous_step')}}">
                                <i class="icon-reply icon-3x"></i>
                                <span>{{trans('messages.previous_step')}}</span>
                            </button>
                        </div>
                    @endif
                    @if(in_array($caravan['status'],["1","2"]))
                        <div class="col-md-6 mb-1">

                            <button class="btn bg-danger btn-block btn-float btn-float-lg modal-ajax-load"
                                    data-ajax-link="{{route('change_caravan_status_form',['caravan_id'=>$caravan['id'],'status'=>"cancel"])}}"
                                    data-toggle="modal"
                                    data-modal-title="{{trans('messages.register_form_title')}}"
                                    data-target="#general_modal"
                                    data-popup="tooltip"
                                    data-placement="bottom"
                                    data-container="body"

                                    data-original-title="{{trans('messages.cancel_caravan')}}">
                                <i class="icon-database-remove icon-3x"></i>
                                <span>{{trans('messages.cancel_caravan')}}</span>
                            </button>
                        </div>
                    @endif
                </div>
                <span class="divider"><hr></span>
                <div class="card">
                    <div class="card-header bg-primary">
                        <span class="card-title">{{trans('messages.destination')}}</span>
                    </div>
                    <div class="card-img-actions px-1 pt-1">
                        <img class="card-img img-fluid img-absolute "
                             src="{{'/'.$caravan['host']['media']['url']}}" alt="">
                        <div class="card-img-actions-overlay  card-img bg-dark-alpha">

                        </div>
                    </div>

                    <div class="card-body">
                        <h6 class="font-weight-semibold"><b>{{$caravan['host']['name']}}</b></h6>
                        {{$caravan['host']['city_name']}}
                    </div>
                </div>


                <div class="card">
                    <div class="card-header bg-primary">
                        <span class="card-title">{{__('messages.caravan_info')}}</span>
                    </div>
                    <div class="card-body p-0">
                        <ul class=" list-group list-group-flush">
                            <li class="list-group-item list-group-item-action legitRipple">
                                <div>
                                    {{trans('messages.capacity')}}:
                                    <b>{{$caravan['capacity']}}</b> |
                                    <span class="text-success">{{get_caravan_usage_status($caravan['id'])['accepted']}}</span> -
                                    <span class="text-warning">{{get_caravan_usage_status($caravan['id'])['pending']}}</span> -
                                    <span class="text-danger">{{get_caravan_usage_status($caravan['id'])['rejected']}}</span>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action legitRipple">
                                <div>
                                    {{trans('messages.province')}} {{trans('messages.departure')}}:
                                    <b>{{get_provinces($caravan['dep_province'])['name']}}</b>

                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action legitRipple">
                                <div>
                                    {{trans('messages.city')}} {{trans('messages.departure')}}:
                                    <b>{{get_cites($caravan['dep_city'])['name']}}</b>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action legitRipple">
                                <div>
                                    {{trans('messages.transport_type').": "}}:
                                    <b>{{$caravan['transport']}}</b>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action legitRipple">
                                <div>
                                    {{trans('messages.date')}}
                                    {{trans('messages.depart')}}:
                                    <b>{{jdate('j F Y',strtotime($caravan['start']))}}</b>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action legitRipple">
                                <div>
                                    {{trans('messages.date')}}
                                    {{trans('messages.entrance')}}:
                                    <b>{{$caravan['arrival']?jdate('j F Y',strtotime($caravan['arrival'])):""}}</b>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action legitRipple">
                                <div>
                                    {{trans('messages.date')}}
                                    {{trans('messages.exit')}}:
                                    <b>{{$caravan['departure']?jdate('j F Y',strtotime($caravan['departure'])):""}}</b>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action legitRipple">
                                <div>
                                    {{trans('messages.date')}}
                                    {{trans('messages.get_back')}}:
                                    <b>{{$caravan['end']?jdate('j F Y',strtotime($caravan['end'])):""}}</b>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action legitRipple">
                                <div>
                                    {{trans('messages.status')}}:
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

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-primary">
                        <span class="card-title">{{__('messages.Workflow')}}</span>
                    </div>
                    <div class="card-body p-0">
                        @include('panel.caravan.materials.caravan_timeline')
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-primary">
                        <span class="card-title">Tag's</span>
                    </div>
                    <div class="card-body px-0">

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection