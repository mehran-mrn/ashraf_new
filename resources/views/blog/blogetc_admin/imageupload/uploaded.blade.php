@extends("blog.blogetc_admin.layouts.admin_layout")
<?php
$active_sidbare = ['blog', 'blog_images', 'add_blog_images']
?>
@section("content")
    <div class="content">
        @if(sizeof($images)>=1)
            <section>
                <div class="card">
                    <div class="card-header bg-light">
                        <span class="card-title">{{__('messages.image_upload')}}</span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($images as $image)
                                <div class="col-12 col-md-6">
                                    <h5>{{$image['filename']}} |
                                        <small>{{$image['w'] . "x" . $image['h']}}</small></h5>
                                    <a href='{{asset('public/images/'.config("blogetc.blog_upload_dir") . "/". $image['filename'])}}'
                                       target='_blank'>
                                        <img src='{{asset('public/images/'.config("blogetc.blog_upload_dir") . "/". $image['filename'])}}'
                                             style='max-width:400px; height: auto;'>
                                    </a>
                                    <input type='text' readonly='readonly' class='form-control' dir="ltr"
                                           value='{{asset('public/images/'.config("blogetc.blog_upload_dir") . "/". $image['filename'])}}'>
                                    <input type='text' readonly='readonly' class='form-control' dir="ltr"
                                           value='{{"<img src='".asset('public/images/'.config("blogetc.blog_upload_dir") . "/". $image['filename'])."' alt='' >"}}'>
                                </div>
                            @endforeach
                        </div>
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