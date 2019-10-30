@extends('layouts.global.global_layout')
@section('title',__('messages.contact_to_we'). " | ".__("messages.ashraf"))
@section('js')
    <script>
        $(document).ready(function () {
            $("#contact_form").validate({
                submitHandler: function (form) {
                    var form_btn = $(form).find('button[type="submit"]');
                    var form_result_div = '#form-result';
                    $(form_result_div).remove();
                    var form_btn_old_msg = form_btn.html();
                    form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
                    $(form).ajaxSubmit({
                        url: "{{route('contact.store')}}",
                        dataType: 'json',
                        success: function (data) {
                            if (data.message.status == 200) {
                                form_btn.parent().before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
                                PNotify.success({
                                    text: data.message.message,
                                    delay: 3000,
                                });
                                $(form).find('.form-control').val('');
                                setTimeout(function () {
                                    window.location.reload();
                                }, 2000);
                            }
                            if (data.message.status == 404) {
                                form_btn.parent().before('<div class="form-group"><div id="form-result" class="alert alert-danger" role="alert" style="display: none;"></div></div>');

                                PNotify.error({
                                    text: data.message.message,
                                    delay: 2000,
                                });
                                // $(form).find('.form-control').val('');
                            }
                            form_btn.prop('disabled', false).html(form_btn_old_msg);
                            $(form_result_div).html(data.message.message).fadeIn('slow');
                            setTimeout(function () {
                                $(form_result_div).fadeOut('slow')
                            }, 3000);
                        },
                        error: function (response) {
                            var errors = response.responseJSON.errors;
                            $.each(errors, function (index, value) {
                                PNotify.error({
                                    delay: 5000,
                                    title: '',
                                    text: value,
                                });
                            });
                            form_btn.prop('disabled', false).html(form_btn_old_msg);
                            $(form_result_div).html(data.message).fadeIn('slow');
                            setTimeout(function () {
                                $(form_result_div).fadeOut('slow')
                            }, 6000);

                        }
                    });
                }
            });


            // $(document).on('click', '.cap', function () {
            //     $(this).html('0');
                {{--$(this).html('{!!  captcha_img('flat') !!}');--}}
            // });
        })


    </script>
@stop
@section('content')
    <div class="main-content">
        <section class="divider">
            <div class="container">
                <div class="row pt-10">
                    <div class="col-md-7">
                        <h4 class="mt-0 mb-30 line-bottom">{{__('messages.contact_to_we')}}</h4>
                        <!-- Contact Form -->
                        <form id="contact_form" name="contact_form" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="name">{{__('messages.name')}}
                                            <small>*</small>
                                        </label>
                                        <input id="name" name="name" class="form-control" type="text"
                                               placeholder="{{__('messages.enter_name')}}" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">{{__('messages.email')}}
                                            <small>*</small>
                                        </label>
                                        <input id="email" name="email" class="form-control required email" type="email"
                                               placeholder="{{__('messages.enter_email')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="subject">{{__('messages.subject')}}
                                            <small>*</small>
                                        </label>
                                        <input id="subject" name="subject" class="form-control required" type="text"
                                               placeholder="{{__('messages.enter_subject')}}">

                                    </div>
                                    <div class="form-group">
                                        <label for="phone">{{__('messages.phone')}}</label>
                                        <input id="phone" name="phone" class="form-control" type="text"
                                               placeholder="{{__('messages.enter_Phone')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="message">{{__('messages.message')}}</label>
                                        <textarea id="message" name="message" class="form-control required" rows="5"
                                                  placeholder="{{__('messages.enter_message')}}"></textarea>
                                    </div>
{{--                                    <div class="form-group">--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-md-5 col-xs-12">--}}
{{--                                                <div class="input-group">--}}
{{--                                                    <a href="javascript:;"--}}
{{--                                                       class="cap">{!! captcha_img('flat') !!}</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-7 col-xs-12">--}}
{{--                                                <input type="text" required="required" class="form-control"--}}
{{--                                                       name="captcha"--}}
{{--                                                       placeholder="{{__('messages.enter_captcha_code')}}">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="form-group">
                                        <input id="form_botcheck" name="form_botcheck" class="form-control"
                                               type="hidden" value=""/>
                                    </div>
                                    <div class="form-group pull-left">
                                        <button type="submit" class="btn btn-dark btn-theme-colored btn-flat mr-5"
                                                data-loading-text="{{__('messages.waiting')}}...">{{__('messages.send_message')}}</button>
                                        <button type="reset"
                                                class="btn btn-default btn-flat btn-theme-colored">{{__('messages.reset')}}</button>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4 col-md-offset-1">
                        <div class="contact-info text-center pt-40 pb-40 mt-10 bg-light border-bottom border-theme-colored">
                            <i class="fa fa-phone font-36 mb-10 text-theme-colored"></i>
                            <h4>{{__('messages.phone')}}</h4>
                            <h6 class="text-gray">{{__('site_info.phone')}}</h6>
                        </div>
                        <div class="contact-info text-center pt-40 pb-40 mt-10 bg-light border-bottom border-theme-colored">
                            <i class="fa fa-envelope font-36 mb-10 text-theme-colored"></i>
                            <h4>{{__('messages.email')}}</h4>
                            <h6 class="text-gray">{{__('site_info.email')}}</h6>
                        </div>
                        <div class="contact-info text-center pt-40 pb-40 mt-10 bg-light border-bottom border-theme-colored">
                            <i class="fa fa-map-marker font-36 mb-10 text-theme-colored"></i>
                            <h4>{{__('messages.address')}}</h4>
                            <h6 class="text-gray">{{__('site_info.address')}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <!-- Google Map HTML Codes -->
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d809.6122279945664!2d51.502356829215394!3d35.799018998760445!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzXCsDQ3JzU2LjUiTiA1McKwMzAnMTAuNSJF!5e0!3m2!1sen!2s!4v1572438601919!5m2!1sen!2s&language=fa" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>

        </section>
    </div>
@endsection
