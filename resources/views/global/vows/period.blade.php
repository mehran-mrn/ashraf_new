@extends('layouts.global.global_layout')
@section('title',__('messages.periodic_payment'). " |")

@section('js')
    <script src="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.js') }}"></script>

    <script>

        $(document).ready(function () {
            $(document).on("change keyup", '.amount', function (event) {
                if (event.which >= 37 && event.which <= 40) return;
                $(this).val(function (index, value) {
                    return value
                        .replace(/\D/g, "")
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                        ;
                });
            });



            $(document).on("submit", '#frm_add_period', function (e) {
                e.preventDefault();
                var submit = $(this).find("button[type=submit]");
                submit.attr('disabled', 'disabled');
                submit.html("لطفاً منتظر بمانید...");
                $.ajax({
                    url: "{{route('add_charity_period')}}",
                    type: "post",
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                    },
                    success: function (response) {
                        if (response.message.code === 200) {
                            PNotify.success({
                                text: response.message.message,
                                delay: 3000,
                            });
                            setTimeout(function () {
                                window.location.replace("{{route('global_profile')}}");
                            }, 2000);

                        } else {
                            PNotify.success({
                                text: response.message.message,
                                delay: 3000,
                            });
                        }
                        submit.removeAttr("disabled");
                        submit.html("{{__('messages.pay')}}")
                    }, error: function (response) {
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
            $('#start_date').MdPersianDateTimePicker({
                targetTextSelector: '#start_date',
            });
        })
    </script>
@stop
@section('css')
    <link href="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.style.css') }}" rel="stylesheet" type="text/css">
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
@stop

@section('content')
    <section>
        <div class="container">
            <div class="section-content">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-8">
                        <h3 class="mt-0 line-bottom">{{$patern['title']}}<span class="font-weight-300"></span></h3>
                        <div class="alert alert-success" role="alert">
                            {!!__('long_msg.periodic_list_guide',['link'=>route('global_profile')])!!}
                        </div>
                        @if(! \Illuminate\Support\Facades\Auth::user()->phone_verified_at)
                            <div class="alert alert-danger" role="alert">
                                {{__('errors.periodic_phone_required')}}

                            </div>
                            @include('global.component.phone')
                        @endif

                        <form action="" method="post" id="frm_add_period">
                            @csrf
                            <input type="hidden" name="charity_id" value="{{$patern['id']}}">
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="amount">{{__('messages.amount')}} <small>({{__('messages.rial')}})</small></label>
                                            <input type="text" min="{{$patern['min']}}" max="{{$patern['max']}}"
                                                   class="form-control amount" name="amount" placeholder="{{__('messages.amount_rial')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="amount">{{__('messages.start_date')}}</label>
                                                <input id="start_date" type="text" class="form-control"
                                                       name="start_date" value="{{miladi_to_shamsi_date(date("Y-m-d"))}}" autocomplete="capacity" autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="period">{{__('messages.period')}}</label>
                                            <select name="period" id="period" class="form-control">
                                                <option value="">{{__('messages.please_select')}}</option>
                                                <option value="0">{{__('messages.daily')}}</option>
                                                <option value="1">{{__('messages.monthly')}}</option>
                                                <option value="3">{{__('messages.every_3_months')}}</option>
                                                <option value="6">{{__('messages.every_6_months')}}</option>
                                                <option value="12">{{__('messages.yearly')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label>{{__('messages.description')}}</label>
                                            <textarea name="description" class="form-control" id="description" cols="30"
                                                      rows="5"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group pt-20">
                                            <button type="submit"
                                                    class="btn btn-success pull-left">{{__("messages.submit")}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <h3 class="mt-0 line-bottom">{{__('messages.cooperation')}}</h3>

                        <div class="testimonial style1 ">
                            <div class="item">

                                <div class="icon-box iconbox-border iconbox-theme-colored p-10">
                                    <p>
                                    <div class="m-30 text-justify">{!! $patern['description']!!}</div>
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
