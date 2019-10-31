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

                });

                $('.datatable-payments').DataTable({
                    autoWidth: false,
                    columnDefs: [{
                        orderable: false,
                        width: 100,
                        targets: [8]
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
                $('.datatable-payments2').DataTable({
                    autoWidth: false,
                    columnDefs: [{
                        orderable: false,
                        width: 100,
                        targets: [7,8]
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
                $('.sidebar-control').on('click', function () {
                    table.columns.adjust().draw();
                });
            }
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
    $active_sidbare = ['charity', 'charity_period','charity_period_status']
@endphp
@section('content')
    <section>
        <div class="content">
            <section>
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title text-black">{{__('messages.Charity')}} | {{__('messages.payment_status')}}</h6>
                        <hr>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills justify-content-center">
                            <li class="nav-item">
                                <a href="#centered-pill2" class="nav-link active"
                                   data-toggle="tab">{{__('messages.waiting_paid')}}</a>
                            </li>
                            <li class="nav-item">
                                <a href="#centered-pill3" class="nav-link"
                                   data-toggle="tab">{{__('messages.paid')}}</a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="centered-pill2">
                                <table class="table datatable-payments table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{__('messages.id')}}</th>
                                        <th>{{__('messages.name_family')}}</th>
                                        <th>{{__('messages.amount')}}</th>
                                        <th>{{{__('messages.it\'s_over_date')}}}</th>
                                        <th>{{__('messages.payment_date')}}</th>
                                        <th>{{__('messages.payment_status')}}</th>
                                        <th class="text-center">{{__('messages.description')}}</th>
                                        <th>{{__('messages.view')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1; @endphp
                                    @foreach($payments as $payment)
                                        @if($payment['status']!='paid')
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$payment['period']['user']['people']['name']}} {{$payment['period']['user']['people']['family']}}</td>
                                                <td>{{number_format($payment['amount'])}} {{__('messages.rial')}}</td>
                                                <td>
                                                    @if($payment['payment_date'])
                                                        {{jdate("Y-m-d",strtotime($payment['payment_date']))}}
                                                    @endif
                                                </td>
                                                <td>
                                                <span dir="ltr">
                                                @if($payment['pay_date'])
                                                        {{jdate("Y-m-d H:i:s",strtotime($payment['pay_date']))}}
                                                    @endif
                                                </span>
                                                </td>
                                                <td>
                                                    @if($payment['status']=='paid')
                                                        <span class="badge badge-success">{{__('messages.'.$payment['status'])}}</span>
                                                    @elseif($payment['status']=='unpaid')
                                                        <span class="badge badge-danger">{{__('messages.'.$payment['status'])}}</span>
                                                    @else
                                                        <span class="badge badge-danger">{{__('messages.unknown')}}</span>
                                                    @endif
                                                </td>
                                                <td>{{$payment['description']}}</td>
                                                <td>
                                                    <a data-toggle="tooltip" data-placement="top" title="{{__('messages.view')}}"
                                                       class="btn btn-sm btn-outline-dark"
                                                       href="{{route('charity_period_status_show',['id'=>$payment['id']])}}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @php $i++; @endphp
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="centered-pill3">
                                <table class="table datatable-payments2 table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{__('messages.id')}}</th>
                                        <th>{{__('messages.name_family')}}</th>
                                        <th>{{__('messages.amount')}}</th>
                                        <th>{{{__('messages.gateway')}}}</th>
                                        <th>{{__('messages.payment_date')}}</th>
                                        <th>{{__('messages.payment_status')}}</th>
                                        <th>{{__('messages.tracking_code')}}</th>
                                        <th class="text-center">{{__('messages.description')}}</th>
                                        <th>{{__('messages.view')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1; @endphp
                                    @foreach($payments as $payment)
                                        @if($payment['status']=='paid')
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$payment['period']['user']['people']['name']}} {{$payment['period']['user']['people']['family']}}</td>
                                                <td>{{number_format($payment['amount'])}} {{__('messages.rial')}}</td>
                                                <td>{{$payment['gateway']['title']}}</td>
                                                <td>
                                                    @if($payment['pay_date'])
                                                        {{jdate("Y-m-d",strtotime($payment['pay_date']))}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($payment['status']=='paid')
                                                        <span class="badge badge-success">{{__('messages.'.$payment['status'])}}</span>
                                                    @elseif($payment['status']=='unpaid')
                                                        <span class="badge badge-danger">{{__('messages.'.$payment['status'])}}</span>
                                                    @else
                                                        <span class="badge badge-danger">{{__('messages.unknown')}}</span>
                                                    @endif
                                                </td>
                                                <td>{{$payment['trans_id']}}</td>
                                                <td>{{$payment['description']}}</td>
                                                <td class="text-center">
                                                    <a data-toggle="tooltip" data-placement="top" title="{{__('messages.view')}}"
                                                       class="btn btn-sm btn-outline-dark"
                                                       href="{{route('charity_period_status_show',['id'=>$payment['id']])}}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @php $i++; @endphp
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
@stop
