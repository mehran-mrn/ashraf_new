@extends('layouts.global.global_layout')
@section('js')
    <script>
        $(document).ready(function () {
            $(".quantity").keyup(function (e) {
                e.preventDefault();
                var ele = $(this);
                $.ajax({
                    url: '{{ route('cart_update') }}',
                    method: "patch",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.attr("data-id"),
                        count: ele.val(),
                    },
                    success: function (response) {
                        window.location.reload();
                    }
                });
            });
            $(".remove-from-cart").click(function (e) {
                e.preventDefault();

                var ele = $(this);

                $.ajax({
                    url: '{{ route('cart_remove') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.attr("data-id"),
                        quantity: ele.parents("tr").find(".quantity").val(),
                    },
                    success: function (response) {
                        window.location.reload();
                    }
                });
            });
        })
    </script>
@endsection
@section('content')
    <div class="main-content">
        <section class="">
            <div class="container mt-30 mb-30 p-30">
                <?php
                $total = 0;
                $details = 0; ?>
                @if(session('cart'))
                    <table id="cart" class="table table-bordered text-center table-condensed">
                        <thead class="">
                        <tr class="bg-light">
                            <th class="col-md-5 p-10 text-center">{{__('messages.product_title')}}</th>
                            <th class="col-md-1 p-10 text-center">{{__('messages.count')}}</th>
                            <th class="col-md-2 p-10 text-center">{{__('messages.fee')}}</th>
                            <th class="col-md-2 p-10 text-center">{{__('messages.off')}}</th>
                            <th class="col-md-2 p-10 text-center">{{__('messages.sub_price')}}</th>
                            <th class="p-10 text-center"></th>
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
                                <td class="actions" data-th="">
                                    <button class="btn btn-default btn-sm remove-from-cart m-30" data-id="{{ $id }}">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot class="border-0 no-border table-borderless">
                        <tr class="visible-xs">
                            <td class="text-center"><strong>Total {{ number_format($total) }}</strong></td>
                        </tr>
                        <tr class="border-0 no-border table-borderless">
                            <td colspan="2" class="hidden-xs text-left no-border"></td>
                            <td colspan="2" class="hidden-xs success text-left"><h6>{{__('messages.pay_amount')}}</h6>
                            </td>
                            <td colspan="2" class="hidden-xs success bold text-left pl-20"><h4
                                        class="text-success">{{ number_format($total)." ".__('messages.toman') }}</h4>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                    <a href="{{route('store_order')}}"
                       class="btn btn-success pull-left p-10 pr-20 pl-20">{{__('messages.continue_shopping')}} <i
                                class="fa fa-caret-left pr-10"></i></a>
                @else
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="text-center">سبد خرید شما خالی می باشد.</h3>
                        </div>
                        <div class="col-md-12 text-center">
                            <a href="{{route('global_shop')}}"
                               class="btn btn-default text-center">{{__('messages.store')}}</a>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection
