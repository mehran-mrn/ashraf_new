@extends("blog.blogetc_admin.layouts.admin_layout")
@section("content")
    <div class="container">
        <div class="row">
    <?php
    $active_sidbare = ['blog','blog_categories','add_blog_category']
    ?>

    <h5>Admin - Add Category</h5>

    <form method='post' action='{{route("blogetc.admin.categories.create_category")}}'  enctype="multipart/form-data" >

        @csrf
        @include("blog.blogetc_admin.categories.form", ['category' => new \WebDevEtc\BlogEtc\Models\BlogEtcCategory()])

        <input type='submit' class='btn btn-primary' value='Add new category' >

    </form>
        </div>
    </div>
@endsection