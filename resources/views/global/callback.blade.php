@extends('layouts.global.global_layout')
@section('content')

    <section>
        <div class="content">
            <div class="container-fluid">
                <div class="row pt-100 pb-100">
                    <div class="col-md-12 col-xs-12 text-center">
                        @if($messages['result']=="repeat" || $messages['result']=="fail")
                            <img src="{{asset(url('/public/assets/global/images/reject.png'))}}" width="200" alt="">
                        @elseif($messages['result']=="success")
                            <img src="{{asset(url('/public/assets/global/images/accept.png'))}}" width="200" alt="">
                        @endif
                        <h4>{{$messages['message']}}</h4>
                        @if($messages['result']=="success")
                            <h5>{{__('messages.tracking_code')}} <span
                                        class="text-success">{{$messages['trackingCode']}}</span></h5>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </section>
@stop
