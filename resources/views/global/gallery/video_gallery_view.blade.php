@extends('layouts.global.global_layout')
@section('css')
    <link rel="stylesheet" href="{{URL::asset('/public/assets/global/js/fancybox/dist/jquery.fancybox.min.css')}}"
          type="text/css" media="screen"/>
    <style>
        .btn:focus, .btn:active, button:focus, button:active {
            outline: none !important;
            box-shadow: none !important;
        }

        #image-gallery .modal-footer {
            display: block;
        }

        .thumb {
            margin-top: 15px;
            margin-bottom: 15px;
        }
    </style>
@stop
@section('content')

    <div class="main-content">
        <section>
            <div class="container">
                <div class="section-content">
                    <div class="row">
                        @foreach($videos as $video)
                            <div class="col-lg-6 col-md-6 col-xs-12 " >
                                {!!$video['iframe']!!}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('js')
    <script src="{{URL::asset('/public/assets/global/js/fancybox/dist/jquery.fancybox.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('[data-fancybox="images"]').fancybox({
                closeExisting: false,
                gutter: 50,
                keyboard: true,
                arrows: true,
                protect: true,
                image: {
                    preload: true
                },
                buttons: [
                    "zoom",
                    "slideShow",
                    "fullScreen",
                    "thumbs",
                    "close"
                ],
                thumbs: {
                    autoStart: true
                },
                zoomOpacity: "auto",

                afterLoad: function (instance, current) {
                    var pixelRatio = window.devicePixelRatio || 1;

                    if (pixelRatio > 1.5) {
                        current.width = current.width / pixelRatio;
                        current.height = current.height / pixelRatio;
                    }
                }
            })
        });
    </script>
@stop
