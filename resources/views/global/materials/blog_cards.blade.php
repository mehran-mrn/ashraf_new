<!-- Section: blog -->
<section id="blog">
    <div class="container pt-0">
        <div class="section-title text-center">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="text-uppercase line-bottom-center mt-0"></h2>
                    <p>{{trans('messages.articles_preview')}}</p>
                </div>
            </div>
        </div>
        <div class="section-content">
            <div class="row">
                @forelse(get_posts(3,'','','','articles')['posts'] as $key=> $news)
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <article class="post clearfix mb-sm-30 bg-silver-light">
                            <div class="entry-header">
                                @if($news['image_large'])
                                    <div class="post-thumb thumb">
                                        <img src="{{ URL::asset('public/'.config('blogetc.blog_upload_dir'))."/".$news['image_large']}}"
                                             alt="" class="img-responsive img-fullwidth">
                                    </div>
                                @endif
                            </div>
                            <div class="entry-content p-20 pr-10">
                                <div class="entry-meta media mt-0 no-bg no-border">
                                    <div class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">
                                        <ul>
                                            <li class="font-16 text-white font-weight-600 border-bottom">28</li>
                                            <li class="font-12 text-white text-uppercase">آبان</li>
                                        </ul>
                                    </div>
                                    <div class="media-body pl-15">
                                        <div class="event-content pull-left flip">
                                            <h4 class="entry-title text-white text-uppercase m-0 mt-5"><a
                                                        href="#">{{$news['title']}}</a></h4>
                                            <span class="mb-10 text-gray-darkgray mr-10 font-13"><i
                                                        class="fa fa-commenting-o mr-5 text-theme-colored"></i> 214 Comments</span>
                                            <span class="mb-10 text-gray-darkgray mr-10 font-13"><i
                                                        class="fa fa-heart-o mr-5 text-theme-colored"></i> 895 Likes</span>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-10">{{$news['short_description'] }}</p>
                                <a href="#" class="btn-read-more">{{trans('messages.read_more')}}</a>
                                <div class="clearfix"></div>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <article class="post clearfix mb-sm-30 bg-silver-light">
                            <div class="entry-header">
                                <div class="post-thumb thumb">
                                    <img src="{{ URL::asset('/public/assets/global/images/blog/1.jpg') }}" alt=""
                                         class="img-responsive img-fullwidth">
                                </div>
                            </div>
                            <div class="entry-content p-20 pr-10">
                                <div class="entry-meta media mt-0 no-bg no-border">
                                    <div class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">
                                        <ul>
                                            <li class="font-16 text-white font-weight-600 border-bottom">28</li>
                                            <li class="font-12 text-white text-uppercase">Feb</li>
                                        </ul>
                                    </div>
                                    <div class="media-body pl-15">
                                        <div class="event-content pull-left flip">
                                            <h4 class="entry-title text-white text-uppercase m-0 mt-5"><a href="#">Post
                                                    title here</a></h4>
                                            <span class="mb-10 text-gray-darkgray mr-10 font-13"><i
                                                        class="fa fa-commenting-o mr-5 text-theme-colored"></i> 214 Comments</span>
                                            <span class="mb-10 text-gray-darkgray mr-10 font-13"><i
                                                        class="fa fa-heart-o mr-5 text-theme-colored"></i> 895 Likes</span>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-10">Lorem ipsum dolor sit amet, consectetur adipisi cing elit. Molestias
                                    eius illum libero dolor nobis deleniti, sint assumenda. Pariatur iste veritatis
                                    excepturi, ipsa optio nobis.</p>
                                <a href="#" class="btn-read-more">Read more</a>
                                <div class="clearfix"></div>
                            </div>
                        </article>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <article class="post clearfix mb-sm-30 bg-silver-light">
                            <div class="entry-header">
                                <div class="post-thumb thumb">
                                    <img src="{{ URL::asset('/public/assets/global/images/blog/2.jpg') }}" alt=""
                                         class="img-responsive img-fullwidth">
                                </div>
                            </div>
                            <div class="entry-content p-20 pr-10">
                                <div class="entry-meta media mt-0 no-bg no-border">
                                    <div class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">
                                        <ul>
                                            <li class="font-16 text-white font-weight-600 border-bottom">28</li>
                                            <li class="font-12 text-white text-uppercase">Feb</li>
                                        </ul>
                                    </div>
                                    <div class="media-body pl-15">
                                        <div class="event-content pull-left flip">
                                            <h4 class="entry-title text-white text-uppercase m-0 mt-5"><a href="#">Post
                                                    title here</a></h4>
                                            <span class="mb-10 text-gray-darkgray mr-10 font-13"><i
                                                        class="fa fa-commenting-o mr-5 text-theme-colored"></i> 214 Comments</span>
                                            <span class="mb-10 text-gray-darkgray mr-10 font-13"><i
                                                        class="fa fa-heart-o mr-5 text-theme-colored"></i> 895 Likes</span>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-10">Lorem ipsum dolor sit amet, consectetur adipisi cing elit. Molestias
                                    eius illum libero dolor nobis deleniti, sint assumenda. Pariatur iste veritatis
                                    excepturi, ipsa optio nobis.</p>
                                <a href="#" class="btn-read-more">Read more</a>
                                <div class="clearfix"></div>
                            </div>
                        </article>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <article class="post clearfix mb-sm-30 bg-silver-light">
                            <div class="entry-header">
                                <div class="post-thumb thumb">
                                    <img src="{{ URL::asset('/public/assets/global/images/blog/3.jpg') }}" alt=""
                                         class="img-responsive img-fullwidth">
                                </div>
                            </div>
                            <div class="entry-content p-20 pr-10">
                                <div class="entry-meta media mt-0 no-bg no-border">
                                    <div class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">
                                        <ul>
                                            <li class="font-16 text-white font-weight-600 border-bottom">28</li>
                                            <li class="font-12 text-white text-uppercase">Feb</li>
                                        </ul>
                                    </div>
                                    <div class="media-body pl-15">
                                        <div class="event-content pull-left flip">
                                            <h4 class="entry-title text-white text-uppercase m-0 mt-5"><a href="#">Post
                                                    title here</a></h4>
                                            <span class="mb-10 text-gray-darkgray mr-10 font-13"><i
                                                        class="fa fa-commenting-o mr-5 text-theme-colored"></i> 214 Comments</span>
                                            <span class="mb-10 text-gray-darkgray mr-10 font-13"><i
                                                        class="fa fa-heart-o mr-5 text-theme-colored"></i> 895 Likes</span>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-10">Lorem ipsum dolor sit amet, consectetur adipisi cing elit. Molestias
                                    eius illum libero dolor nobis deleniti, sint assumenda. Pariatur iste veritatis
                                    excepturi, ipsa optio nobis.</p>
                                <a href="#" class="btn-read-more">Read more</a>
                                <div class="clearfix"></div>
                            </div>
                        </article>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
