
<form method="POST" id="" enctype="multipart/form-data" class="form-ajax-submit" action="{{route('host_data')}}">
    @csrf
    @if(!empty($host))
    <input type="hidden" name="host_id" value="{{$host['id']}}">
    @endif
        <div class="form-group row">

        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('messages.name'). " " . __('messages.host')  }}</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                   value="{{$host['name']}}"  autocomplete="name" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">

        <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('messages.name') . " " . __('messages.city') }}</label>

        <div class="col-md-6">
            <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city"
                   value="{{$host['city_name']}}"  autocomplete="city" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">

        <label for="capacity" class="col-md-4 col-form-label text-md-right">{{ __('messages.capacity') }}</label>

        <div class="col-md-6">
            <input id="capacity" type="number" class="form-control @error('capacity') is-invalid @enderror" name="capacity"
                   value="{{$host['capacity']}}"  autocomplete="capacity" autofocus>
            <span class="help-block text-muted">{{ trans('messages.empty').":". trans('messages.no_limit')}}</span>

            @error('name')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

    </div>

    <div class="form-group row">

        <label for="capacity" class="col-md-4 col-form-label text-md-right">{{ __('messages.gender') }}</label>

        <div class="col-md-6">

            <div class="custom-control custom-radio custom-control-inline">
                <input value="1" type="radio" class="custom-control-input" name="gender" id="custom_radio_inline_g1"
                        {{$host['gender'] == 1 ? "checked":""}}>
                <label class="custom-control-label" for="custom_radio_inline_g1">{{__('messages.male')}}</label>
            </div>

            <div class="custom-control custom-radio custom-control-inline">
                <input value="2" type="radio" class="custom-control-input" name="gender" id="custom_radio_inline_g2"
                        {{$host['gender'] == 2 ? "checked":""}}>
                <label class="custom-control-label" for="custom_radio_inline_g2">{{__('messages.female')}}</label>
            </div>

            <div class="custom-control custom-radio custom-control-inline">
                <input value="0" type="radio" class="custom-control-input" name="gender" id="custom_radio_inline_g0"
                       {{$host['gender'] == null ? "checked":""}}>
                <label class="custom-control-label" for="custom_radio_inline_g0">{{__('messages.both')}}</label>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="image" class="col-md-4 col-form-label text-md-right" >{{ __('messages.image') }}</label>

        <div class="col-lg-6">
            <input type="file" name="image" id="fileToUpload">
        </div>
    </div>

    <div class="form-group row">

        <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('messages.description') }}</label>

        <div class="col-md-6">

            <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description"
                   value="{{$host['description']}}"  autocomplete="city" autofocus>

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

