@extends('layouts.global.global_layout')
@section('content')
    <div class="main-content rtl">

        <section class="bg-white-f7 pt-20">
            <div class="container pb-0">
                <div class="section-title">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="text-right">
                                <h2 class="title mb-5">{{__('messages.gallery')}}</h2>
                                <h5 class="sub-title">{{__('messages.image_gallery_ashraf')}}</h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-left">
                                <p class="left-bordered mt-5">هر مسلمانی که به گروهی از مسلمانان خدمت کند خداوند متعال
                                    به تعداد آنان، خدمتگزارانی را در بهشت به او عطا خواهد کرد .</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container-fluid pb-0  ">
                <div class="section-content">
                    <div class="row ">
                        <div class="col-md-12">
                            <div id="grid" class="gallery-isotope grid-4 gutter clearfix rtl">
                                @foreach($medias as $media)
                                    @if(count($media['media'])>1)
                                        <div class="gallery-item branding "
                                             style="left: unset!important;right: 0!important;">
                                            <div class="thumb">
                                                <img class="img-fullwidth"
                                                     src="{{asset('/public/assets/global/images/gallery/2.jpg')}}"
                                                     alt="project">
                                                <div class="overlay-shade"></div>
                                                <div class="icons-holder">
                                                    <div class="icons-holder-inner">
                                                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                                                            <a href="{{route('gallery_view',['id'=>$media['id']])}}"><i
                                                                        class="fa fa-link"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a class="hover-link" data-lightbox="image"
                                                   href="{{asset('/public/assets/global/images/gallery/2.jpg')}}">View
                                                    more</a>
                                            </div>
                                            <h5 class="text-center mt-15 mb-40">{{$media['title']}}</h5>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <!-- End Portfolio Gallery Grid -->

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

@endsection
