<section class="">
    <div class="container" style="max-width: 700px">
        <h3 class="bg-theme-colored text-center p-15 mb-0 text-white">{{trans('messages.login_form_title')}}</h3>
        <div class="section-content bg-white p-30">
            <div class="row">
                <div class="col-md-12">
                    <form id="login_form" name="login_form" action="{{route('global_login_form_check')}}" method="post">
                        {{@csrf_field()}}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group ">
                                    <label for="phone_email" class="pull-right">{{trans('messages.email_or_mobile')}}
                                        <small>*</small>
                                    </label>
                                    <input id="phone_email" name="phone_email" type="text"
                                           placeholder="{{__('messages.enter_email_mobile')}}"
                                           class="form-control text-left required">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="password" class="pull-right">{{__('messages.password')}}
                                        <small>*</small>
                                    </label>
                                    <input id="password" name="password" class="form-control required text-left"
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
                                <a href="">{{__('messages.forgot_password')}}</a>
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
                                phone_email: {
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
                                form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
                                var form_btn_old_msg = form_btn.html();
                                form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
                                $(form).ajaxSubmit({
                                    dataType: 'json',
                                    success: function (data) {
                                        console.log(data);
                                        if (data.status == 'true') {
                                            $(form).find('.form-control').val('');
                                        }
                                        form_btn.prop('disabled', false).html(form_btn_old_msg);
                                        $(form_result_div).html(data.message).fadeIn('slow');
                                        setTimeout(function () {
                                            $(form_result_div).fadeOut('slow')
                                        }, 6000);
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
