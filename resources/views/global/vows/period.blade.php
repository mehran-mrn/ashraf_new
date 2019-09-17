@extends('layouts.global.global_layout')
@section('js')
    <script src="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.js') }}"></script>

    <script>
        $(document).ready(function () {
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
                        console.log(response)
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
                    }, error: function () {
                        console.log(response)

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
@stop
@section('css')
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
                        <form action="" method="post" id="frm_add_period">
                            @csrf
                            <input type="hidden" name="charity_id" value="{{$patern['id']}}">
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="amount">{{__('messages.amount')}}</label>
                                            <input type="number" min="{{$patern['min']}}" max="{{$patern['max']}}"
                                                   class="form-control" name="amount">
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
                        <div class="m-30 text-justify">{!! $patern['description']!!}</div>
                        <div class="testimonial style1 owl-carousel-1col owl-nav-top">
                            <div class="item">
                                <div class="comment bg-theme-colored">
                                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                        گرافیک است.</p>
                                </div>
                                <div class="content mt-20">
                                </div>
                            </div>
                            <div class="item">
                                <div class="comment bg-theme-colored">
                                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                        گرافیک است.</p>
                                </div>
                                <div class="content mt-20">
                                </div>
                            </div>
                            <div class="item">
                                <div class="comment bg-theme-colored">
                                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                        گرافیک است.</p>
                                </div>
                                <div class="content mt-20">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
