@extends('layouts.global.global_layout')
@section('title',__('messages.gallery'). " |")
@section('css')
    <style>
        .flip-box {
            background-color: transparent;
            width: 300px;
            height: 200px;
            border: 1px solid #f1f1f1;
            perspective: 1000px;
            margin: auto;
        }

        /* This container is needed to position the front and back side */
        .flip-box-inner {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.8s;
            transform-style: preserve-3d;
        }

        /* Do an horizontal flip when you move the mouse over the flip box container */
        .flip-box:hover .flip-box-inner {
            transform: rotateY(180deg);
        }

        /* Position the front and back side */
        .flip-box-front, .flip-box-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
        }

        /* Style the front side (fallback if image is missing) */
        .flip-box-front {
            background-color: #bbb;
            color: black;
        }

        /* Style the back side */
        .flip-box-back {
            background-color: rgba(225, 238, 225, 0.03);
            color: white;
            transform: rotateY(180deg);
        }
    </style>
@stop
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
            <div class="container ">
                <div class="section-content">
                    <div class="row ">
                        @foreach($medias as $media)
                            @if(count($media['media'])>1)
                                <div class="col-sm-6 col-md-4">
                                    <div class="thumbnail">
                                        <a href="{{route('gallery_view',['id'=>$media['id']])}}">
                                            <div class="flip-box">
                                                <div class="flip-box-inner">
                                                    <div class="flip-box-front">
                                                        @if($media['media_two']['path'])
                                                        <img src="{{$media['media_two']['path']."/300/".$media['media_two']['name']}}"
                                                             alt="{{$media['media_two']['title']}} - {{__('messages.ashraf')}}" style="width:300px;height:200px">
                                                            @else
                                                            <img src="{{asset(url("/public/assets/global/images/logoImage.png"))}}"
                                                                 alt="{{__('messages.ashraf')}}" style="width:300px;height:200px">
                                                            @endif
                                                    </div>
                                                    <div class="flip-box-back">
{{--                                                        <img src="{{$media['media_one']['path']."/300-200/".$media['media_one']['name']}}"--}}
{{--                                                             alt="Paris" style="width:300px;height:200px">--}}
                                                        <h3>{{$media['title']}}</h3>
                                                        <p>{{$media['description']}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="caption text-center">
                                            <p>{{$media['description']}}</p>
                                            <p>
                                                <a href="{{route('gallery_view',['id'=>$media['id']])}}"
                                                   class="btn btn-default"
                                                   role="button">{{__('messages.show')}}</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

    </div>

@endsection
