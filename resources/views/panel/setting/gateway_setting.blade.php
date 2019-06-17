@extends('layouts.panel.panel_layout')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('js')
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
@endsection
@section('css')
@endsection
@section('content')
    <?php
    $active_sidbare = ['setting', 'cities_list']
    ?>
    <div class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <button type="button" class="btn btn-outline-info btn-lg modal-ajax-load"
                                data-ajax-link="{{route('gateway_add')}}" data-toggle="modal"
                                data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.gateway_pay')])}}"
                                data-target="#general_modal"><i
                                    class="icon-user-plus mr-2"></i> {{trans('messages.add_new',['item'=>trans('messages.gateway_pay')])}}
                        </button>
                    </div>
                    <div class="card-body">
                        <a href="" class="popup_selector" data-inputid="feature_image">Select Image</a>

                        <label for="feature_image">Feature Image</label>
                        <input type="text" id="feature_image" name="feature_image" value="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
