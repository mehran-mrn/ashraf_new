@extends("blog.blogetc_admin.layouts.admin_layout")
@section("content")
    <div class="container">
        <div class="row">
    <?php
    $active_sidbare = ['blog','blog_categories','add_blog_category']
    ?>

<div class="card m-1">
<div class="card-body">

    <form method='post' action='{{route("blogetc.admin.categories.create_category")}}'  enctype="multipart/form-data" >

        @csrf
        @include("blog.blogetc_admin.categories.form", ['category' => new \WebDevEtc\BlogEtc\Models\BlogEtcCategory()])

        <button type='submit' class='btn btn-primary' value='Add new category' >
        {{trans('messages.add_new',['item'=>__('messages.category')])}}
        </button>

    </form>
        </div>
    </div>

        </div>
    </div>
@endsection