@extends('layouts.panel.panel_layout')
@section('js')
@endsection
@section('css')
@endsection
@section('meta')
    @csrf
@endsection
@section('content')
    @php
        $active_sidbare = ['store', 'discount_code']
    @endphp
    <div class="content">
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-light modal-ajax-load"
                        data-ajax-link="{{route('discount_add_form')}}" data-toggle="modal"
                        data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.discount_code')])}}"
                        data-target="#general_modal">
                    <i class="icon-pencil7"></i>
                    <span
                        class="d-none d-lg-inline-block ml-2">{{trans('messages.add_discount_code',['item'=>trans('messages.discount_code')])}}</span>
                </button>
            </div>
        </div>
    </div>
@endsection
