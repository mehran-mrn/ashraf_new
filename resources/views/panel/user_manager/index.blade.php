@extends('layouts.panel.panel_layout')
<?php
$active_sidbare = ['user_manager', 'users_list']
?>
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('js')
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/uploaders/dropzone.min.js')}}"></script>
    <script src="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.js') }}"></script>
    <script>
        var DropzoneUploader = function () {
            var _componentDropzone = function () {
                if (typeof Dropzone == 'undefined') {
                    console.warn('Warning - dropzone.min.js is not loaded.');
                    return;
                }
                Dropzone.options.dropzoneRemove = {
                    url: "{{route('user_info_update_image')}}",
                    paramName: "file",
                    dictDefaultMessage: '{{__('messages.please_click_for_change_profile_picture')}}',
                    maxFilesize: 5,
                    acceptedFiles: ".jpeg,.jpg,.png",
                    maxFiles: 1,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    addRemoveLinks: true,
                    init: function () {
                        this.on('sending', function (file, xhr, formData) {
                            var data = $('#frm_image').serializeArray();
                            $.each(data, function (key, el) {
                                formData.append(el.name, el.value);
                            });
                        });
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
                        url: "{{route('user_info_update')}}",
                        type: "post",
                        data: $(this).serialize(),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            if (data.message.status === 200) {

                                new PNotify({
                                    text: data.message.message,
                                    type: 'success',
                                    delay: 3000,

                                });
                            }
                            form_btn.prop('disabled', false).html(form_btn_old_msg);
                            setTimeout(function () {
                                window.location.href = "{{route('users_list')}}";
                            }, 2000)
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

            $('#birthday').MdPersianDateTimePicker({
                targetTextSelector: '#birthday',
                disableAfterToday: true
            });
        })
    </script>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('/public/vendor/laravel-filemanager/css/dropzone.min.css') }}">
    <link href="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.style.css') }}"
          rel="stylesheet" type="text/css">
@stop
@section('content')
    <section>
        <div class="content">
            <div class="container-fluid">
                <section>
                    <a href="{{route('users_list')}}" class="btn btn-outline-dark m-2 py-2 px-3">
                        < {{trans('messages.back')}}</a>
                </section>
                <section>
                    <div class="card">
                        <div class="card-header bg-light">
                            <h4 class="card-title">{{__('messages.users_list')}}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row ">
                                <div class="col-3">
                                    <h4 class="mt-0 mb-30 line-bottom">{{__('messages.image')}}</h4>
                                    <div class="card-img text-center">
                                        @if($userInfo['profile_image']->last())
                                            <?php
                                            $image = $userInfo['profile_image']->last();
                                            ?>
                                            <img src="/{{$image['path']}}/300/{{$image['name']}}" width="200"
                                                 alt="{{$userInfo['people']['name']}} {{$userInfo['people']['family']}} - {{__('messages.ashraf')}}">
                                        @else
                                            <img src="{{asset(url('/public/assets/global/images/unknown-avatar.png'))}}"
                                                 width="200"
                                                 alt="{{__('messages.ashraf')}}">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-9 col-xs-12">
                                    <form id="contact_form" name="contact_form"
                                          method="post">
                                        <input type="hidden" name="user_id" value="{{$userInfo['id']}}">
                                        <div class="row">
                                            <div class="col-xs-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="form_name">{{__('messages.name')}}
                                                        <small>*</small>
                                                    </label>
                                                    <input id="form_name" name="name" class="form-control" type="text"
                                                           placeholder="{{__('messages.enter_name')}}" required=""
                                                           minlength="2" maxlength="100"
                                                           value="{{$userInfo['people']['name']}}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="form_family">{{__('messages.family')}}
                                                        <small>*</small>
                                                    </label>
                                                    <input id="form_family" name="family" class="form-control"
                                                           type="text"
                                                           placeholder="{{__('messages.enter_family')}}"
                                                           required='required'
                                                           minlength="2" maxlength="100"
                                                           value="{{$userInfo['people']['family']}}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="form_national_code">{{__('messages.national_code')}} </label>
                                                    <input id="form_national_code" name="national_code"
                                                           class="form-control"
                                                           type="number"
                                                           placeholder="{{__('messages.enter_national_code')}}"
                                                           minlength="10" maxlength="10"
                                                           value="{{$userInfo['people']['national_code']}}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="form_email">{{__('messages.email')}}
                                                    </label>
                                                    <input id="form_email" name="email" class="form-control email"
                                                           type="email" placeholder="{{__('messages.enter_email')}}"
                                                           value="{{$userInfo['email']}}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="form_phone">{{__('messages.phone')}}</label>
                                                    <input id="form_phone" name="phone" class="form-control"
                                                           type="number"
                                                           placeholder="02122113344"
                                                           maxlength="11"
                                                           value="{{$userInfo['people']['phone']}}">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="form_mobile">{{__('messages.mobile')}}</label>
                                                    <input id="form_mobile" name="mobile" class="form-control"
                                                           type="number"
                                                           placeholder="09123456789" maxlength="11"
                                                           value="{{$userInfo['phone']}}" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="amount">{{__('messages.birth_date')}}</label>
                                                    <input id="birthday" type="text" class="form-control"
                                                           name="birthday"
                                                           value="@if($userInfo['people']['birth_date']){{jdate("Y-m-d",strtotime($userInfo['people']['birth_date']))}}@endif"
                                                           autocomplete="capacity">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-4">
                                                <label for="">{{__('messages.gender')}}</label>
                                                <div class="form-group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input value="1" type="radio" class="custom-control-input"
                                                               name="gender"
                                                               id="custom_radio_inline_g1" required="required"
                                                                {{$userInfo['people']['gender']==1?'checked="checked"':''}}>
                                                        <label class="custom-control-label"
                                                               for="custom_radio_inline_g1">{{__('messages.male')}}</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input value="2" type="radio" class="custom-control-input"
                                                               name="gender"
                                                               id="custom_radio_inline_g2" required="required"
                                                                {{$userInfo['people']['gender']==2?'checked="checked"':''}}>
                                                        <label class="custom-control-label"
                                                               for="custom_radio_inline_g2">{{__('messages.female')}}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-4">
                                                <label for="">{{__('messages.status')}}</label>
                                                <div class="form-group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input value="0" type="radio" class="custom-control-input"
                                                               name="status"
                                                               id="custom_radio_inline_g3" required="required"
                                                                {{$userInfo['disabled']==0?'checked="checked"':''}}>
                                                        <label class="custom-control-label"
                                                               for="custom_radio_inline_g3">{{__('messages.active')}}</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input value="1" type="radio" class="custom-control-input"
                                                               name="status"
                                                               id="custom_radio_inline_g4" required="required"
                                                                {{$userInfo['disabled']==1?'checked="checked"':''}}>
                                                        <label class="custom-control-label"
                                                               for="custom_radio_inline_g4">{{__('messages.inactive')}}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit"
                                                    class="btn btn-dark btn-theme-colored btn-flat mr-5 pull-left"
                                                    data-loading-text="Please wait...">{{__('messages.save')}}
                                            </button>
                                            <button type="reset"
                                                    class="btn btn-default btn-flat btn-theme-colored pull-left">{{__('messages.reset')}}</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-12">

                                    <div class="col-6">
                                        <form action="" method="post" id="frm_image">
                                            <input type="hidden" name="user_id" value="{{$userInfo['id']}}">
                                            <div class="form-group pt-5">
                                                <div class="dropzone" id="dropzone_remove">
                                                    <div class="fallback">
                                                        <input name="file" type="file"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection