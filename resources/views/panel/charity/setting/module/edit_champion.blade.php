@extends('layouts.panel.panel_layout')
@section('css')
    <link href="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.style.css') }}"
          rel="stylesheet" type="text/css">
    <style>
        .error {
            color: red;
        }
    </style>
@stop
@section('js')
    <script src="{{URL::asset('/public/assets/panel/js/ckeditor/ckeditor.js')}}"></script>
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/uploaders/dropzone.min.js')}}"></script>

    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/validation/validate.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/global/js/localization/messages_fa.js') }}"></script>

    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/forms/tags/tagsinput.min.js')}}"></script>
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/forms/tags/tokenfield.min.js')}}"></script>
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js')}}"></script>
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js')}}"></script>

    <script src="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.js') }}"></script>


    @php $name = explode("/",$champion['image']['url']) @endphp
    <script>
        $(document).ready(function () {
            $('#start_date_btn').MdPersianDateTimePicker({
                targetTextSelector: '#start_date',
                fromDate: true,
                groupId: 'dateRangeSelector1',
                enableTimePicker: true,
                englishNumber: true
            });
            $('#end_date_btn').MdPersianDateTimePicker({
                targetTextSelector: '#end_date',
                toDate: true,
                groupId: 'dateRangeSelector1',
                enableTimePicker: true,
                englishNumber: true

            });
            $(document).on('keyup', '.price', function (e) {
                if (e.which >= 37 && e.which <= 40) return;
                $(this).val(function (index, value) {
                    return value
                        .replace(/\D/g, "")
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                        ;
                });
            })
            $('.tokenfield').tokenfield();
            CKEDITOR.replace('description', {
                language: 'fa',
                uiColor: '#9AB8F3',
                extraPlugins: 'filebrowser',
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
            });
        });
        var DropzoneUploader = function () {
            var _componentDropzone = function () {
                if (typeof Dropzone == 'undefined') {
                    console.warn('Warning - dropzone.min.js is not loaded.');
                    return;
                }
                var token = $('meta[name="csrf-token"]').attr('content');

                Dropzone.options.dropzoneRemove = {
                    url: "{{route('charity_champion_update')}}",
                    paramName: "file",
                    dictDefaultMessage: '{{__('messages.please_click_or_drop_and_down_file_for_upload')}}',
                    maxFilesize: 10,
                    maxFiles: 1,
                    acceptedFiles: ".jpeg,.jpg,.png,.gif",
                    autoProcessQueue: false,
                    addRemoveLinks: true,
                    parallelUploads: 1,
                    sending: function (file, xhr, formData) {
                        formData.append("_token", token);
                    },
                    init: function () {
                        var myDropzone = this;
                        var mockFile = { name: "{{end($name)}}", size: 12345 };
                        myDropzone.options.addedfile.call(myDropzone, mockFile);
                        myDropzone.options.thumbnail.call(myDropzone, mockFile, "/{{$champion['image']['url']}}");
                        mockFile.previewElement.classList.add('dz-success');
                        mockFile.previewElement.classList.add('dz-complete');
                        $("#frm_add_champion").on('submit', function (e) {
                            e.preventDefault();
                            e.stopPropagation();
                            var submit = $("#frm_add_champion").find("#submit");
                            if ($(this).valid()) {
                                submit.attr('disabled', true);
                                submit.html("{{__('messages.please_waite')}}");
                                for (instance in CKEDITOR.instances) {
                                    CKEDITOR.instances[instance].updateElement();
                                }
                                if (myDropzone.getQueuedFiles().length > 0) {
                                    myDropzone.processQueue();
                                } else {
                                    myDropzone.uploadFiles([]);
                                }
                                myDropzone.processQueue();

                                submit.attr('disabled', false);
                                submit.html("{{__('messages.edit')}}");
                            }
                        });
                        this.on('sending', function (file, xhr, formData) {
                            var data = $('#frm_add_champion').serializeArray();
                            $.each(data, function (key, el) {
                                formData.append(el.name, el.value);
                            });
                        });
                        this.on("success", function (file, response) {
                            var org_name = file.name;
                            var new_name = org_name.replace(".", "_");
                            $("#file_names").append(
                                '<input class="' + new_name + '" name="file_name[]" type="hidden" value="' + response + '" />'
                            );
                            new PNotify({
                                title: '',
                                text: response.message,
                                type: 'success'
                            });
                            submit.removeAttr("disabled");
                            submit.html("{{__('messages.add')}}");
                            setTimeout(function () {
                                location.reload();
                            }, 1000)

                        });
                        this.on("complete", function (file, response) {
                            $("input").remove(".dz-hidden-input");
                            $('.dz-hidden-input').hide();
                        });
                        this.on("removedfile", function (file) {
                            var org_name = file.name;
                            var new_name = org_name.replace(".", "_");
                            $('.' + new_name).remove();
                        });
                    }
                };

            };
            return {
                init: function () {
                    _componentDropzone();
                }
            }
        }();
        DropzoneUploader.init();

        document.addEventListener('DOMContentLoaded', function () {
            $('.multiselect').multiselect();
            $('.multiselect-reset').multiselect();
            $('#multiselect-reset-form').on('reset', function () {
                $('.multiselect-reset option:selected').each(function () {
                    $(this).prop('selected', false);
                })
                $('.multiselect-reset').multiselect('refresh');
            });
            $(".styled").uniform();
        });
    </script>
