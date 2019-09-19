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
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                        ;
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
$active_sidbare = ['charity', 'charity_payment_titles', 'charity_setting']
?>
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('content')
    <div class="content">
        {{--    <div class="row">--}}
        {{--        <div class="col-md-12">--}}
        {{--            <div class="card">--}}
        {{--                <div class="card-header bg-light">--}}
        {{--                    <button type="button" class="btn btn-outline-info btn-lg modal-ajax-load"--}}
        {{--                            data-ajax-link="{{route('charity_payment_title_add')}}" data-toggle="modal"--}}
        {{--                            data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.payment_title')])}}"--}}
        {{--                            data-modal-size="modal-full"--}}
        {{--                            data-target="#general_modal"><i--}}
        {{--                                class="icon-user-plus mr-2"></i> {{trans('messages.add_new',['item'=>trans('messages.payment_title')])}}--}}
        {{--                    </button>--}}
        {{--                </div>--}}
        {{--                <div class="card-body">--}}
        {{--                    <div class="row">--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--    </div>--}}

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                            <li class="nav-item"><a href="#custom_payment_types" class="nav-link active"
                                                    data-toggle="tab">
                                    {{trans('messages.custom_payment_types')}}
                                </a></li>
                            <li class="nav-item"><a href="#system_title" class="nav-link" data-toggle="tab">
                                    {{$system_title['title']}}
                                </a></li>
                            <li class="nav-item"><a href="#periodic_title" class="nav-link" data-toggle="tab">
                                    {{$periodic_title['title']}}
                                </a></li>
                            <li class="nav-item"><a href="#payment_champion" class="nav-link" data-toggle="tab">
                                    {{$champion_titles['title']}}
                                </a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade  show active" id="custom_payment_types">
                                <div class="row mb-2">
                                    <button type="button" class="btn btn-outline-warning btn-lg modal-ajax-load"
                                            data-ajax-link="{{route('charity_payment_pattern_add')}}"
                                            data-toggle="modal"
                                            data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.payment_pattern')])}}"
                                            data-modal-size="modal-full"
                                            data-target="#general_modal"><i
                                                class="icon-folder-plus mr-2"></i> {{trans('messages.add_new',['item'=>trans('messages.payment_pattern')])}}
                                    </button>
                                </div>
                                <div class="row mb-2">

                                    @foreach($other_titles as $title)
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-header p-1 bg-info">
                                                    <span class="font-size-lg">{{$title['title']}}</span>
                                                    <button type="button" class="float-right btn alpha-info m-0 border-info-800 text-info-800 btn-icon rounded-round ml-2
                                             modal-ajax-load"
                                                            data-ajax-link="{{route('charity_payment_pattern_add',['payment_pattern_id'=>$title['id']])}}"
                                                            data-toggle="modal"
                                                            data-modal-size="modal-full"
                                                            data-modal-title="{{trans('messages.edit_item',['item'=>trans('messages.payment_pattern')])}}"
                                                            data-target="#general_modal">
                                                        <i class="icon-pencil"></i>
                                                    </button>


                                                    <button type="button"
                                                            class="legitRipple swal-alert float-right m-0 btn alpha-pink border-pink-400 text-pink-800 btn-icon rounded-round ml-2"
                                                            data-ajax-link="{{route('charity_payment_pattern_delete',['payment_pattern_id'=>$title['id']])}}"
                                                            data-method="POST"
                                                            data-csrf="{{csrf_token()}}"
                                                            data-title="{{trans('messages.delete_item',['item'=>trans('messages.payment_pattern')])}}"
                                                            data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.payment_pattern')])}}"
                                                            data-type="warning"
                                                            data-cancel="true"
                                                            data-confirm-text="{{trans('messages.delete')}}"
                                                            data-cancel-text="{{trans('messages.cancel')}}">
                                                        <i class="icon-trash"></i>
                                                    </button>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        {!! $title['description'] !!}


                                                        @if(count($title['fields'])>0)
                                                            <table class="table">
                                                                <tr>
                                                                    <th>{{trans('messages.title')}}</th>
                                                                    <th>{{trans('messages.type')}}</th>
                                                                    <th></th>
                                                                </tr>
                                                                @foreach($title['fields'] as $field)
                                                                    <tr>
                                                                        <td>{{$field['label']}}</td>
                                                                        <td>
                                                                            @switch($field['type'])
                                                                                @case(0)
                                                                                {{trans('messages.input')}}
                                                                                @break
                                                                                @case(1)
                                                                                {{trans('messages.textarea')}}
                                                                                @break
                                                                                @case(2)
                                                                                {{trans('messages.number')}}
                                                                                @break
                                                                                @case(3)
                                                                                {{trans('messages.date_input')}}
                                                                                @break
                                                                                @case(4)
                                                                                {{trans('messages.time_input')}}
                                                                                @break
                                                                            @endswitch
                                                                        </td>
                                                                        <td>
                                                                            @switch($field['require'])
                                                                                @case(0)
                                                                                {{trans('messages.optional')}}
                                                                                @break
                                                                                @case(1)
                                                                                {{trans('messages.required')}}
                                                                                @break
                                                                            @endswitch
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </table>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <div class="tab-pane fade" id="system_title">
                                <div class="card border-secondary">
                                    <div class="card-body">
                                        {!! $system_title['description'] !!}
                                        <span class="text-danger-300 float-right">
                                            <a href="#" class=" m-0 ml-2
                                             modal-ajax-load"
                                               data-ajax-link="{{route('charity_payment_pattern_add',['payment_pattern_id'=>$system_title['id']])}}"
                                               data-toggle="modal"
                                               data-modal-size="modal-full"
                                               data-modal-title="{{trans('messages.edit_item',['item'=>trans('messages.payment_pattern')])}}"
                                               data-target="#general_modal">
                                                        {{trans('messages.edit')}}
                                                    </a>
                                        </span>
                                        @if(count($system_title['fields'])>0)
                                            <table class="table">
                                                <tr>
                                                    <th>{{trans('messages.title')}}</th>
                                                    <th>{{trans('messages.type')}}</th>
                                                    <th></th>
                                                </tr>
                                                @foreach($system_title['fields'] as $field)
                                                    <tr>
                                                        <td>{{$field['label']}}</td>
                                                        <td>
                                                            @switch($field['type'])
                                                                @case(0)
                                                                {{trans('messages.input')}}
                                                                @break
                                                                @case(1)
                                                                {{trans('messages.textarea')}}
                                                                @break
                                                                @case(2)
                                                                {{trans('messages.number')}}
                                                                @break
                                                                @case(3)
                                                                {{trans('messages.date_input')}}
                                                                @break
                                                                @case(4)
                                                                {{trans('messages.time_input')}}
                                                                @break
                                                            @endswitch
                                                        </td>
                                                        <td>
                                                            @switch($field['require'])
                                                                @case(0)
                                                                {{trans('messages.optional')}}
                                                                @break
                                                                @case(1)
                                                                {{trans('messages.required')}}
                                                                @break
                                                            @endswitch
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        @endif

                                    </div>
                                </div>
                                <hr>
                                <button type="button" class="btn btn-outline-primary btn-lg modal-ajax-load"
                                        data-ajax-link="{{route('charity_payment_title_add',['payment_pattern_id'=>$system_title['id']])}}"
                                        data-toggle="modal"
                                        data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.payment_selection')])}}"
                                        data-target="#general_modal"><i
                                            class="icon-file-plus2 mr-2"></i> {{trans('messages.add_new',['item'=>trans('messages.payment_selection')])}}
                                </button>

                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <span class="text-info">{{trans('messages.display_items')}}</span>
                                        <table class="table table-bordered table-striped">
                                            <tr class="font-size-lg font-weight-black header">
                                                <th>{{trans('messages.title')}}</th>
                                                <th></th>
                                            </tr>
                                            @foreach($system_title['titles'] as $title)
                                                <tr>
                                                    <td>{{$title['title']}}</td>
                                                    <td>
                                                        <button type="button" class="float-right btn alpha-info border-info-400 text-info-800 btn-icon rounded-round ml-2
                                             modal-ajax-load"
                                                                data-ajax-link="{{route('charity_payment_title_add',['payment_pattern_id'=>$system_title['id'],'payment_title_id'=>$title['id']])}}"
                                                                data-toggle="modal"
                                                                data-modal-title="{{trans('messages.edit_item',['item'=>trans('messages.payment_selection')])}}"
                                                                data-target="#general_modal">
                                                            <i class="icon-pencil"></i>
                                                        </button>


                                                        <button type="button"
                                                                class="legitRipple swal-alert float-right btn alpha-pink border-pink-400 text-pink-800 btn-icon rounded-round ml-2"
                                                                data-ajax-link="{{route('charity_payment_title_delete',['payment_pattern_id'=>$system_title['id'],'payment_title_id'=>$title['id']])}}"
                                                                data-method="POST"
                                                                data-csrf="{{csrf_token()}}"
                                                                data-title="{{trans('messages.delete_item',['item'=>trans('messages.payment_selection')])}}"
                                                                data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.payment_selection')])}}"
                                                                data-type="warning"
                                                                data-cancel="true"
                                                                data-confirm-text="{{trans('messages.delete')}}"
                                                                data-cancel-text="{{trans('messages.cancel')}}">
                                                            <i class="icon-trash"></i>
                                                        </button>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="text-danger">{{trans('messages.deleted_items')}}</span>
                                        <table class="table border-danger table-bordered table-striped">
                                            <tr class="font-size-lg font-weight-black header">
                                                <th>{{trans('messages.title')}}</th>
                                                <th></th>
                                            </tr>
                                            @foreach($deleted_titles as $deleted_title)
                                                <tr>
                                                    <td>{{$deleted_title['title']}}</td>
                                                    <td>
                                                        <button type="button" class="float-right btn alpha-success border-success-400 text-success-800 btn-icon rounded-round ml-2
                                             modal-ajax-load"
                                                                data-ajax-link="{{route('charity_payment_title_recover',['payment_pattern_id'=>$system_title['id'],'payment_title_id'=>$deleted_title['id']])}}"
                                                                data-toggle="modal"
                                                                data-modal-title="{{trans('messages.recover_item',['item'=>trans('messages.payment_selection')])}}"
                                                                data-target="#general_modal">
                                                            <i class="icon-rotate-cw2"></i>
                                                        </button>


                                                    </td>

                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="periodic_title">
                                <div class="card border-secondary">
                                    <div class="card-body">
                                        {!! $periodic_title['description'] !!}
                                        <span class="text-danger-300 float-right"><a href="#" class=" m-0 ml-2
                                             modal-ajax-load"
                                                                                     data-ajax-link="{{route('charity_payment_pattern_add',['payment_pattern_id'=>$periodic_title['id']])}}"
                                                                                     data-toggle="modal"
                                                                                     data-modal-size="modal-full"
                                                                                     data-modal-title="{{trans('messages.edit_item',['item'=>trans('messages.payment_pattern')])}}"
                                                                                     data-target="#general_modal">
                                                        {{trans('messages.edit')}}
                                                    </a> </span>
                                        @if(count($periodic_title['fields'])>0)
                                            <table class="table">
                                                <tr>
                                                    <th>{{trans('messages.title')}}</th>
                                                    <th>{{trans('messages.type')}}</th>
                                                    <th></th>
                                                </tr>
                                                @foreach($periodic_title['fields'] as $field)
                                                    <tr>
                                                        <td>{{$field['label']}}</td>
                                                        <td>
                                                            @switch($field['type'])
                                                                @case(0)
                                                                {{trans('messages.input')}}
                                                                @break
                                                                @case(1)
                                                                {{trans('messages.textarea')}}
                                                                @break
                                                                @case(2)
                                                                {{trans('messages.number')}}
                                                                @break
                                                                @case(3)
                                                                {{trans('messages.date_input')}}
                                                                @break
                                                                @case(4)
                                                                {{trans('messages.time_input')}}
                                                                @break
                                                            @endswitch
                                                        </td>
                                                        <td>
                                                            @switch($field['require'])
                                                                @case(0)
                                                                {{trans('messages.optional')}}
                                                                @break
                                                                @case(1)
                                                                {{trans('messages.required')}}
                                                                @break
                                                            @endswitch
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="payment_champion">
                                <div class="card border-secondary">
                                    <div class="card-body">
                                        {!! $champion_titles['description'] !!}
                                    </div>
                                    <hr>
                                    <a href="{{route('charity_champion_add')}}"
                                       class="btn btn-primary m-2 py-2 px-3 ">{{__('messages.add_champion')}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection