@extends("blog.blogetc_admin.layouts.admin_layout")
<?php
$active_sidbare = ['blog', 'blog_categories', 'all_blog_categories']
?>
@section("content")
    <div class="content">
        <div class="card">
            <div class="card-header bg-light">
                <span class="card-title">{{__('messages.edit_category')}}</span>
            </div>
            <div class="card-body">
                <form method='post' action='{{route("blogetc.admin.categories.edit_category",$category->id)}}'
                      enctype="multipart/form-data">
                    @csrf
                    @method("patch")
                    @include("blog.blogetc_admin.categories.form", ['category' => $category])
                    <div class="form-group pull-left">
                        <input type='submit' class='btn btn-primary' value='{{__('messages.save')}}'>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

