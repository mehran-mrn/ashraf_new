@extends('layouts.global.global_layout')
@section('title',__('messages.blog'). " |")

@section('content')
    <div class="main-content">

        <!-- Section: inner-header -->
        <section>
            <div class="container mt-30 mb-30 pt-30 pb-30">
                <div class="row ">
                    <div class="col-md-9 pull-right  sm-pull-none">
                        <div class="blog-posts">
                            @forelse($search_results as $result)
                                <?php $post = $result->indexable; ?>
                                    @if($post && is_a($post,\WebDevEtc\BlogEtc\Models\BlogEtcPost::class))

                                <div class="col-md-12">
                                    <article class="post clearfix mb-30 bg-lighter">

                                        <div class="col-sm-3 p-0 m-0">
                                        <div class="entry-content p-0">
                                            <div class="post-thumb thumb">
                                                <img src="{{$post['image_medium'] ? URL::asset('public/images/'.config('blogetc.blog_upload_dir'))."/".$post['image_medium']:''}}" alt=""
                                                     class="img-responsive img-fullwidth">
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-sm-9 p-0 m-0">
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
                                                        <h4 class="entry-title text-white text-uppercase m-0 mt-5"><a
                                                                    href="{{route('post_page',$post->slug)}}">{{$post->title}}</a></h4>
                                                        <span class="mb-10 text-gray-darkgray mr-10 font-13"><i
                                                                    class="fa fa-commenting-o mr-5 text-theme-colored"></i> {{$post->comments()->count()}}</span>

                                                    </div>
                                                </div>
                                            </div>
                                            <p class="mt-10">{{$post->subtitle}}</p>
                                            <a href="{{route('post_page',$post->slug)}}" class="btn-read-more pull-left">
                                                {{__('messages.continue_post')}}
                                            </a>
                                            <div class="clearfix"></div>
                                        </div>
                                </div>

                                        </article>
                                </div>
                                    @else
                                        <div class='alert alert-danger'>{{__('messages.search_results_cant_display')}}</div>
                                    @endif
                            @empty
                                <div class='alert alert-danger'>{{__('messages.search_results_null',['query'=>$query])}}</div>
                            @endforelse
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