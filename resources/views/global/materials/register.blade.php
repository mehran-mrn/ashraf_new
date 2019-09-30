<section class="">
    <div class="container"  style="max-width: 700px">
        <h3 class="bg-theme-colored text-center p-15 mb-0 text-white">{{trans('messages.register_form_title')}}</h3>
        <div class="section-content bg-white p-30">
            <div class="row">
                <div class="col-md-12">
                    <form id="register_form" name="register_form" action="{{route('global_register_form_store')}}" method="post" >
                        {{@csrf_field()}}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group ">
                                    <label for="phone_email" class="pull-right">{{trans('messages.email_or_mobile')}} <small>*</small></label>
                                    <input id="phone_email" dir="ltr" name="phone_email" type="text" placeholder="{{__('messages.enter_email_mobile')}}" class="form-control text-left required">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="password" class="pull-right">{{__('messages.password')}} <small>*</small></label>
                                    <input id="password" dir="ltr" name="password" class="form-control required text-left" type="password" placeholder="{{__('messages.enter_password')}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="password_confirmation" class="pull-right">{{__('messages.repeat_password')}} <small>*</small></label>
                                    <input id="password_confirmation" dir="ltr" name="password_confirmation" class="form-control required text-left" type="password" placeholder="{{__('messages.repeat_repeat_password')}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input id="form_botcheck" name="form_botcheck" class="form-control" type="hidden" value="" />
                            <button type="submit" class="btn btn-block btn-dark btn-theme-colored btn-sm mt-20 pt-10 pb-10" data-loading-text="{{__("messages.please_waite")}}">{{__('messages.register_btn')}}</button>
                        </div>
                    </form>
                    <!-- Job Form Validation-->
                    <script type="text/javascript">
                        $("#register_form").validate({
                            lang:"fa",
                            rules: {
                                phone_email: {
                                    required: true,
                                    minlength: 3,
                                    remote:{
                                        url:"{{route('check_email')}}",
                                        headers: {
                                            'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                                        },
                                        type:"post"
                                    },
                                },
                                password: {
                                    required: true,
                                    minlength: 5,
                                    maxlength: 100,
                                },
                                password_confirmation: {
                                    minlength: 5,
                                    equalTo: "#password"
                                },
                            },
                            messages:
                                {
                                    phone_email:{
                                        remote:"{{__('messages.duplicate_email')}}"
                                    }
                                },
                            submitHandler: function(form) {
                                var form_btn = $(form).find('button[type="submit"]');
                                var form_result_div = '#form-result';
                                $(form_result_div).remove();
                                form_btn.before('<div id="form-result" class="alert alert-success text-center" role="alert" style="display: none;"></div>');
                                var form_btn_old_msg = form_btn.html();
                                form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
                                $(form).ajaxSubmit({
                                    dataType:  'json',
                                    success: function(response) {
                                        console.log(response)
                                        PNotify.success({
                                            text: response.message,
                                            delay: 5000,
                                        });
                                        setTimeout(function(){
                                            location.reload();
                                        }, 3000);
                                        $(form).find('.form-control').val('');
                                        $(form_btn).html(form_btn_old_msg);
                                        $(form_result_div).html(response.message).fadeIn('slow');
                                        setTimeout(function(){ $(form_result_div).fadeOut('slow') }, 3000);
                                    },
                                    error:function (response){
                                        console.log(response)
                                        var errors = response.responseJSON.errors;
                                        $.each( errors, function( index, value ) {
                                            PNotify.error({
                                                delay: 5000,
                                                text: value,
                                            });
                                        });
                                        setTimeout(function(){
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
