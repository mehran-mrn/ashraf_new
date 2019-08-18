@extends("blog.blogetc_admin.layouts.admin_layout")
<?php
$active_sidbare = ['blog', 'blog_images', 'blog_posts_list']
?>
@section('footer_js')
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/media/fancybox.min.js')}}"></script>
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/demo_pages/gallery.js')}}"></script>
    <script>
        function show_uploaded_file_row(id, img) {
            [].forEach.call(document.querySelectorAll('.' + id), function (el) {
                el.style.display = 'block';
            });
            document.getElementById(id).innerHTML = "<a href='" + img + "'><img src='" + img + "' style='max-width:100%; height:auto;'></a>";
        }
    </script>
@stop
@section("content")
    <div class="content">
        @if(sizeof($uploaded_photos)>=1)
            <section>
                <div class='row'>
                    @foreach($uploaded_photos as $uploadedPhoto)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <span class="card-title">
                                        {{__('messages.images_id')}} {{$uploadedPhoto->id}}:
                                        {{$uploadedPhoto->image_title ?? __('messages.untitled_photo')}}
                                    </span>
                                </div>
                                <div class="card-body">
                                    <small title='{{$uploadedPhoto->created_at}}'>
                                        {{__('messages.uploaded_on')}}
                                        : {{$uploadedPhoto->created_at->diffForHumans()}}</small>
                                    <div class='row'>

                                        <div class='col-md-12'>
                                            <div class='row'>
                                                <?php
                                                $smallest = null;
                                                $smallest_size = -1;
                                                foreach ($uploadedPhoto->uploaded_images as $file_key => $file) {
                                                $id = "uploaded_" . ($uploadedPhoto->id) . "_" . $file_key;
                                                ?>
                                                <div class='col-md-6'>
                                                    <div class="flex flex-row">
                                                        <div class="text-center">
                                                            <strong>{{$file_key}}</strong>
                                                        </div>
                                                        <div class="text-center">
                                                            <small>{{$file['w']}}
                                                                x {{$file['h']}}</small>
                                                        </div>
                                                    </div>
                                                    <div class='btn-group'>
                                                        <a href='{{asset('public/images/'.config("blogetc.blog_upload_dir") . "/". $file['filename'])}}'
                                                           data-popup="lightbox"
                                                           class='btn btn-sm btn-info'
                                                           rel="group">{{__('messages.zoom_in')}}</a>
                                                        <span class='btn btn-sm btn-primary'
                                                              style='cursor: zoom-in;'
                                                              onclick='show_uploaded_file_row("{{$id}}","{{asset('public/images/'.config("blogetc.blog_upload_dir") . "/". $file['filename'])}}")'>{{__('messages.address')}}
                                                        </span>
                                                    </div>

                                                    <div id="{{$id}}"></div>
                                                </div>
                                                <div class='col-md-6 {{$id}}' style='display:none;'>
                                                    <div style=''>
                                                        <small class='text-muted'>{{__('messages.image_url')}}</small>
                                                        <input type='text' readonly='readonly' class='form-control'
                                                               value='{{asset('public/images/'.config("blogetc.blog_upload_dir") . "/". $file['filename'])}}'>
                                                    </div>
                                                </div>
                                                <div class='col-md-6 {{$id}}' style='display:none;'>
                                                    <div style=''>
                                                        <small class='text-muted'>{{__('messages.image_tag')}}</small>
                                                        <input type='text' readonly='readonly' class='form-control'
                                                               value='{{"<img src='".asset('public/images/'.config("blogetc.blog_upload_dir") . "/". $file['filename'])."' alt='" . e($uploadedPhoto->image_title) . "' >"}}'>
                                                    </div>
                                                </div>
                                                <?php
                                                $area = $file['w'] * $file['h'];
                                                if ($area < $smallest_size || $smallest_size < 0) {
                                                    $smallest = $file;
                                                    $smallest_size = $area;
                                                }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class='col-md-12'>
                                            @if($smallest)
                                                <div style='text-align:center;'>
                                                    <a style='cursor: zoom-in;'
                                                       href='{{asset('public/images/'.config("blogetc.blog_upload_dir") . "/". $smallest['filename'])}}'
                                                       target='_blank'>
                                                        <img src='{{asset('public/images/'.config("blogetc.blog_upload_dir") . "/". $smallest['filename'])}}'
                                                             style='max-width:100%; height: auto;'>
                                                    </a>
                                                </div>
                                            @else
                                                <div class='alert alert-danger'>No image found</div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class='col-12 justify-content-between'>
                        {{$uploaded_photos->appends( [] )->links()}}
                    </div>
                </div>
            </section>
        @else
            @include('panel.not_found',['html'=>'',
            'msg'=>__('messages.not_found_any_data'),
            'des'=>__('messages.no_found_any',['item'=>__('messages.image')])])
        @endif

    </div>
@endsection