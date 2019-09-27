@extends('layouts.global.global_layout')
@section('title',__('messages.my_profile'). " |")
@section('js')
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/uploaders/dropzone.min.js')}}"></script>
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
                    url: "{{route('upload_ticket_files')}}", // The name that will be used to transfer the file
                    paramName: "file", // The name that will be used to transfer the file
                    dictDefaultMessage: '{{__('messages.please_click_for_change_profile_picture')}}',
                    maxFilesize: 10, // MB
                    maxFiles: 10,
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
                            <img src="{{asset(url('/public/assets/global/images/unknown-avatar.png'))}}" width="200" alt="">

                            <div class="form-group pt-20">
                                <div class="dropzone" id="dropzone_remove">
                                    <div class="fallback">
                                        <input name="file" type="file" multiple/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-xs-12">
                        <h4 class="mt-0 mb-30 line-bottom">{{__('messages.information')}}</h4>
                        <!-- Contact Form -->
                        <form id="contact_form" name="contact_form" class="" action="includes/sendmail.php" method="post">

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="form_name">{{__('messages.name')}} <small>*</small></label>
                                        <input id="form_name" name="form_name" class="form-control" type="text" placeholder="Enter Name" required="">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="form_email">{{__('messages.email')}} <small>*</small></label>
                                        <input id="form_email" name="form_email" class="form-control required email" type="email" placeholder="Enter Email">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="form_name">Subject <small>*</small></label>
                                        <input id="form_subject" name="form_subject" class="form-control required" type="text" placeholder="Enter Subject">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="form_phone">Phone</label>
                                        <input id="form_phone" name="form_phone" class="form-control" type="text" placeholder="Enter Phone">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="form_name">Message</label>
                                <textarea id="form_message" name="form_message" class="form-control required" rows="5" placeholder="Enter Message"></textarea>
                            </div>



                            <div class="form-group">
                                <input id="form_botcheck" name="form_botcheck" class="form-control" type="hidden" value="" />
                                <button type="submit" class="btn btn-dark btn-theme-colored btn-flat mr-5" data-loading-text="Please wait...">Send your message</button>
                                <button type="reset" class="btn btn-default btn-flat btn-theme-colored">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop