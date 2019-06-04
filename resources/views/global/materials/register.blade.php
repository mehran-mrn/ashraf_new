<section class="">
    <div class="container" style="max-width: 700px;">
        <h3 class="bg-theme-colored p-15 mb-0 text-white">{{trans('messages.register_form_title')}}</h3>
        <div class="section-content bg-white p-30">
            <div class="row">
                <div class="col-md-12">
                    <form id="volunteer_apply_form" name="job_apply_form" action="includes/become-volunteer.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="form_name">{{trans('messages.name')}} <small>*</small></label>
                                    <input id="form_name" name="form_name" type="text" placeholder="{{__('enter_email_phone')}}" required="required" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="form_email">{{__('messages.email')}} <small>*</small></label>
                                    <input id="form_email" name="form_email" class="form-control required email" type="email" placeholder="Enter Email">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input id="form_botcheck" name="form_botcheck" class="form-control" type="hidden" value="" />
                            <button type="submit" class="btn btn-block btn-dark btn-theme-colored btn-sm mt-20 pt-10 pb-10" data-loading-text="Please wait...">Apply Now</button>
                        </div>
                    </form>
                    <!-- Job Form Validation-->
                    <script type="text/javascript">
                        $("#volunteer_apply_form").validate({
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
