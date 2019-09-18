@extends("blog.blogetc_admin.layouts.admin_layout")
@section("js")
    <script src="{{URL::asset('/public/assets/panel/js/ckeditor/ckeditor.js')}}"></script>
    <script src="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.js') }}"></script>
    <script>
        $(document).ready(function () {

            CKEDITOR.replace('post_text', {
                language: 'fa',
                uiColor: '#9AB8F3',

            });
            $('#blog_posted_at_btn').MdPersianDateTimePicker({
                targetTextSelector: '#blog_posted_at',
                enableTimePicker: true,
                englishNumber: true,
            });
        });
    </script>
@endsection
@section('css')
    <link href="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.style.css') }}"
          rel="stylesheet" type="text/css">
@stop
<?php
$active_sidbare = ['blog', 'blog_posts']
?>
@section("content")
    <section>
        <div class="content">
            <div class="container-fluid">
                <section>
                    <a target='_blank' href='{{route('post_page',$post->slug)}}'
                       class="btn btn-primary m-2 py-2 px-3 ">{{__("messages.show_post")}}</a>
                </section>
                <div class="card">
                    <div class="card-header bg-light">
                        <span class="card-title">{{__('messages.edit_post')}}</span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <form method='post' action='{{route("blogetc.admin.update_post",$post->id)}}'
                                  enctype="multipart/form-data">

                                @csrf
                                @method("patch")
                                @include("blog.blogetc_admin.posts.form", ['post' => $post])

                                <div class="form-group pull-left">
                                    <button type='submit' class='btn btn-primary'>
                                        {{__('messages.edit_post')}}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
