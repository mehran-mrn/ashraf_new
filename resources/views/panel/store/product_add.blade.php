@extends('layouts.panel.panel_layout')
@section('js')
    <script src="{{URL::asset('/public/assets/panel/js/ckeditor/ckeditor.js')}}"></script>
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/forms/tags/tagsinput.min.js')}}"></script>
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/forms/tags/tokenfield.min.js')}}"></script>
    <script
        src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js')}}"></script>
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/ui/prism.min.js')}}"></script>
    <script
        src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/uploaders/fileinput/plugins/purify.min.js')}}"></script>
    <script
        src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js')}}"></script>
    <script
        src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/uploaders/fileinput/fileinput.min.js')}}"></script>
    <script>

        $(document).ready(function () {
            CKEDITOR.replace('description', {
                language: 'fa',
                uiColor: '#9AB8F3',
                extraPlugins: 'filebrowser',
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
            });
            $('.tokenfield').tokenfield();
        });

        function deleteGatewayOnline(id) {
            $("#g_row_online_" + id).html("");
        }

        function deleteGatewayCart(id) {
            $("#g_row_cart_" + id).html("");
        }

        function deleteGatewayAccount(id) {
            $("#g_row_account_" + id).html("");
        }

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

        $('#lfm').filemanager('image', {prefix: route_prefix});

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
    </script>
@endsection
@section('css')
    <link rel="stylesheet" href="{{URL::asset('/public/assets/panel/css/iranBanks/ibl.css')}}">
@endsection
@section('content')
    @php
        $active_sidbare = ['store', 'product_add']
    @endphp
    <div class="content">
        <form action="{{route('store_product_add')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-header text-center bg-light"><span
                                class="card-title">{{__('messages.product_add')}}</span>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="title">{{__('messages.product_title')}}</label>
                                        <input type="text" name="title" id="title" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="description">{{__('messages.description')}}</label>
                                        <textarea name="description" id="description" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                    <span class="input-group-btn">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder"
                                           class="btn btn-primary"><i
                                                class="fa fa-picture-o"></i>{{__('messages.select_image')}}</a>
                                    </span>
                                        <input id="thumbnail" class="form-control" type="text" name="filepath">
                                        <img id="holder" style="margin-top:15px;max-height:100px;">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="image">{{__('messages.image')}}</label>
                                        <input type="file" class="file-input-ajax" multiple="multiple" id="image"
                                               name="image" data-fouc>
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
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card">
                        <div class="card-header text-center bg-light"><span
                                class="panel-title">{{__('messages.category')}}</span></div>
                        <div class="card-body">
                            {!! treeView() !!}
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header text-center bg-light"><span
                                class="card-title">{{__('messages.pay_gateway')}}</span></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 text-center pb-3">
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" class="custom-control-input" id="pay_online"
                                               checked>
                                        <label class="custom-control-label"
                                               for="pay_online">{{__('messages.online')}}</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    @foreach($gateways as $gateway)
                                        @php
                                            $logo = $gateway->bank->logo;
                                        if($gateway['online']==1){
                                        echo '<div class="row" id="g_row_online_'.$gateway['id'].'"><div class="col-12 col-md-6">';
                                        echo $logo;
                                        echo '<input type="hidden" name="online_gateway_online_'.$gateway['id'].'" value="'.$gateway['id'].'">';
                                        echo '</div><div class="col-12 col-md-6">';
                                        echo '<button type="button" onclick="deleteGatewayOnline('.$gateway['id'].')" class="btn float-right mt-2 btn-xs btn-outline-dark"><i class="icon-trash"></i></button>';
                                        echo '</div></div>';
                                        }
                                        @endphp
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" class="custom-control-input" id="pay_cart"
                                               checked>
                                        <label class="custom-control-label"
                                               for="pay_cart">{{__('messages.cart_to_cart')}}</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">

                                    @foreach($gateways as $gateway)
                                        @php
                                            $logo = $gateway->bank->logo;
                                        if($gateway['cart']==1){
                                        echo '<div class="row" id="g_row_cart_'.$gateway['id'].'"><div class="col-12 col-md-6">';
                                          echo $logo;
                                        echo '<input type="hidden" name="online_gateway_cart_'.$gateway['id'].'" value="'.$gateway['id'].'">';
                                        echo '</div><div class="col-md-6">';
                                        echo '<button type="button" onclick="deleteGatewayCart('.$gateway['id'].')" class="btn float-right mt-2 btn-xs btn-outline-dark"><i class="icon-trash"></i></button>';
                                        echo '</div></div>';
                                        }
                                        @endphp
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" class="custom-control-input" id="pay_account"
                                               checked>
                                        <label class="custom-control-label"
                                               for="pay_account">{{__('messages.send_to_account')}}</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    @foreach($gateways as $gateway)
                                        @php
                                            $logo = $gateway->bank->logo;
                                        if($gateway['account']==1){
                                        echo '<div class="row" id="g_row_account_'.$gateway['id'].'"><div class="col-12 col-md-6">';
                                          echo $logo;
                                        echo '<input type="hidden" name="online_gateway_account_'.$gateway['id'].'" value="'.$gateway['id'].'">';
                                        echo '</div><div class="col-md-6">';
                                        echo '<button type="button" onclick="deleteGatewayAccount('.$gateway['id'].')" class="btn float-right mt-2 btn-xs btn-outline-dark"><i class="icon-trash"></i></button>';
                                        echo '</div></div>';
                                        }
                                        @endphp
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" class="custom-control-input" id="pay_place"
                                               checked>
                                        <label class="custom-control-label"
                                               for="pay_place">{{__('messages.pay_on_place')}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header text-center bg-light"><span class="card-title">{{__('messages.action')}}</span>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-primary btn-block" type="submit">{{__('messages.submit')}}</button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
