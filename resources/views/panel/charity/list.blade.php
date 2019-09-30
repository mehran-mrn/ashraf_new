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
                            if (data[4] === 'active') {
                                $(row).find('td:eq(4)').addClass('text-center bg-success')
                            } else if (data[4] === 'inactive') {
                                $(row).find('td:eq(4)').addClass('text-center bg-danger')
                            }
                        }
                    });
                    $('.datatable-payments').DataTable({
                        rowCallback: function (row, data, index) {
                            if (data[4] === 'active') {
                                $(row).find('td:eq(4)').addClass('text-center bg-success')
                            } else if (data[4] === 'inactive') {
                                $(row).find('td:eq(4)').addClass('text-center bg-danger')
                            }
                        }
                    });
                    $('.datatable-payments2').DataTable({
                        rowCallback: function (row, data, index) {
                            if (data[5] === 'active') {
                                $(row).find('td:eq(5)').addClass('text-center bg-success')
                            } else if (data[5] === 'inactive') {
                                $(row).find('td:eq(5)').addClass('text-center bg-danger')
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
            }
            document.addEventListener('DOMContentLoaded', function () {
                DatatableBasic.init();
            });
        })

    </script>
@endsection
@section('css')
@stop
@php
    $active_sidbare = ['charity', 'charity_list']
@endphp
@section('content')
    <section>
        <div class="content">
            <section>
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title text-black">{{__('messages.Charity')}}</h6>
                        <hr>
                    </div>

                    <div class="card-body">
                        <ul class="nav nav-pills justify-content-center">
                            <li class="nav-item">
                                <a href="#centered-pill1" class="nav-link active"
                                   data-toggle="tab">{{__('messages.period_list')}}</a></li>
                            <li class="nav-item">
                                <a href="#centered-pill2" class="nav-link"
                                   data-toggle="tab">{{__('messages.waiting_list')}}</a>
                            </li>
                            <li class="nav-item">
                                <a href="#centered-pill3" class="nav-link"
                                   data-toggle="tab">{{__('messages.approved_list')}}</a>
                            </li>
                            <li class="nav-item">
                                <a href="#centered-pill4" class="nav-link"
                                   data-toggle="tab">{{__('messages.other_payments')}}</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="centered-pill1">
                                <table class="table datatable-basic table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{__('messages.name_family')}}</th>
                                        <th>{{__('messages.amount')}}</th>
                                        <th>{{{__('messages.start_date')}}}</th>
                                        <th>{{__('messages.predict_end_date')}}</th>
                                        <th>{{__('messages.status')}}</th>
                                        <th class="text-center">{{__('messages.description')}}</th>
                                        <th>{{__('messages.show')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($periods as $period)
                                        <tr>
                                            <td>{{$period['user']['name']}}</td>
                                            <td>{{number_format($period['amount'])}}</td>
                                            <td>{{jdate("Y-m-d",strtotime($period['start_date']))}}</td>
                                            <td>{{jdate("Y-m-d",strtotime($period['next_date']))}}</td>
                                            <td>{{__('messages.'.$period['status'])}}</td>
                                            <td>{{$period['description']}}</td>
                                            <td>
                                                <a href="{{route('charity_periods_show',['user_id'=>$period['user_id'],'id'=>$period['id']])}}"
                                                   class="btn btn-info btn-sm"><i class="icon-eye"></i></a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="centered-pill2">
                                <table class="table datatable-payments table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{__('messages.name_family')}}</th>
                                        <th>{{__('messages.amount')}}</th>
                                        <th>{{{__('messages.it\'s_over_date')}}}</th>
                                        <th>{{__('messages.payment_date')}}</th>
                                        <th>{{__('messages.payment_status')}}</th>
                                        <th>{{__('messages.status')}}</th>
                                        <th class="text-center">{{__('messages.description')}}</th>
                                        <th>{{__('messages.send_sms')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($payments as $payment)
                                        <tr>
                                            <td>{{$payment['period']['user']['name']}}</td>
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
                                            <td>{{__('messages.'.$payment['review'])}}</td>
                                            <td>{{$payment['description']}}</td>
                                            <td>
                                                @if($payment['status']=="unpaid")
                                                    <a href="#" class="btn btn-info btn-sm"><i class="icon-mobile"></i></a>
                                                @endif
                                                @if($payment['status']=='paid')
                                                    <button type="button"
                                                            class="btn btn-success btn-sm swal-alert"
                                                            data-ajax-link="{{route('charity_payment_approve',['id'=>$payment['id']])}}"
                                                            data-method="POST"
                                                            data-csrf="{{csrf_token()}}"
                                                            data-title="{{trans('messages.payment_approve')}}"
                                                            data-text="{{trans('messages.approve',['item'=>trans('messages.pay')])}}"
                                                            data-type="warning"
                                                            data-cancel="true"
                                                            data-confirm-text="{{trans('messages.approve')}}"
                                                            data-cancel-text="{{trans('messages.cancel')}}">
                                                        <i class="icon-check"></i>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="centered-pill3">
                                <table class="table datatable-payments table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{__('messages.name_family')}}</th>
                                        <th>{{__('messages.amount')}}</th>
                                        <th>{{{__('messages.it\'s_over_date')}}}</th>
                                        <th>{{__('messages.payment_date')}}</th>
                                        <th>{{__('messages.payment_status')}}</th>
                                        <th>{{__('messages.status')}}</th>
                                        <th>{{__('messages.approve_time')}}</th>
                                        <th>{{__('messages.approve_user')}}</th>
                                        <th class="text-center">{{__('messages.description')}}</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($paymentsApprove as $payment)
                                        <tr>
                                            <td>{{$payment['period']['user']['name']}}</td>
                                            <td>{{number_format($payment['amount'])}}</td>
                                            <td>
                                                @if($payment['payment_date'])
                                                    {{jdate("Y-m-d",strtotime($payment['payment_date']))}}
                                                @endif
                                            </td>
                                            <td>
                                                @if($payment['pay_date'])
                                                    {{jdate("Y-m-d",strtotime($payment['pay_date']))}}
                                                @endif
                                            </td>
                                            <td>{{__('messages.'.$payment['status'])}}</td>
                                            <td>{{__('messages.'.$payment['review'])}}</td>
                                            <td>
                                                @if($payment['review_datetime'])
                                                    {{jdate("Y/m/d",strtotime($payment['review_datetime']))}}
                                                @endif
                                            </td>
                                            <td>{{$payment['admin']['name']}}</td>
                                            <td>{{$payment['description']}}</td>
                                            <td>
                                                <a href="#" class="btn btn-info btn-sm"><i class="icon-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="centered-pill4">
                                <table class="table datatable-payments2 table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{__('messages.name_family')}}</th>
                                        <th>{{__('messages.phone')}}</th>
                                        <th>{{__('messages.amount')}}</th>
                                        <th>{{{__('messages.payment_date')}}}</th>
                                        <th>{{__('messages.patern')}}</th>
                                        <th>{{__('messages.status')}}</th>
                                        <th class="text-center">{{__('messages.description')}}</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($otherPayments as $payment)
                                        <tr>
                                            <td>{{$payment['name']}}</td>
                                            <td>{{$payment['phone']}}</td>
                                            <td>{{number_format($payment['amount'])}}</td>
                                            <td>
                                                @if($payment['payment_date'])
                                                    {{jdate("Y-m-d",strtotime($payment['payment_date']))}}
                                                @endif
                                            </td>
                                            <td>{{$payment['patern']['title']}}</td>
                                            <td>
                                                @if($payment['status']=='success')
                                                    <span class="badge badge-success">{{__('messages.'.$payment['status'])}}</span>
                                                @elseif($payment['status']=='fail')
                                                    <span class="badge badge-danger">{{__('messages.'.$payment['status'])}}</span>
                                                @else
                                                    <span class="badge badge-danger">{{__('messages.unknown')}}</span>
                                                @endif
                                            </td>
                                            <td>{{$payment['description']}}</td>
                                            <td>
                                                <a href="{{route('charity_payment_list_vow_show',['id'=>$payment['id']])}}"
                                                   class="btn btn-info btn-sm"><i class="icon-eye"></i></a>
                                            </td>
                                        </tr>
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
