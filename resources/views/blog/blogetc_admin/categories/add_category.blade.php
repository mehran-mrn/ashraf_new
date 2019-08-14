@extends("blog.blogetc_admin.layouts.admin_layout")
<?php
$active_sidbare = ['blog', 'blog_categories', 'add_blog_category']
?>
@section("content")
    <div class="content">
        <div class="card">
            <div class="card-header bg-light">
                <span class="card-title">{{__('messages.categories')}}</span>
            </div>
            <div class="card-body">
                <form method='post' action='{{route("blogetc.admin.categories.create_category")}}'
                      enctype="multipart/form-data">
                    @csrf
                    @include("blog.blogetc_admin.categories.form", ['category' => new \WebDevEtc\BlogEtc\Models\BlogEtcCategory()])
                    <div class="form-group pull-left">
                    <button type='submit' class='btn btn-primary' value='Add new category'>
                        {{trans('messages.add_new',['item'=>__('messages.category')])}}
                    </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection