@extends('layouts.panel.panel_layout')

@section('js')
    <script src="{{URL::asset('/public/assets/panel/js/ckeditor/ckeditor.js')}}"></script>
    <Script>
        $(document).ready(function () {

            var route_prefix = {{env('url')}}"/laravel-filemanager";

            (function ($) {
                $.fn.filemanager = function (type, options) {
                    type = type || 'file';

                    this.on('click', function (e) {
                        var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
                        var target_input = $('#' + $(this).data('input'));
                        var target_preview = $('#' + $(this).data('preview'));
                        window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
                        window.SetUrl = function (items) {
                            var file_path = items.map(function (item) {
                                console.log(item.url);
                                return item.url;
                            }).join(',');

                            // set the value of the desired input to image url
                            target_input.val('').val(file_path).trigger('change');

                            // clear previous preview
                            target_preview.html('');

                            // set or change the preview image src
                            items.forEach(function (item) {
                                target_preview.append(
                                    $('<img>').css('height', '5rem').attr('src', item.thumb_url)
                                );
                            });

                            // trigger change event
                            target_preview.trigger('change');
                        };
                        return false;
                    });
                }
            })(jQuery);

            $('#lfmMain').filemanager('image', {prefix: route_prefix});

        });

    </Script>

@endsection
@section('content')
    <?php
    $active_sidbare = ['blog']
    ?>
    <div class="content">
        <?php $rand_id = rand(1, 8000); ?>
        <div class="card ">
            <div class="bg-info-300 card-header">
            </div>
            <form class="" method="post" action="{{route('slider_page')}}">
            @csrf
            <div class="card-body">
                <div class="col-12">
            <span class="input-group-btn">
                <a id="lfmMain" data-input="thumbnail" data-preview="holder"
                   class="btn btn-outline-primary m-2"><i class="icon-image2"></i> {{__('messages.select_image')}}</a>
            </span>
                    @if($slider)
                        <input id="thumbnail" class="form-control" type="hidden" name="slider_id"
                               readonly="readonly" value="{{$slider['id']}}">
                    @endif
                    <input id="thumbnail" class="form-control" type="text" name="filepath"
                           readonly="readonly" value="{{isset($slider['image_large'])?$slider['image_large'] : old('thumbnail')}}">
                    <img id="holder" style="margin-top:15px;max-height:100px;">
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="image">{{__('messages.image')}}</label>
                        <input type="file" class="file-input-ajax" multiple="multiple" id="image"
                               name="image[]" data-fouc>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2"> <i class="icon-link2"></i> {{trans('messages.link')}} </label>
                    <input class="form-control col-md-10" name="btn_link" value="{{isset($slider['btn_link'])?$slider['btn_link'] : old('btn_link')}}">

                </div>
            </div>
            <div class="card-footer">
                <div class="form-group">
                    <button class="btn btn-success " type="submit">
                        <i class="icon-floppy-disk"></i> {{__('messages.save')}}
                    </button>
                </div>
            </div>
            </form>
        </div>


    </div>
@endsection

@section('footer_js')
    <script>
        $(document).ready(function () {

            CKEDITOR.replace('text_1', {
                language: 'fa',
                uiColor: '#9AB8F3',

            });
            CKEDITOR.replace('text_2', {
                language: 'fa',
                uiColor: '#9AB8F3',

            });
            CKEDITOR.replace('text_3', {
                language: 'fa',
                uiColor: '#9AB8F3',
            });

        });
    </script>
@endsection

