@extends("blog.blogetc_admin.layouts.admin_layout")
@section("js")
    <script src="{{URL::asset('/public/assets/panel/js/ckeditor/ckeditor.js')}}"></script>
    <script src="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.js') }}"></script>
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/uploaders/fileinput/plugins/purify.min.js')}}"></script>
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js')}}"></script>
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/uploaders/fileinput/fileinput.min.js')}}"></script>
    <script>
        $(document).ready(function () {

            CKEDITOR.replace('post_text', {
                language: 'fa',
                uiColor: '#9AB8F3',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
            });
            $('#blog_posted_at_btn').MdPersianDateTimePicker({
                targetTextSelector: '#blog_posted_at',
                enableTimePicker: true,
                englishNumber: true,
            });

            var FileUpload = function () {
                var _componentFileUpload = function () {
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
                    $('#btn-modify').on('click', function () {
                        $btn = $(this);
                        if ($btn.text() == 'Disable file input') {
                            $('#file-input-methods').fileinput('disable');
                            $btn.html('Enable file input');
                            alert('Hurray! I have disabled the input and hidden the upload button.');
                        } else {
                            $('#file-input-methods').fileinput('enable');
                            $btn.html('Disable file input');
                            alert('Hurray! I have reverted back the input to enabled with the upload button.');
                        }
                    });
                };
                return {
                    init: function () {
                        _componentFileUpload();
                    }
                }
            }();
            document.addEventListener('DOMContentLoaded', function () {
                FileUpload.init();
            });
        });
    </script>
@endsection
@section('css')
    <link href="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.style.css') }}"
          rel="stylesheet" type="text/css">
@stop
<?php
$active_sidbare = ['blog', 'blog_posts']
?>
@section("content")
    <section>
        <div class="content">
            <div class="container-fluid">
                <section>
                    <a target='_blank' href='{{route('post_page',$post->slug)}}'
                       class="btn btn-primary m-2 py-2 px-3 ">{{__("messages.show_post")}}</a>
                </section>
                <div class="card">
                    <div class="card-header bg-light">
                        <span class="card-title">{{__('messages.edit_post')}}</span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <form method='post' action='{{route("blogetc.admin.update_post",$post->id)}}'
                                  enctype="multipart/form-data">

                                @csrf
                                @method("patch")
                                @include("blog.blogetc_admin.posts.form", ['post' => $post])

                                <div class="form-group pull-left">
                                    <button type='submit' class='btn btn-primary'>
                                        {{__('messages.edit_post')}}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
