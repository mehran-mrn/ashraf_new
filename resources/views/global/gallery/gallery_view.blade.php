@extends('layouts.global.global_layout')
@section('content')
    <div class="main-content">
        <section class="bg-white-f7 pt-20">
            <div class="container pb-0">
                <div class="section-title">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="text-center">
                                <h5 class="sub-title">{{$categoryInfo['title']}}</h5>
                                <h2 class="title">{{$categoryInfo['description']}}</h2>
                                <p>{!! $categoryInfo['more_description'] !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Gallery Grid 4 -->
        <section>
            <div class="container">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="grid" class="gallery-isotope grid-4 gutter clearfix">
                                @foreach($pics as $pic)
                                    <div class="gallery-item photography">
                                        <div class="thumb">
                                            <img class="img-fullwidth" src="/{{$pic['url']}}" alt="{{$pic['title']}}">
                                            <div class="overlay-shade"></div>
                                            <div class="icons-holder">
                                                <div class="icons-holder-inner">
                                                    <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                                                        <a data-lightbox="image" href="/{{$pic['url']}}"><i
                                                                    class="fa fa-plus"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
