@extends("blog.blogetc_admin.layouts.admin_layout")
<?php
$active_sidbare = ['blog', 'blog_categories', 'all_blog_categories']
?>
@section("content")
    <div class="content">
        <div class="container-fluid">
            <section>
                <button
                        class="btn btn-primary m-2 py-2 px-3 "
                        data-toggle="modal"
                        data-modal-title="{{trans('messages.add_category',['item'=>trans('messages.category')])}}"
                        data-target="#general_modal">{{__('messages.add_item',['item'=>__('messages.category')])}}
                </button>
            </section>
        </div>
        @if(sizeof($categories))
            <section>
                <div class="card">
                    <div class="card-header bg-light">
                        <span class="card-title">{{__('messages.categories')}}</span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($categories as $category)
                                <div class="col-md-4">
                                    <div class="card">

                                        <div class="card-body">
                                            <h5 class="card-title"><a
                                                        href="{{$category->url()}}">{{$category->category_name}}</a>
                                            </h5>
                                            <p class="card-text"></p>
                                        </div>
                                        <div class="card-footer bg-light">
                                            <div class="btn-group pull-left">
                                                <a href="{{$category->url()}}"
                                                   class="float-right btn alpha-success border-success-400 text-success-800 btn-icon rounded-round ml-2">
                                                    <i class="icon-eye8"></i>
                                                </a>
                                                <a href="{{$category->edit_url()}}"
                                                   class="float-right btn alpha-info border-info-400 text-info-800 btn-icon rounded-round ml-2">
                                                    <i class="icon-pencil"></i>
                                                </a>
                                                <button type="submit"
                                                        class="legitRipple  float-right btn alpha-pink border-pink-400 text-pink-800 btn-icon rounded-round ml-2 swal-alert "
                                                        data-ajax-link="{{route('blogetc.admin.categories.destroy_category',['id'=>$category->id])}}"
                                                        data-method="delete"
                                                        data-csrf="{{csrf_token()}}"
                                                        data-title="{{trans('messages.delete_item',['item'=>trans('messages.category')])}}"
                                                        data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.category')])}}"
                                                        data-type="warning"
                                                        data-cancel="true"
                                                        data-confirm-text="{{trans('messages.delete')}}"
                                                        data-cancel-text="{{trans('messages.cancel')}}"><i
                                                            class="icon-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @else
            @include('panel.not_found',['html'=>'<a class="btn btn-primary" href="'.route('blogetc.admin.categories.create_category').'">
                '.__('messages.add_new_category').'</a>',
                              'msg'=>__('messages.not_found_any_data'),
                           'des'=>__('messages.no_found_any',['item'=>__('messages.category')])])
        @endif
        <div class='text-center'>
            {{$categories->appends( [] )->links()}}
        </div>

        <div id="general_modal" class="modal fade ">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h6 class="modal-title">{{__('messages.add_image')}}</h6>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
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
        </div>
    </div>

@endsection