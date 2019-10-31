@extends('layouts.panel.panel_layout')
<?php
$active_sidbare = ['user_manager', 'users_list']
?>
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
                        targets: [6]
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
                // Basic datatable
                $('.datatable-basic').DataTable({
                    pagingType: "simple",
                    language: {
                        paginate: {
                            'next': $('html').attr('dir') == 'rtl' ? '{{__('messages.next')}} &larr;' : '{{__('messages.next')}} &rarr;',
                            'previous': $('html').attr('dir') == 'rtl' ? '&rarr; {{__('messages.prev')}}' : '&larr; {{__('messages.prev')}}'
                        }
                    },
                    stateSave: true,
                    autoWidth: true,
                });

                // Resize scrollable table when sidebar width changes
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
@section('content')
    <section>
        <div class="content">
            <div class="container-fluid">
                <section>
                    <button type="button" class="btn btn-outline-dark m-2 py-2 px-3 modal-ajax-load"
                            data-ajax-link="{{route('panel_register_form')}}" data-toggle="modal"
                            data-modal-title="{{trans('messages.add_new_user')}}" data-target="#general_modal">
                        <i class="icon-user-plus mr-2"></i> {{trans('messages.add_new_user')}}
                    </button>
                </section>
                <section>
                    <div class="card">
                        <div class="card-header bg-light">
                            <h4 class="card-title">{{__('messages.users_list')}}</h4>
                        </div>
                        <div class="card-body">
                            <table class="table  datatable-basic">
                                <thead>
                                <tr>
                                    <th>{{__('messages.id')}}</th>
                                    <th>{{__('messages.name')}}</th>
                                    <th>{{__('messages.email')}}</th>
                                    <th>{{__('messages.mobile')}}</th>
                                    <th>{{__('messages.register_date')}}</th>
                                    <th>{{__('messages.status')}}</th>
                                    <th class="text-center">{{__('messages.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i=1;
                                ?>
                                @foreach($users as $user)
                                    <tr>
                                        <td><b>{{$i}}</b></td>
                                        <td><b>{{$user['people']['name']}} {{$user['people']['family']}}</b></td>
                                        <td><b>{{$user['email']}}</b></td>
                                        <td><b>{{$user['phone']}}</b></td>
                                        <td>
                                            @if($user['created_at'])
                                                <span dir="ltr">{{jdate("Y-m-d H:i",strtotime($user['created_at']))}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($user['disabled']==1)
                                                <span class="badge badge-danger">{{__('messages.inactive')}}</span>
                                            @else
                                                <span class="badge badge-success">{{__('messages.active')}}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a class="btn btn-outline-dark btn-sm"
                                                   href="{{route('user_permission_assign_page',['user_id'=>$user->id])}}"
                                                   data-toggle="tooltip" data-placement="top" title="{{__('messages.permissions')}}"
                                                >
                                                    <i class="fa fa-key"></i></a>
                                                <a class="btn btn-outline-dark btn-sm"
                                                   href="{{route('users_list_info_edit',['user'=>$user->id])}}"
                                                   data-toggle="tooltip" data-placement="top" title="{{__('messages.edit')}}"
                                                >
                                                    <i class="fa fa-edit"></i></a>
                                                @if($user['disabled']==0)
                                                <button type="button"
                                                        class="btn btn-outline-danger btn-sm swal-alert"
                                                        data-ajax-link="{{route('users_list_delete',['id'=>$user->id])}}"
                                                        data-method="POST"
                                                        data-csrf="{{csrf_token()}}"
                                                        data-title="{{trans('messages.delete_item',['item'=>__('messages.user')])}}"
                                                        data-text="{{trans('messages.approve',['item'=>trans('messages.user')])}}"
                                                        data-type="warning"
                                                        data-cancel="true"
                                                        data-toggle="tooltip" data-placement="top" title="{{__('messages.inactivate')}}"
                                                        data-confirm-text="{{trans('messages.delete')}}"
                                                        data-cancel-text="{{trans('messages.cancel')}}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                    @else
                                                    <button type="button"
                                                            class="btn btn-outline-success btn-sm swal-alert"
                                                            data-ajax-link="{{route('users_list_delete',['id'=>$user->id])}}"
                                                            data-method="POST"
                                                            data-csrf="{{csrf_token()}}"
                                                            data-title="{{trans('messages.active',['item'=>__('messages.user')])}}"
                                                            data-text="{{trans('messages.approve',['item'=>trans('messages.user')])}}"
                                                            data-type="warning"
                                                            data-cancel="true"
                                                            data-toggle="tooltip" data-placement="top" title="{{__('messages.activate')}}"
                                                            data-confirm-text="{{trans('messages.active')}}"
                                                            data-cancel-text="{{trans('messages.cancel')}}">
                                                        <i class="fa fa-check"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                    ?>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection