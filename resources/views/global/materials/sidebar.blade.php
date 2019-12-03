<div class="sidebar sidebar-left mt-30 mt-sm-30">
    <div class="widget">


        <h5 class="widget-title line-bottom">{{trans('messages.search_blog')}}</h5>
        <div class="search-form">
            <form method='get' action='{{route("blogetc.search")}}' class='text-center'>
                <div class="input-group">
                    <input type="text" name='s' placeholder="" class="form-control search-input"
                           value='{{\Request::get("s")}}'>
                    <span class="input-group-btn">
                      <button type="submit" value='Search' class="btn search-button"><i
                                  class="fa fa-search"></i></button>
                      </span>
                </div>
            </form>
        </div>
    </div>
    <div class="widget">
        <h5 class="widget-title line-bottom">{{trans('messages.categories')}}</h5>
        <div class="categories">
            <ul class="list list-border angle-double-right">
                @forelse($side_menu as $side_m)
                    <li><a href="{{$side_m->url}}">{{$side_m['name']}}</a></li>
                @empty
                @endforelse

            </ul>
        </div>
    </div>
    <div class="widget">
        <h5 class="widget-title line-bottom">{{trans('messages.latest_post')}}</h5>

        <div class="latest-posts">
            @foreach(get_posts(8) as  $news)
                <article class="post media-post clearfix pb-0 mb-10">
                    <a class="post-thumb" href="{{route('post_page',['blogPostSlug'=>$news['slug']])}}"><img
                                class="post-side-thumb-img"
                                src="{{ URL::asset('public/'.config('blogetc.blog_upload_dir'))."/".$news['image_medium']}}"
                                alt=""></a>
                    <div class="post-right">
                        <h5 class="post-title mt-0"><a
                                    href="{{route('post_page',['blogPostSlug'=>$news['slug']])}}">{{$news['title']}}</a>
                        </h5>
                    </div>
                </article>
            @endforeach

        </div>
    </div>
    <div class="widget">
        <h5 class="widget-title line-bottom">{!! __('messages.photos_gallery') !!}</h5>
        <div class="owl-carousel-1col">
            @forelse(get_photo_gallery(5) as $photo)
                <div class="item">
                    <img src="{{url($photo['path']."/300/".$photo['name'])}}"
                         alt="{{$photo['title']}} - {{__('messages.ashraf')}}">
                    <h4 class="title">{{$photo['title']}}</h4>

                </div>
            @empty

            @endforelse
        </div>
    </div>
</div>
