@extends('layouts.global.global_layout')
@section('content')
    <div class="main-content">
        <section class="">
            <div class="container mt-30 mb-30 p-30">
                <div class="section-content">
                    <div class="row multi-row-clearfix">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="products">
                                @if(sizeof($products)>=1)
                                    @foreach($products as $pro)
                                        <div class="col-sm-6 col-md-4 col-lg-4 mb-30">
                                            <div class="product pb-0">
                                                <div class="product-thumb">
                                                    <img alt="" src="{{$pro['main_image']}}"
                                                         class="img-responsive img-fullwidth">
                                                    <div class="overlay">
                                                        <div class="btn-product-view-details">
                                                            <a class="b{{route('store_detail',['pro_id'=>$pro['id']])}}tn btn-default btn-theme-colored btn-sm btn-flat pl-20 pr-20 btn-add-to-cart text-uppercase font-weight-700"
                                                               href="{{route('store_detail',['pro_id'=>$pro['slug']])}}">{{__('messages.view_detail')}}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-details text-center bg-lighter pt-15 pb-10">
                                                    <a href="{{route('store_detail',['pro_id'=>$pro['slug']])}}">
                                                        <h5 class="product-title mt-0">{{$pro['title']}}</h5>
                                                        @if($pro['store_product_inventory']['count']<1)
                                                            <small class="text-danger">{{__('messages.unavailable')}}</small>
                                                        @endif
                                                    </a>
                                                    <div class="price">

                                                        @if($pro['store_product_inventory']['off']>=1)
                                                            <del>
                                                                <span class="amount">{{number_format($pro['store_product_inventory']['price'])}}</span>
                                                            </del>
                                                            <ins>
                                                                <span class="amount">{{number_format($pro['store_product_inventory']['price']-($pro['store_product_inventory']['price']*$pro['store_product_inventory']['off']/100))}}</span>
                                                                <small class="text-gray">{{__('messages.toman')}}</small>
                                                            </ins>
                                                        @else
                                                            <ins>
                                                                <span class="amount">{{number_format($pro['store_product_inventory']['price'])}}</span>
                                                                <small class="text-gray">{{__('messages.toman')}}</small>
                                                            </ins>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
