<form method="POST" class="form-ajax-submit" action="{{ route('panel_register_user') }}">
    @csrf


    <div class="form-group row ">
        <div class="col-md-6 offset-md-4">
            <span class="text-info"><i class="text-danger">*</i>  حداقل یکی از سه فیلد اول باید تکمیل شود
            </span>
        </div>
    </div>

    <div class="form-group row">

        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('messages.username') }}</label>

        <div class="col-md-6">
            <input id="username" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                   value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                   value="{{ old('email') }}" required autocomplete="email">

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
                   value="{{ old('email') }}" required autocomplete="email">

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
        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('messages.re-password') }} <i
                    class="text-danger">*</i> </label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
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


@include('panel.materials.form_notification')

</form>
