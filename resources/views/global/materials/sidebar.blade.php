<div class="sidebar sidebar-left mt-sm-30">
    <div class="widget">



        <h5 class="widget-title line-bottom">{{trans('messages.search_blog')}}</h5>
        <div class="search-form">
            <form method='get' action='{{route("blogetc.search")}}' class='text-center'>
            <div class="input-group">
                    <input type="text" name='s' placeholder="" class="form-control search-input" value='{{\Request::get("s")}}'>
                    <span class="input-group-btn">
                      <button type="submit" value='Search' class="btn search-button"><i class="fa fa-search"></i></button>
                      </span>
                </div>
            </form>
        </div>
    </div>
    <div class="widget">
        <h5 class="widget-title line-bottom">{{trans('messages.categories')}}</h5>
        <div class="categories">
            <ul class="list list-border angle-double-right">
                @forelse(get_blog_categories() as $category)
                @empty
                @endforelse
                <li><a href="{{$category['slug']}}">{{$category['category_name']}}</a></li>

            </ul>
        </div>
    </div>
    <div class="widget">
        <h5 class="widget-title line-bottom">{{trans('messages.latest_post')}}</h5>

        <div class="latest-posts">
            @foreach(get_posts(8) as $key=> $news)
                    <article class="post media-post clearfix pb-0 mb-10">
                        <a class="post-thumb" href="{{route('post_page',['blogPostSlug'=>$news['slug']])}}"><img class="post-side-thumb-img" src="{{ URL::asset('public/'.config('blogetc.blog_upload_dir'))."/".$news['image_medium']}}" alt=""></a>
                        <div class="post-right">
                            <h5 class="post-title mt-0"><a href="{{route('post_page',['blogPostSlug'=>$news['slug']])}}">{{$news['title']}}</a></h5>
                        </div>
                    </article>

            @endforeach

        </div>
    </div>
    <div class="widget">
        <h5 class="widget-title line-bottom">Photos from Flickr</h5>
        <div id="flickr-feed" class="clearfix">
            <!-- Flickr Link -->
            <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=9&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=52617155@N08">
            </script><!-- DEVELOPER WARNING: The Flickr badge code is likely to be deprecated, and we recommend changing to a new method to embed photo as soon as possible.  See https://www.flickr.com/api for information on how to access Flickr data. Thanks. --><div class="flickr_badge_image" id="flickr_badge_image1"><a href="https://www.flickr.com/photos/we-are-envato/15647274066/"><img src="https://live.staticflickr.com/3940/15647274066_2ee48c3fe9_s.jpg" alt="A photo on Flickr" title="Halloween 2014 at Envato in Melbourne" height="75" width="75"></a></div><div class="flickr_badge_image" id="flickr_badge_image2"><a href="https://www.flickr.com/photos/we-are-envato/15485436268/"><img src="https://live.staticflickr.com/3945/15485436268_846ccca178_s.jpg" alt="A photo on Flickr" title="Halloween 2014 at Envato in Melbourne" height="75" width="75"></a></div><div class="flickr_badge_image" id="flickr_badge_image3"><a href="https://www.flickr.com/photos/we-are-envato/15668911091/"><img src="https://live.staticflickr.com/3956/15668911091_4ef20118b5_s.jpg" alt="A photo on Flickr" title="Halloween 2014 at Envato in Melbourne" height="75" width="75"></a></div><div class="flickr_badge_image" id="flickr_badge_image4"><a href="https://www.flickr.com/photos/we-are-envato/15484954949/"><img src="https://live.staticflickr.com/5605/15484954949_a4e97a9dc5_s.jpg" alt="A photo on Flickr" title="Halloween 2014 at Envato in Melbourne" height="75" width="75"></a></div><div class="flickr_badge_image" id="flickr_badge_image5"><a href="https://www.flickr.com/photos/we-are-envato/15647103116/"><img src="https://live.staticflickr.com/7490/15647103116_1e4b9033f0_s.jpg" alt="A photo on Flickr" title="Halloween 2014 at Envato in Melbourne" height="75" width="75"></a></div><div class="flickr_badge_image" id="flickr_badge_image6"><a href="https://www.flickr.com/photos/we-are-envato/15668909741/"><img src="https://live.staticflickr.com/5599/15668909741_eaf3db4054_s.jpg" alt="A photo on Flickr" title="Halloween 2014 at Envato in Melbourne" height="75" width="75"></a></div><div class="flickr_badge_image" id="flickr_badge_image7"><a href="https://www.flickr.com/photos/we-are-envato/15670834825/"><img src="https://live.staticflickr.com/7544/15670834825_5f55bb7e4e_s.jpg" alt="A photo on Flickr" title="Halloween 2014 at Envato in Melbourne" height="75" width="75"></a></div><div class="flickr_badge_image" id="flickr_badge_image8"><a href="https://www.flickr.com/photos/we-are-envato/15485435298/"><img src="https://live.staticflickr.com/3946/15485435298_7848e85e0a_s.jpg" alt="A photo on Flickr" title="Halloween 2014 at Envato in Melbourne" height="75" width="75"></a></div><div class="flickr_badge_image" id="flickr_badge_image9"><a href="https://www.flickr.com/photos/we-are-envato/15647100406/"><img src="https://live.staticflickr.com/3937/15647100406_34599445cf_s.jpg" alt="A photo on Flickr" title="Halloween 2014 at Envato in Melbourne" height="75" width="75"></a></div><span style="position:absolute;left:-999em;top:-999em;visibility:hidden" class="flickr_badge_beacon"><img src="https://geo.yahoo.com/p?s=792600102&amp;t=9202b86ee9014b880e5e68aef15b1e03&amp;r=http%3A%2F%2Fhtml.kodesolution.live%2Fj%2Fngopress%2Fv2.0%2Fdemo%2Fblog-single-left-sidebar.html&amp;fl_ev=0&amp;lang=en&amp;intl=de" width="0" height="0" alt=""></span>
        </div>
    </div>
</div>
