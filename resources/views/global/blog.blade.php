@extends('layouts.global.global_layout')
@section('content')
    <div class="main-content">

        <!-- Section: inner-header -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-stellar-background-ratio="0.5" data-bg-img="images/bg/bg1.jpg">
            <div class="container pt-100 pb-50">
                <!-- Section Content -->
                <div class="section-content pt-100">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="title text-white">Blog</h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container mt-30 mb-30 pt-30 pb-30">
                <div class="row ">
                    <div class="col-md-9 pull-right flip sm-pull-none">
                        <div class="blog-posts">
                            @foreach($posts as $post)
                            <div class="col-md-6">
                                <article class="post clearfix mb-30 bg-lighter">
                                    <div class="entry-header">
                                        <div class="post-thumb thumb">
                                            <img src="{{asset('/public/assets/global/images/blog/1.jpg')}}" alt="" class="img-responsive img-fullwidth">
                                        </div>
                                    </div>
                                    <div class="entry-content p-20 pr-10">
                                        <div class="entry-meta media mt-0 no-bg no-border">
                                            <div class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">
                                                <ul>
                                                    <li class="font-16 text-white font-weight-600">{{jdate("d",strtotime($post->posted_at))}}</li>
                                                    <li class="font-12 text-white text-uppercase">{{jdate("F",strtotime($post->posted_at))}}</li>
                                                </ul>
                                            </div>
                                            <div class="media-body pl-15">
                                                <div class="event-content pull-left flip">
                                                    <h4 class="entry-title text-white text-uppercase m-0 mt-5"><a href="#">{{$post->title}}</a></h4>
                                                    <span class="mb-10 text-gray-darkgray mr-10 font-13"><i class="fa fa-commenting-o mr-5 text-theme-colored"></i> 214 Comments</span>
                                                    <span class="mb-10 text-gray-darkgray mr-10 font-13"><i class="fa fa-heart-o mr-5 text-theme-colored"></i> 895 Likes</span>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mt-10">{{$post->subtitle}}</p>
                                        <a href="#" class="btn-read-more pull-left">
                                            {{__('messages.continue_post')}}
                                        </a>
                                        <div class="clearfix"></div>
                                    </div>
                                </article>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="sidebar sidebar-right mt-sm-30">
                            <div class="widget">
                                <h5 class="widget-title line-bottom">{{__('messages.category')}}</h5>
                                <ul class="list-divider list-border list check">
                                    @forelse(\WebDevEtc\BlogEtc\Models\BlogEtcCategory::orderBy("category_name","asc")->limit(1000)->get() as $category)
                                            <li><a href="#">{{$category->category_name}}</a></li>
                                    @empty
                                        <div class='col-md-12'>
                                            {{trans('messages.no_categories')}}
                                        </div>
                                    @endforelse
                                </ul>
                            </div>
                            <div class="widget">
                                <h5 class="widget-title line-bottom">Twitter Feed</h5>
                                <div class="twitter-feed list-border clearfix" data-username="Envato"></div>
                            </div>
                            <div class="widget">
                                <h5 class="widget-title line-bottom">Image gallery with text</h5>
                                <div class="owl-carousel-1col">
                                    <div class="item">
                                        <img src="https://placehold.it/365x230" alt="">
                                        <h4 class="title">This is a Demo Title</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae illum amet illo.</p>
                                    </div>
                                    <div class="item">
                                        <img src="https://placehold.it/365x230" alt="">
                                        <h4 class="title">This is a Demo Title</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae illum amet illo.</p>
                                    </div>
                                    <div class="item">
                                        <img src="https://placehold.it/365x230" alt="">
                                        <h4 class="title">This is a Demo Title</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae illum amet illo.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="widget">
                                <h5 class="widget-title line-bottom">Tags</h5>
                                <div class="tags">
                                    <a href="#">travel</a>
                                    <a href="#">blog</a>
                                    <a href="#">lifestyle</a>
                                    <a href="#">feature</a>
                                    <a href="#">mountain</a>
                                    <a href="#">design</a>
                                    <a href="#">restaurant</a>
                                    <a href="#">journey</a>
                                    <a href="#">classic</a>
                                    <a href="#">sunset</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
