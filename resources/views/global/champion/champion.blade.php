@extends('layouts.global.global_layout')
@section('title',$champion['meta_description']. " |")
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('meta_description',$champion['meta_description'])
@section('js')
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/validation/validate.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/global/js/localization/messages_fa.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).on("change keyup", '.price', function (event) {
                if (event.which >= 37 && event.which <= 40) return;
                $(this).val(function (index, value) {
                    return value
                        .replace(/\D/g, "")
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                        ;
                });
            });
            $(document).on("submit", "#frm_charity_champion", function (e) {
                e.preventDefault();
                if ($(this).valid()) {
                    $.ajax({
                        url: "{{route('champion_payment')}}",
                        type: "post",
                        data: $(this).serialize(),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            if (response.message.code === 200) {
                                PNotify.success({
                                    text: response.message.message,
                                    delay: 3000,
                                });
                                setTimeout(function () {
                                    window.location.replace("/champion/cart/" + response.message.id);
                                }, 2000);

                            } else {
                                PNotify.success({
                                    text: response.message.message,
                                    delay: 3000,
                                });
                            }
                            submit.removeAttr("disabled");
                            submit.html("{{__('messages.pay')}}")
                        }, error: function (response) {
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
                }
            })
        });
    </script>
@stop
@section('content')
    <?php
    $avgMain = 0;
    if ($champion['raised'] != 0) {
        $avgMain = $champion['raised'] / $champion['target_amount'] * 100;
    }
    ?>
    <div class="main-content">

        <section>
            <div class="container">
                <div class="row mtli-row-clearfix">
                    <div class="col-sm-6 col-md-8 col-lg-8">
                        <div class="causes bg-white maxwidth500 mb-30">
                            <div class="thumb">
                                <img src="/{{$champion['image']['path']}}/600/{{$champion['image']['name']}}" alt=""
                                     class="img-fullwidth">
                                <div class="overlay-donate-now">
                                    <a href="page-donate.html"
                                       class="btn btn-dark btn-theme-colored btn-flat btn-sm pull-left mt-10">{{__('messages.donate')}}
                                        <i class="flaticon-charity-make-a-donation font-16 ml-5"></i></a>
                                </div>
                            </div>
                            <div class="progress-item mt-0">
                                <div class="progress mb-0">
                                    <div data-percent="{{$avgMain}}" class="progress-bar"><span
                                                class="percent">{{$avgMain}}</span></div>
                                </div>
                            </div>
                            <div class="causes-details clearfix border-bottom p-15 pt-10 pb-10">
                                <h3 class="font-weight-600"><a href="page-single-cause.html">{{$champion['title']}}</a>
                                </h3>
                                <p>{{$champion['description_small']}}</p>
                                <ul class="list-inline font-weight-600 border-top clearfix mt-20 pt-10">
                                    <li class="pull-left pr-0">{{__('messages.receive')}}
                                        : {{number_format($champion['raised'])}}</li>
                                    <li class="text-theme-colored pull-right pr-0">{{__('messages.target_amount')}}
                                        : {{number_format($champion['target_amount'])}}
                                        <small>{{__('messages.rial')}}</small>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="event-details">
                            <p class="mb-20 mt-20">{!! $champion['description'] !!}</p>
                        </div>
                        <hr>
                        <div class="widget pt-20">
                            <h6 class="text-uppercase title line-bottom mt-0 mb-30 mt-sm-40">
                                <i class="fa fa-thumb-tack text-gray-darkgray mr-10"></i> {{__('messages.projects')}}
                                <span class="text-theme-colored">{{__('messages.champion')}}</span></h6>
                            <div class="row">
                                @forelse($champion['projects'] as $ch)
                                    <div class="col-xs-12 col-sm-6 col-md-4">
                                        <article class="post clearfix mb-sm-30 bg-silver-light">
                                            <div class="entry-header">
                                                <div class="post-thumb thumb">
                                                    <img src="/{{$ch['media']['url']}}" alt=""
                                                         class="img-responsive img-fullwidth">
                                                </div>
                                            </div>
                                            <div class="entry-content p-20 pr-10">
                                                <div class="entry-meta media mt-0 no-bg no-border">
                                                    <div class="media-body pl-15">
                                                        <div class="event-content pull-left flip">
                                                            <h4 class="entry-title text-white text-uppercase m-0 mt-5">
                                                                <a href="#">{{$ch['title']}}</a></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="mt-10">{{$ch['description']}}</p>
                                                <div class="clearfix"></div>
                                            </div>
                                        </article>
                                    </div>
                                @empty

                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="sidebar sidebar-right mt-sm-30">
                            <div class="widget">
                                <h4 class="widget-title line-bottom">{{__('messages.donate')}}</h4>
                                <form action="" id="frm_charity_champion">
                                    <input type="hidden" name="champion_id" value="{{$champion['id']}}">
                                    <div class="row">
                                        @if(!Auth::id())
                                            <div class="col-md-6 col-xs-12 form-group">
                                                <label for="">{{__('messages.name')}}</label>
                                                <input type="text" name="name" class="form-control">
                                            </div>
                                            <div class="col-md-6 col-xs-12 form-group">
                                                <label for="">{{__('messages.family')}}</label>
                                                <input type="text" name="family" class="form-control">
                                            </div>
                                        @endif
                                        <div class="col-md-12 col-xs-12 form-group">
                                            <div class="form-group">
                                                <label for="">{{__('messages.donate_pay')}}
                                                    <small>({{__('messages.rial')}})</small>
                                                </label>
                                                <input type="text" required="required" minlength="5" maxlength="90000"
                                                       class="form-control price" name="amount">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xs-12">
                                            <div class="form-group pull-left">
                                                <button class="btn btn-theme-colored">{{__('messages.pay')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="clearfix"></div>
                            </div>
                            @if(sizeof($champion['projects'])>=1)
                                <div class="widget">
                                    <h4 class="widget-title line-bottom">{{__('messages.patron_finance_projects')}}</h4>
                                    <div class="form-group">
                                        <div class="form-group pull-left">
                                            <button class="btn btn-success">{{__('messages.patron')}}</button>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            @endif

                            <div class="widget">
                                <h4 class="widget-title line-bottom">{{__('messages.count_people')}}</h4>
                                <h5>{{count($champion['transaction'])}}</h5>
                            </div>
                            <div class="widget">
                                <h5 class="widget-title line-bottom">{{__('messages.projects_gallery')}}</h5>
                                <div class="owl-carousel-1col">
                                    @forelse($champion['projects'] as $cham)
                                        @foreach($cham['gallery'] as $gallery)
                                            <div class="item">
                                                <img src="/{{$gallery['path']}}/300/{{$gallery['name']}}" alt="">
                                                <h5 class="title">{{$gallery['asd']}}</h5>
                                            </div>
                                        @endforeach
                                    @empty

                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section: Upcoming Events -->
        <section class="bg-lighter">
            <div class="container">
                <div class="section-content">
                    <div class="row">

                        <div class="col-md-12">
                            <h5 class="text-uppercase title line-bottom mt-0 mb-30 mt-sm-40"><i
                                        class="fa fa-thumb-tack text-gray-darkgray mr-10"></i> {{__('messages.champions')}}
                            </h5>
                            <div class="owl-carousel-4col">
                                @forelse($champions as $champion)
                                    <?php
                                    $avg = 0;
                                    if ($champion['raised'] != 0) {
                                        $avg = $champion['raised'] / $champion['target_amount'] * 100;
                                    }
                                    ?>
                                    <div class="item">
                                        <div class="causes bg-white maxwidth400 mb-sm-30">
                                            <div class="thumb">
                                                <img src="/{{$champion['image']['path']}}/300/{{$champion['image']['name']}}"
                                                     alt="{{$champion['title']}}" class="img-fullwidth">
                                                <div class="overlay-donate-now">
                                                    <a href="page-donate.html"
                                                       class="btn btn-dark btn-theme-colored btn-flat btn-sm pull-left mt-10">{{__('messages.donate')}}
                                                        <i class="flaticon-charity-make-a-donation font-16 ml-5"></i></a>
                                                </div>
                                            </div>
                                            <div class="progress-item mt-0">
                                                <div class="progress mb-0">
                                                    <div data-percent="{{$avg}}" class="progress-bar"><span
                                                                class="percent">{{$avg}}</span></div>
                                                </div>
                                            </div>
                                            <div class="causes-details clearfix border-bottom p-15 pt-10 pb-10">
                                                <h5 class="font-weight-600 font-14"><a
                                                            href="page-single-cause.html">{{substr($champion['title'],0,30)}}</a>
                                                </h5>
                                                <p>{{$champion['description_small']}}</p>
                                                <ul class="list-inline font-weight-600 border-top clearfix mt-20 pt-10">
                                                    <li class="pull-left pr-0">{{__('messages.receive')}}
                                                        : {{number_format($champion['raised'])}}</li>
                                                    <li class="text-theme-colored pull-right pr-0">{{__('messages.target_amount')}}
                                                        : {{number_format($champion['target_amount'])}}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="item">
                                        <div class="causes bg-white maxwidth500 mb-sm-30">
                                            <div class="thumb">
                                                <img src="images/project/6.jpg" alt="" class="img-fullwidth">
                                                <div class="overlay-donate-now">
                                                    <a href="page-donate.html"
                                                       class="btn btn-dark btn-theme-colored btn-flat btn-sm pull-left mt-10">Donate
                                                        <i class="flaticon-charity-make-a-donation font-16 ml-5"></i></a>
                                                </div>
                                            </div>
                                            <div class="progress-item mt-0">
                                                <div class="progress mb-0">
                                                    <div data-percent="84" class="progress-bar"><span
                                                                class="percent">0</span></div>
                                                </div>
                                            </div>
                                            <div class="causes-details clearfix border-bottom p-15 pt-10 pb-10">
                                                <h5 class="font-weight-600 font-16"><a href="page-single-cause.html">Sponsor
                                                        a child today</a></h5>
                                                <p>Lorem ipsum dolor sit amet, consect adipisicing elit. Praesent quos
                                                    sit.</p>
                                                <ul class="list-inline font-weight-600 border-top clearfix mt-20 pt-10">
                                                    <li class="pull-left pr-0">Raised: $1890</li>
                                                    <li class="text-theme-colored pull-right pr-0">Goal: $2500</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="causes bg-white maxwidth500 mb-sm-30">
                                            <div class="thumb">
                                                <img src="images/project/7.jpg" alt="" class="img-fullwidth">
                                                <div class="overlay-donate-now">
                                                    <a href="page-donate.html"
                                                       class="btn btn-dark btn-theme-colored btn-flat btn-sm pull-left mt-10">Donate
                                                        <i class="flaticon-charity-make-a-donation font-16 ml-5"></i></a>
                                                </div>
                                            </div>
                                            <div class="progress-item mt-0">
                                                <div class="progress mb-0">
                                                    <div data-percent="84" class="progress-bar"><span
                                                                class="percent">0</span></div>
                                                </div>
                                            </div>
                                            <div class="causes-details clearfix border-bottom p-15 pt-10 pb-10">
                                                <h5 class="font-weight-600 font-16"><a href="page-single-cause.html">Sponsor
                                                        a child today</a></h5>
                                                <p>Lorem ipsum dolor sit amet, consect adipisicing elit. Praesent quos
                                                    sit.</p>
                                                <ul class="list-inline font-weight-600 border-top clearfix mt-20 pt-10">
                                                    <li class="pull-left pr-0">Raised: $1890</li>
                                                    <li class="text-theme-colored pull-right pr-0">Goal: $2500</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Divider: Clients -->
        <section class="clients bg-theme-colored">
            <div class="container pt-0 pb-0">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Section: Clients -->
                        <div class="owl-carousel-6col clients-logo transparent text-center">
                            <div class="item"><a href="#"><img src="images/clients/w1.png" alt=""></a></div>
                            <div class="item"><a href="#"><img src="images/clients/w2.png" alt=""></a></div>
                            <div class="item"><a href="#"><img src="images/clients/w3.png" alt=""></a></div>
                            <div class="item"><a href="#"><img src="images/clients/w4.png" alt=""></a></div>
                            <div class="item"><a href="#"><img src="images/clients/w5.png" alt=""></a></div>
                            <div class="item"><a href="#"><img src="images/clients/w6.png" alt=""></a></div>
                            <div class="item"><a href="#"><img src="images/clients/w3.png" alt=""></a></div>
                            <div class="item"><a href="#"><img src="images/clients/w4.png" alt=""></a></div>
                            <div class="item"><a href="#"><img src="images/clients/w5.png" alt=""></a></div>
                            <div class="item"><a href="#"><img src="images/clients/w6.png" alt=""></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
