@extends("blog.blogetc_admin.layouts.admin_layout")
<?php
$active_sidbare = ['blog', 'blog_images', 'add_blog_images']
?>
@section("content")
    <div class="content">
        <div class="card">
            <div class="card-header bg-light">
                <span class="card-title">{{__('messages.image_upload')}}</span>
            </div>
            <div class="card-body">
                <form method='post' action='{{route("blogetc.admin.images.store")}}' enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="upload">{{__('messages.title')}}</label>
                            <small id="image_title_help"
                                   class="form-text text-muted">{{__('messages.image_title')}}</small>
                            <input required class="form-control" type="text" name="image_title" id="image_title"
                                   aria-describedby="image_title_help">
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="upload">{{__('messages.select_image')}}</label>
                            <small id="blog_upload_help"
                                   class="form-text text-muted">{{__('messages.image_upload')}}</small>
                            <input required class="form-control" type="file" name="upload" id="upload"
                                   aria-describedby="upload_help">
                        </div>
                        <div class="col-12 col-md-12 form-group">
                            <label>{{__('messages.change_size_to')}}: </label>
                                <div class="custom-control custom-checkbox ">
                                    <input type='checkbox'
                                           class="custom-control-input"
                                           name='sizes_to_upload[blogetc_full_size]'
                                           value='true'
                                           checked
                                           id='size_blogetc_full_size'>
                                    <label class="custom-control-label"
                                           for='size_blogetc_full_size'>{{__('messages.full_size')}}</label>
                                </div>
                            @foreach((array)config('blogetc.image_sizes') as $size => $image_size_details)
                                <div class="custom-control custom-checkbox ">
                                    <input type='checkbox' name='sizes_to_upload[{{$size}}]'
                                           class="custom-control-input "
                                           value='true' checked
                                           id='size_{{$size}}'>
                                    <label class="custom-control-label"
                                           for='size_{{$size}}'>{{$image_size_details['name']}}
                                        - {{$image_size_details['w']}} x {{$image_size_details['h']}}px</label>
                                </div>
                            @endforeach

                        </div>
                        <div class="col-12 col-md-12 form-group pull-left">
                            <input type='submit' class='btn btn-primary pull-left'
                                   value='{{{__('messages.image_upload')}}}'>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection