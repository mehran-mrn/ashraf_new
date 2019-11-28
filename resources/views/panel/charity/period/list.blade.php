@extends('layouts.panel.panel_layout')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('js')
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script>
        var DatatableBasic = function () {
            var _componentDatatableBasic = function () {
                if (!$().DataTable) {
                    console.warn('Warning - datatables.min.js is not loaded.');
                    return;
                }
                $.extend($.fn.dataTable.defaults, {
                    autoWidth: true,
                    columnDefs: [{
                        orderable: false,
                        autoWidth: false,
                        width: 150,
                        targets: 7
                    }],
                    dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
                    language: {
                        search: '<span>{{__('messages.filter')}}:</span> _INPUT_',
                        searchPlaceholder: '{{__('messages.search')}}...',
                        lengthMenu: '<span>{{__('messages.show')}}:</span> _MENU_',
                        paginate: {
                            'first': '{{__('messages.first')}}',
                            'last': '{{__('messages.last')}}',
                            'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;',
                            'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;'
                        }
                    }
                });
                $('.datatable-basic').DataTable({
                    pagingType: "simple",
                    language: {
                        paginate: {
                            'next': $('html').attr('dir') == 'rtl' ? '{{__('messages.next')}} &larr;' : '{{__('messages.next')}} &rarr;',
                            'previous': $('html').attr('dir') == 'rtl' ? '&rarr; {{__('messages.prev')}}' : '&larr; {{__('messages.prev')}}'
                        }
                    },
                    stateSave: true,
                    autoWidth: false,
                    columnDefs: [{
                        orderable: false,
                        autoWidth: false,
                        width: 200,
                        targets: 7
                    }],
                });
                $('.sidebar-control').on('click', function () {
                    table.columns.adjust().draw();
                });
            };
            var _componentSelect2 = function () {
                if (!$().select2) {
                    console.warn('Warning - select2.min.js is not loaded.');
                    return;
                }
                $('.dataTables_length select').select2({
                    minimumResultsForSearch: Infinity,
                    dropdownAutoWidth: true,
                    width: 'auto'
                });
            };
            return {
                init: function () {
                    _componentDatatableBasic();
                    _componentSelect2();
                }
            }
        }();

        document.addEventListener('DOMContentLoaded', function () {
            DatatableBasic.init();
        });
    </script>
@endsection
@section('css')

@stop
@php
    $active_sidbare = ['charity', 'charity_period','charity_period_list']
@endphp
@section('content')
    <section>
        <div class="content">
            <section>
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title text-black">{{__('messages.Charity')}}
                            | {{__('messages.periodic_payment')}}</h6>
                        <hr>
                    </div>
                    <div class="card-body">

                        <table class="table datatable-basic">
                            <thead>
                            <tr>
                                <th>{{__('messages.id')}}</th>
                                <th>{{__('messages.name')}}</th>
                                <th>{{__('messages.amount')}}</th>
                                <th>{{__('messages.start_date')}}</th>
                                <th>{{__('messages.next_payment_date')}}</th>
                                <th>{{__('messages.description')}}</th>
                                <th>{{__('messages.status')}}</th>
                                <th>{{__('messages.status')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $i=1; @endphp
                            @foreach($periods as $period)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$period['user']['people']['name']}} {{$period['user']['people']['family']}}</td>
                                    <td>{{number_format($period['amount'])}}</td>
                                    <td>
                                        @if(isset($period['start_date']))
                                            {{jdate("Y-m-d",strtotime($period['start_date']))}}
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($period['next_date']))
                                            {{jdate("Y-m-d",strtotime($period['next_date']))}}
                                        @endif
                                    </td>
                                    <td>{{$period['description']}}</td>
                                    <td>
                                        @if($period['status']=='active')
                                            <span class="badge badge-success">{{__('messages.'.$period['status'])}}</span>
                                        @else
                                            <span class="badge badge-danger">{{__('messages.'.$period['status'])}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a data-toggle="tooltip" data-placement="top" title="{{__('messages.view')}}"
                                           href="{{route('charity_periods_show',['user_id'=>$period['user_id'],'id'=>$period['id']])}}"
                                           class="btn btn-outline-dark btn-sm"><i class="icon-eye"></i></a>


                                        <a href="javascript:;"
                                           class="btn btn-outline-danger btn-sm swal-alert "
                                           data-ajax-link="{{route('charity_periods_delete',['id'=>$period['id']])}}"
                                           data-method="post"
                                           data-csrf="{{csrf_token()}}"
                                           data-title="{{trans('messages.delete_item',['item'=>trans('messages.period')])}}"
                                           data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.period')])}}"
                                           data-type="warning"
                                           data-cancel="true"
                                           data-toggle="tooltip" data-placement="top" title="{{__('messages.delete')}}"
                                           data-confirm-text="{{trans('messages.delete')}}"
                                           data-cancel-text="{{trans('messages.cancel')}}">
                                            <i class="icon-bin top-0"></i></a>

                                        @if($period['status']=='active')
                                            <a href="javascript:;"
                                               class="btn btn-outline-warning btn-sm swal-alert "
                                               data-ajax-link="{{route('charity_periods_inactive',['id'=>$period['id']])}}"
                                               data-method="post"
                                               data-csrf="{{csrf_token()}}"
                                               data-title="{{trans('messages.delete_item',['item'=>trans('messages.period')])}}"
                                               data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.period')])}}"
                                               data-type="warning"
                                               data-cancel="true"
                                               data-toggle="tooltip" data-placement="top"
                                               title="{{__('messages.inactivate')}}"
                                               data-confirm-text="{{trans('messages.inactivate')}}"
                                               data-cancel-text="{{trans('messages.cancel')}}">
                                                <i class="icon-x top-0"></i></a>
                                        @else
                                            <a href="javascript:;"
                                               class="btn btn-outline-success btn-sm swal-alert "
                                               data-ajax-link="{{route('charity_periods_inactive',['id'=>$period['id']])}}"
                                               data-method="post"
                                               data-csrf="{{csrf_token()}}"
                                               data-title="{{trans('messages.delete_item',['item'=>trans('messages.period')])}}"
                                               data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.period')])}}"
                                               data-type="warning"
                                               data-cancel="true"
                                               data-toggle="tooltip" data-placement="top"
                                               title="{{__('messages.activate')}}"
                                               data-confirm-text="{{trans('messages.activate')}}"
                                               data-cancel-text="{{trans('messages.cancel')}}">
                                                <i class="icon-check top-0"></i></a>
                                    @endif
                                </tr>
                                @php $i++; @endphp
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </section>
@stop
