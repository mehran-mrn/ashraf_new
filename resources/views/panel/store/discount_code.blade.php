@extends('layouts.panel.panel_layout')
@section('js')
    <script
        src="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/js/jquery_form.js') }}"></script>
@endsection
@section('css')
    <link
        href="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.style.css') }}"
        rel="stylesheet" type="text/css">
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
            <div class="card-header bg-light">
                <span class="card-title">{{__('messages.discount_code')}}</span>
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-light modal-ajax-load"
                        data-ajax-link="{{route('discount_add_form')}}" data-toggle="modal"
                        data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.discount_code')])}}"
                        data-target="#general_modal">
                    <i class="icon-pencil7"></i>
                    <span
                        class="d-none d-lg-inline-block ml-2">{{trans('messages.add_discount_code',['item'=>trans('messages.discount_code')])}}</span>
                </button>
                <hr>
                <div class="row">
                    @foreach($codes as $code)
                        @php
                            if(strtotime($code['expire_date']) > time()){
                              $color = 'success';
                              }else {
                            $color='danger';
                            };
                        @endphp
                        <div class="col-12 col-md-4">
                            <div class="card">
                                <div class="card-header bg-{{$color}}"><span
                                        class="card-title text-center">{{$code['code']}}</span>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <span>{{__('messages.expire_date')}}</span>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <span
                                                class="text-left">{{jdate("Y/m/d-H:i",strtotime($code['expire_date']))}}</span>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <span class="text-left">{{__('messages.discount_persent')}}</span>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <strong class="text-left">{{$code['discount_persent']}} %</strong>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <span class="text-left">{{__('messages.discount_maximum')}}</span>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <strong class="text-left">{{number_format($code['max_discount'])}}</strong>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <span class="text-left">{{__('messages.count')}}</span>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <strong class="text-left">{{number_format($code['count'])}}</strong>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <span class="text-left">{{__('messages.usage_count_per_user')}}</span>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <strong class="text-left">{{number_format($code['usage_count'])}}</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">

                                    <button type="button" class="egitRipple float-right btn alpha-primary border-primary-400 text-primary-800 btn-icon rounded-round ml-2 modal-ajax-load"
                                            data-ajax-link="{{route('discount_code_edit_form',['dis_id'=>$code['id']])}}" data-toggle="modal"
                                            data-modal-title="{{trans('messages.edit',['item'=>trans('messages.discount_code')])}}"
                                            data-target="#general_modal">
                                        <i class="icon-pencil7"></i>
                                    </button>

                                    <button
                                        class="legitRipple swal-alert float-right btn alpha-pink border-pink-400 text-pink-800 btn-icon rounded-round ml-2"
                                        data-ajax-link="{{route('discount_code_delete',['dis_id'=>$code['id']])}}"
                                        data-method="get"
                                        data-csrf="{{csrf_token()}}"
                                        data-title="{{trans('messages.delete_item',['item'=>trans('messages.discount_code')])}}"
                                        data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.discount_code')])}}"
                                        data-type="warning"
                                        data-cancel="true"
                                        data-confirm-text="{{trans('messages.delete')}}"
                                        data-cancel-text="{{trans('messages.cancel')}}">
                                        <i class="icon-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
