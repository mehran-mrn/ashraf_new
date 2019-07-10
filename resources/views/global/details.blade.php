@extends('layouts.global.global_layout')
@section('content')
    <div class="main-content">

        <!-- Section: inner-header -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-5"
                 data-bg-img="{{URL::asset('public/assets/global/images/bg/bg1.jpg')}}">
            <div class="container pt-90 pb-50">
                <!-- Section Content -->
                <div class="section-content pt-100">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="title text-white">{{$proInfo['title']}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="section-content">
                    <div class="row">
                        <div class="product">
                            <div class="col-md-5">
                                <div class="product-image">
                                    <div class="zoom-gallery">
                                        <a href="{{$proInfo['main_image']}}" title="{{$proInfo['title']}}"><img
                                                    src="{{$proInfo['main_image']}}" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="product-summary">
                                    <h2 class="product-title">{{$proInfo['title']}}</h2>
                                    {{--                                    <div class="product_review">--}}
                                    {{--                                        <ul class="review_text list-inline">--}}
                                    {{--                                            <li>--}}
                                    {{--                                                <div title="Rated 4.50 out of 5" class="star-rating"><span--}}
                                    {{--                                                            style="width: 90%;">4.50</span></div>--}}
                                    {{--                                            </li>--}}
                                    {{--                                            <li><a href="#"><span>2</span>Reviews</a></li>--}}
                                    {{--                                            <li><a href="#">Add reviews</a></li>--}}
                                    {{--                                        </ul>--}}
                                    {{--                                    </div>--}}
                                    <div class="price">
                                        @if($proInfo['off']>=1)
                                            <del><span class="amount">{{number_format($proInfo['price'])}}</span></del>
                                            <ins>
                                                <span class="amount">{{number_format($proInfo['price']-($proInfo['price']*$proInfo['off']/100))}}</span>
                                                <small class="text-gray">{{__('messages.toman')}}</small>
                                            </ins>
                                        @else
                                            <ins><span class="amount">{{number_format($proInfo['price'])}}</span></ins>
                                            <small class="text-gray">{{__('messages.toman')}}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="short-description pt-20">
                                    {{ $proInfo['properties'] }}
                                </div>
                                <hr>
                                @php
                                    $cats = $proInfo->store_category;
                                @endphp
                                @if(sizeof($cats)>=1)
                                    <div class="category"><strong>{{__("messages.category")}}:</strong>
                                        @foreach($cats as $cat)
                                            <a href="#">{{$cat->title}}</a>,
                                        @endforeach
                                    </div>
                                @endif
                                @if(sizeof($proInfo->store_product_tag)>=1)
                                    <div class="tags">
                                        <strong>{{__('messages.tags')}}: </strong>
                                        @foreach($proInfo->store_product_tag as $tag)
                                            <a href="#">{{$tag['tag']}}</a>,
                                        @endforeach
                                    </div>
                                @endif
                                <div class="cart-form-wrapper mt-30">
                                    <form enctype="multipart/form-data" method="post" class="cart">
                                        <input type="hidden" value="productID" name="add-to-cart">
                                        <table class="table variations no-border">
                                            <tbody>
                                            <tr>
                                                <td class="name">Size</td>
                                                <td class="value">
                                                    <select class="form-control">
                                                        <option value="">Choose an option...</option>
                                                        <option value="large">Large</option>
                                                        <option selected="selected" value="medium">Medium</option>
                                                        <option value="small">Small</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="name">Amount</td>
                                                <td class="value">
                                                    <div class="quantity buttons_added">
                                                        <input type="button" class="minus" value="-">
                                                        <input type="number" size="4" class="input-text qty text"
                                                               title="Qty" value="1" name="quantity" min="1" step="1">
                                                        <input type="button" class="plus" value="+">
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <button class="single_add_to_cart_button btn btn-theme-colored" type="submit">
                                            Add to cart
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="horizontal-tab product-tab">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab1"
                                                          data-toggle="tab">{{__('messages.description')}}</a></li>
                                    <li><a href="#tab2" data-toggle="tab">{{{__('messages.properties')}}}</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="tab1">
                                        <h3>{{__('messages.product_description')}}</h3>
                                        {!! $proInfo['description'] !!}
                                    </div>
                                    <div class="tab-pane fade" id="tab2">
                                        @php
                                            $pro = $proInfo->store_product_item;
                                        @endphp
                                        @if(sizeof($pro)>=1)
                                            <table class="table table-striped">
                                                <tbody>
                                                @foreach($pro as $po)
                                                    <tr>
                                                        <th>{{$po['title']}}</th>
                                                        <td>
                                                            <p>
                                                            @if(isset($po['prefix']))
                                                                <small>{{$po['prefix']}}</small>
                                                            @endif
                                                            {{$po->store_product_items['value']}}
                                                            @if(isset($po['suffix']))
                                                                <small>{{$po['suffix']}}</small>
                                                            @endif
                                                            </p>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-30">
                        <h3 class="line-bottom">Related Products</h3>
                        <div class="row multi-row-clearfix">
                            <div class="products related">
                                <div class="col-sm-6 col-md-3 col-lg-3 mb-30">
                                    <div class="product pb-0">
                                        <span class="tag-sale">Sale!</span>
                                        <div class="product-thumb">
                                            <img alt="" src="images/products/6.jpg"
                                                 class="img-responsive img-fullwidth">
                                            <div class="overlay">
                                                <div class="btn-add-to-cart-wrapper">
                                                    <a class="btn btn-theme-colored btn-sm btn-flat pl-20 pr-20 btn-add-to-cart text-uppercase font-weight-700"
                                                       href="#">Add To Cart</a>
                                                </div>
                                                <div class="btn-product-view-details">
                                                    <a class="btn btn-default btn-theme-colored btn-sm btn-flat pl-20 pr-20 btn-add-to-cart text-uppercase font-weight-700"
                                                       href="#">View detail</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-details text-center bg-lighter pt-15 pb-10">
                                            <a href="#"><h5 class="product-title mt-0">Vests</h5></a>
                                            <div class="star-rating" title="Rated 3.50 out of 5"><span
                                                        style="width: 80%;">3.50</span></div>
                                            <div class="price">
                                                <del><span class="amount">$165.00</span></del>
                                                <ins><span class="amount">$160.00</span></ins>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3 col-lg-3 mb-30">
                                    <div class="product pb-0">
                                        <span class="tag-sale">Sale!</span>
                                        <div class="product-thumb">
                                            <img alt="" src="images/products/3.jpg"
                                                 class="img-responsive img-fullwidth">
                                            <div class="overlay">
                                                <div class="btn-add-to-cart-wrapper">
                                                    <a class="btn btn-theme-colored btn-sm btn-flat pl-20 pr-20 btn-add-to-cart text-uppercase font-weight-700"
                                                       href="#">Add To Cart</a>
                                                </div>
                                                <div class="btn-product-view-details">
                                                    <a class="btn btn-default btn-theme-colored btn-sm btn-flat pl-20 pr-20 btn-add-to-cart text-uppercase font-weight-700"
                                                       href="#">View detail</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-details text-center bg-lighter pt-15 pb-10">
                                            <a href="#"><h5 class="product-title mt-0">Saddles</h5></a>
                                            <div class="star-rating" title="Rated 3.50 out of 5"><span
                                                        style="width: 60%;">3.50</span></div>
                                            <div class="price">
                                                <del><span class="amount">$70.00</span></del>
                                                <ins><span class="amount">$55.00</span></ins>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3 col-lg-3 mb-30">
                                    <div class="product pb-0">
                                        <div class="product-thumb">
                                            <img alt="" src="images/products/4.jpg"
                                                 class="img-responsive img-fullwidth">
                                            <div class="overlay">
                                                <div class="btn-add-to-cart-wrapper">
                                                    <a class="btn btn-theme-colored btn-sm btn-flat pl-20 pr-20 btn-add-to-cart text-uppercase font-weight-700"
                                                       href="#">Add To Cart</a>
                                                </div>
                                                <div class="btn-product-view-details">
                                                    <a class="btn btn-default btn-theme-colored btn-sm btn-flat pl-20 pr-20 btn-add-to-cart text-uppercase font-weight-700"
                                                       href="#">View detail</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-details text-center bg-lighter pt-15 pb-10">
                                            <a href="#"><h5 class="product-title mt-0">Helmets</h5></a>
                                            <div class="star-rating" title="Rated 3.50 out of 5"><span
                                                        style="width: 75%;">3.50</span></div>
                                            <div class="price">
                                                <ins><span class="amount">$185.00</span></ins>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md3 col-lg-3 mb-30">
                                    <div class="product pb-0">
                                        <div class="product-thumb">
                                            <img alt="" src="images/products/2.jpg"
                                                 class="img-responsive img-fullwidth">
                                            <div class="overlay">
                                                <div class="btn-add-to-cart-wrapper">
                                                    <a class="btn btn-theme-colored btn-sm btn-flat pl-20 pr-20 btn-add-to-cart text-uppercase font-weight-700"
                                                       href="#">Add To Cart</a>
                                                </div>
                                                <div class="btn-product-view-details">
                                                    <a class="btn btn-default btn-theme-colored btn-sm btn-flat pl-20 pr-20 btn-add-to-cart text-uppercase font-weight-700"
                                                       href="#">View detail</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-details text-center bg-lighter pt-15 pb-10">
                                            <a href="#"><h5 class="product-title mt-0">Saddles</h5></a>
                                            <div class="star-rating" title="Rated 5.00 out of 5"><span
                                                        style="width: 100%;">5.00</span></div>
                                            <div class="price">
                                                <ins><span class="amount">$480.00</span></ins>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
@endsection
