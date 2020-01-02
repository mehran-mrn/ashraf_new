@extends('layouts.panel.panel_layout')
<?php $aCount=0; ?>
@foreach($orders as $order)
    @if($order['status']!="accepted")
        <?php $aCount++ ?>
    @endif
@endforeach
@section('js')
    <script
            src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script
            src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script>
        var DatatableBasic = function () {
            var _componentDatatableBasic = function () {
                if (!$().DataTable) {
                    console.warn('Warning - datatables.min.js is not loaded.');
                    return;
                }
                $('.datatable-payments2').DataTable({
                    autoWidth: true,
                    "order": [[0, "desc"]],
                    columnDefs: [{
                        orderable: false,
                        width: 150,
                        targets: [7]
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
                $('.datatable-accepted').DataTable({
                    autoWidth: false,
                    "order": [[0, "desc"]],
                    columnDefs: [{
                        orderable: false,
                        width: 150,
                        targets: [7]
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

        $(document).ready(function () {
            if ($(".nav-link").hasClass("active")) {
                var aCount = '{{$aCount}}';
                if(aCount>0) {
                    $('.nav-link.active').append(" <span class='badge badge-danger float-left'>{{$aCount}}</span>")
                }
            }
        });
    </script>
@endsection
@section('css')
@endsection
@section('content')
    @php
        $active_sidbare = ['store', 'manage_orders']
    @endphp

    <section>
        <div class="content">
            <div class="card">
                <div class="card-header">
                    <span class="card-title text-black">{{__('messages.manage_orders')}}</span>
                    <hr>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                        <li class="nav-item"><a href="#highlighted-justified-tab1" class="nav-link active"
                                                data-toggle="tab">{{__('messages.new_orders')}}</a></li>
                        <li class="nav-item"><a href="#highlighted-justified-tab2" class="nav-link"
                                                data-toggle="tab">{{__('messages.approved_orders')}}</a></li>
                        <li class="nav-item"><a href="#highlighted-justified-tab3" class="nav-link"
                                                data-toggle="tab">{{__('messages.in_progress')}}</a></li>
                        <li class="nav-item"><a href="#highlighted-justified-tab4" class="nav-link"
                                                data-toggle="tab">{{__('messages.ready_for_sent')}}</a></li>
                        <li class="nav-item"><a href="#highlighted-justified-tab5" class="nav-link"
                                                data-toggle="tab">{{__('messages.sent')}}</a></li>
                        <li class="nav-item"><a href="#highlighted-justified-tab6" class="nav-link"
                                                data-toggle="tab">{{__('messages.final_orders')}}</a></li>

                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="highlighted-justified-tab1">
                            <table class="table datatable-basic datatable-payments2 table-striped">
                                <thead>
                                <tr>
                                    <th>{{__("messages.id")}}</th>
                                    <th>{{__("messages.user")}}</th>
                                    <th>{{__("messages.payment_type")}}</th>
                                    <th>{{__('messages.amount')}}</th>
                                    <th>{{{__('messages.payment_date')}}}</th>
                                    <th>{{__('messages.gateway')}}</th>
                                    <th>{{__('messages.status')}}</th>
                                    <th class="text-center">{{__('messages.view')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    @if($order['status']!="accepted")
                                        <tr>
                                            <td>{{$order['id']}}</td>
                                            <td>{{$order['people']['name']." ".$order['people']['family']}}</td>
                                            <td>{{__('messages.'.$order['payment'])}}</td>
                                            <td>{{number_format($order['amount'])}}</td>
                                            <td>{{miladi_to_shamsi_date($order['pay_date'])}}</td>
                                            <td>{{$order['gateway']['title']}}</td>
                                            <td>
                                                @if($order['status']=='paid')
                                                    <span
                                                            class="badge badge-success">{{__('messages.'.$order['status'])}}</span>
                                                @elseif($order['status']=='fail')
                                                    <span
                                                            class="badge badge-danger">{{__('messages.'.$order['status'])}}</span>
                                                @else
                                                    <span
                                                            class="badge badge-secondary">{{__('messages.'.$order['status'])}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route('manage_orders_detail',['id'=>$order['id']])}}"
                                                   data-toggle="tooltip" data-placement="top" title=""
                                                   class="btn btn-outline-dark btn-sm" data-original-title="مشاهده"><i
                                                            class="icon-eye"></i></a>

                                                <a href="javascript:;"
                                                   class="btn btn-outline-success btn-sm swal-alert "
                                                   data-ajax-link="{{route('manage_orders_approve',['id'=>$order['id']])}}"
                                                   data-method="post"
                                                   data-csrf="{{csrf_token()}}"
                                                   data-title="{{trans('messages.approve',['item'=>trans('messages.order')])}}"
                                                   data-text="{{trans('messages.approve',['item'=>trans('messages.order')])}}"
                                                   data-type="success"
                                                   data-cancel="true"
                                                   data-toggle="tooltip" data-placement="top"
                                                   title="{{__('messages.approve')}}"
                                                   data-confirm-text="{{trans('messages.approve')}}"
                                                   data-cancel-text="{{trans('messages.cancel')}}">
                                                    <i class="icon-check top-0"></i></a>

                                                <a href="javascript:;"
                                                   class="btn btn-outline-danger btn-sm swal-alert "
                                                   data-ajax-link="{{route('manage_orders_delete',['id'=>$order['id']])}}"
                                                   data-method="post"
                                                   data-csrf="{{csrf_token()}}"
                                                   data-title="{{trans('messages.delete_item',['item'=>trans('messages.order')])}}"
                                                   data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.order')])}}"
                                                   data-type="warning"
                                                   data-cancel="true"
                                                   data-toggle="tooltip" data-placement="top"
                                                   title="{{__('messages.delete')}}"
                                                   data-confirm-text="{{trans('messages.delete')}}"
                                                   data-cancel-text="{{trans('messages.cancel')}}">
                                                    <i class="icon-bin top-0"></i></a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade" id="highlighted-justified-tab2">
                            <table class="table datatable-basic datatable-accepted table-striped">
                                <thead>
                                <tr>
                                    <th>{{__("messages.id")}}</th>
                                    <th>{{__("messages.user")}}</th>
                                    <th>{{__("messages.payment_type")}}</th>
                                    <th>{{__('messages.amount')}}</th>
                                    <th>{{{__('messages.payment_date')}}}</th>
                                    <th>{{__('messages.gateway')}}</th>
                                    <th>{{__('messages.status')}}</th>
                                    <th class="text-center">{{__('messages.view')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    @if($order['status']=="accepted")
                                        <tr>
                                            <td>{{$order['id']}}</td>
                                            <td>{{$order['people']['name']." ".$order['people']['family']}}</td>
                                            <td>{{__('messages.'.$order['payment'])}}</td>
                                            <td>{{number_format($order['amount'])}}</td>
                                            <td>{{miladi_to_shamsi_date($order['pay_date'])}}</td>
                                            <td>{{$order['gateway']['title']}}</td>
                                            <td>
                                                @if($order['status']=='paid')
                                                    <span
                                                            class="badge badge-success">{{__('messages.'.$order['status'])}}</span>
                                                @elseif($order['status']=='fail')
                                                    <span
                                                            class="badge badge-danger">{{__('messages.'.$order['status'])}}</span>
                                                @else
                                                    <span
                                                            class="badge badge-secondary">{{__('messages.'.$order['status'])}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route('manage_orders_detail',['id'=>$order['id']])}}"
                                                   data-toggle="tooltip" data-placement="top" title=""
                                                   class="btn btn-outline-dark btn-sm" data-original-title="مشاهده"><i
                                                            class="icon-eye"></i></a>


                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade" id="highlighted-justified-tab3">
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

                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade" id="highlighted-justified-tab4">
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

                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="highlighted-justified-tab5">
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

                                </tbody>
                            </table>
                        </div>


                        <div class="tab-pane fade" id="highlighted-justified-tab6">
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

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
