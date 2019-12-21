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
                    url: "",
                    type: "POST",
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
        <div class="main-content">
            {{@csrf_field()}}
            <section class="">
                <div class="container mt-30 mb-30 p-30">
                    <div class="row">
                        <div class="col-md-6  text-center step_two">
                            <h3 class="badge badge-danger">1</h3><br>
                            <i class="fa fa-truck fa-3x mb-10"></i>
                            <h5>{{__('messages.send_information')}}</h5>
                        </div>
                        <div class="col-md-6 bg-success text-center step_three">
                            <h3 class="badge badge-danger">2</h3><br>
                            <i class="fa fa-amazon fa-3x text-success mb-10"></i>
                            <h5>{{__('messages.payment_information')}}</h5>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="row pt-50 pb-50">
                        <?php
                        $total = 0;
                        $details = 0; ?>
                        <table id="cart" class="table table-bordered text-center table-condensed">
                            <thead class="">
                            <tr class="bg-light">
                                <th class="col-md-5 p-10 text-center">{{__('messages.product_title')}}</th>
                                <th class="col-md-1 p-10 text-center">{{__('messages.count')}}</th>
                                <th class="col-md-2 p-10 text-center">{{__('messages.fee')}}</th>
                                <th class="col-md-2 p-10 text-center">{{__('messages.off')}}</th>
                                <th class="col-md-2 p-10 text-center">{{__('messages.sub_price')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(session('cart')['order'] as $id => $details)
                                <?php
                                $off = (($details['price'] * $details['count']) * $details['off']) / 100;
                                $totalAfterOff = ($details['price'] * $details['count']) - $off;
                                $total += $totalAfterOff;
                                ?>
                                <tr>
                                    <td data-th="Product">
                                        <div class="row">
                                            <div class="col-sm-3 hidden-xs">
                                                <img src="{{ $details['photo'] }}" width="100" height="100"
                                                     class="img-responsive"/>
                                            </div>
                                            <div class="col-sm-9">
                                                <h5 class="m-30 font-weight-900">{{ $details['title'] }}</h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Quantity"><h5
                                                class="m-30 font-weight-900">{{ number_format($details['count']) }}</h5>
                                    </td>
                                    <td data-th="Price"><h5
                                                class="m-30 font-weight-900">{{ number_format($details['price'])." ".__('messages.toman') }}</h5>
                                    </td>
                                    <td data-th="Price"><h5
                                                class="m-30 font-weight-900">{{$off>0? number_format($off)." ".__('messages.toman'):0}}</h5>
                                    </td>
                                    <td data-th="Subtotal" class="text-center"><h5
                                                class="m-30 font-weight-900">{{ number_format($totalAfterOff)." ".__('messages.toman') }}</h5>
                                    </td>
                                </tr>
                            @endforeach
                            @if($trnasCost!="")
                                <tr>
                                    <td data-th="Product">
                                        <div class="row">
                                            <div class="col-sm-3 hidden-xs">
                                                <img src="{{ $details['photo'] }}" width="100" height="100"
                                                     class="img-responsive"/>
                                            </div>
                                            <div class="col-sm-9">
                                                <h5 class="m-30 font-weight-900">{{ $details['title'] }}</h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Quantity"><h5
                                                class="m-30 font-weight-900">{{ number_format($details['count']) }}</h5>
                                    </td>
                                    <td data-th="Price"><h5
                                                class="m-30 font-weight-900">{{ number_format($details['price'])." ".__('messages.toman') }}</h5>
                                    </td>
                                    <td data-th="Price"><h5
                                                class="m-30 font-weight-900">{{$off>0? number_format($off)." ".__('messages.toman'):0}}</h5>
                                    </td>
                                    <td data-th="Subtotal" class="text-center"><h5
                                                class="m-30 font-weight-900">{{ number_format($totalAfterOff)." ".__('messages.toman') }}</h5>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                            <tfoot class="border-0 no-border table-borderless">
                            <tr class="visible-xs">
                                <td class="text-center"><strong>Total {{ number_format($total) }}</strong></td>
                            </tr>
                            <tr class="border-0 no-border table-borderless">
                                <td colspan="2" class="hidden-xs text-left no-border"></td>
                                <td colspan="2" class="hidden-xs success text-left">
                                    <h6>{{__('messages.pay_amount')}}</h6>
                                </td>
                                <td colspan="2" class="hidden-xs success bold text-left pl-20"><h4
                                            class="text-success">{{ number_format($total)." ".__('messages.toman') }}</h4>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                        <div class="col-md-6 col-md-push-3">
                            <form action="" method="get" id="frm_payment">
                                @csrf
                                <input type="hidden" value="" name="id">
                                <input type="hidden" value="charity_period" name="type">
                                <div class="row">
                                    <div class="col-xs-12 col-md-7">
                                        <div class="row ">
                                            <div class="col-md-4 col-xs-12 pt-20">
                                                <strong>{{__('messages.description')}}</strong>
                                            </div>
                                            <div class="col-md-8 col-xs-12 pt-20 text-center">
                                                <h4></h4>
                                            </div>
                                            <div class="col-md-4 col-xs-12 pt-20">
                                                <strong>{{__('messages.price')}}:</strong>
                                            </div>
                                            <div class="col-md-8 col-xs-12 pt-20 text-center">
                                                <h4>
                                                    <small>{{__('messages.rial')}}</small>
                                                </h4>
                                            </div>
                                            <div class="col-md-4 col-xs-12 pt-20">
                                                <strong>{{__("messages.payment_date")}}:</strong>
                                            </div>
                                            <div class="col-md-8 col-xs-12 pt-20 text-center">
                                                <h4></h4>
                                            </div>
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
        </div>
    </section>
@stop
