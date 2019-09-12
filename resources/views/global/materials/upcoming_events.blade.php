<!-- Section: Upcoming Events -->
<section class="bg-silver-light">
    <div class="container">
        <div class="section-content">
            <div class="row">
                <div class="col-md-6 bordered_box_bottom">
                    @foreach(get_posts(1,'','','','articles')['posts'] as $news)
                            <img class="img-fullwidth"
                                 src="{{$news['image_large']? URL::asset('public/'.config('blogetc.blog_upload_dir'))."/".$news['image_large']:''}}"
                                 alt="">

                        <h5 class="line-bottom"><strong>{{$news['title']}}</strong></h5>
                        <p>{{$news['short_description'] }}</p>
                        <a class="text-theme-colored font-13 pull-left"
                           href="{{route('post_page',['blogPostSlug'=>$news['slug']])}}">{{trans('messages.read_more')}}
                            ...</a>
                    @endforeach
                </div>

                <div class="col-md-6">
                    <h3 class="text-uppercase title line-bottom mt-0 mb-20"><i
                                class="fa fa-calendar text-gray-darkgray mr-10"></i>{!!  trans('messages.latest_posts')!!}
                    </h3>
                    @foreach(get_posts(4,'','','','articles')['posts'] as $key=> $news)
                        @if($key !=0)
                            <article class="post media-post clearfix pb-0 mb-10">
                                <a href="{{route('post_page',['blogPostSlug'=>$news['slug']])}}"
                                   class="post-thumb post-thumb-img mb-0">
                                    <img alt=""
                                         src="{{ URL::asset('public/'.config('blogetc.blog_upload_dir'))."/".$news['image_medium']}}">
                                    <ul class="list-inline font-12 mt-1 m-0 text-center">
                                        <li class="pr-0"><i
                                                    class="fa fa-calendar m-0"></i> {{jdate('d F',strtotime($news['posted_at']))}}
                                        </li>
                                    </ul>
                                </a>
                                <div class="post-right">
                                    <h5 class="mt-5 mb-5"><strong><a
                                                    href="{{route('post_page',['blogPostSlug'=>$news['slug']])}}">{{$news['title']}}</a></strong>
                                    </h5>
                                    <p class="mb-0 font-13">{{$news['short_description'] }}</p>
                                    <a class="text-theme-colored pull-left font-13"
                                       href="{{route('post_page',['blogPostSlug'=>$news['slug']])}}">{{trans('messages.read_more')}}
                                        ...</a>
                                </div>
                            </article>
                            <hr class="bordered_box p-0 m-0">
                        @endif
                    @endforeach


                </div>

            </div>
        </div>
    </div>
</section>
