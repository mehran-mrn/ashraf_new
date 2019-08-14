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

            $(document).on('change', '#ticket_type_select', function () {
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
            <div class="col-sm-9">
                @foreach($ticket['histories'] as $history)
                    @if($history['note'])
                        <div class="card border-teal-800">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <i class="btn btn-flat btn-border alpha-blue m-1 pt-0 pb-0">
                                            {{ get_user($history['user_id'])['name']}}
                                        </i>
                                        <br>

                                        <i class="btn btn-flat btn-border alpha-blue pt-0 pb-0">
                                            {{ miladi_to_shamsi_date($history['note']['created_at'],null,true)}}
                                        </i>

                                    </div>
                                    <div class="col-md-9 ">
                                        <div class="card card-body bg-light mb-0">
                                            <div class="well">
                                                {!! $history['note']['description'] !!}
                                            </div>
                                        </div>
                                        <?php $i = 1;?>
                                        @foreach($history['note']['files'] as $file)
                                            <div><a href="{{storage_path('test.jpg')}}"><i
                                                            class="icon-file-media"></i> {{__('messages.attachment') . $i}}
                                                </a></div>
                                            <?php $i++; ?>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                <form class="" method="post"
                      action="{{route('add_ticket_note',['ticket_id'=>$ticket['id']])}}">
                    @csrf
                    <input name="ticket_id" type="hidden" value="{{$ticket['id']}}">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="description">{{__('messages.description')}}</label>
                            <textarea name="description" id="description" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">


                        <div class="col-lg-12">
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
                    <div class="form-group">
                        <button class="btn btn-block btn-success">{{__('messages.save')}}</button>

                    </div>
                </form>
            </div>
            <div class="col-sm-3">
                <div>
                    <a href="{{route('building_project',['project_id'=>$ticket['building_id']])}}"
                       class="btn bg-blue-300 btn-block "
                       data-popup="tooltip" title="" data-placement="bottom"
                       data-container="body" data-original-title="{{trans('messages.project_page')}}"
                    > {{trans('messages.project_page')}} <i class="icon-xl icon-backward"> </i></a>
                </div>
                <br>
                <div class="card border-info">
                    <div class="card-header p-1 bg-info">
                        {{__('messages.options')}}
                    </div>
                    <div class="card-body p-2">
                        <div class="row">
{{--                            <div class="col-sm-4 p-1">--}}
{{--                                <button class="btn mt-1 p-1 bg-success btn-block btn-float btn-float-lg"--}}
{{--                                        data-popup="tooltip" title="" data-placement="bottom"--}}
{{--                                        data-container="body" data-original-title="{{trans('messages.accept_ticket')}}"--}}
{{--                                ><i class="icon-xl icon-square-down"></i></button>--}}
{{--                            </div>--}}
                            @if(!$ticket['closed'])

                            <div class="col-sm-4 p-1">
                                <button type="button" class="btn mt-1 p-1 bg-orange btn-block btn-float btn-float-lg modal-ajax-load"
                                        data-ajax-link="{{route('load_building_ticket_close_form',['ticket_id'=>$ticket['id']])}}"
                                        data-toggle="modal"
                                        data-modal-title="{{trans('messages.close_ticket')}}"
                                        data-popup="tooltip"
                                        data-target="#general_modal"
                                        title=""
                                        data-placement="bottom"
                                        data-container="body" data-original-title="{{trans('messages.approve')}}"
                                ><i class="icon-xl icon-shield-check"></i></button>
                            </div>
                            @endif

                            @if($ticket['closed'])

                                <div class="col-sm-4 p-1">
                                    <button type="button" class="btn mt-1 p-1 bg-pink btn-block btn-float btn-float-lg modal-ajax-load"
                                            data-ajax-link="{{route('load_building_ticket_close_form',['ticket_id'=>$ticket['id']])}}"
                                            data-toggle="modal"
                                            data-modal-title="{{trans('messages.re_open_ticket')}}"
                                            data-popup="tooltip"
                                            data-target="#general_modal"
                                            title=""
                                            data-placement="bottom"
                                            data-container="body" data-original-title="{{trans('messages.re_open_ticket')}}"
                                    ><i class="icon-xl icon-reset"></i></button>
                                </div>
                            @endif
{{--                            <div class="col-sm-4 p-1">--}}
{{--                                <button class="btn mt-1 p-1 bg-danger btn-block btn-float btn-float-lg"--}}
{{--                                        data-popup="tooltip" title="" data-placement="bottom"--}}
{{--                                        data-container="body" data-original-title="{{trans('messages.close_ticket')}}"--}}
{{--                                ><i class="icon-xl icon-switch2"></i></button>--}}
{{--                            </div>--}}

{{--                            @if(!$ticket['closed'])--}}

{{--                            <div class="col-sm-4 p-1">--}}
{{--                                <button class="btn mt-1 p-1 bg-violet btn-block btn-float btn-float-lg"--}}
{{--                                        data-popup="tooltip" title="" data-placement="bottom"--}}
{{--                                        data-container="body" data-original-title="{{trans('messages.Refer_to')}}"--}}
{{--                                ><i class="icon-xl icon-reply"></i></button>--}}
{{--                            </div>--}}
{{--                            @endif--}}

                        </div>
                    </div>
                </div>
                <div class="card border-info ">
                    <div class="card-header p-1  bg-teal-800">
                        {{__('messages.ticket_info')}}
                    </div>
                    <div class="card-body font-size-lg ">
                        @if($ticket['closed'])
                        <div class="card-body-icon ">
                            <div class="text-danger-300" style="font-size: 4rem;">{{trans('messages.closed')}}</div>
                        </div>
                        @endif
                        <div class="list mb-1 "><strong>{{__('messages.project_title')}}:</strong> {{$project['title']}}
                        </div>
                        <div class="list mb-1"><strong>{{__('messages.creator')}}
                                :</strong> {{get_user($ticket['creator'])['name']}}</div>
                        <div class="list mb-1"><strong>{{__('messages.create_date')}}
                                :</strong> {{miladi_to_shamsi_date($ticket['created_at'])}}</div>
                        <div class="list mb-1"><strong>{{__('messages.ticket_id')}}
                                :</strong> {{$ticket['id']}}</div>

                        <div class="list mb-1"><strong>{{__('messages.priority')}}:</strong>
                            @switch($ticket['priority'])
                                @case('0')
                                <span class="badge badge-danger">{{__('messages.critical')}}</span>
                                @break
                                @case('1')
                                <span class="badge badge-warning">{{__('messages.high_priority')}}</span>
                                @break
                                @case('2')
                                <span class="badge badge-success">{{__('messages.normal_priority')}}</span>
                                @break
                                @case('3')
                                <span class="badge badge-info">{{__('messages.low_priority')}}</span>
                                @break
                                @default
                                ---
                            @endswitch
                        </div>
                        <div class="list mb-1"><strong>{{__('messages.type')." ".__('messages.ticket')}}:</strong>
                            @switch($ticket['ticket_type'])
                                @case('0')
                                <span>{{__('messages.progress_ticket')}} <i class="icon-percent"></i> </span>
                                @break
                                @case('1')
                                <span>{{__('messages.normal_ticket')}} <i class="icon-screen-normal"></i> </span>
                                @break
                                @default
                                ---
                            @endswitch
                        </div>
                        @if(!empty($ticket['predict_percent']))
                            <div class="list mb-1"><strong>{{__('messages.progress_percent')}}
                                    :</strong> {{$ticket['predict_percent']}} %</div>
                        @endif
                        @if(!empty($ticket['actual_percent']))
                            <div class="list mb-1"><strong>{{__('messages.actual_percent') ." ". __('messages.certain')}}
                                    :</strong> {{$ticket['actual_percent']}} %</div>
                        @endif

                    </div>
                </div>
                <div class="card border-info">
                    <div class="card-header p-1 bg-info">
                        {{__('messages.history')}}
                    </div>
                    <div class="card-body">
                        @foreach($ticket['histories'] as $history)
                            @switch($history['history_type'])
                                // 0 => created 1=> add note 2 =>refer 3=>assign to self 4=>close 5=> approve 6=> reject 7 => reOpen
                                @case(0)
                                <div class="list mb-1 text-muted"><strong> {{get_user($history['user_id'])['name']}}  {{__('messages.ticket_creation')}}
                                    </strong> {{miladi_to_shamsi_date($history['created_at'],null,true)}}</div>
                                @break
                                @case(1)
                                <div class="list mb-1 text-muted"><strong> {{get_user($history['user_id'])['name']}}  {{__('messages.add_note')}}
                                    </strong> {{miladi_to_shamsi_date($history['created_at'],null,true)}}</div>
                                @break
                                @case(2)
                                <div class="list mb-1 text-muted"><strong> {{get_user($history['user_id'])['name']}}  {{__('messages.refer')}}
                                    </strong> {{miladi_to_shamsi_date($history['created_at'],null,true)}}</div>
                                @break
                                @case(3)
                                <div class="list mb-1 text-muted"><strong> {{get_user($history['user_id'])['name']}}  {{__('messages.assign_to_self')}}
                                    </strong> {{miladi_to_shamsi_date($history['created_at'],null,true)}}</div>
                                @break
                                @case(4)
                                <div class="list mb-1 text-muted"><strong> {{get_user($history['user_id'])['name']}}  {{__('messages.close')}}
                                    </strong> {{miladi_to_shamsi_date($history['created_at'],null,true)}}</div>
                                @break
                                @case(5)
                                <div class="list mb-1 text-muted"><strong> {{get_user($history['user_id'])['name']}}  {{__('messages.approved')}}
                                    </strong> {{miladi_to_shamsi_date($history['created_at'],null,true)}}</div>
                                @break
                                @case(6)
                                <div class="list mb-1 text-muted"><strong> {{get_user($history['user_id'])['name']}}  {{__('messages.reject')}}
                                    </strong> {{miladi_to_shamsi_date($history['created_at'],null,true)}}</div>
                                @break
                                @case(7)
                                <div class="list mb-1 text-muted"><strong> {{get_user($history['user_id'])['name']}}  {{__('messages.re_open_ticket')}}
                                    </strong> {{miladi_to_shamsi_date($history['created_at'],null,true)}}</div>
                                @break
                                @default
                            @endswitch
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

