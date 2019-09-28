@extends('layouts.global.global_layout')
@section('title',__('messages.my_profile'). " |")
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('js')
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/uploaders/dropzone.min.js')}}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/validation/validate.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/global/js/localization/messages_fa.js') }}"></script>
    <script>
        var DropzoneUploader = function () {


            // Dropzone file uploader
            var _componentDropzone = function () {
                if (typeof Dropzone == 'undefined') {
                    console.warn('Warning - dropzone.min.js is not loaded.');
                    return;
                }

                // Removable thumbnails
                Dropzone.options.dropzoneRemove = {
                    url: "{{route('global_profile_completion_upload_image')}}", // The name that will be used to transfer the file
                    paramName: "file", // The name that will be used to transfer the file
                    dictDefaultMessage: '{{__('messages.please_click_for_change_profile_picture')}}',
                    maxFilesize: 3, // MB
                    acceptedFiles: ".jpeg,.jpg,.png",
                    maxFiles: 1,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    addRemoveLinks: true,
                    init: function () {
                        this.on("success", function (file, response) {
                            var org_name = file.name;
                            var new_name = org_name.replace(".", "_");
                            $("#file_names").append(
                                '<input class="' + new_name + '" name="doc_id[]" type="hidden" value="' + response + '" />'
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
            return {
                init: function () {
                    _componentDropzone();

                }
            }
        }();
        DropzoneUploader.init();

        $(document).ready(function () {
            $(document).on('submit', '#contact_form', function (e) {
                e.preventDefault();

                var form_btn = $(this).find('button[type="submit"]');
                var form_btn_old_msg = form_btn.html();
                form_btn.html(form_btn.prop('disabled', true).data("loading-text"));

                if ($(this).valid()) {
                    $.ajax({
                        url: "{{route('global_profile_completion_submit')}}",
                        type: "post",
                        data: $(this).serialize(),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            console.log(data);
                            if (data.message.status === 200) {
                                PNotify.success({
                                    text: data.message.message,
                                    delay: 3000,
                                });
                            }
                            form_btn.prop('disabled', false).html(form_btn_old_msg);
                        }, error: function (error) {
                            $.each(error.responseJSON.errors, function (i, item) {
                                PNotify.error({
                                    text: item,
                                    delay: 3000,
                                });
                            });
                            form_btn.prop('disabled', false).html(form_btn_old_msg);
                        }
                    });
                }
                form_btn.prop('disabled', false).html(form_btn_old_msg);

            })
        })
    </script>
@stop
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('/public/vendor/laravel-filemanager/css/dropzone.min.css') }}">
@stop
@section('content')

    <div class="main-content">
        <section class="divider">
            <div class="container pt-10">
                <div class="row pt-10">
                    <div class="col-md-3 col-xs-12">
                        <h4 class="mt-0 mb-30 line-bottom">{{__('messages.image')}}</h4>
                        <div class="media text-center">
                            @if($userInfo['profile_image']->last())
                                <?php
                                $image = $userInfo['profile_image']->last();
                                ?>
                                <img src="/{{$image['path']}}/300/{{$image['name']}}" width="200"
                                     alt="{{$userInfo['people']['name']}} {{$userInfo['people']['family']}} - {{__('messages.ashraf')}}">
                            @else
                                <img src="{{asset(url('/public/assets/global/images/unknown-avatar.png'))}}" width="200"
                                     alt="{{__('messages.ashraf')}}">
                            @endif
                            <div class="form-group pt-20">
                                <div class="dropzone" id="dropzone_remove">
                                    <div class="fallback">
                                        <input name="file" type="file"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-xs-12">
                        <h4 class="mt-0 mb-30 line-bottom">{{__('messages.information')}}</h4>
                        <!-- Contact Form -->
                        <form id="contact_form" name="contact_form" class="" novalidate
                              method="post">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="form_name">{{__('messages.name')}}
                                            <small>*</small>
                                        </label>
                                        <input id="form_name" name="name" class="form-control" type="text"
                                               placeholder="{{__('messages.enter_name')}}" required=""
                                               minlength="2" maxlength="100">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="form_family">{{__('messages.family')}}
                                            <small>*</small>
                                        </label>
                                        <input id="form_family" name="family" class="form-control" type="text"
                                               placeholder="{{__('messages.enter_family')}}" required='required'
                                               minlength="2" maxlength="100">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="form_national_code">{{__('messages.national_code')}} </label>
                                        <input id="form_national_code" name="national_code" class="form-control"
                                               type="number" placeholder="{{__('messages.enter_national_code')}}"
                                               minlength="10" maxlength="10">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="form_email">{{__('messages.email')}}
                                            <small>*</small>
                                        </label>
                                        <input id="form_email" name="email" class="form-control required email"
                                               type="email" placeholder="{{__('messages.enter_email')}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="form_phone">{{__('messages.phone')}}</label>
                                        <input id="form_phone" name="phone" class="form-control" type="number"
                                               placeholder="02122113344"
                                               maxlength="11">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="form_mobile">{{__('messages.mobile')}}</label>
                                        <input id="form_mobile" name="mobile" class="form-control" type="number"
                                               placeholder="09123456789" maxlength="11">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="form_username">{{__('messages.username')}}</label>
                                        <input id="form_username" name="username" class="form-control" type="text"
                                               placeholder="{{__('messages.enter_username')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-dark btn-theme-colored btn-flat mr-5 pull-left"
                                        data-loading-text="Please wait...">{{__('messages.save')}}
                                </button>
                                <button type="reset"
                                        class="btn btn-default btn-flat btn-theme-colored pull-left">{{__('messages.reset')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop