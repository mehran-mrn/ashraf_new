
<form method="POST" id="" enctype="multipart/form-data" class="form-ajax-submit"
      action="{{empty($city)?route('cities.store'):route('cities.update',[$city['id']])}}">
    @csrf
    @if(!empty($city))
        <input type="hidden" name="city_id" value="{{$city['id']}}">
        @method('patch')
    @endif
    @if(!empty($parent))
        <input type="hidden" name="parent" value="{{$parent}}">
    @endif
        <div class="form-group row">

        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('messages.name'). " " . __('messages.city')  }}</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                   value="{{$city['name']}}"  autocomplete="name" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>


    <div class="form-group row ">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-block btn-info">
                {{ __('messages.save') }}
            </button>
        </div>
    </div>


</form>

