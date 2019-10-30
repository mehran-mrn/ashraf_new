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
                        <h6 class="card-title text-black">{{__('messages.period_payment_list'). " | ".$periodInfo['user']['people']['name']." ".$periodInfo['user']['people']['family']}}</h6>
                        <hr>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3 py-2">
                            <h4 class="font-weight-semibold mb-1">{{$periodInfo['description']}}</h4>
                            <span class="text-muted d-block" dir='ltr'>{{__('messages.start_date') }}: @if($periodInfo['start_date']){{jdate("d F y",strtotime($periodInfo['start_date']))}}@endif</span>
                            <span class="text-muted d-block" dir='ltr'>{{__('messages.next_payment_date') }}: @if($periodInfo['next_date']){{jdate("d F y",strtotime($periodInfo['next_date']))}}@endif</span>
                        </div>
                        <table class="table datatable-basic table-striped">
                            <thead>
                            <tr>
                                <th>{{__("messages.it's_over_date")}}</th>
                                <th>{{__('messages.amount')}}</th>
                                <th>{{{__('messages.payment_date')}}}</th>
                                <th>{{__('messages.gateway')}}</th>
                                <th>{{__('messages.status')}}</th>
                                <th class="text-center">{{__('messages.description')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paymentList as $payment)
                                @if($payment['status']=='paid'?$sumPay+=$payment['amount']:'')@endif
                                @if($payment['status']=='unpaid'?$unPaid+=$payment['amount']:'')@endif
                                <tr>
                                    <td>{{jdate("Y-m-d",strtotime($payment['payment_date']))}}</td>
                                    <td>{{number_format($payment['amount'])}} {{__('messages.rial')}}</td>
                                    <td>
                                        <span dir="lrt">
                                        {{$payment['pay_date']!=null?jdate("Y-m-d H:i:s",strtotime($payment['pay_date'])):''}}
                                        </span>
                                    </td>
                                    <td>{{$payment['gateway']['title']}}</td>
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
                                            <h3 class="mb-0">{{number_format(count($paymentList))}}</h3>
                                            <span class="text-uppercase font-size-xs">{{__('messages.count')}}</span>
                                        </div>
                                        <div class="mr-3 align-self-center">
                                            <i class="icon-pointer icon-3x opacity-75"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-4">
                                <div class="card card-body bg-danger-400 has-bg-image">
                                    <div class="media">
                                        <div class="media-body text-left">
                                            <h3 class="mb-0">{{number_format($unPaid)}}</h3>
                                            <span class="text-uppercase font-size-xs">{{__("messages.unpaid")}}</span>
                                        </div>
                                        <div class="ml-3 align-self-center">
                                            <i class="icon-bag icon-3x opacity-75"></i>
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