@endsection
<?php
$active_sidbare = ['charity', 'charity_payment_titles', 'charity_setting'];

?>
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('content')
    <section>
        <div class="content">
            <div class="card">
                <div class="card-header bg-warning">
                    <span class="card-title">{{__('messages.edit_item',['item'=>__('messages.champion')])}}</span>
                </div>
                <div class="card-body">
                    <form action="" method="post" id="frm_add_champion"
                          autocomplete="off">
                        <input type="hidden" name="id" value="{{$champion['id']}}">
                        <div class="row">
                            <div class="col-12 col-md-3 form-group">
                                <label for="">{{__("messages.title")}}</label>
                                <input type="text" class="form-control" name="title" minlength="3" maxlength="254"
                                       required="required" value="{{$champion['title']}}">
                            </div>
                            <div class="col-12 col-md-3 form-group">
                                <label for="">{{__("messages.start_date")}}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" readonly="readonly" id="start_date"
                                           name="start_date"
                                           required="required"
                                           value="{{jdate("Y-m-d H:i:s",strtotime($champion['start_date']))}}">
                                    <button class="btn btn-outline-dark btn-sm" type="button" id="start_date_btn"><i
                                                class="icon-calendar"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 form-group">
                                <label for="">{{__("messages.end_date")}}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" readonly="readonly" id="end_date"
                                           name="end_date"
                                           required="required"
                                           value="{{jdate("Y-m-d H:i:s",strtotime($champion['end_date']))}}">
                                    <button class="btn btn-outline-dark btn-sm" type="button" id="end_date_btn"><i
                                                class="icon-calendar"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 form-group">
                                <label for="">{{__("messages.target_amount")}}
                                    <small>({{__('messages.rial')}})</small>
                                </label>
                                <input type="text" class="form-control price" minlength="4" maxlength="15" name="target"
                                       required="required" value="{{number_format($champion['target_amount'])}}">
                            </div>

                            <div class="col-12 col-md-6 form-group">
                                <label for="">{{__('messages.tags')}}</label>
                                <input type="text" name="tags" class="form-control tokenfield"
                                       value="@foreach($champion['tag'] as $tag) {{$tag['tag']}}, @endforeach">
                            </div>

                            <div class="col-12 col-md-6 form-group">
                                <label for="">{{__('messages.description_meta')}}</label>
                                <input type="text" class="form-control" name="meta_description"
                                       value="{{$champion['meta']}}">
                            </div>

                            <div class="col-12 col-md-6 form-group">
                                <label for="">{{__('messages.description_small')}}</label>
                                <input type="text" class="form-control" name="small_description" required="required"
                                       value="{{$champion['description_small']}}">
                            </div>

                            <div class="col-12 col-md-12 form-group">
                                <label for="">{{__('messages.description')}}</label>
                                <textarea class="form-control" name="description" id="description" cols="30"
                                          rows="5">{{$champion['description']}}</textarea>
                            </div>
                            <div class="col-12 col-md-4 form-group">
                                <label for="">{{__('messages.image')}}</label>
                                <div class="dropzone" id="dropzone_remove">
                                    <div class="fallback">
                                        <input name="file" type="file"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 form-group">
                                <label for="">{{__('messages.project_title')}}</label>
                                <select class="multiselect" name="projects[]" multiple="multiple">
                                    @foreach($projects as $project)
                                        <option value="{{$project['id']}}"
                                                @foreach($champion['projects'] as $pro)
                                                @if($project['id'] == $pro['id'])
                                                selected="selected"
                                                @endif
                                                @endforeach
                                        >{{$project['title']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-4 form-group">
                                <label for="">{{__('messages.status')}}</label>
                                <div class="d-flex justify-content-around">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="status" id="status"
                                               value="active"
                                               @if($champion['status']==1) checked @endif data-fouc>
                                        <label class="custom-control-label text-success"
                                               for="status">{{__('messages.active')}}
                                        </label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="status" id="status2"
                                               @if($champion['status']==0) checked @endif value="inactive">
                                        <label class="custom-control-label text-danger"
                                               for="status2">{{__('messages.inactive')}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-end">

                                    <button class="btn btn-primary px-3 py-1" id="submit"
                                            type="submit">{{__('messages.edit')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop