@extends('layouts.panel.panel_layout')
@section('js')
    <script src="{{URL::asset('/node_modules/ckeditor/ckeditor.js')}}"></script>

    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/forms/tags/tagsinput.min.js')}}"></script>
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/forms/tags/tokenfield.min.js')}}"></script>
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js')}}"></script>
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/ui/prism.min.js')}}"></script>
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/uploaders/fileinput/plugins/purify.min.js')}}"></script>
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js')}}"></script>
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/uploaders/fileinput/fileinput.min.js')}}"></script>
    <script>
        // var path =;
        // path[ path.length-3 ] = 'upload_image';

        $(document).ready(function () {
            CKEDITOR.replace('text', {
                language: 'fa',
                uiColor: '#9AB8F3',
                // filebrowserUploadUrl: path.join('/').replace(/\/+$/, ''),
{{--                filebrowserUploadUrl: '{{route('ckeditorImage',['_token' => csrf_token() ])}}',--}}
                extraPlugins: 'filebrowser',


                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
            });
            $('.tokenfield').tokenfield();

            $("#title").keyup(function () {
                var title = $("#title").val();
                res = title.replace(/ /g, '_');
                $("#slug").val(res);
            });



        });
        var FileUpload = function() {
            var _componentFileUpload = function() {
                if (!$().fileinput) {
                    console.warn('Warning - fileinput.min.js is not loaded.');
                    return;
                }
                var modalTemplate = '<div class="modal-dialog modal-lg" role="document">\n' +
                    '  <div class="modal-content">\n' +
                    '    <div class="modal-header align-items-center">\n' +
                    '      <h6 class="modal-title">{heading} <small><span class="kv-zoom-title"></span></small></h6>\n' +
                    '      <div class="kv-zoom-actions btn-group">{toggleheader}{fullscreen}{borderless}{close}</div>\n' +
                    '    </div>\n' +
                    '    <div class="modal-body">\n' +
                    '      <div class="floating-buttons btn-group"></div>\n' +
                    '      <div class="kv-zoom-body file-zoom-content"></div>\n' + '{prev} {next}\n' +
                    '    </div>\n' +
                    '  </div>\n' +
                    '</div>\n';
                var previewZoomButtonClasses = {
                    toggleheader: 'btn btn-light btn-icon btn-header-toggle btn-sm',
                    fullscreen: 'btn btn-light btn-icon btn-sm',
                    borderless: 'btn btn-light btn-icon btn-sm',
                    close: 'btn btn-light btn-icon btn-sm'
                };
                var previewZoomButtonIcons = {
                    prev: '<i class="icon-arrow-left32"></i>',
                    next: '<i class="icon-arrow-right32"></i>',
                    toggleheader: '<i class="icon-menu-open"></i>',
                    fullscreen: '<i class="icon-screen-full"></i>',
                    borderless: '<i class="icon-alignment-unalign"></i>',
                    close: '<i class="icon-cross2 font-size-base"></i>'
                };
                var fileActionSettings = {
                    zoomClass: '',
                    zoomIcon: '<i class="icon-zoomin3"></i>',
                    dragClass: 'p-2',
                    dragIcon: '<i class="icon-three-bars"></i>',
                    removeClass: '',
                    removeErrorClass: 'text-danger',
                    removeIcon: '<i class="icon-bin"></i>',
                    indicatorNew: '<i class="icon-file-plus text-success"></i>',
                    indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
                    indicatorError: '<i class="icon-cross2 text-danger"></i>',
                    indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>'
                };
                $('.file-input-ajax').fileinput({
                    browseLabel: 'Browse',
                    uploadUrl: "http://localhost", // server upload action
                    uploadAsync: true,
                    maxFileCount: 5,
                    initialPreview: [],
                    browseIcon: '<i class="icon-file-plus mr-2"></i>',
                    uploadIcon: '<i class="icon-file-upload2 mr-2"></i>',
                    removeIcon: '<i class="icon-cross2 font-size-base mr-2"></i>',
                    fileActionSettings: {
                        removeIcon: '<i class="icon-bin"></i>',
                        uploadIcon: '<i class="icon-upload"></i>',
                        uploadClass: '',
                        zoomIcon: '<i class="icon-zoomin3"></i>',
                        zoomClass: '',
                        indicatorNew: '<i class="icon-file-plus text-success"></i>',
                        indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
                        indicatorError: '<i class="icon-cross2 text-danger"></i>',
                        indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>',
                    },
                    layoutTemplates: {
                        icon: '<i class="icon-file-check"></i>',
                        modal: modalTemplate
                    },
                    initialCaption: 'No file selected',
                    previewZoomButtonClasses: previewZoomButtonClasses,
                    previewZoomButtonIcons: previewZoomButtonIcons
                });
                $('#btn-modify').on('click', function() {
                    $btn = $(this);
                    if ($btn.text() == 'Disable file input') {
                        $('#file-input-methods').fileinput('disable');
                        $btn.html('Enable file input');
                        alert('Hurray! I have disabled the input and hidden the upload button.');
                    }
                    else {
                        $('#file-input-methods').fileinput('enable');
                        $btn.html('Disable file input');
                        alert('Hurray! I have reverted back the input to enabled with the upload button.');
                    }
                });
            };
            return {
                init: function() {
                    _componentFileUpload();
                }
            }
        }();
        document.addEventListener('DOMContentLoaded', function() {
            FileUpload.init();
        });
    </script>
