@extends('layouts.panel.panel_layout')
@section('js')
@endsection
@section('css')
@endsection
@section('content')
    @php
        $active_sidbare = ['store', 'store_setting']
    @endphp
    <div class="content">
        <div class="card">
            <div class="card-header bg-light"><span class="card-title">{{__('messages.how_to_send')}}</span></div>
            <div class="card-body">

                <button class="btn bg-success btn-float modal-ajax-load"
                        data-ajax-link="{{route('setting_how_to_send_add')}}"
                        data-toggle="modal"
                        data-modal-title="{{trans('messages.add_transport')}}"
                        data-target="#general_modal"
                        data-popup="tooltip"
                        data-placement="bottom"
                        data-container="body"
                        data-original-title="{{trans('messages.add_transport')}}">
                    <i class="icon-plus2 icon-2x"></i>
                    <span>{{trans('messages.add_transport')}}</span>
                </button>
            </div>
        </div>
    </div>
@endsection
