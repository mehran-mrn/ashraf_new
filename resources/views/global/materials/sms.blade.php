<section class="">
    <script>
        $("#change_password_form").validate({
            lang: "fa",
            rules: {
                now_password: {
                    required: true,
                    minlength: 3
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
            submitHandler: function (form) {
                var form_btn = $(form).find('button[type="submit"]');
                var form_result_div = '#form-result';
                $(form_result_div).remove();
                form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
                var form_btn_old_msg = form_btn.html();
                form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
                $(form).ajaxSubmit({
                    dataType: '',
                    success: function (data) {
                        PNotify.success({
                            text: data.message,
                            delay: 3000,
                        });
                        setTimeout(function(){
                            location.reload();
                        }, 3000);
                        $(form).find('.form-control').val('');
                        $(form_btn).html(form_btn_old_msg);
                        $(form_result_div).html(data.message).fadeIn('slow');
                        setTimeout(function(){ $(form_result_div).fadeOut('slow') }, 3000);
                    }, error:function (response){
                        var errors = response.responseJSON.errors;
                        $.each( errors, function( index, value ) {
                            PNotify.error({
                                delay: 3000,
                                title: index,
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
    <div class="container" style="max-width: 700px">
        <h3 class="bg-theme-colored text-center p-15 mb-0 text-white">{{trans('messages.change_password')}}</h3>
        <div class="section-content bg-white p-30">
            <div class="row">
                <div class="col-md-8 col-md-push-2">
                    <form id="change_password_form" method="post" action="{{route('global_update_password')}}" class="clearfix">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12 ">
                                <label for="old_password" class="pull-right">{{__('messages.now_password')}}</label>
                                <input id="old_password" name="old_password" class="form-control left"
                                       type="password" required="required" placeholder="{{__('messages.now_password')}}">
                            </div>

                        </div>
                        <div class="clear text-center pt-10">
                            <button class="btn btn-dark btn-lg btn-block no-border mt-15 mb-15" type="submit"
                               data-bg-color="#3b5998">{{__('messages.change_password')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


