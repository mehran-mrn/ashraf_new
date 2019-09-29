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
$active_sidbare = ['blog', 'blog_posts', 'blog_posts_add']
?>
@section("content")
    <div class="content">
        <div class="card">
            <div class="card-header  bg-light">
                <span class="card-title">{{__('messages.new_post')}}</span>
            </div>
            <div class="card-body">
                <form method='post' action='{{route("blogetc.admin.store_post")}}' enctype="multipart/form-data">
                    @csrf
                    @include("blog.blogetc_admin.posts.form", ['post' => new \WebDevEtc\BlogEtc\Models\BlogEtcPost()])
                    <div class="form-group pull-left">
                        <button type='submit' class='btn btn-primary'
                                value='Add new post'>{{trans('messages.add_new',['item'=>__('messages.post')])}}</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
@section('footer_js')
    <script>

    </script>
@endsection

