@extends('layouts.global.global_layout')
@section('title',__('messages.blog'). " |")

@section('content')
    <div class="main-content">

        <!-- Section: inner-header -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-5"
                 data-stellar-background-ratio="0.5"
                 data-bg-img="{{asset(url('/public/assets/global/images/bg/bg1.jpg'))}}">
            <div class="container pt-100 pb-50">
                <!-- Section Content -->
                <div class="section-content pt-100">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="title text-white">{{__('messages.search_results_for') ." ". $query }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
                        @include('global.materials.sidebar')
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
