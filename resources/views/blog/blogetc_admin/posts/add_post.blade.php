@extends("blog.blogetc_admin.layouts.admin_layout")
@section("content")
    <div class="container">
        <div class="row">
    <?php
    $active_sidbare = ['blog','blog_posts','blog_posts_add']
    ?>

    <h5>Admin - Add post</h5>

    <form method='post' action='{{route("blogetc.admin.store_post")}}'  enctype="multipart/form-data" >

        @csrf
        @include("blog.blogetc_admin.posts.form", ['post' => new \WebDevEtc\BlogEtc\Models\BlogEtcPost()])

        <input type='submit' class='btn btn-primary' value='Add new post' >

    </form>
        </div>
    </div>
@endsection