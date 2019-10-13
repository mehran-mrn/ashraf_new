<form method="POST" id="update_role_panel" class="form-ajax-submit"
      action="{{ route('role_update',['id'=>$id['id']]) }}">
    @csrf
    @method('PATCH')
    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('messages.name') }}</label>
        <div class="col-md-6">
            <input id="display_name" type="text"
                   class="form-control @error('display_name') is-invalid @enderror"
                   name="display_name"
                   value="{{ old('display_name') ?? $id['display_name'] }}"
                   autocomplete="off"
                   required="required"
                   minlength="3"
                   maxlength="20"
                   autofocus>
            @error('name')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('messages.key') }}</label>
        <div class="col-md-6">
            <input id="name"
                   type="text"
                   class="form-control @error('name') is-invalid @enderror"
                   name="name"
                   value="{{ old('name') ?? $id['name'] }}"
                   autocomplete="off"
                   required="required"
                   minlength="3"
                   maxlength="20">
            <label id="key-error" class="validation-invalid-label" for="key"></label>
            @error('email')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('messages.description') }}</label>
        <div class="col-md-6">
            <input id="description"
                   type="text"
                   class="form-control @error('description') is-invalid @enderror"
                   name="description"
                   value="{{ old('description') ?? $id['description'] }}"
                   autocomplete="off"
                   required="required"
                   minlength="3"
                   maxlength="100">
            @error('email')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
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
    $("#register_role_panel").validate({
        lang: "fa",
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