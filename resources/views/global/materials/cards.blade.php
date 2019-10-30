<?php   $champions = App\charity_champion::with('image')->get();?>

<section class="bg-silver-light">
    <div class="container">
        <div class="section-title text-center">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="text-uppercase line-bottom-center mt-0">{{__('messages.champion')}}</h2>
{{--                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem autem<br> voluptatem obcaecati!</p>--}}
                </div>
            </div>
        </div>
        <div class="row multi-row-clearfix">
            @forelse($champions as $champion)
                <?php
                $avg=0;
                if($champion['raised']!=0){
                    $avg = $champion['raised'] / $champion['target_amount'] * 100;
                }
                ?>
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="causes bg-white maxwidth500 mb-30">
                        <div class="thumb thumb-campaign">
                            <img src="{{$champion->image['path']}}/300/{{$champion->image['name']}}" alt=""
                                 class="img-fullwidth">
                            <div class="overlay-donate-now">
                                <a href="page-donate.html"
                                   class="btn btn-dark btn-theme-colored btn-flat btn-sm pull-left mt-10">
                                    {{__('messages.donate')}}
                                    <i class="flaticon-charity-make-a-donation font-16 ml-5"></i></a>
                            </div>
                        </div>
                        <div class="progress-item mt-0">
                            <div class="progress mb-0">
                                <div data-percent="{{$avg}}" class="progress-bar"><span class="percent">{{$avg}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="causes-details clearfix border-bottom p-15 pt-10 pb-10">
                            <h5 class="font-weight-600 font-14"><a href="{{route('champion_show',['id'=>$champion['id']])}}">{{substr($champion['title'],0,30)}}...</a></h5>
                            <p>{{$champion['description_small']}}</p>
                            <ul class="list-inline font-weight-600 border-top clearfix mt-20 pt-10">
                                <li class="pull-left pr-0">{{__('messages.receive')}}: {{$champion['raised']}}</li>
                                <li class="text-theme-colored pull-right pr-0">{{__('messages.target_amount')}} {{number_format($champion['target_amount'])}}
                                    <small>{{__('messages.rial')}}</small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-sm-6 col-md-3 col-lg-3">
                    <div class="causes bg-white maxwidth500 mb-30">
                        <div class="thumb">
                            <img src="{{ URL::asset('/public/assets/global/images/project/1.jpg') }}" alt=""
                                 class="img-fullwidth">
                            <div class="overlay-donate-now">
                                <a href="page-donate.html"
                                   class="btn btn-dark btn-theme-colored btn-flat btn-sm pull-left mt-10">Donate <i
                                            class="flaticon-charity-make-a-donation font-16 ml-5"></i></a>
                            </div>
                        </div>
                        <div class="progress-item mt-0">
                            <div class="progress mb-0">
                                <div data-percent="84" class="progress-bar"><span class="percent">0</span></div>
                            </div>
                        </div>
                        <div class="causes-details clearfix border-bottom p-15 pt-10 pb-10">
                            <h5 class="font-weight-600 font-16"><a href="page-single-cause.html">Education for
                                    Childreen</a></h5>
                            <p>Lorem ipsum dolor sit amet, consect adipisicing elit. Praesent quos sit.</p>
                            <ul class="list-inline font-weight-600 border-top clearfix mt-20 pt-10">
                                <li class="pull-left pr-0">Raised: $1890</li>
                                <li class="text-theme-colored pull-right pr-0">Goal: $2500</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3">
                    <div class="causes bg-white maxwidth500 mb-30">
                        <div class="thumb">
                            <img src="{{ URL::asset('/public/assets/global/images/project/2.jpg') }}" alt=""
                                 class="img-fullwidth">
                            <div class="overlay-donate-now">
                                <a href="page-donate.html"
                                   class="btn btn-dark btn-theme-colored btn-flat btn-sm pull-left mt-10">Donate <i
                                            class="flaticon-charity-make-a-donation font-16 ml-5"></i></a>
                            </div>
                        </div>
                        <div class="progress-item mt-0">
                            <div class="progress mb-0">
                                <div data-percent="84" class="progress-bar"><span class="percent">0</span></div>
                            </div>
                        </div>
                        <div class="causes-details clearfix border-bottom p-15 pt-10 pb-10">
                            <h5 class="font-weight-600 font-16"><a href="page-single-cause.html">Sponsor a child
                                    today</a></h5>
                            <p>Lorem ipsum dolor sit amet, consect adipisicing elit. Praesent quos sit.</p>
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
</section>
