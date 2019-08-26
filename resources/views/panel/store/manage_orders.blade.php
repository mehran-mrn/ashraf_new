@extends('layouts.panel.panel_layout')
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

                        <div class="tab-pane fade" id="highlighted-justified-tab2">
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
