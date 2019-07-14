@extends('layouts.panel.panel_layout')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('js')
    <script src="{{URL::asset('/public/assets/panel/js/ckeditor/ckeditor.js')}}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>

    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/uploaders/dropzone.min.js')}}"></script>

    <script>

        // Setup module
        // ------------------------------

        var DropzoneUploader = function () {


            //
            // Setup module components
            //

            // Dropzone file uploader
            var _componentDropzone = function () {
                if (typeof Dropzone == 'undefined') {
                    console.warn('Warning - dropzone.min.js is not loaded.');
                    return;
                }

                // Removable thumbnails
                Dropzone.options.dropzoneRemove = {
                    url: "{{route('upload_files')}}", // The name that will be used to transfer the file
                    paramName: "file", // The name that will be used to transfer the file
                    dictDefaultMessage: 'Drop files to upload <span>or CLICK</span>',
                    maxFilesize: 5, // MB
                    maxFiles: 10,
                    addRemoveLinks: true,
                    init: function () {
                        this.on("success", function (file, response) {
                            var org_name = file.name;
                            var new_name = org_name.replace(".", "_");
                            $("#file_names").append(
                                '<input class="' + new_name + '" name="file_name[]" type="hidden" value="' + response + '" />'
                            );
                        });
                        this.on("complete", function (file) {
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


            //
            // Return objects assigned to module
            //

            return {
                init: function () {
                    _componentDropzone();

                }
            }
        }();

        // Initialize module
        // ------------------------------

        DropzoneUploader.init();

    </script>

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
            $("#ticket_type_select").select2();
            $("#ticket_priority_select").select2();
            $("#building_items").select2();

            $(document).on('change','#ticket_type_select',function () {
                var value = $('#ticket_type_select').val();
                if (value == '0') {
                    $('#progress_input_col').show();
                } else {
                    $('#progress_input_col').hide();
                }
            });


        });


    </script>
@endsection
@section('content')
    @php
        $active_sidbare = ['building', 'collapse']
    @endphp
    <div class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card border-info">
                    <div class="card-header bg-info">
                        {{__('messages.add_new',['item'=>__('messages.ticket')])}}
                    </div>
                    <div class="card-body">
                        <form class="" method="post"
                              action="{{route('building_new_ticket_submit',['project_id'=>1])}}">
                            @csrf
                            <input name="project_id" type="hidden" value="{{1}}">
                            <div class="row">
                                <div class="col-lg-8">

                                    <div class="form-group">
                                        <label for="ticket_title">{{__('messages.title')}}</label>
                                        <input class="form-control" type="text" name="ticket_title">
                                    </div>
                                </div>
                                <div class="col-lg-4">

                                    <div class="form-group">
                                        <label for="ticket_title">{{__('messages.priority')." ".__('messages.ticket')}}</label>
                                        <select name="priority" id="ticket_priority_select" class="form-control select-item">
                                            <option value="0">{{__('messages.critical')}}</option>
                                            <option value="1">{{__('messages.high_priority')}}</option>
                                            <option value="2">{{__('messages.normal_priority')}}</option>
                                            <option value="3">{{__('messages.low_priority')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group ">
                                        <label for="ticket_type">{{__('messages.type')." ".__('messages.ticket')}}</label>
                                        <select name="ticket_type" id="ticket_type_select" class="form-control  select-item">
                                            <option value="0">{{__('messages.progress_ticket')}}</option>
                                            <option value="1">{{__('messages.normal_ticket')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6" id="progress_input_col">
                                    <div class="row">
                                    <div class="col-lg-8">
                                    <div class="form-group ">
                                        <label for="ticket_title">{{__('messages.items')}}</label>
                                        <select name="item_id" id="building_items" class="form-control  select-item">
                                            @foreach(get_building_items(1) as $item)
                                                <option value="{{$item['id']}}">{{$item['title']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    </div>
                                    <div class="col-lg-4">
                                    <div class="form-group ">
                                        <label>{{__('messages.percent')}}</label>
                                        <input name="progress_percent" class="form-control text-danger-600 text-black" max="100" min="0" type="number" >

                                    </div>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-group">
                                    <label for="description">{{__('messages.description')}}</label>
                                    <textarea name="description" id="description" cols="30" rows="10"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">

                                <label class="col-lg-2 col-form-label font-weight-semibold">{{__('messages.file')}}</label>
                                <div class="col-lg-10">
                                    <div id="file_names">
                                    </div>
                                    {{--                                <input name="file[]" type="file" class="file-input-ajax" multiple="true" data-fouc>--}}
                                    <div class="dropzone" id="dropzone_remove">
                                        <div class="fallback">
                                            <input name="file" type="file" multiple/>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-2">
                            <div class="form-group">
                                <button class="btn btn-block btn-success">{{__('messages.save')}}</button>

                            </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-info">
                    <div class="card-header bg-info">
                        {{__('messages.users')}}
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

