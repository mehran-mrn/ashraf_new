@extends('layouts.global.global_layout')

@section('js')
    <script>
        $(document).on("change", '.priceFinal', function (event) {
            if (event.which >= 37 && event.which <= 40) return;
            $(this).val(function (index, value) {
                return value
                    .replace(/\D/g, "")
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                    ;
            });
        });
        function comma(val) {
            return val.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
        $(document).on('ready', function () {
            $(document).on('click', '.single_add_to_cart_button', function () {
                var btnContent = $(".cart-btn").html();
                $(".single_add_to_cart_button").attr("disabled", "disabled");
                $(".single_add_to_cart_button").html("<i class='fa fa-spin fa-spinner fa-1x'></i> {{__('messages.please_waite')}}...");
                var pro_id = '{{$proInfo['id']}}';
                var qty = $(".qty").val();
                $.ajax({
                    url: "{{route('add_to_cart')}}",
                    type: "post",
                    data: {
                        pro_id: pro_id,
                        count: qty
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                    },
                    success: function (response) {
                        $("#res").html(response);
                        PNotify.success({
                            text: response.message,
                            delay: 3000,
                        });
                        $(".cart-btn").html('' +
                            '<a href="{{route('store_cart')}}" class="btn btn-default">{{__('messages.view_basket')}}</a>');
                        $(".single_add_to_cart_button").removeAttr("disabled");
                        $(".single_add_to_cart_button").html("{{__('messages.add_to_cart')}}");
                    }, error: function () {
                    }
                });
            })

            var html = '<del><span class="amount off"></span></del>' +
                ' <ins>' +
                ' <span class="amount priceFinal"></span>' +
                ' <small class="text-gray">{{__('messages.toman')}}</small>' +
                '</ins>';
            $(".select-size").on('change', function () {
                $(".price").html("<i class='fa fa-spin fa-spinner fa-3x'></i>");
                $.ajax({
                    url: "{{route('product_size_info')}}",
                    type: "post",
                    data: {size_id: $(this).val()},
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                    },
                    success: function (response) {
                        $(".price").html(html);
                        var info = JSON.parse(response);
                        if (info.off > 0) {
                            $(".off").html(comma(info.price));
                            var final = info.price - (info.price * info.off / 100);
                            $(".priceFinal").html(comma(final.toFixed()));
                        } else {
                            $(".off").html("");
                            $(".priceFinal").html(comma(info.price))
                        }
                        $(".priceFinal").change();

                    }, error: function () {
                    }
                });
            });
            $(".select-size").change();
        })
    </script>
@endsection
@section('content')
    @csrf
    <div class="main-content">
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
                                    <div id="res"></div>
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
                                        <input type="hidden" name="inventory" class="inventory"
                                               value="{{$proInfo['store_product_inventory']['id']}}">
                                        @if($proInfo['store_product_inventory']['off']>0)
                                            <del>
                                                <span class="amount off">{{number_format($proInfo['store_product_inventory']['price'])}}</span>
                                            </del>
                                            <ins>
                                                <span class="amount priceFinal">{{number_format($proInfo['store_product_inventory']['price']-($proInfo['store_product_inventory']['price']*$proInfo['store_product_inventory']['off']/100))}}</span>
                                                <small class="text-gray">{{__('messages.toman')}}</small>
                                            </ins>
                                        @else
                                            <ins>
                                                <span class="amount priceFinal">{{number_format($proInfo['store_product_inventory']['price'])}}</span>
                                                <small class="text-gray">{{__('messages.toman')}}</small>
                                            </ins>
                                        @endif
                                    </div>
                                </div>

                                <hr>
                                @if(sizeof($proInfo['store_category'])>=1)
                                    <div class="category"><strong>{{__("messages.category")}}:</strong>
                                        @foreach($proInfo['store_category'] as $cat)
                                            <a href="#">{{$cat['title']}}</a>,
                                        @endforeach
                                    </div>
                                @endif
                                @if(sizeof($proInfo->store_product_tag)>=1)
                                    <div class="tags">
                                        <strong>{{__('messages.tags')}}: </strong>
                                        @foreach($proInfo->store_product_tag as $tag)
                                            @if($tag['tag']!="")
                                                <a href="#">{{$tag['tag']}}</a>,
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                                <div class="cart-form-wrapper mt-30">
                                    <form enctype="multipart/form-data" method="post" class="cart">
                                        <input type="hidden" value="productID" name="add-to-cart">
                                        <table class="table variations no-border">
                                            <tbody>
                                            <tr>
                                                <td class="name">{{__('messages.count')}}</td>
                                                <td class="value">
                                                    <div class="quantity buttons_added">
                                                        <input type="button" class="minus" value="-">
                                                        <input type="number" size="4" class="input-text qty text"
                                                               title="count" value="1" name="count" min="1" max="20" step="1">
                                                        <input type="button" class="plus" value="+">
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="cart-btn">
                                            <button class="single_add_to_cart_button btn btn-theme-colored"
                                                    type="button">{{__('messages.add_to_cart')}}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="horizontal-tab product-tab">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tab1" data-toggle="tab">{{__('messages.description')}}</a></li>
                                    <li><a href="#tab2" data-toggle="tab">{{{__('messages.properties')}}}</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="tab1">
                                        <h3>{{__('messages.product_description')}}</h3>
                                        {!! $proInfo['description'] !!}
                                    </div>
                                    <div class="tab-pane fade" id="tab2">
                                        <div class="short-description pt-20">
                                            {{ $proInfo['properties'] }}
                                        </div>
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
                </div>
            </div>
        </section>
    </div>
@endsection
