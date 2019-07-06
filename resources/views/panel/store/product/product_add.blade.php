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
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/uploaders/fileinput/fileinput.min.js')}}"></script>
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/ui/dragula.min.js')}}"></script>
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/pickers/color/spectrum.js')}}"></script>
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/forms/styling/switchery.min.js')}}"></script>
    <script>

        $(document).ready(function () {

            $('input:radio[name="inv_type"]').change(
                function () {
                    if ($(this).is(':checked') && $(this).val() === 'bycolor') {
                        $(".inv-box").html("");
                        $(".inventoriesW").addClass("d-none");
                        $(".inventoriesC").removeClass("d-none");
                    } else if ($(this).is(':checked') && $(this).val() === 'withoutcolor') {
                        $(".color-box").html("");
                        $(".inventoriesW").removeClass("d-none");
                        $(".inventoriesC").addClass("d-none");
                        $(".inv-box").html('' +
                            '<label for="inventories">{{__("messages.inventories")}}</label>\n' +
                            '<input type="number" class="form-control" required="required" name="inventories" id="inventories">');

                    }
                });

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
            $("[id^='box_']").on('click', function () {
                var id = $(this).data("id");
                $(this).parent().parent().parent().parent().after("<div id='boxSel_" + id + "'>").fadeOut().appendTo("#forms-target-right").fadeIn();
            });

            dragula([document.getElementById('forms-target-left'), document.getElementById('forms-target-right')]);

            document.addEventListener('DOMContentLoaded', function () {
                DragAndDrop.init();
            });


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


            $(".add-color").on('click', function () {
                var x = +$("#randomNumber").val() + 1;
                $(".color-box").append(
                    '<div class="row pt-2 counter-row-' + x + '"><div class="col-md-4">' +
                    '<div class="d-inline-block"><input type="text" data-preferred-format="hex" class="form-control colorpicker-palette" value="#27ADCA" data-fouc name="color-name[' + x + '][]">' +
                    '</div></div><div class="col-md-6">' +
                    '<input type="number" min="0" max="10000000" placeholder="{{__('messages.count')}}" required="required" class="form-control" name="color-name[' + x + '][]"></div>' +
                    '<div class="col-md-2"><button type="button" data-row-id="' + x + '" onclick="removeRow(' + x + ')" class="btn btn-outline-danger btn-xs"><i class="icon-x"></i></button></div></div>'
                );
                $("#randomNumber").val(x);
                ColorPicker.init();
            })


        });

        function removeRow(x) {
            var rowID = x;
            $(".counter-row-" + rowID).remove();
        };

        function deleteGatewayOnline(id) {
            $("#g_row_online_" + id).html("");
        }

        function deleteGatewayCart(id) {
            $("#g_row_cart_" + id).html("");
        }

        function deleteGatewayAccount(id) {
            $("#g_row_account_" + id).html("");
        }

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
        var ColorPicker = function () {
            var _componentColorPicker = function () {
                if (!$().spectrum) {
                    console.warn('Warning - spectrum.js is not loaded.');
                    return;
                }
                var demoPalette = [
                    ["#000", "#444", "#666", "#999", "#ccc", "#eee", "#f3f3f3", "#fff"],
                    ["#f00", "#f90", "#ff0", "#0f0", "#0ff", "#00f", "#90f", "#f0f"],
                    ["#f4cccc", "#fce5cd", "#fff2cc", "#d9ead3", "#d0e0e3", "#cfe2f3", "#d9d2e9", "#ead1dc"],
                    ["#ea9999", "#f9cb9c", "#ffe599", "#b6d7a8", "#a2c4c9", "#9fc5e8", "#b4a7d6", "#d5a6bd"],
                    ["#e06666", "#f6b26b", "#ffd966", "#93c47d", "#76a5af", "#6fa8dc", "#8e7cc3", "#c27ba0"],
                    ["#c00", "#e69138", "#f1c232", "#6aa84f", "#45818e", "#3d85c6", "#674ea7", "#a64d79"],
                    ["#900", "#b45f06", "#bf9000", "#38761d", "#134f5c", "#0b5394", "#351c75", "#741b47"],
                    ["#600", "#783f04", "#7f6000", "#274e13", "#0c343d", "#073763", "#20124d", "#4c1130"]
                ]
                $('.colorpicker-palette').spectrum({
                    showPalette: true,
                    palette: demoPalette,
                    showInput: true
                });
            }
            var _componentSwitchery = function () {
                if (typeof Switchery == 'undefined') {
                    console.warn('Warning - switchery.min.js is not loaded.');
                    return;
                }

                // Initialization
                var toggleState = document.querySelector('.form-input-switchery');
                var toggleStateInit = new Switchery(toggleState);

                // Toggle navbar type state toggle
                toggleState.onchange = function () {
                    if (toggleState.checked) {
                        $('.colorpicker-disabled').spectrum('enable');
                    } else {
                        $('.colorpicker-disabled').spectrum('disable');
                    }
                }
            };
            return {
                init: function () {
                    _componentColorPicker();
                    _componentSwitchery();
                }
            }
        }();

        document.addEventListener('DOMContentLoaded', function () {
            ColorPicker.init();
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
                                        <input type="text" name="title" id="title" class="form-control"
                                               value="{{old('title')}}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="description">{{__('messages.description')}}</label>
                                        <textarea name="description" id="description" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <span class="input-group-btn">
                                        <a id="lfmMain" data-input="thumbnail" data-preview="holder"
                                           class="btn btn-outline-primary m-2"><i class="icon-image2"></i> {{__('messages.select_image')}}</a>
                                    </span>
                                    <input id="thumbnail" class="form-control" type="text" name="filepath"
                                           readonly="readonly">
                                    <img id="holder" style="margin-top:15px;max-height:100px;">
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="image">{{__('messages.image')}}</label>
                                        <input type="file" class="file-input-ajax" multiple="multiple" id="image"
                                               name="image[]" data-fouc>
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
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header header-elements-inline">
                                            <h6 class="card-title">{{__('messages.items')}}</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row" id="forms-target-right"><br><br><br></div>
                                        </div>
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
                                    class="panel title">{{__('messages.count')}}</span></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="form-group mb-3 mb-md-2">
                                        <label
                                                class="d-block font-weight-semibold">{{__('messages.inventories')}}</label>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" name="inv_type"
                                                   id="custom_radio_inline_unchecked" checked value="withoutcolor">
                                            <label class="custom-control-label"
                                                   for="custom_radio_inline_unchecked">{{__("messages.without_color")}}</label>
                                        </div>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" name="inv_type"
                                                   id="custom_radio_inline_checked" value="bycolor">
                                            <label class="custom-control-label"
                                                   for="custom_radio_inline_checked">{{__("messages.by_color")}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 inventoriesW">
                                    <div class="form-group inv-box">
                                        <label for="inventories">{{__("messages.inventories")}}</label>
                                        <input type="number" class="form-control" required="required" name="inventories"
                                               id="inventories">
                                    </div>
                                </div>
                                <div class="col-md-12 inventoriesC d-none">
                                    <button type="button" class="btn btn-outline-info add-color float-right"><i
                                                class="icon-plus2"></i> {{__('messages.add_color')}}</button>
                                    <div class="clearfix"></div>
                                    <hr>
                                    <input type="hidden" value="1" id="randomNumber">
                                    <div class="color-box">
                                    </div>
                                </div>

                            </div>

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
                                               name="pay_online"
                                               checked>
                                        <label class="custom-control-label"
                                               for="pay_online">{{__('messages.online')}}</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="row">
                                        @foreach($gateways as $gateway)
                                            @php
                                                $logo = $gateway->bank->logo;
                                            if($gateway['online']==1){

                                            echo '<div class="col-4 col-md-4 border-right-1">';
                                            echo '<div class="custom-control custom-checkbox custom-control-inline">';
                                            echo '<input type="checkbox" checked class="custom-control-input" id="online_gateway_online_'.$gateway['id'].'" name="online_gateway_online[]" value="'.$gateway['id'].'">';
                                            echo '<label class="custom-control-label" for="online_gateway_online_'.$gateway['id'].'">'.$logo.'</label></div></div>';
                                            }
                                            @endphp
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 text-center pb-3">
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" class="custom-control-input" id="pay_cart"
                                               name="pay_cart"
                                               checked>
                                        <label class="custom-control-label"
                                               for="pay_cart">{{__('messages.cart_to_cart')}}</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="row">
                                        @foreach($gateways as $gateway)
                                            @php
                                                $logo = $gateway->bank->logo;
                                            if($gateway['cart']==1){
                                            echo '<div class="col-4 col-md-4 border-right-1">';
                                            echo '<div class="custom-control custom-checkbox custom-control-inline">';
                                            echo '<input type="checkbox" checked class="custom-control-input" id="online_gateway_cart_'.$gateway['id'].'" name="online_gateway_cart[]" value="'.$gateway['id'].'">';
                                            echo '<label class="custom-control-label" for="online_gateway_cart_'.$gateway['id'].'">'.$logo.'</label></div></div>';
                                            }
                                            @endphp
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 text-center pb-3">
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" class="custom-control-input" id="pay_account"
                                               name="pay_account"
                                               checked>
                                        <label class="custom-control-label"
                                               for="pay_account">{{__('messages.send_to_account')}}</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="row">
                                        @foreach($gateways as $gateway)
                                            @php
                                                $logo = $gateway->bank->logo;
                                                if($gateway['account']==1){
                                                    echo '<div class="col-4 col-md-4 border-right-1">';
                                                    echo '<div class="custom-control custom-checkbox custom-control-inline">';
                                                    echo '<input type="checkbox" checked class="custom-control-input" id="online_gateway_account_'.$gateway['id'].'" name="online_gateway_account[]" value="'.$gateway['id'].'">';
                                                    echo '<label class="custom-control-label" for="online_gateway_account_'.$gateway['id'].'">'.$logo.'</label></div></div>';
                                                }
                                            @endphp
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" class="custom-control-input" id="pay_place"
                                               name="pay_place"
                                               checked>
                                        <label class="custom-control-label"
                                               for="pay_place">{{__('messages.pay_on_place')}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header text-center bg-light"><span
                                    class="card-title">{{__('messages.action')}}</span>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <label for="ready">{{__('messages.ready_for_send')}}</label>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <input type="number" class="form-control" id="ready" name="ready" min="0"
                                                   max="60">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <label for="price">{{__('messages.price')}}</label>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <input type="text" class="form-control" id="price" name="price" min="0"
                                                   max="60">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <label for="off">{{__('messages.off')}}</label>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <input type="number" class="form-control" id="off" name="off" min="0"
                                                   max="100">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <label for="off">{{__('messages.model')}}</label>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <input type="text" class="form-control" id="model" name="model">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <label for="off">{{__('messages.code')}}</label>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <input type="text" class="form-control" id="code" name="code">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <label for="off">{{__('messages.status')}}</label>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <select name="status" id="status" class="form-control">
                                                <option value="active">{{__('messages.active')}}</option>
                                                <option value="inactive">{{__('messages.inactive')}}</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <button class="btn btn-primary btn-block" type="submit">{{__('messages.submit')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="card">
            <div class="card-body">
                <div class="row" id="forms-target-left">
                    @foreach($items_cats as $item)
                        @php $child = $item->getChild() @endphp
                        <div class="col-md-6" id="boxSel_{{$item['id']}}">
                            <div class="form-group">
                                <div class="card card-collapsed">
                                    <div class="card-header bg-info header-elements-inline">
                                        <h6 class="card-title text-center">{{$item->title}}</h6>
                                        <div class="header-elements">
                                            <div class="list-icons">
                                                <a class="list-icons-item" data-action="collapse"></a>
                                                <a class="list-icons-item" data-action="reload"></a>
                                                <a class="list-icons-item" data-action="remove"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        @foreach($child as $ch)
                                            <label class="cursor-move">{{$ch->title}}</label>
                                            <div class="input-group">
                                                @if($ch['prefix']!='')
                                                    <span class="input-group-prepend">
                                                            <span class="input-group-text">{{$ch['prefix']}}</span>
                                                        </span>
                                                @endif
                                                <input type="text" class="form-control" name="items_{{$ch['id']}}">
                                                <input type="hidden" class="form-control" name="items_id[]"
                                                       value="{{$ch['id']}}">
                                                @if($ch['suffix']!='')
                                                    <span class="input-group-append">
                                                            <span class="input-group-text">{{$ch['suffix']}}</span>
                                                        </span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-outline-dark float-right"
                                                data-id="{{$item['id']}}"
                                                id="box_{{$item['id']}}">{{__('messages.select')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <br>
                <hr>
            </div>
        </div>
    </div>

    <div id="modal_backdrop" class="modal fade" data-backdrop="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__("messages.select_color")}}</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">{{__('messages.cancel')}}</button>
                    <button type="button" class="btn bg-primary">{{__('messages.add')}}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
