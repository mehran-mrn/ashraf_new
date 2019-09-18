@extends("blog.blogetc_admin.layouts.admin_layout")
<?php
$active_sidbare = ['blog', 'blog_comments']
?>
@section("content")
    <section>
        <div class="content">
            <div class="row">
                @forelse ($comments as $comment)
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header bg-light">
                                <span class="panel-title">{{$comment->author()}} {{__('messages.comment')}}:</span>
                                <div class="float-right ">
                                    <span>{{__('messages.create_date')}}: </span>
                                    <strong dir="ltr">{{jdate("Y-m-d H:i:s",strtotime($comment->created_at))}}</strong>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class='card-title'>
                                    @if($comment->post)
                                        <a href='{{$comment->post->url()}}'>{{$comment->post->title}}</a>
                                    @else
                                        Unknown blog post
                                    @endif
                                </h5>
                                <p class='m-3 p-2'>{{$comment->comment}}</p>
                            </div>
                            <div class="card-footer">
                                @if($comment->post)
                                    <div class="btn-group">
                                        <a href="{{$comment->post->url()}}" class="card-link btn btn-outline-secondary"><i
                                                    class="fa fa-file-text-o"
                                                    aria-hidden="true"></i>
                                            {{__('messages.show_post')}}</a>
                                        <a href="{{$comment->post->edit_url()}}" class="card-link btn btn-primary">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            {{__('messages.edit_post')}}</a>
                                    </div>
                                @endif

                                <div class="btn-group float-right">
                                    @if(!$comment->approved)
                                        <form method='post'
                                              action='{{route("blogetc.admin.comments.approve", $comment->id)}}'>
                                            @csrf
                                            @method("PATCH")
                                            <button type='submit'
                                                    class='card-link btn btn-outline-success'>{{__('messages.approve')}}</button>
                                        </form>
                                    @endif
                                    <form
                                            onsubmit="return confirm('Are you sure you want to delete this blog post comment?\n You cannot undo this action!');"
                                            method='post'
                                            action='{{route("blogetc.admin.comments.delete", $comment->id)}}'>
                                        @csrf
                                        @method("DELETE")
                                        <button type='submit'
                                                class='card-link btn btn-outline-danger'>{{__('messages.delete')}}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    @include('panel.not_found',['html'=>'',
                           'msg'=>__('messages.not_found_any_data'),
                           'des'=>__('messages.no_found_any',['item'=>__('messages.commentss')])])
                @endforelse
            </div>
            <div class='text-center'>
                {{$comments->appends( [] )->links()}}
            </div>
        </div>
    </section>
@endsection