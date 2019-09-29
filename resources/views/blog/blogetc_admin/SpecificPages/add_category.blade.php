@extends("blog.blogetc_admin.layouts.admin_layout")
<?php
$active_sidbare = ['blog', 'blog_Specific_page', 'list']
?>
@section("content")
    <div class="content">
        <div class="card">
            <div class="card-header bg-light">
                <span class="card-title">{{__('messages.Specific_page')}}</span>
            </div>
            <div class="card-body">
                <form method='post' action='{{route("blogetc.admin.SpecificPages.create_category")}}'
                      enctype="multipart/form-data">
                    @csrf
                    @include("blog.blogetc_admin.SpecificPages.form", ['category' => new \WebDevEtc\BlogEtc\Models\BlogEtcSpecificPages()])
                    <div class="form-group pull-left">
                    <button type='submit' class='btn btn-primary' value='Add new category'>
                        {{trans('messages.add_new',['item'=>__('messages.Specific_page')])}}
                    </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection