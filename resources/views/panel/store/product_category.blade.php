@extends('layouts.panel.panel_layout')
@section('js')
    <script
        src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
@endsection
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
@endsection
@section('content')
    @php
        $active_sidbare = ['store', 'product_category']
    @endphp
    <div class="content">
        <div class="card">
            <div class="card-header bg-light">
                <span class="card-title">{{__('messages.product_category')}}</span>
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-light modal-ajax-load"
                        data-ajax-link="{{route('product_category_add_form')}}" data-toggle="modal"
                        data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.product_category')])}}"
                        data-target="#general_modal">
                    <i class="icon-pencil7"></i>
                    <span
                        class="d-none d-lg-inline-block ml-2">{{trans('messages.add_product_category',['item'=>trans('messages.product_category')])}}</span>
                </button>

                <div class="row pt-3">
                    @foreach($product_categories as $cat)
                        <div class="col-12 col-md-4">
                            <div class="card">
                                <div class="card-header text-center bg-light">
                                    <span class="card-title">{{$cat['title']}}</span>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-center">
                                        <div class="">
                                            <img src="{{$cat['icon']}}" width="100" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
