@extends('layouts.global.global_layout')
@section('content')

    <section>
        <div class="content">
            <div class="row pt-50">
                <div class="col-md-6 col-md-push-3">
                    <h4 class="mt-0 pt-5"> {{$charityIn['period']['description']}} </h4>
                    <hr>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    <strong>{{__('messages.description')}}</strong>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <h5>{{$charityIn['description']}}</h5>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <strong>{{__('messages.price')}}:</strong>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <p> {{number_format($charityIn['price'])}}</p>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <strong>{{__("messages.payment_date")}}:</strong>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <h5>{{jdate("Y-m-d",strtotime($charityIn['payment_date']))}}</h5>
                                </div>
                            </div>

                        </div>
                        div.col-xs-12.col-md-6
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
