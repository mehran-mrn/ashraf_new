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
                    url: "{{route('payment2',['type2'=>"shop",'id2'=>$order_info['id']])}}",
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
                        <div class="col-md-4 text-center step_one">
                            <h3 class="badge badge-danger">1</h3><br>
                            <i class="fa fa-user fa-3x mb-10"></i>
                            <h5>{{__('messages.user_information')}}</h5>
                        </div>
                        <div class="col-md-4 text-center step_two">
                            <h3 class="badge badge-danger">2</h3><br>
                            <i class="fa fa-truck fa-3x mb-10"></i>
                            <h5>{{__('messages.send_information')}}</h5>
                        </div>
                        <div class="col-md-4 bg-success text-center step_three">
                            <h3 class="badge badge-danger">3</h3><br>
                            <i class="fa fa-amazon fa-3x text-success  mb-10"></i>
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
                            <tr>
                                <td data-th="Product">
                                    <div class="row">
                                        <div class="col-sm-6 hidden-xs">
                                            <h5 class="m-30 font-weight-900">{{ __('messages.transportation') }}</h5>

                                        </div>
                                        <div class="col-sm-6">
                                            <h5 class="m-30 font-weight-900">{{ $transport['title'] }}</h5>
                                        </div>
                                    </div>
                                </td>
                                <td colspan="3"></td>

                                <td data-th="Subtotal" class="text-center">
                                    <h5 class="m-30 font-weight-900">
                                        {{$trnasCost==0?__('messages.free'): number_format($trnasCost)." ".__('messages.toman') }}</h5>
                                </td>
                            </tr>
                            @php
                                $total += $trnasCost['cost'];
                            @endphp
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <span>{{__('messages.province')}}: </span>
                                        <strong>{{$address['province']['name']}}</strong>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <span>{{__('messages.city')}}: </span>
                                        <strong>{{$address['city']['name']}}</strong>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <span>{{__('messages.receiver_name')}}: </span>
                                        <strong>{{$address['receiver']}}</strong>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <span>{{__('messages.phone')}}: </span>
                                        <strong>{{$address['phone']}}</strong>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <span>{{__('messages.mobile')}}: </span>
                                        <strong>{{$address['mobile']}}</strong>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <span>{{__('messages.condolences_to')}}: </span>
                                        <strong>{{$address['extraInfo']['condolences']}}</strong>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <span>{{__('messages.on_behalf_of')}}: </span>
                                        <strong>{{$address['extraInfo']['on_behalf_of']}}</strong>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <span>{{__('messages.late_name')}}: </span>
                                        <strong>{{$address['extraInfo']['late_name']}}</strong>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <span>{{__('messages.meeting_date')}}: </span>
                                        <strong dir="ltr">{{$address['extraInfo']['meeting_date']}}</strong>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <span>{{__('messages.meeting_time')}}: </span>
                                        <strong>{{$address['extraInfo']['meeting_time']}}</strong>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span>{{__('messages.descriptions')}}: </span>
                                        <strong>{{$address['extraInfo']['descriptions']}}</strong>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span>{{__('messages.address')}}: </span>
                                        <strong>{{$address['address']}}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-md-push-3">
                            @if($order_info['payment']=="online")
                                <form action="" method="get" id="frm_payment">
                                    @csrf
                                    <input type="hidden" value="{{$order_info['id']}}" name="id">
                                    <input type="hidden" value="shop" name="type">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-12">
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
                            @elseif($order_info['payment']=="place")
                                <hr>
                                <h4 class="alert alert-success">سفارش شما با موفقیت ثبت گردید. منتظر تماس از موسسه باشید.</h4>
                            @endif
                        </div>
                        <div id="res"></div>
                    </div>
                </div>
            </section>
        </div>
    </section>
@stop
