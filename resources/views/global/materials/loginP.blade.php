<section class="">
    <div class="container" style="max-width: 700px">
        <h3 class="bg-theme-colored text-center p-15 mb-0 text-white">{{trans('messages.login_form_title')}}</h3>
        <div class="section-content bg-white p-30">
            <div class="row">
                <div class="col-md-12">
                    <form id="login_form" name="login_form" method="post" action="{{route('login')}}">
                        {{@csrf_field()}}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group ">
                                    <label for="phone_email" class="pull-right">{{trans('messages.email_or_mobile')}}
                                        <small>*</small>
                                    </label>
                                    <input id="name" name="name" type="text" dir="ltr"
                                           placeholder="{{__('messages.enter_email_mobile')}}"
                                           class="form-control text-left required">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="password" class="pull-right">{{__('messages.password')}}
                                        <small>*</small>
                                    </label>
                                    <input id="password" name="password" dir="ltr" class="form-control required text-left"
                                           type="password" placeholder="{{__('messages.enter_password')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 text-right">
                                <div class="check">
                                    <input type="checkbox" class="" name="remember" id="remember"> <label
                                            for="remember">{{__('messages.remember_me')}}</label>
                                </div>
                            </div>
                            <div class="col-sm-6 text-left">
                                <a href="{{route('global_reset_password')}}">{{__('messages.forgot_password')}}</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <input id="form_botcheck" name="form_botcheck" class="form-control" type="hidden" value=""/>
                            <button type="submit"
                                    class="btn btn-block btn-dark btn-theme-colored btn-sm mt-20 pt-10 pb-10"
                                    data-loading-text="{{__("messages.please_waite")}}">{{__('messages.login')}}</button>
                        </div>
                    </form>
                    <!-- Job Form Validation-->
                    <script type="text/javascript">
                        $("#login_form").validate({
                            lang: "fa",
                            rules: {
                                name: {
                                    required: true,
                                    minlength: 3
                                },
                                password: {
                                    required: true,
                                    minlength: 5,
                                    maxlength: 100,
                                },
                            },
                            submitHandler: function (form) {
                                var form_btn = $(form).find('button[type="submit"]');
                                var form_result_div = '#form-result';
                                $(form_result_div).remove();
                                form_btn.before('<div id="form-result" class="alert alert-success text-center" role="alert" style="display: none;"></div>');
                                var form_btn_old_msg = form_btn.html();
                                form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
                                $(form).ajaxSubmit({
                                    dataType: '',
                                    success: function (data) {
                                        console.log(11);
                                        PNotify.success({
                                            text: "{{__('messages.login_successfully')}}",
                                            delay: 3000,
                                        });
                                        setTimeout(function () {
                                            location.reload();
                                        }, 3000);
                                        $(form).find('.form-control').val('');
                                        $(form_btn).html(form_btn_old_msg);
                                        $(form_result_div).html("{{__('messages.login_successfully')}}").fadeIn('slow');
                                        setTimeout(function () {
                                            $(form_result_div).fadeOut('slow')
                                        }, 3000);
                                    }, error: function (response) {
                                        var errors = response.responseJSON.errors;
                                        $.each(errors, function (index, value) {
                                            PNotify.error({
                                                delay: 3000,
                                                text: value,
                                            });
                                        });
                                        setTimeout(function () {
                                            $('[type="submit"]').prop('disabled', false);
                                        }, 2500);
                                        $(form_btn).html(form_btn_old_msg);
                                    }
                                });
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</section>