@endsection
@section('content')
    <?php
    $active_sidbare = ['blog', 'add_post']
    ?>
    <div class="content">
        <form action="{{route('add_post_store')}}" method="post" enctype="multipart/form-data">
            @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header bg-indigo">
                        <span class="card-title">{{__('messages.new_post')}}</span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">{{__('messages.title')}}</label>
                                    <input type="text" class="form-control" name="title" id="title"
                                           placeholder="{{__('messages.enter_title')}}" value="{{old('title')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="slug">{{__('messages.slug')}}</label>
                                    <input type="text" class="form-control" readonly="readonly" name="slug" id="slug" value="{{old('slug')}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="text">{{__('messages.text')}}</label>
                                    <textarea name="text" id="text" class="textarea" cols="30" rows="10">{{old('text')}}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">{{__('messages.description')}}</label>
                                    <textarea name="description" id="description" class="form-control" cols="30"
                                              rows="3">{{old('description')}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                <label for="image">{{__('messages.image')}}</label>
                                <input type="file" class="file-input-ajax" multiple="multiple" id="image" name="image" data-fouc>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tages">{{__('messages.tages')}}</label>
                                    <input type="text" class="form-control tokenfield"
                                           placeholder="{{__('messages.enter_text')}}"
                                           data-fouc name="tags" id="tags" value="{{old('tags')}}">
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /basic responsive configuration -->
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-primary">
                        <span class="card-title">{{__('messages.category')}}</span>
                    </div>
                    <div class="card-body">
                        @foreach($cats as $cat)
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input"  value="{{$cat->id}}" id="cat_{{$cat->id}}" name="cats[]">
                                <label class="custom-control-label"
                                       for="cat_{{$cat->id}}">{{$cat->title}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-primary">
                        <span class="card-title">{{__('messages.publish_time')}}</span>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="publish_time" id="publish_time"
                                   value="{{date("Y-m-d H:i:s")}}" >
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-primary">
                        <span class="card-title">{{__('messages.publish_status')}}</span>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <select name="publish_status" id="publish_status" class="form-control">
                                <option value="published" {{old('publish_status')=='published'?'selected':''}}>{{__('messages.published')}}</option>
                                <option value="draft" {{old('publish_status')=='draft'?'selected':''}}>{{__('messages.draft')}}</option>
                            </select>
                            <div class="form-group pt-2">
                                <button class="btn btn-success btn-block">{{__('messages.publish')}}</button>
                                <button class="btn btn-info btn-block">{{__('messages.cancel')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
@endsection
