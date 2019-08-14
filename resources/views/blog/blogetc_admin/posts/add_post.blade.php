@extends("blog.blogetc_admin.layouts.admin_layout")
@section("js")
    <script src="{{URL::asset('/public/assets/panel/js/ckeditor/ckeditor.js')}}"></script>
@endsection
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
        $(document).ready(function () {
            CKEDITOR.replace('post_text', {
                language: 'fa',
                uiColor: '#9AB8F3',

            });
        });
    </script>
@endsection

