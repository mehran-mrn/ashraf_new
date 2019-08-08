@extends("blog.blogetc_admin.layouts.admin_layout")
@section("content")
    <div class="container">
        <div class="row">

    <h5>Admin - Edit Category</h5>

    <form method='post' action='{{route("blogetc.admin.categories.edit_category",$category->id)}}'  enctype="multipart/form-data" >

        @csrf
        @method("patch")
        @include("blog.blogetc_admin.categories.form", ['category' => $category])

        <input type='submit' class='btn btn-primary' value='Save Changes' >

    </form>
        </div>
    </div>
@endsection