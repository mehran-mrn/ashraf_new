@extends('layouts.panel.panel_layout')
@section('css')
    <link href="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.style.css') }}"
          rel="stylesheet" type="text/css">
@stop
@section('js')
    <script src="{{URL::asset('/public/assets/panel/js/ckeditor/ckeditor.js')}}"></script>
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/uploaders/dropzone.min.js')}}"></script>
    <script src="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#start_date_btn').MdPersianDateTimePicker({
                targetTextSelector: '#start_date',
                fromDate: true,
                groupId: 'dateRangeSelector1',
                enableTimePicker: true
            });
            $('#end_date_btn').MdPersianDateTimePicker({
                targetTextSelector: '#end_date',
                toDate: true,
                groupId: 'dateRangeSelector1',
                enableTimePicker: true
            });
            $(document).on('keyup', '.price', function (e) {
                if (e.which >= 37 && e.which <= 40) return;
                $(this).val(function (index, value) {
                    return value
                        .replace(/\D/g, "")
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                });
            })

            CKEDITOR.replace('description', {
                language: 'fa',
                uiColor: '#9AB8F3',
                extraPlugins: 'filebrowser',
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
            });
        })
        var DropzoneUploader = function () {
            var _componentDropzone = function () {
                if (typeof Dropzone == 'undefined') {
                    console.warn('Warning - dropzone.min.js is not loaded.');
                    return;
                }
                var token = $('meta[name="token"]').attr('content');

                Dropzone.options.dropzoneRemove = {
                    url: "{{route('upload_files_category')}}",
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
                        $("#frm_add_champion").on('submit', function (e) {
                            e.preventDefault();
                            myDropzone.processQueue();
                        })
                        this.on('sending', function (file, xhr, formData) {
                            var data = $('#frm_add_champion').serializeArray();
                            $.each(data, function (key, el) {
                                formData.append(el.name, el.value);
                            });
                        });
                        this.on("success", function (file, response) {
                            console.log(response);
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
    </script>
@endsection
<?php
$active_sidbare = ['charity', 'charity_setting', 'charity_support_title']
?>
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('content')
    <section>
        <div class="content">
            <section>
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title text-black">{{__('messages.Charity')}} | {{__('messages.setting')}}</h6>
                        <hr>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <button type="button" class="btn btn-outline-warning btn-lg modal-ajax-load"
                                    data-ajax-link="{{route('sForm.create')}}"
                                    data-toggle="modal"
                                    data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.form')])}}"
                                    data-modal-size="modal-full"
                                    data-target="#general_modal"><i
                                        class="icon-folder-plus mr-2"></i> {{trans('messages.add_new',['item'=>trans('messages.form')])}}
                            </button>
                        </div>
                        <div class="row mb-2">
                        </div>
                    @foreach($sforms as $sform)

                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </section>
@endsection