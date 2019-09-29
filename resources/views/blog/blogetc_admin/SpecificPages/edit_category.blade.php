@extends("blog.blogetc_admin.layouts.admin_layout")
<?php
$active_sidbare = ['blog', 'blog_Specific_page', 'list']
?>
@section("content")
    <div class="content">
        <div class="card">
            <div class="card-header bg-light">
                <span class="card-title">{{__('messages.edit')}}</span>
            </div>
            <div class="card-body">
                <form method='post' action='{{route("blogetc.admin.SpecificPages.edit_category",$category->id)}}'
                      enctype="multipart/form-data">
                    @csrf
                    @method("patch")
                    @include("blog.blogetc_admin.SpecificPages.form", ['category' => $category])
                    <div class="form-group pull-left">
                        <input type='submit' class='btn btn-primary' value='{{__('messages.save')}}'>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

