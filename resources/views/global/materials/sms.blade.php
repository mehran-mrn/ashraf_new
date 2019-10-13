<section class="">
    <script>
        $("#verify_mobile").validate({
            lang: "fa",
            submitHandler: function (form) {
                var form_btn = $(form).find('button[type="submit"]');
                var form_result_div = '#form-result';
                $(form_result_div).remove();
                form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
                var form_btn_old_msg = form_btn.html();
                form_btn.html(form_btn.prop('disabled', true).data("{{__('messages.please_waite')}}..."));
                $(form).ajaxSubmit({
                    dataType: '',
                    success: function (data) {
                        PNotify.success({
                            text: data.message.message,
                            delay: 3000,
                        });
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                        $(form).find('.form-control').val('');
                        $(form_btn).html(form_btn_old_msg);
                        $(form_result_div).html(data.message.message).fadeIn('slow');
                        setTimeout(function () {
                            $(form_result_div).fadeOut('slow')
                        }, 3000);
                    }, error: function (response) {
                        var errors = response.responseJSON;
                        $.each(errors, function (index, value) {
                            if (index === 'errors') {
                                PNotify.error({
                                    delay: 3000,
                                    title: "",
                                    text: value,
                                });
                            }
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
    <div class="container" style="max-width: 700px">
        <h3 class="bg-theme-colored text-center p-15 mb-0 text-white">{{trans('messages.verify_phone')}}</h3>
        <div class="section-content bg-white p-30">
            <div class="row">
                <div class="col-md-8 col-md-push-2">
                    <form id="verify_mobile" method="post" action="{{route('global_profile_verify_mobile')}}"
                          class="clearfix">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12 text-center">
                                <label for="code">{{__('messages.enter_sms_send_code')}}</label>
                                <input id="code" minlength="5" maxlength="5" name="code" class="form-control left"
                                       type="number" required="required">
                            </div>

                            <h2 class="time text-center"></h2>
                            <script>
                                var min = 2;
                                var sec = 59;
                                setInterval(function () {
                                    $(".time").html(min + ":" + sec);
                                    if (sec >= 0) {
                                        sec = sec - 1;
                                    }
                                    if (sec < 0) {
                                        min = min - 1;
                                        sec = 59;
                                    }
                                    if (min < 0) {
                                        min = 0;
                                        sec = 0;
                                        PNotify.error({
                                            delay: 3000,
                                            title: "{{__('messages.timeout')}}",
                                            text: "{{__('messages.try_again')}}",
                                        });
                                        setTimeout(function () {
                                            window.location.reload();
                                        }, 2000)
                                    }
                                }, 1000);
                            </script>
                        </div>
                        <div class="clear text-center pt-10">
                            <button class="btn btn-dark btn-lg btn-block no-border mt-15 mb-15" type="submit"
                                    data-bg-color="#3b5998">{{__('messages.submit')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


