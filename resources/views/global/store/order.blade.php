@extends('layouts.global.global_layout')
@section('js')
    <script>
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

                <div class="_p_frame _m_registration_steps_container">
                    <div class="_m_registration_steps_line _p_flex_around">
                        <div class="_m_steps _m_step1 _m_active">
                            <section class="_m_border"></section>
                        </div>
                        <div class="_m_steps _m_step1 _m_active">
                            <a href="#">
                                <section class="_m_icon_step"><span class="fa fa-registered"></span></section>
                                <section class="_m_name_step">ورود / ثبت نام</section>
                            </a>
                        </div>
                        <div class="_m_steps _m_step2">
                            <section class="_m_border"></section>
                        </div>
                        <div class="_m_steps _m_step2">
                            <a href="#">
                                <section class="_m_icon_step"><span class="fa fa-truck"></span></section>
                                <section class="_m_name_step">اطلاعات ارسال</section>
                            </a>
                        </div>
                        <div class="_m_steps _m_step3">
                            <section class="_m_border"></section>
                        </div>
                        <div class="_m_steps _m_step3">
                            <a href="#">
                                <section class="_m_icon_step"><span class="fa fa-paypal"></span></section>
                                <section class="_m_name_step">اطلاعات پرداخت</section>
                            </a>
                        </div>
                        <div class="_m_steps _m_step4">
                            <section class="_m_border"></section>
                        </div>
                    </div>
                </div>
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
                                            <h5 class="m-30 font-weight-900">{{ $details['title'] }}</h5>
                                        </div>
                                    </div>
                                </td>
                                <td data-th="Quantity"><h5 class="m-30 font-weight-900">{{ number_format($details['count']) }}</h5></td>
                                <td data-th="Price"><h5 class="m-30 font-weight-900">{{ number_format($details['price'])." ".__('messages.toman') }}</h5></td>
                                <td data-th="Price"><h5 class="m-30 font-weight-900">{{ number_format($off)." ".__('messages.toman') }}</h5></td>
                                <td data-th="Subtotal" class="text-center"><h5 class="m-30 font-weight-900">{{ number_format($totalAfterOff)." ".__('messages.toman') }}</h5></td>
                                <td class="actions" data-th="">
                                    <button class="btn btn-default btn-sm remove-from-cart m-30"
                                            data-id="{{ $id }}"
                                            data-inventory="{{$details['inventory_id']}}"
                                            data-inventory-size="{{$details['inventory_size_id']}}"><i
                                                class="fa fa-remove"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @endif

                    </tbody>
                    <tfoot class="border-0 no-border table-borderless">
                    <tr class="visible-xs">
                        <td class="text-center"><strong>Total {{ number_format($total) }}</strong></td>
                    </tr>
                    <tr class="border-0 no-border table-borderless">
                        <td colspan="2" class="hidden-xs text-left no-border"></td>
                        <td colspan="2" class="hidden-xs success text-left"><h6>{{__('messages.pay_amount')}}</h6></td>
                        <td colspan="2" class="hidden-xs success bold text-left pl-20"><h4 class="text-success">{{ number_format($total)." ".__('messages.toman') }}</h4></td>
                    </tr>
                    </tfoot>
                </table>
                <a href="" class="btn btn-success pull-left p-10 pr-20 pl-20">{{__('messages.continue_shopping')}} <i class="fa fa-caret-left pr-10"></i></a>

            </div>
        </section>
        <!-- end main-content -->

@endsection
