<!-- Section: Upcoming Events -->
<section class="bg-silver-light">
    <div class="container">
        <div class="section-content">
            <div class="row">

                <div class="col-md-7">
                    @foreach(get_posts(1) as $news)

                    <img class="img-fullwidth" src="{{ URL::asset('public/'.config('blogetc.blog_upload_dir'))."/".$news['image_large']}}" alt="">
                    <h3 class="line-bottom">{{$news['title']}}</h3>
                    <p>{{$news['short_description'] }}</p>
                    <a class="text-theme-colored font-13 pull-left" href="{{route('post_page',['blogPostSlug'=>$news['slug']])}}">{{trans('messages.read_more')}}...</a>
                    @endforeach
                </div>

                <div class="col-md-5">
                    <h3 class="text-uppercase title line-bottom mt-0 mb-30"><i class="fa fa-calendar text-gray-darkgray mr-10"></i>{!!  trans('messages.latest_posts')!!} </h3>
                    @foreach(get_posts(4) as $key=> $news)
                        @if($key !=0)
                            <article class="post media-post clearfix pb-0 mb-10">
                                <a href="{{route('post_page',['blogPostSlug'=>$news['slug']])}}" class="post-thumb post-thumb-img mb-0"><img alt="" src="{{ URL::asset('public/'.config('blogetc.blog_upload_dir'))."/".$news['image_medium']}}">
                                    <ul class="list-inline font-12 mt-1 m-0">
                                        <li class="pr-0"><i class="fa fa-calendar m-0"></i> {{miladi_to_shamsi_date($news['publish_time'])}}|</li>
                                    </ul>
                                </a>
                                <div class="post-right">
                                    <h4 class="mt-0 mb-5"><a href="{{route('post_page',['blogPostSlug'=>$news['slug']])}}">{{$news['title']}}</a></h4>

                                    <p class="mb-0 font-13">{{$news['short_description'] }}</p>
                                    <a class="text-theme-colored font-13" href="{{route('post_page',['blogPostSlug'=>$news['slug']])}}">{{trans('messages.read_more')}}...</a>
                                </div>
                            </article>
                        @endif
                    @endforeach



                </div>

            </div>
        </div>
    </div>
</section>
