@extends('layouts.panel.panel_layout')
@section('js')
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/extensions/jquery_ui/widgets.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/tables/datatables/extensions/natural_sort.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
@stop
@section('content')
    <?php
    $active_sidbare = ['blog', 'blog_Specific_page', 'pages']

    ?>


    <!-- Content area -->
    <div class="content">

        <!-- Task manager table -->
        <div class="card">
            <div class="card-header bg-transparent header-elements-inline">
                <h6 class="card-title">{{trans('words.pages')}}
                </h6>
                <a class="float-left btn border-info-400 text-info-800 btn-icon btn alpha-info" href="{{route('pages.create')}}">
                    <i class="icon-plus-circle2"></i>
                    {{trans('messages.add_new',['item'=>trans('words.page')])}}</a>

            </div>

            <table class="table tasks-list table-lg">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{trans('messages.language')}}</th>
                    <th>{{trans('messages.name')}}</th>
                    <th>{{trans('messages.url')}}</th>
                    <th>{{trans('messages.type')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pages as $page)
                    <tr>
                        <td>#{{$page['id']}}</td>
                        <td>{{$page['local']}}</td>
                        <td>
                            <div class="font-weight-semibold"><a href="{{route('pages.edit',['page'=>$page['id']])}}">{{$page['name']}}</a></div>
                        </td>
                        <td>
                            <div class="input-group">
											<span class="input-group-prepend">
												<button class="btn btn-light" type="button"><i class="icon-copy4"></i> </button>
											</span>
                                <input type="text" class="form-control" value="{{url("p/".$page['slug'])}}" readonly="">
                            </div>
                        </td>
                        <td>
                            <div class="d-inline-flex align-items-center">
                                @switch($page['index'])
                                    @case('1')
                                        <div class="badge badge-danger">Index</div>
                                    @break
                                @endswitch
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
@section('footer_js')
<script>
    var TaskManagerList = function () {


        //
        // Setup components
        //

        // Datatable
        var _componentDatatable = function() {
            if (!$().DataTable) {
                console.warn('Warning - datatables.min.js is not loaded.');
                return;
            }

            // Create an array with the values of all the input boxes in a column
            $.fn.dataTable.ext.order['dom-text'] = function (settings, col) {
                return this.api().column(col, {order:'index'}).nodes().map( function (td, i) {
                    return $('input', td).val();
                });
            };

            // Create an array with the values of all the select options in a column
            $.fn.dataTable.ext.order['dom-select'] = function (settings, col) {
                return this.api().column(col, {order:'index'}).nodes().map( function (td, i) {
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
                        targets: 2
                    },
                    {
                        targets: 3
                    },
                    {
                        orderDataType: 'dom-text',
                        type: 'string',
                        targets: 4
                    },

                ],
                order: [[ 0, 'desc' ]],
                dom: '<"datatable-header"fl><"datatable-scroll-lg"t><"datatable-footer"ip>',
                language: {
                    search: '<span>Filter:</span> _INPUT_',
                    searchPlaceholder: 'Type to filter...',
                    lengthMenu: '<span>Show:</span> _MENU_',
                    paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
                },
                lengthMenu: [ 15, 25, 50, 75, 100 ],
                displayLength: 25,
                drawCallback: function (settings) {
                    var api = this.api();
                    var rows = api.rows({page:'current'}).nodes();
                    var last=null;

                    // Grouod rows
                    api.column(1, {page:'current'}).data().each(function (group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                                '<tr class="table-active table-border-double"><td colspan="4" class="font-weight-semibold">'+group+'</td></tr>'
                            );

                            last = group;
                        }
                    });

                    // Initialize components
                    _componentUiDatepicker();
                    _componentSelect2();
                }
            });
        };

        // Datepicker
        var _componentUiDatepicker = function() {
            if (!$().datepicker) {
                console.warn('Warning - jQuery UI components are not loaded.');
                return;
            }

            // Initialize
            $('.datepicker').datepicker({
                showOtherMonths: true,
                dateFormat: 'd MM, y'
            });
        };

        // Select2
        var _componentSelect2 = function() {
            if (!$().select2) {
                console.warn('Warning - select2.min.js is not loaded.');
                return;
            }

            // Initialize
            $('.form-control-select2').select2({
                minimumResultsForSearch: Infinity
            });

            // Length menu styling
            $('.dataTables_length select').select2({
                minimumResultsForSearch: Infinity,
                dropdownAutoWidth: true,
                width: 'auto'
            });
        };


        //
        // Return objects assigned to module
        //

        return {
            init: function() {
                _componentDatatable();
                _componentSelect2();
            }
        }
    }();


    // Initialize module
    // ------------------------------

    document.addEventListener('DOMContentLoaded', function() {
        TaskManagerList.init();
    });
</script>
@stop