@extends("blog.blogetc_admin.layouts.admin_layout")
@section("content")
    <div class="container">
        <div class="row">
    <?php
    $active_sidbare = ['blog','blog_posts']
    ?>

    <h5>Admin - Editing post
    <a target='_blank' href='{{$post->url()}}' class='float-right btn btn-primary'>View post</a>
    </h5>

    <form method='post' action='{{route("blogetc.admin.update_post",$post->id)}}'  enctype="multipart/form-data" >

        @csrf
        @method("patch")
        @include("blog.blogetc_admin.posts.form", ['post' => $post])

        <input type='submit' class='btn btn-primary' value='Save Changes' >

    </form>
        </div></div>
@endsection