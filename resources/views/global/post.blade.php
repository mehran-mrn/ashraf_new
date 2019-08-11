@extends('layouts.global.global_layout')
@section('content')
    <div class="main-content">

        <!-- Section: inner-header -->

        <!-- Section: Blog -->
        <section>
            <div class="container mt-30 mb-30 pt-30 pb-30">
                <div class="row">
                    <div class="col-md-9 pull-right flip sm-pull-none">
                        <div class="blog-posts single-post">
                            <article class="post clearfix mb-0">
                                <div class="entry-header">
                                    <div class="post-thumb thumb"> <img src="{{ URL::asset('public/'.config('blogetc.blog_upload_dir'))."/".$post['image_large']}}" alt="" class="img-responsive img-fullwidth"> </div>
                                </div>
                                <div class="entry-content">
                                    <div class="entry-meta media no-bg no-border mt-15 pb-20">
                                        <div class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">
                                            <ul>
                                                <li class="font-16 text-white font-weight-600">{{miladi_to_shamsi_date($post['posted_at'],true)[2]}}</li>
                                                <li class="font-12 text-white text-uppercase">{{jdate('F',strtotime($post['posted_at']))}}</li>
                                            </ul>
                                        </div>
                                        <div class="media-body pl-15">
                                            <div class="event-content pull-left flip">
                                                <h4 class="entry-title text-white text-uppercase m-0"><a href="#">{{$post['title']}}</a></h4>
                                                @if(count($comments)>0)
                                                <span class="mb-10 text-gray-darkgray mr-10 font-13"><i class="fa fa-commenting-o mr-5 text-theme-colored"></i> {{count($comments) ." ".trans('messages.comment')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <b class="mb-20 mt-15">{{$post['subtitle']}}</b>
                                    <div class="">
                                    {!! $post['post_body'] !!}
                                    </div>
                                    <div class="mt-30 mb-0">
                                        <p class="mt-10 mr-20 text-theme-colored">{{trans('messages.posted')}} <strong>{{$post->posted_at->diffForHumans()}}</strong></p>
                                        <h5 class="pull-left mt-10 mr-20 text-theme-colored">Share:</h5>
                                        <ul class="styled-icons icon-circled m-0">
                                            <li><a href="#" data-bg-color="#3A5795" style="background: rgb(58, 87, 149) !important;"><i class="fa fa-facebook text-white"></i></a></li>
                                            <li><a href="#" data-bg-color="#55ACEE" style="background: rgb(85, 172, 238) !important;"><i class="fa fa-twitter text-white"></i></a></li>
                                            <li><a href="#" data-bg-color="#A11312" style="background: rgb(161, 19, 18) !important;"><i class="fa fa-google-plus text-white"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </article>
                            <div class='tagline p-0 pt-20 mt-5'>
                                @foreach($post->categories as $category)
                                    <a class='btn btn-outline-success btn-sm m-1' href='{{$category->url()}}'>
                                        {{$category->category_name}}
                                    </a>
                                @endforeach
                            </div>

                            <div class="author-details media-post">
                                <a href="#" class="post-thumb mb-0 pull-left flip pr-20"><img class="post-thumb-img img-thumbnail" alt="" src="{{url('public/assets/global/images/unknown-avatar.png')}}"></a>
                                <div class="post-right">
                                    <p disabled="" class="post-title m-1"><a href="#" class="font-18"><strong>{{$post->author->name}}</strong>
                                        </a></p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            @if(config("blogetc.comments.type_of_comments_to_show","built_in") !== 'disabled')
                                <hr>
                            <div class="comments-area">
                                <h5 class="comments-title">{{trans('messages.comments')}}</h5>
                                <ul class="comment-list">
                                    @forelse($comments as $comment)

                                    <li>
                                        <div class="media comment-author"> <a class="media-left pull-left flip" href="#"><img class="comment-thumb-img img-thumbnail" src="{{url('public/assets/global/images/unknown-avatar.png')}}" alt=""></a>
                                            <div class="media-body">
                                                <h5 class="media-heading comment-heading">{{$comment->author()}}:</h5>
                                                <div class="comment-date">{{miladi_to_shamsi_date($comment->created_at)}}</div>
                                                @if(config("blogetc.comments.ask_for_author_website") && $comment->author_website)
                                                    <div class="comment-date">
                                                    (<a href='{{$comment->author_website}}' target='_blank' rel='noopener'>website</a>)
                                                    </div>
                                                @endif
                                                <p>{!! nl2br(e($comment->comment))!!}</p>

                                            </div>
                                        </div>
                                    </li>
                                    @empty
                                        <div class='alert alert-info'>{{trans('messages.no_comment_yet')}}</div>
                                    @endforelse
                                </ul>
                                @if(count($comments)> config("blogetc.comments.max_num_of_comments_to_show",500) - 1)
                                    <p><em>Only the first {{config("blogetc.comments.max_num_of_comments_to_show",500)}} comments are
                                            shown.</em>
                                    </p>
                                @endif
                            </div>
                                <hr>
                            <div class="comment-box">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h5>{{trans('messages.leave_a_comment')}}</h5>
                                        <div class="row">
                                            <form method='post' role="form" id="comment-form" action='{{route("blogetc.comments.add_new_comment", $post->slug)}}'>
                                                @csrf
                                                <div class="col-sm-6 pt-0 pb-0">
                                                    @if(config("blogetc.comments.save_user_id_if_logged_in", true) == false || !\Auth::check())

                                                    <div class="form-group">
                                                        <input type="text" class="form-control" required="" name="author_name" id="author_name"
                                                               placeholder="{{trans('messages.name')}}" value="{{old("author_name")}}">
                                                    </div>
                                                        @if(config("blogetc.comments.ask_for_author_email"))

                                                        <div class="form-group">
                                                        <input type="text" required="" class="form-control"
                                                               name="author_email" id="contact_email2"
                                                               placeholder="{{trans('messages.email')}}"
                                                               value="{{old("author_email")}}">
                                                    </div>
                                                        @endif
                                                    @endif
                                                        @if(config("blogetc.comments.ask_for_author_website"))

                                                    <div class="form-group">
                                                        <input type="url" placeholder="Website Address"
                                                               required="" class="form-control"
                                                               name="author_website"
                                                               value="{{old("author_website")}}">
                                                    </div>
                                                        @endif

                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <textarea
                                                                class="form-control"
                                                                name='comment'
                                                                required
                                                                id="comment"
                                                                placeholder="{{trans('messages.comment_body')}}"
                                                                rows="7">{{old("comment")}}</textarea>
                                                    </div>

                                                    @if($captcha)
                                                        {{--Captcha is enabled. Load the type class, and then include the view as defined in the captcha class --}}
                                                        @include($captcha->view())
                                                    @endif
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-dark btn-flat pull-right m-0" data-loading-text="Please wait...">{{trans('messages.submit')}}</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--Comments are disabled--}}
                            @endif
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
