@extends('layouts.panel.panel_layout')
@section('js')
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/js/jquery_form.js') }}"></script>

    <script>

    </script>
@endsection
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
@endsection
@section('content')
    @php
        $active_sidbare = ['store', 'store_items']
    @endphp
    <div class="content">
        <div class="card">
            <div class="card-header bg-light">
                <span class="card-title">{{__('messages.items')}}</span>
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-light modal-ajax-load"
                        data-ajax-link="{{route('store_items_add_form')}}" data-toggle="modal"
                        data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.item')])}}"
                        data-target="#general_modal">
                    <i class="icon-pencil7"></i>
                    <span
                            class="d-none d-lg-inline-block ml-2">{{trans('messages.add_new',['item'=>trans('messages.item')])}}</span>
                </button>
                <button type="button" class="btn btn-light modal-ajax-load"
                        data-ajax-link="{{route('store_items_category_add_form')}}" data-toggle="modal"
                        data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.category')])}}"
                        data-target="#general_modal">
                    <i class="icon-pencil7"></i>
                    <span
                            class="d-none d-lg-inline-block ml-2">{{trans('messages.add_new',['item'=>trans('messages.category')])}}</span>
                </button>
                <hr>

                <div class="row">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-header bg-light"><span class="card-title">{{__('messages.items')}}</span>
                            </div>
                            <div class="card-body">
                                <table class="table table-active table-hover">
                                    <thead>
                                    <tr>
                                        <th>{{__('messages.title')}}</th>
                                        <th>{{__('messages.prefix')}}</th>
                                        <th>{{__('messages.suffix')}}</th>
                                        <th>{{__('messages.category')}}</th>
                                        <th>{{__('messages.description')}}</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($items as $item)
                                        <tr>
                                            <td>{{$item['title']}}</td>
                                            <td>{{$item['prefix']}}</td>
                                            <td>{{$item['suffix']}}</td>
                                            <td>{{$item->store_item_category->title}}</td>
                                            <td>{{$item['description']}}</td>
                                            <td>
                                                <button type="button" class="legitRipple float-right btn alpha-primary border-primary-400 text-primary-800 btn-icon rounded-round ml-2 modal-ajax-load"
                                                        data-ajax-link="{{route('store_items_edit_form',['item_id'=>$item['id']])}}" data-toggle="modal"
                                                        data-modal-title="{{trans('messages.edit',['item'=>trans('messages.item')])}}"
                                                        data-target="#general_modal">
                                                    <i class="icon-pencil7"></i>
                                                </button>

                                                <button
                                                        class="legitRipple swal-alert float-right btn alpha-pink border-pink-400 text-pink-800 btn-icon rounded-round ml-2"
                                                        data-ajax-link="{{route('store_items_delete',['item_id'=>$item['id']])}}"
                                                        data-method="get"
                                                        data-csrf="{{csrf_token()}}"
                                                        data-title="{{trans('messages.delete_item',['item'=>trans('messages.item')])}}"
                                                        data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.item')])}}"
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
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="card">
                            <div class="card-header bg-light"><span
                                        class="card-title">{{__('messages.category')}}</span></div>
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    @foreach($items_category as $item)
                                        <li class="p-3">
                                            <strong>{{$item['title']}}</strong>
                                            <button type="button" class="legitRipple float-right btn alpha-primary border-primary-400 text-primary-800 btn-icon rounded-round ml-2 modal-ajax-load"
                                                    data-ajax-link="{{route('store_items_category_edit_form',['cat_id'=>$item['id']])}}" data-toggle="modal"
                                                    data-modal-title="{{trans('messages.edit',['item'=>trans('messages.item')])}}"
                                                    data-target="#general_modal">
                                                <i class="icon-pencil7"></i>
                                            </button>

                                            <button
                                                    class="legitRipple swal-alert float-right btn alpha-pink border-pink-400 text-pink-800 btn-icon rounded-round ml-2"
                                                    data-ajax-link="{{route('store_items_category_delete',['cat_id'=>$item['id']])}}"
                                                    data-method="get"
                                                    data-csrf="{{csrf_token()}}"
                                                    data-title="{{trans('messages.delete_item',['item'=>trans('messages.category')])}}"
                                                    data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.category')])}}"
                                                    data-type="warning"
                                                    data-cancel="true"
                                                    data-confirm-text="{{trans('messages.delete')}}"
                                                    data-cancel-text="{{trans('messages.cancel')}}">
                                                <i class="icon-trash"></i>
                                            </button></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
