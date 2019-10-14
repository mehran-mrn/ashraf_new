<section  class="divider parallax layer-overlay overlay-theme-colored-2"  data-bg-img="{{ URL::asset('/public/assets/global/images/bg/bg25.jpg') }}"
         data-parallax-ratio="0.7"
         style="background-image: url({{URL::asset('/public/assets/global/images/bg/bg12.jpg')}}); background-position: 50% 177px;">
    <div class="container pt-15 pb-15" >
        <div class="row">
            <div class="col-md-5">
                <?php $video = get_video_gallery();?>
                <h3 class="text-white font-24 font-weight-600 mt-0 mb-5">{{$video['title']}}</h3>

                <p class="text-white">{{$video['description']}}</p>

                <a class="btn btn-lg btn-theme-colored mt-30" href="{{route('video_gallery')}}"><i
                            class="fa fa-video-camera text-white mr-10"></i> {{trans('messages.watch_more_videos')}} </a>
            </div>
            <div class="col-md-7">
                <div class="fluid-video-wrapper mt-sm-60">
                    <div class="fluid-width-video-wrapper" style="padding-top: 55.8824%;">
                        {!!$video['iframe']!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>