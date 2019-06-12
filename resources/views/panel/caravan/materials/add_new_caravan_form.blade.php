<?php $rand_id = rand(1, 8000); ?>
<form method="POST" id="" enctype="multipart/form-data" class="form-ajax-submit" action="{{route('host_data')}}">
    @csrf
    @if(!empty($caravan))
    <input type="hidden" name="host_id" value="{{$caravan['id']}}">
    @endif
    <div class="row">
    <div class="col-md-6">

    <div class="form-group row">

            <label for="capacity" class="col-md-4 col-form-label text-md-right">{{ __('messages.capacity') }}</label>

            <div class="col-md-6">
                <input id="capacity" type="number" class="form-control @error('capacity') is-invalid @enderror" name="capacity"
                       value="{{$caravan['capacity']}}"  autocomplete="capacity" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>

        </div>

    <div class="form-group row">

        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('messages.name'). " " . __('messages.host')  }}</label>

        <div class="col-md-6">
            <select id="select_host_{{$rand_id}}" name="user_id" class="form-control select-search" data-fouc>
                @foreach($caravan_hosts as $caravan_host)
                    <option value="{{$caravan_host['id']}}">{{$caravan_host['city_name'].' | '. $caravan_host['name']}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">

            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('messages.province') . " " . __('messages.departure') }}</label>
            <div class="col-md-6">
                <input id="capacity" type="text" class="form-control @error('capacity') is-invalid @enderror" name="capacity"
                       value="{{$caravan['capacity']}}"  autocomplete="capacity" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>

        </div>

    <div class="form-group row">

        <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('messages.city') . " " . __('messages.departure') }}</label>
        <div class="col-md-6">
            <input id="capacity" type="text" class="form-control @error('capacity') is-invalid @enderror" name="capacity"
                   value="{{$caravan['capacity']}}"  autocomplete="capacity" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

    </div>

    <div class="form-group row">

            <label for="capacity" class="col-md-4 col-form-label text-md-right">{{ __('messages.budget') }}</label>

            <div class="col-md-6">
                <input id="capacity" type="number" class="form-control @error('capacity') is-invalid @enderror" name="capacity"
                       value="{{$caravan['capacity']}}"  autocomplete="capacity" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>

        </div>

    <div class="form-group row">

            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('messages.duty')}}</label>

            <div class="col-md-6">
                <select id="select_user_{{$rand_id}}" name="user_id" class="form-control select-search" data-fouc>
                    @foreach($users as $user)
                        <option value="{{$user['id']}}">{{$user['name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>

    </div>

    <div class="col-md-6">
        <div class="form-group row">

            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('messages.transport_type')}}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                       value="{{$caravan['name']}}"  autocomplete="name" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">

            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('messages.date'). " " . __('messages.depart')  }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                       value="{{$caravan['name']}}"  autocomplete="name" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">

            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('messages.date'). " " . __('messages.entrance')  }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                       value="{{$caravan['name']}}"  autocomplete="name" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">

            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('messages.date'). " " . __('messages.exit')  }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                       value="{{$caravan['name']}}"  autocomplete="name" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">

            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('messages.date'). " " . __('messages.get_back')  }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                       value="{{$caravan['name']}}"  autocomplete="name" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>


    </div>
    </div>
<hr>
        <div class="form-group row ">
            <div class="col-md-2 ">
                <button type="submit" class="btn btn-block btn-info">
                    {{ __('messages.save') }}
                </button>
            </div>
        </div>
</form>

<script>
    $(document).ready(function () {
        $("#select_host_{{$rand_id}}").select2();
        $("#select_user_{{$rand_id}}").select2();
    });
</script>