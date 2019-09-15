@extends('layouts.global.global_layout')
@section('js')
    <script>
        $(document).ready(function () {
            $(document).on("submit", '#frm_add_charity', function (e) {
                e.preventDefault();
                var submit = $(this).find("button[type=submit]");
                submit.attr('disabled', 'disabled');
                submit.html("لطفاً منتظر بمانید...");
                $.ajax({
                    url: "{{route('add_charity_transaction')}}",
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
                                window.location.replace("/payment?id=" + response.message.id+"&type=charity_donate");
                            }, 2000);

                        }else{
                            PNotify.success({
                                text: response.message.message,
                                delay: 3000,
                            });
                        }
                        submit.removeAttr("disabled");
                        submit.html("{{__('messages.pay')}}")
                    }, error: function () {
                    }
                });
            })
        })
    </script>
@stop
@section('content')
    <section>
        <div class="container">
            <div class="section-content">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-8">
                        <h3 class="mt-0 line-bottom">{{$patern['title']}}<span class="font-weight-300"></span></h3>
                        <form action="" method="post" id="frm_add_charity">
                            @csrf
                            <input type="hidden" name="charity_id" value="{{$patern['id']}}">
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label>{{__('messages.name')}}</label>
                                            <input type="text" class="form-control" name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label>{{__('messages.phone')}}</label>
                                            <input type="number" class="form-control" name="phone">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label>{{__('messages.email')}}</label>
                                            <input type="email" class="form-control" name="email">
                                        </div>
                                    </div>
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
                                            <label>{{__('messages.for')}}</label>
                                            <select name="title" class="form-control" id="title">
                                                @foreach($title as $titl)
                                                    <option value="{{$titl['id']}}">{{$titl['title']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label>{{__('messages.description')}}</label>
                                            <textarea name="description" class="form-control" id="description" cols="30"
                                                      rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xs-12">
                                        <label for="">{{__('messages.payment_gateway')}}</label>
                                        <select name="gateway" id="gateway" class="form-control">
                                            @foreach($gateways as $gateway)
                                                <option value="{{$gateway['id']}}">{{$gateway['bank']['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 col-xs-12">
                                        <div class="form-group pt-20">
                                            <button type="submit"
                                                    class="btn btn-success pull-left">{{__("messages.pay")}}</button>
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
