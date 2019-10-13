<form method="POST" id="register_permission_panel" class="form-ajax-submit"
      action="{{ route('panel_register_permission') }}" autocomplete="off">
    @csrf
    <div class="row">
        <div class="col-6 form-group">
            <label for="name">{{ __('messages.name') }}</label>
            <input id="display_name" type="text" class="form-control @error('name') is-invalid @enderror"
                   name="display_name"
                   value="{{ old('display_name') }}" autocomplete="display_name" autofocus>
            @error('name')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror

        </div>
        <div class="col-6 form-group">
            <label for="key">{{__('messages.key')}}</label>
            <input id="key" type="text" class="form-control @error('email') is-invalid @enderror" name="key"
                   value="{{ old('key') }}" autocomplete="key">
            @error('email')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="col-6 form-group">
            <label for="category">{{ __('messages.category') }}</label>
            @if(sizeof($categories)>=1)
                <select name="category" id="category" class="form-control">
                    @foreach($categories as $cat)
                        <option value="{{$cat['category']}}">{{$cat['category']}}</option>
                    @endforeach
                </select>
            @else
                <input id="category" type="text" class="form-control @error('category') is-invalid @enderror"
                       name="category"
                       value="{{ old('category') }}" autocomplete="category">
            @endif
            @error('category')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="col-6 form-group">
            <label for="description">{{ __('messages.description') }}</label>
            <input id="description" type="description"
                   class="form-control @error('description') is-invalid @enderror"
                   name="description"
                   value="{{ old('description') }}" autocomplete="description">
            @error('description')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="col-6"></div>
        <div class="col-6 form-group">
            <button type="submit" class="btn btn-block btn-info">
                {{ __('messages.submit') }}
            </button>
        </div>
    </div>
</form>

<script type="text/javascript">
    $("#register_permission_panel").validate({
        lang: "fa",
        rules: {
            name: {
                minlength: 3,
                require: true,
            },
            key: {
                minlength: 3,
                require: true,
            },
            description: {
                minlength: 10,
                maxlength: 250,
                require: true,

            },

        },
        submitHandler: function (form) {
            var form_btn = $("#register_permission_panel").find('button[type="submit"]');
            var form_result_div = '#form-result';
            $(form_result_div).remove();
            form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
            var form_btn_old_msg = form_btn.html();
            form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
            $(form).ajaxSubmit({
                dataType: 'json',
                success: function (data) {
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