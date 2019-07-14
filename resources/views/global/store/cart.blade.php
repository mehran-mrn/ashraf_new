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
    <!-- Start main-content -->
    <div class="main-content">

        <!-- Section: inner-header -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-5"
                 data-bg-img="{{URL::asset('public/assets/global/images/bg/bg1.jpg')}}">
            <div class="container pt-90 pb-50">
                <!-- Section Content -->
                <div class="section-content pt-100">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="title text-white">{{__("messages.tableau_and_wreath")}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="">
            <div class="container mt-30 mb-30 p-30">
                <table id="cart" class="table table-hover table-condensed">
                    <thead>
                    <tr>
                        <th class="col-md-5">{{__('messages.product_title')}}</th>
                        <th class="col-md-1">{{__('messages.off')}}</th>
                        <th class="col-md-2 text-center">{{__('messages.price')}}</th>
                        <th class="col-md-1">{{__('messages.count')}}</th>
                        <th class="col-md-2 text-center">{{__('messages.sub_price')}}</th>
                        <th class="col-md-1"></th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $total = 0;
                    $details = 0; ?>

                    @if(session('cart'))
                        @foreach(session('cart') as $id => $details)

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
                                            <h4 class="nomargin">{{ $details['title'] }}</h4>
                                        </div>
                                    </div>
                                </td>
                                <td data-th="Price">{{ number_format($off) }}</td>
                                <td data-th="Price">{{ number_format($details['price']) }}</td>
                                <td data-th="Quantity">
                                    <input type="number" data-id="{{ $id }}"
                                           value="{{ number_format($details['count']) }}"
                                           class="form-control quantity"/>
                                </td>
                                <td data-th="Subtotal"
                                    class="text-center">{{ number_format($totalAfterOff) }}</td>
                                <td class="actions" data-th="">

                                    <button class="btn btn-danger btn-sm remove-from-cart"
                                            data-id="{{ $id }}"
                                            data-inventory="{{$details['inventory_id']}}"
                                            data-inventory-size="{{$details['inventory_size_id']}}"><i
                                                class="fa fa-trash-o"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @endif

                    </tbody>
                    <tfoot>
                    <tr class="visible-xs">
                        <td class="text-center"><strong>Total {{ number_format($total) }}</strong></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="hidden-xs"></td>
                        <td class="hidden-xs text-center"><strong>{{ number_format($total) }}</strong></td>
                    </tr>
                    </tfoot>
                </table>
                <a href="" class="btn btn-primary pull-left">{{__('messages.continue_shopping')}}</a>

            </div>
        </section>
        <!-- end main-content -->

@endsection
