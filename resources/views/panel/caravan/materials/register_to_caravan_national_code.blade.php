<div class="form-group row">
    <div class="col-md-6">

    <label for="national_code "
           class="col-md-4 text-muted col-form-label ">{{ __('messages.national_code') }}</label>

    <input id="national_code" type="text" class=" col-md-6 form-control @error('national_code') is-invalid @enderror"
           name="national_code"
           value="" autocomplete="national_code" autofocus>

</div>
</div>