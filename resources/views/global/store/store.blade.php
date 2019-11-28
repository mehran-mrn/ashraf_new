@extends('layouts.global.global_layout')
@section('content')
    <!-- Start main-content -->
    <div class="main-content">

        <!-- Section: inner-header -->
        <section class="inner-header divider parallax "
                 data-bg-img="{{URL::asset('public/assets/global/images/bg/bg26.webp')}}">
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
                <div class="section-content">
                    <div class="row multi-row-clearfix">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="products">
                                @php
                                    $proIns=[];
                                @endphp
                                @if(sizeof($products)>=1)
                                    @foreach($products as $pro)
                                        @php
                                            array_push($proIns,$pro['product_id'])
                                        @endphp
                                        <div class="col-sm-6 col-md-4 col-lg-4 mb-30">
                                            <div class="product pb-0">
                                                <div class="product-thumb">
                                                    <img alt="" src="{{$pro->store_product['main_image']}}"
                                                         class="img-responsive img-fullwidth">
                                                    <div class="overlay">
                                                        <div class="btn-add-to-cart-wrapper">
                                                            <a class="btn btn-theme-colored btn-sm btn-flat pl-20 pr-20 btn-add-to-cart text-uppercase font-weight-700"
                                                               href="#">{{__('messages.add_to_cart')}}</a>
                                                        </div>
                                                        <div class="btn-product-view-details">
                                                            <a class="b{{route('store_detail',['pro_id'=>$pro['product_id']])}}tn btn-default btn-theme-colored btn-sm btn-flat pl-20 pr-20 btn-add-to-cart text-uppercase font-weight-700"
                                                               href="{{route('store_detail',['pro_id'=>$pro->store_product['slug']])}}">{{__('messages.view_detail')}}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-details text-center bg-lighter pt-15 pb-10">
                                                    <a href="{{route('store_detail',['pro_id'=>$pro['product_id']])}}">
                                                        <h5 class="product-title mt-0">{{$pro->store_product['title']}}
                                                            <small>{{__('messages.size')}} {{$pro['size']}}</small>
                                                        </h5>
                                                    </a>
                                                    {{--                                                    <div class="star-rating" title="Rated 3.50 out of 5"><span style="width: 60%;">3.50</span></div>--}}
                                                    <div class="price">

                                                        @if($pro['off']>=1)
                                                            <del>
                                                                <span class="amount">{{number_format($pro['price'])}}</span>
                                                            </del>
                                                            <ins>
                                                                <span class="amount">{{number_format($pro['price']-($pro['price']*$pro['off']/100))}}</span>
                                                                <small class="text-gray">{{__('messages.toman')}}</small>
                                                            </ins>
                                                        @else
                                                            <ins>
                                                                <span class="amount">{{number_format($pro['price'])}}</span>
                                                                <small class="text-gray">{{__('messages.toman')}}</small>
                                                            </ins>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                @if(sizeof($productsInv)>=1)
                                    @foreach($productsInv as $pro2)
                                        @if(!in_array($pro2['product_id'],$proIns))
                                            <div class="col-sm-6 col-md-4 col-lg-4 mb-30">
                                                <div class="product pb-0">
                                                    <div class="product-thumb">
                                                        <img alt="" src="{{$pro2->store_product['main_image']}}"
                                                             class="img-responsive img-fullwidth">
                                                        <div class="overlay">
                                                            <div class="btn-add-to-cart-wrapper">
                                                                <a class="btn btn-theme-colored btn-sm btn-flat pl-20 pr-20 btn-add-to-cart text-uppercase font-weight-700"
                                                                   href="#">{{__('messages.add_to_cart')}}</a>
                                                            </div>
                                                            <div class="btn-product-view-details">
                                                                <a class="btn btn-default btn-theme-colored btn-sm btn-flat pl-20 pr-20 btn-add-to-cart text-uppercase font-weight-700"
                                                                   href="{{route('store_detail',['pro_id'=>$pro2->store_product['slug']])}}">{{__('messages.view_detail')}}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product-details text-center bg-lighter pt-15 pb-10">
                                                        <a href="#">
                                                            <h5 class="product-title mt-0">{{$pro2->store_product['title']}}
                                                                <small>{{__('messages.size')}} {{$pro2['size']}}</small>
                                                            </h5>
                                                        </a>
                                                        {{--                                                    <div class="star-rating" title="Rated 3.50 out of 5"><span style="width: 60%;">3.50</span></div>--}}
                                                        <div class="price">
                                                            @if($pro2['off']>=1)
                                                                <del>
                                                                    <span class="amount">{{number_format($pro2['price'])}}</span>
                                                                </del>
                                                                <ins>
                                                                    <span class="amount">{{number_format($pro2['price']-($pro2['price']*$pro2['off']/100))}}</span>
                                                                    <small class="text-gray">{{__('messages.toman')}}</small>
                                                                </ins>
                                                            @else
                                                                <ins>
                                                                    <span class="amount">{{number_format($pro2['price'])}}</span>
                                                                    <small class="text-gray">{{__('messages.toman')}}</small>
                                                                </ins>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end main-content -->

@endsection
