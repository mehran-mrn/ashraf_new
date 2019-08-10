@extends("blog.blogetc_admin.layouts.admin_layout")
@section("content")
    <div class="container">
        <div class="row">
    <?php
    $active_sidbare = ['blog','blog_categories','all_blog_categories']
    ?>
    @forelse ($categories as $category)

        <div class="col-lg-4" >
        <div class="card m-2" >
            <div class="card-body">
                <h5 class='card-title'><a href='{{$category->url()}}'>{{$category->category_name}}</a></h5>


                <a href="{{$category->url()}}"  class="float-right btn alpha-success border-success-400 text-success-800 btn-icon rounded-round ml-2
                                             ">
                    <i class="icon-eye8"></i>
                </a>
                <a href="{{$category->edit_url()}}"  class="float-right btn alpha-info border-info-400 text-info-800 btn-icon rounded-round ml-2
                                             ">
                    <i class="icon-pencil"></i>
                </a>


                <form onsubmit="return confirm('Are you sure you want to delete this blog post?\n You cannot undo this action!');"
                      method='post' action='{{route("blogetc.admin.categories.destroy_category", $category->id)}}' class='float-right'>
                    @csrf

                    <input name="_method" type="hidden" value="Delete"/>
                    <button type="submit" value="Delete"
                            class="legitRipple  float-right btn alpha-pink border-pink-400 text-pink-800 btn-icon rounded-round ml-2">
                        <i class="icon-trash"></i>
                    </button>
                </form>




            </div>
        </div>
        </div>


    @empty
    <div class='alert alert-danger'>{{trans('messages.no_item_find')}}</div>
    @endforelse


    <div class='text-center'>
        {{$categories->appends( [] )->links()}}
    </div>
    </div>
    </div>

    @endsection