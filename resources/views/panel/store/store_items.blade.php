@extends('layouts.panel.panel_layout')
@section('js')
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
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
                <span class="card-title">{{__('messages.store_items')}}</span>
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-light modal-ajax-load"
                        data-ajax-link="{{route('store_items_add_form')}}" data-toggle="modal"
                        data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.store_items')])}}"
                        data-target="#general_modal">
                    <i class="icon-pencil7"></i>
                    <span
                        class="d-none d-lg-inline-block ml-2">{{trans('messages.add_items',['item'=>trans('messages.items')])}}</span>
                </button>
                <button type="button" class="btn btn-light modal-ajax-load"
                        data-ajax-link="{{route('store_items_category_add_form')}}" data-toggle="modal"
                        data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.store_items_category')])}}"
                        data-target="#general_modal">
                    <i class="icon-pencil7"></i>
                    <span
                        class="d-none d-lg-inline-block ml-2">{{trans('messages.add',['item'=>trans('messages.category')])}}</span>
                </button>


                <hr>

            </div>
        </div>
    </div>
@endsection
