@extends('layouts.global.global_layout')
@section('content')
    <div class="main-content">
        <!-- Section: inner-header -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-6" data-bg-img="{{URL::asset('/public/assets/global/images/bg/bg6.jpg')}}">
            <div class="container pt-60 pb-60">
                <!-- Section Content -->
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h3 class="font-28 text-white">{{__('messages.account')}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-push-3">
                        <form name="register_form" id="register_form" action="{{route('global_register_form_store')}}" class="register-form" method="post">
                            @csrf
                            <div class="icon-box mb-0 p-0">
                                <a href="#" class="icon icon-bordered icon-rounded icon-sm pull-left mb-0 mr-10">
                                    <i class="pe-7s-users"></i>
                                </a>
                                <h4 class="text-gray pt-10 mt-0 mb-30">{{__('messages.register_page_title')}}</h4>
                            </div>
                            <hr>
                            <p class="text-gray">{{__('messages.register_page_description')}}</p>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="phone_email">{{__('messages.email_or_mobile')}}</label>
                                    <input id="phone_email" name="phone_email" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="password">{{__('messages.password')}}</label>
                                    <input id="password" name="password" class="form-control" type="text">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password_confirmation">{{__('messages.repeat_password')}}</label>
                                    <input id="password_confirmation" name="password_confirmation"  class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-dark btn-lg btn-block mt-15" type="submit">{{__('messages.register')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
@section('footer_js')
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
                    }
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
                form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
                var form_btn_old_msg = form_btn.html();
                form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
                $(form).ajaxSubmit({
                    dataType:  'json',
                    success: function(response) {
                        PNotify.success({
                            text: response.message,
                            delay: 5000,
                        });
                        setTimeout(function(){
                            location.reload();
                        }, 3000);
                        $(form).find('.form-control').val('');
                        $(form_result_div).html(response.message).fadeIn('slow');
                        setTimeout(function(){ $(form_result_div).fadeOut('slow') }, 3000);
                    },
                    error:function (response){
                        var errors = response.responseJSON.errors;
                        $.each( errors, function( index, value ) {
                            PNotify.error({
                                delay: 5000,
                                title: index,
                                text: value,
                            });
                        });
                        setTimeout(function(){
                            $('[type="submit"]').prop('disabled', false);
                        }, 2500);

                    }
                });
            }
        });
    </script>
@endsection

