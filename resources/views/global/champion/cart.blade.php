@extends('layouts.global.global_layout')
@section('css')
    <link rel="stylesheet" href="{{URL::asset('/public/assets/panel/css/iranBanks/ibl.css')}}">
@stop

@section('js')
    <script>
        $(document).ready(function () {
            $(document).on("submit", '#frm_payment', function (e) {
                e.preventDefault();
                var submit = $(this).find("button[type=submit]");
                submit.attr('disabled', 'disabled');
                submit.html("{{__('messages.please_waite')}}");
                $.ajax({
                    url: "{{route('payment')}}",
                    type: "GET",
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                    },
                    success: function (response) {
                        PNotify.success({
                            text: "{{__('messages.is_going_connect_to_gateway')}}",
                            delay: 3000,
                        });

                        setTimeout(function () {
                            $("#res").html(response);
                            submit.removeAttr("disabled");
                            submit.html("{{__('messages.pay')}}")
                        }, 2000);

                    }, error: function (response) {
                        console.log(response)
                        var errors = response.responseJSON.errors;
                        $.each(errors, function (index, value) {
                            PNotify.error({
                                delay: 3000,
                                title: '',
                                text: value,
                            });
                        });
                        submit.removeAttr("disabled");
                        submit.html("{{__('messages.pay')}}")
                    }
                });
            })
        })
    </script>
@stop
@section('content')
    <section>
        <div class="content">
            <div class="row pt-50 pb-50">
                <div class="col-md-6 col-md-push-3">
                    <h4 class="mt-0 pt-5"> {{$champion['champion']['title']}} </h4>
                    <hr>
                    <form action="" method="get" id="frm_payment">
                        @csrf
                        <input type="hidden" value="{{$champion['id']}}" name="id">
                        <input type="hidden" value="charity_champion" name="type">
                        <div class="row">
                            <div class="col-xs-12 col-md-7">
                                <div class="row ">
                                    <div class="col-md-4 col-xs-12 pt-20">
                                        <strong>{{__('messages.description')}}</strong>
                                    </div>
                                    <div class="col-md-8 col-xs-12 pt-20 text-center">
                                        <h4>{{$champion['champion']['description_small']}}</h4>
                                    </div>
                                    <div class="col-md-4 col-xs-12 pt-20">
                                        <strong>{{__('messages.price')}}:</strong>
                                    </div>
                                    <div class="col-md-8 col-xs-12 pt-20 text-center">
                                        <h4> {{number_format($champion['amount'])}}
                                            <small>{{__('messages.rial')}}</small>
                                        </h4>
                                    </div>
                                    @if($champion['user_id']==0)
                                        @if($champion['name']!="")
                                            <div class="col-md-4 col-xs-12 pt-20">
                                                <strong>{{__("messages.name")}}:</strong>
                                            </div>
                                            <div class="col-md-8 col-xs-12 pt-20 text-center">
                                                <h4>{{$champion['name']}}</h4>
                                            </div>
                                        @endif
                                        @if($champion['last_name']!="")
                                            <div class="col-md-4 col-xs-12 pt-20">
                                                <strong>{{__("messages.family")}}:</strong>
                                            </div>
                                            <div class="col-md-8 col-xs-12 pt-20 text-center">
                                                <h4>{{$champion['last_name']}}</h4>
                                            </div>
                                        @endif
                                        @if($champion['phone']!="")
                                            <div class="col-md-4 col-xs-12 pt-20">
                                                <strong>{{__("messages.phone")}}:</strong>
                                            </div>
                                            <div class="col-md-8 col-xs-12 pt-20 text-center">
                                                <h4>{{$champion['phone']}}</h4>
                                            </div>
                                        @endif
                                        @if($champion['email']!="")
                                            <div class="col-md-4 col-xs-12 pt-20">
                                                <strong>{{__("messages.email")}}:</strong>
                                            </div>
                                            <div class="col-md-8 col-xs-12 pt-20 text-center">
                                                <h4>{{$champion['email']}}</h4>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-5">
                                <div class="row">
                                    <div class="col-md-12 col-xs-12 pt-20 text-center">
                                        <strong>{{__('messages.payment_gateway')}}</strong>
                                    </div>
                                    <div class="col-md-12 pt-10">
                                        @foreach($gateways as $gateway)
                                            <div class="col-md-6 col-xs-6 border-1px border-success">
                                                <div class="text-center">
                                                    {!! $gateway['logo'] !!}
                                                </div>
                                                <div class="radio text-center">
                                                    <label>
                                                        <input type="radio" name="gateway_id"
                                                               id="gateway_{{$gateway['id']}}"
                                                               value="{{$gateway['id']}}"
                                                               checked="checked">
                                                        <strong>{{$gateway['bank']['name']}}</strong>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-md-12 pt-10 text-center">
                                        <button class="btn btn-block btn-theme-colored"
                                                type="submit">{{__("messages.pay")}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="res"></div>
            </div>
        </div>
    </section>
@stop
