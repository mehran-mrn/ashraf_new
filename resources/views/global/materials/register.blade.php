<section class="">
    <div class="container"  style="max-width: 700px">
        <h3 class="bg-theme-colored p-15 mb-0 text-white">{{trans('messages.register_form_title')}}</h3>
        <div class="section-content bg-white p-30">
            <div class="row">
                <div class="col-md-12">
                    <form id="volunteer_apply_form" name="job_apply_form" action="includes/become-volunteer.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group ">
                                    <label for="form_email" class="pull-right">{{trans('messages.email_or_mobile')}} <small>*</small></label>
                                    <input id="form_email" name="form_email" type="text" placeholder="{{__('messages.enter_email_mobile')}}" class="form-control text-left required">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="form_password" class="pull-right">{{__('messages.password')}} <small>*</small></label>
                                    <input id="form_password" name="form_password" class="form-control required text-left" type="password" placeholder="{{__('messages.enter_password')}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="form_repeat_password" class="pull-right">{{__('messages.repeat_password')}} <small>*</small></label>
                                    <input id="form_repeat_password" name="form_repeat_password" class="form-control required text-left" type="password" placeholder="{{__('messages.repeat_repeat_password')}}">
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
                        $("#volunteer_apply_form").validate({
                            lang:"fa",
                            rules: {
                                form_email: {
                                    required: true,
                                    minlength: 3
                                },
                                form_password: {
                                    required: true,
                                    minlength: 5,
                                    maxlength: 100,
                                },
                                form_repeat_password: {
                                    minlength: 5,
                                    equalTo: "#form_password"
                                },
                            },
                            submitHandler: function(form) {
                                var form_btn = $(form).find('button[type="submit"]');
                                var form_result_div = '#form-result';
                                $(form_result_div).remove();
                                form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
                                var form_btn_old_msg = form_btn.html();
                                form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
                                $(form).ajaxSubmit({
                                    dataType:  'json',
                                    success: function(data) {
                                        if( data.status == 'true' ) {
                                            $(form).find('.form-control').val('');
                                        }
                                        form_btn.prop('disabled', false).html(form_btn_old_msg);
                                        $(form_result_div).html(data.message).fadeIn('slow');
                                        setTimeout(function(){ $(form_result_div).fadeOut('slow') }, 6000);
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
