
<form method="POST" id="register_user_panel" class="form-ajax-submit" action="{{ route('panel_register_user') }}">
    @csrf

    <div class="form-group row ">
        <div class="col-md-6 offset-md-4">
            <span class="text-info"><i class="text-danger">*</i>  حداقل یکی از سه فیلد اول باید تکمیل شود
            </span>
        </div>
    </div>

    <div class="form-group row">

        <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('messages.username') }}</label>

        <div class="col-md-6">
            <input id="username" type="text" class="form-control @error('name') is-invalid @enderror" name="username"
                   value="{{ old('name') }}"  autocomplete="name" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('messages.email') }}</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                   value="{{ old('email') }}"  autocomplete="email">
            <label id="email-error" class="validation-invalid-label" for="email"></label>
            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('messages.phone') }}</label>

        <div class="col-md-6">
            <input id="phone" type="phone" class="form-control @error('email') is-invalid @enderror" name="phone"
                   value="{{ old('email') }}"  autocomplete="email">

            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('messages.password') }} <i
                    class="text-danger">*</i> </label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                   name="password" required autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
            </span>
            @enderror

        </div>
    </div>

    <div class="form-group row">
        <label for="repeat_password" class="col-md-4 col-form-label text-md-right">{{ __('messages.re-password') }} <i
                    class="text-danger">*</i> </label>

        <div class="col-md-6">
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required
                   autocomplete="new-password">
        </div>
    </div>

    <div class="form-group row ">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-block btn-info">
                {{ __('messages.submit') }}
            </button>
        </div>
    </div>



</form>

<script type="text/javascript">
    $("#register_user_panel").validate({
        lang: "fa",
        rules: {
            // username: {
            //     minlength: 3,
            // },
            // email: {
            //     minlength: 3,
            //     email: true,
            // },
            // phone: {
            //     minlength: 10,
            // },
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