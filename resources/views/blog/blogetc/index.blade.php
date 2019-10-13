@extends('layouts.global.global_layout')
@section('title',__('messages.blog'). " |")

@section('content')
    <div class="main-content">
        <section>
            <div class="container mt-30 mb-30 pt-30 pb-30">
                <div class="row ">
                    <div class="col-md-9 pull-right  sm-pull-none">
                        <div class="blog-posts">
                            @forelse($posts as $post)
                                <div class="col-md-12">
                                    <article class="post clearfix mb-30 bg-lighter">
                                        <div class="col-sm-3 p-0 m-0">
                                            <div class="entry-content p-0">
                                                <div class="post-thumb thumb">
                                                    <img src="{{$post['image_medium'] ? URL::asset('public/images/'.config('blogetc.blog_upload_dir'))."/".$post['image_medium']:''}}"
                                                         alt=""
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
                                                            <h4 class="entry-title text-white text-uppercase m-0 mt-5">
                                                                <a
                                                                        href="{{route('post_page',$post->slug)}}">{{$post->title}}</a>
                                                            </h4>
                                                            <span class="mb-10 text-gray-darkgray mr-10 font-13"><i
                                                                        class="fa fa-commenting-o mr-5 text-theme-colored"></i> {{$post->comments()->count()}}</span>

                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="mt-10">{{$post->subtitle}}</p>
                                                <a href="{{route('post_page',$post->slug)}}"
                                                   class="btn-read-more pull-left">
                                                    {{__('messages.continue_post')}}
                                                </a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>

                                    </article>
                                </div>

                            @empty
                                <div class='alert alert-danger'>{{__('messages.nothing_to_display')}}</div>
                            @endforelse
                            <div class="col-md-12">
                                {{$posts->appends( [] )->links()}}
                            </div>
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
