@extends('layouts.panel.panel_layout')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('js')
    <script
        src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{asset('public/assets/global/js/leatflat/leaflet.js')}}"></script>

    <script
        src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            var map = L.map('map').setView([{{$orders['address']['lat']}}, {{$orders['address']['lon']}}], 12);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([{{$orders['address']['lat']}}, {{$orders['address']['lon']}}]).addTo(map)
                .bindPopup('مکان دریافت')
                .openPopup();

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
    <link rel="stylesheet" href="{{URL::asset('public/assets/global/js/leatflat/leaflet.css')}}" />
    <style>
        #map { height: 380px; }
    </style>
@stop
@php
    $active_sidbare = ['charity', 'charity_champion_payments_list'];
    $sumPay=0;
    $unPaid=0;
@endphp
@section('content')
    <section>
        <div class="content">
            <div class="container-fluid">
                <section>
                    <a href="{{route('manage_orders')}}"
                       class="btn btn-outline-dark m-2 py-2 px-3">{{__('messages.back')}}</a>
                </section>
            </div>
            <section>
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title text-black">{{__('messages.order_detail')}}
                            | {{$orders['id']}}
                        </h6>
                        <hr>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3 py-2">
                            <h4 class="font-weight-semibold mb-1">
                                <strong>{{__('messages.name')}}: </strong><span>{{$orders['people']['name']}}</span> |
                                <strong>{{__('messages.family')}}: </strong><span>{{$orders['people']['family']}}</span>
                            </h4>
                        </div>
                        <div class="container">
                            <hr>
                            <div class="row">
                                <hr>
                                @if($orders['address']['extraInfo']['condolences']!="")
                                    <div class="col-6 py-2">
                                        <strong>{{__('messages.condolences_to')}}
                                            :</strong> {{$orders['address']['extraInfo']['condolences']}}
                                    </div>
                                @endif
                                @if($orders['address']['extraInfo']['on_behalf_of']!="")
                                    <div class="col-6 py-2">
                                        <strong>{{__('messages.on_behalf_of')}}
                                            :</strong> {{$orders['address']['extraInfo']['on_behalf_of']}}
                                    </div>
                                @endif
                                @if($orders['address']['extraInfo']['late_name']!="")
                                    <div class="col-6 py-2">
                                        <strong>{{__('messages.late_name')}}
                                            :</strong> {{$orders['address']['extraInfo']['late_name']}}
                                    </div>
                                @endif
                                @if($orders['address']['extraInfo']['meeting_date']!=0)
                                    <div class="col-6 py-2">
                                        <strong>{{__('messages.meeting_date')}}
                                            :</strong> {{$orders['address']['extraInfo']['meeting_date']}}
                                    </div>
                                @endif
                                @if($orders['address']['extraInfo']['meeting_time']!="")
                                    <div class="col-6 py-2">
                                        <strong>{{__('messages.meeting_time')}}
                                            :</strong> {{$orders['address']['extraInfo']['meeting_time']}}
                                    </div>
                                @endif
                                @if($orders['address']['extraInfo']['descriptions']!="")
                                    <div class="col-6 py-2">
                                        <strong>{{__('messages.descriptions')}}
                                            :</strong> {{$orders['address']['extraInfo']['descriptions']}}
                                    </div>
                                @endif
                            </div>
                            <hr>
                            <div class="row">
                                @if($orders['address']['province']['name']!="")
                                    <div class="col-6 py-2">
                                        <strong>{{__('messages.province')}}
                                            :</strong> {{$orders['address']['province']['name']}}
                                    </div>
                                @endif
                                @if($orders['address']['city']['name']!="")
                                    <div class="col-6 py-2">
                                        <strong>{{__('messages.city')}}
                                            :</strong> {{$orders['address']['city']['name']}}
                                    </div>
                                @endif
                                @if($orders['address']['address']!="")
                                    <div class="col-6 py-2">
                                        <strong>{{__('messages.address')}}
                                            :</strong> {{$orders['address']['address']}}
                                    </div>
                                @endif
                                @if($orders['address']['receiver']!="")
                                    <div class="col-6 py-2">
                                        <strong>{{__('messages.receiver_name')}}
                                            :</strong> {{$orders['address']['receiver']}}
                                    </div>
                                @endif
                                @if($orders['address']['phone']!="")
                                    <div class="col-6 py-2">
                                        <strong>{{__('messages.phone')}}
                                            :</strong> {{$orders['address']['phone']}}
                                    </div>
                                @endif
                                @if($orders['address']['mobile']!="")
                                    <div class="col-6 py-2">
                                        <strong>{{__('messages.mobile')}}
                                            :</strong> {{$orders['address']['mobile']}}
                                    </div>
                                @endif
                                @if($orders['address']['zip_code']!="")
                                    <div class="col-6 py-2">
                                        <strong>{{__('messages.zip_code')}}
                                            :</strong> {{$orders['address']['zip_code']}}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        @if(isset($orders['address']['lat']))
                        <div id="map"></div>
                        @endif
                        <table class="table datatable-basic table-bordered border-success border-3 table-striped mt-3">
                            <thead>
                            <tr>
                                <th>{{__('messages.product')}}</th>
                                <th>{{__('messages.count')}}</th>
                                <th>{{__('messages.price')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders['items'] as $payment)
                                <tr>
                                    <td>
                                        <span dir="ltr">
                                        @if(isset($payment['product']['title']))
                                                {{$payment['product']['title']}}
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        <span>{{$payment['count']}}</span>
                                    </td>
                                    <td>
                                        <span>{{number_format($payment['product']['store_product_inventory']['price'])}} {{__('messages.toman')}}</span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        @foreach($transInfo as $payment)
                            @if($payment['status']=='SUCCEED'?$sumPay+=$payment['price']:'')@endif
                            <table
                                class="table datatable-basic table-bordered border-{{$payment['status']=="SUCCEED"?'success':'danger'}} border-3 table-striped mt-3">
                                <tbody>
                                <tr>
                                    <td>
                                        <strong>{{__('messages.payment_date')}}: </strong>
                                        <span dir="ltr">
                                        @if(isset($payment['payment_date']))
                                                {{jdate("Y-m-d H:i:s",strtotime($payment['payment_date']))}}
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        <strong>{{__('messages.gateway')}}: </strong>
                                        <span>{{$payment['port']}}</span>
                                    </td>
                                    <td>
                                        <strong>{{__('messages.price')}}: </strong>
                                        <span>{{number_format($payment['price'])}} {{__('messages.rial')}}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>{{__('messages.ref_id')}}: </strong>
                                        <span dir="ltr">{{$payment['ref_id']}}</span>
                                    </td>
                                    <td>
                                        <strong>{{__('messages.tracking_code')}}: </strong>
                                        <span dir="ltr">{{$payment['tracking_code']}}</span>
                                    </td>
                                    <td>
                                        <strong>{{__('messages.card_number')}}: </strong>
                                        <span dir="ltr">{{$payment['card_number']}}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>{{__('messages.status')}}: </strong>
                                        @if($payment['status']=='SUCCEED')
                                            <span class="badge badge-success">{{$payment['status']}}</span>
                                        @else
                                            <span class="badge badge-danger">{{$payment['status']}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{__('messages.ip')}}: </strong>
                                        <span dir="ltr">{{$payment['ip']}}</span>
                                    </td>
                                    <td>
                                        <strong>{{__('messages.create_date')}}: </strong>
                                        <span
                                            dir="ltr">{{jdate("Y-m-d H:i:s",strtotime($payment['created_at']))}}</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        @endforeach

                        <hr>

                    </div>
                </div>
            </section>
        </div>
    </section>
@stop
