@extends('layouts.panel.panel_layout')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('js')
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            var DatatableBasic = function () {
                var _componentDatatableBasic = function () {
                    if (!$().DataTable) {
                        console.warn('Warning - datatables.min.js is not loaded.');
                        return;
                    }
                    $.extend($.fn.dataTable.defaults, {
                        autoWidth: false,
                        columnDefs: [{
                            orderable: false,
                            width: 100,
                            targets: [5]
                        }],
                        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
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
                        }
                    });
                    $('.datatable-basic').DataTable({
                        rowCallback: function (row, data, index) {
                            console.log(row)
                            if (data[4] === 'active') {
                                $(row).find('td:eq(4)').addClass('text-center bg-success')
                            } else if (data[4] === 'inactive') {
                                $(row).find('td:eq(4)').addClass('text-center bg-danger')
                            }
                        }
                    });
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
            }
        })

    </script>
@endsection
@section('css')
@stop
@php
    $active_sidbare = ['charity', 'charity_list'];
    $sumPay=0;
    $unPaid=0;
@endphp
@section('content')
    <section>
        <div class="content">
            <div class="container-fluid">
                <section>
                    <a href="{{route('charity_payment_list')}}"
                       class="btn btn-outline-dark m-2 py-2 px-3">{{__('messages.back')}}</a>
                </section>
            </div>
            <section>
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title text-black">{{__('messages.period_payment_list')}}
                            | {{$info['user'] ? $info['user']['name'] : ''}}</h6>
                        <hr>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3 py-2">
                            <h4 class="font-weight-semibold mb-1">{{$info['patern']['title']}}</h4>
                            <span class="text-muted d-block" dir='ltr'>{{__('messages.description')}}:  {{$info['description']}}</span>
                        </div>
                        <div class="container">
                            <hr>
                            <div class="row">
                                @foreach($info['values'] as $value)
                                    <div class="col-6 py-2">
                                        {{$value['charity_field']['label']}}: {{$value['value']}}
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                        </div>
                        <table class="table datatable-basic table-striped">
                            <thead>
                            <tr>
                                <th>{{{__('messages.payment_date')}}}</th>
                                <th>{{__('messages.amount')}}</th>
                                <th>{{__('messages.gateway')}}</th>
                                <th>{{__('messages.status')}}</th>
                                <th>{{__('messages.tracking_code')}}</th>
                                <th>{{__('messages.card_number')}}</th>
                                <th>{{__('messages.ref_id')}}</th>
                                <th>{{__('messages.ip')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($info['tranInfo'] as $payment)
                                @if($payment['status']=='SUCCEED'?$sumPay+=$payment['price']:'')@endif
                                <tr>
                                    <td>
                                        <span dir="ltr">
                                        {{$payment['payment_date']?jdate("Y-m-d H:i:s",strtotime($payment['payment_date'])):''}}
                                        </span>
                                    </td>
                                    <td>{{number_format($payment['price'])}} {{__('messages.rial')}}</td>
                                    <td>{{$payment['port']}}</td>
                                    <td>
                                        @if($payment['status']=='SUCCEED')
                                            <span class="badge badge-success">{{__('messages.'.$payment['status'])}}</span>
                                        @elseif($payment['status']=='FAILED')
                                            <span class="badge badge-danger">{{__('messages.'.$payment['status'])}}</span>
                                        @else
                                            <span class="badge badge-danger">{{__('messages.unknown')}}</span>
                                        @endif
                                    </td>
                                    <td>{{$payment['tracking_code']}}</td>
                                    <td>{{$payment['card_number']}}</td>
                                    <td>{{$payment['ref_id']}}</td>
                                    <td>{{$payment['ip']}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <div class="row text-center">
                            <div class="col-sm-6 col-xl-4">
                                <div class="card card-body bg-success-400 has-bg-image">
                                    <div class="media">
                                        <div class="media-body text-left">
                                            <h3 class="mb-0">{{number_format($sumPay)}}</h3>
                                            <span class="text-uppercase font-size-xs">{{__('messages.paid')}}</span>
                                        </div>
                                        <div class="mr-3 align-self-center">
                                            <i class="icon-cash4 icon-3x opacity-75"></i>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-4">
                                <div class="card card-body bg-indigo-400 has-bg-image">
                                    <div class="media">
                                        <div class="media-body text-left">
                                            <h3 class="mb-0">{{number_format(count($info['tranInfo']))}}</h3>
                                            <span class="text-uppercase font-size-xs">{{__('messages.count')}}</span>
                                        </div>
                                        <div class="mr-3 align-self-center">
                                            <i class="icon-pointer icon-3x opacity-75"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
@stop