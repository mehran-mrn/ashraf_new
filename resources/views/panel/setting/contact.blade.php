@extends('layouts.panel.panel_layout')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('js')
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/tables/datatables/extensions/responsive.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/demo_pages/datatables_responsive.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#tablePost').dataTable({
                "columnDefs": [
                    {
                        "orderable": false,
                        "targets": [2, 3, 4, 6]
                    }
                ],
                "autoWidth": false,
                "order": [[0, 'desc']],
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
                },
            });


        })
    </script>
@endsection
@section('css')
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
@endsection
@section('content')
    <?php
    $active_sidbare = ['setting', 'contact']
    ?>
    <section>
        <div class="content">
            <div class="container-fluid">
            </div>
            <section>
                <div class="card">
                    <div class="card-header">
                        <span class="card-title text-black">{{__("messages.contact_to_we")}}</span>
                        <hr>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive table-condensed table-striped hidden-xs " id="tablePost">
                            <thead>
                            <tr>
                                <th>{{__('messages.date')}}</th>
                                <th>{{__('messages.name')}}</th>
                                <th>{{__('messages.email')}}</th>
                                <th>{{__('messages.phone')}}</th>
                                <th>{{__('messages.subject')}}</th>
                                <th>{{__('messages.status')}}</th>
                                <th>{{__('messages.view')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contacts as $contact)
                                <tr>
                                    <td>
                                        <span dir="ltr">
                                        {{$contact['created_at']?jdate("Y-m-d H:i:s",strtotime($contact['created_at'])):''}}
                                        </span>
                                    </td>
                                    <td>{{$contact['name']}}</td>
                                    <td>{{$contact['email']}}</td>
                                    <td>{{$contact['phone']}}</td>
                                    <td>{{$contact['subject']}}</td>
                                    <td>
                                        @if($contact['status']=='new')
                                            <span class="badge badge-success">{{__('messages.'.$contact['status'])}}</span>
                                        @elseif($contact['status']=='read')
                                            <span class="badge badge-default">{{__('messages.'.$contact['status'])}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('contact.show',['id'=>$contact['id']])}}"
                                           class="btn btn-sm btn-outline-dark"><i class="icon-eye"></i></a>


                                        <button type="button"
                                                class="btn btn-outline-danger btn-sm legitRipple swal-alert"
                                                data-ajax-link="{{route('contact.destroy',['id'=>$contact['id']])}}"
                                                data-method="DELETE"
                                                data-csrf="{{csrf_token()}}"
                                                data-title="{{trans('messages.delete_item',['item'=>trans('messages.message')])}}"
                                                data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.message')])}}"
                                                data-type="warning"
                                                data-cancel="true"
                                                data-confirm-text="{{trans('messages.delete')}}"
                                                data-cancel-text="{{trans('messages.cancel')}}">
                                            <i class="icon-trash"></i>
                                        </button>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </section>

@endsection
