@extends('layouts.panel.panel_layout')

@section('content')
    <?php
    $active_sidbare = ['blog','blog_slider']
    ?>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header bg-light">
                        <a  class="btn btn-outline-info btn-lg "
                                href="{{route('slider_page')}}"><i
                                    class="icon-image5 mr-2"></i> {{trans('messages.add_new',['item'=>trans('messages.blog_slider')])}}
                        </a>
                    </div>

                    <div class="card-body">

                        @foreach($sliders->chunk(2) as $chunk)
                            <div class="row">
                                @foreach($chunk as $slider)
                                    <div class="col-md-6">
                                        <div class="card">

                                            <div class="card-img-actions px-1 pt-1">
                                                <img class="card-img img-fluid img-absolute "
                                                     src="{{$slider['image_large']}}" alt="">
                                                <div class="card-img-actions-overlay  card-img bg-dark-alpha">

                                                </div>
                                            </div>

                                            <div class="card-body">
                                            {!! $slider['text_1'] !!}<br>
                                            {!! $slider['text_2'] !!}<br>
                                            {!! $slider['text_3'] !!}<br>
                                            </div>
                                            <div class="card-footer">
                                                <a href="{{route('slider_page',['slider_id'=>$slider['id']])}}" class="float-right btn alpha-info border-info-400 text-info-800 btn-icon rounded-round ml-2"
                                                        >
                                                    <i class="icon-pencil"></i>
                                                </a>
                                                <button type="button"
                                                        class="legitRipple swal-alert float-right btn alpha-pink border-pink-400 text-pink-800 btn-icon rounded-round ml-2"
                                                        data-ajax-link="{{route('delete_blog_slider',['slider_id'=>$slider['id']])}}"
                                                        data-method="POST"
                                                        data-csrf="{{csrf_token()}}"
                                                        data-title="{{trans('messages.delete_item',['item'=>trans('messages.blog_slider')])}}"
                                                        data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.blog_slider')])}}"
                                                        data-type="warning"
                                                        data-cancel="true"
                                                        data-confirm-text="{{trans('messages.delete')}}"
                                                        data-cancel-text="{{trans('messages.cancel')}}">
                                                    <i class="icon-trash"></i>
                                            </div>
                                        </div>


                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
