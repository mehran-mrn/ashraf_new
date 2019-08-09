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
