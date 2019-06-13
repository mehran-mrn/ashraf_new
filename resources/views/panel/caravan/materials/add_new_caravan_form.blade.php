<?php $rand_id = rand(1, 8000); ?>
<form method="POST" id="" enctype="multipart/form-data" class="form-ajax-submit" action="{{route('caravan_data')}}"
      autocomplete="off">
    @csrf
    @if(!empty($caravan))
        <input type="hidden" name="host_id" value="{{$caravan['id']}}">
    @endif
    <div class="row">
        <div class="col-md-6">

            <div class="form-group row">

                <label for="capacity"
                       class="col-md-4 col-form-label text-md-right">{{ __('messages.capacity') }}</label>

                <div class="col-md-6">
                    <input id="capacity" type="number" class="form-control @error('capacity') is-invalid @enderror"
                           name="capacity"
                           value="{{$caravan['capacity']}}" autocomplete="capacity" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
            </span>
                    @enderror
                </div>

            </div>

            <div class="form-group row">

                <label for="select_host_{{$rand_id}}"
                       class="col-md-4 col-form-label text-md-right">{{ __('messages.name'). " " . __('messages.host')  }}</label>

                <div class="col-md-6">
                    <select id="select_host_{{$rand_id}}" name="user_id" class="form-control select-search" data-fouc>
                        @foreach($caravan_hosts as $caravan_host)
                            <option value="{{$caravan_host['id']}}">{{$caravan_host['city_name'].' | '. $caravan_host['name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">

                <label for="select_province_{{$rand_id}}"
                       class="col-md-4 col-form-label text-md-right">{{ __('messages.province') . " " . __('messages.departure') }}</label>
                <div class="col-md-6">
                    <select id="select_province_{{$rand_id}}" name="province_id" class="form-control select-search"
                            data-fouc>
                        @foreach(get_provinces() as $province)
                            <option value="{{$province['id']}}">{{$province['name']}}</option>
                        @endforeach
                    </select>
                </div>


            </div>

            <div class="form-group row">

                <label for="select_city_{{$rand_id}}"
                       class="col-md-4 col-form-label text-md-right">{{ __('messages.city') . " " . __('messages.departure') }}</label>
                <div class="col-md-6">
                    <select id="select_city_{{$rand_id}}" name="city_id" class="form-control select-search" data-fouc>

                        @foreach(get_cites() as $city)
                            <option value="{{$city['id']}}">{{$city['name']}}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="form-group row">

                <label for="budget" class="col-md-4 col-form-label text-md-right">{{ __('messages.budget') }}</label>

                <div class="col-md-6">
                    <input id="budget" type="number" class="form-control @error('capacity') is-invalid @enderror"
                           name="capacity"
                           value="{{$caravan['capacity']}}" >

                    @error('budget')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
            </span>
                    @enderror
                </div>

            </div>

            <div class="form-group row">

                <label for="select_user_{{$rand_id}}" class="col-md-4 col-form-label text-md-right">{{ __('messages.duty')}}</label>

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

                <label for="transport"
                       class="col-md-4 col-form-label text-md-right">{{ __('messages.transport_type')}}</label>

                <div class="col-md-6">
                    <input id="transport" type="text" class="form-control @error('transport') is-invalid @enderror" name="transport"
                           value="{{$caravan['transport']}}" autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">

                <label for="date_depart_{{$rand_id}}"
                       class="col-md-4 col-form-label text-md-right">{{ __('messages.date'). " " . __('messages.depart')  }}</label>

                <div class="col-md-6">
                    <input id="date_depart_{{$rand_id}}" type="text"
                           class="form-control @error('name') is-invalid @enderror" name="start"
                           value="{{$caravan['start']}}" autofocus>

                    @error('start')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">

                <label for="date_entrance_{{$rand_id}}"
                       class="col-md-4 col-form-label text-md-right">{{ __('messages.date'). " " . __('messages.entrance')  }}</label>

                <div class="col-md-6">
                    <input id="date_entrance_{{$rand_id}}" type="text"
                           class="form-control @error('arrival') is-invalid @enderror" name="arrival"
                           value="{{$caravan['arrival']}}" autofocus>

                    @error('arrival')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">

                <label for="date_exit_{{$rand_id}}"
                       class="col-md-4 col-form-label text-md-right">{{ __('messages.date'). " " . __('messages.exit')  }}</label>

                <div class="col-md-6">
                    <input id="date_exit_{{$rand_id}}" type="text"
                           class="form-control @error('departure') is-invalid @enderror" name="departure"
                           value="{{$caravan['departure']}}" autofocus>

                    @error('departure')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">

                <label for="date_get_back{{$rand_id}}"
                       class="col-md-4 col-form-label text-md-right">{{ __('messages.date'). " " . __('messages.get_back')  }}</label>

                <div class="col-md-6">
                    <input id="date_get_back{{$rand_id}}" type="text"
                           class="form-control @error('end') is-invalid @enderror" name="end"
                           value="{{$caravan['end']}}" autofocus>

                    @error('end')
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
        $("#select_province_{{$rand_id}}").select2();
        $("#select_city_{{$rand_id}}").select2();

        $('#date_depart_{{$rand_id}}').MdPersianDateTimePicker({
            targetTextSelector: '#date_depart_{{$rand_id}}',
        });
        $('#date_entrance_{{$rand_id}}').MdPersianDateTimePicker({
            targetTextSelector: '#date_entrance_{{$rand_id}}',

        });
        $('#date_exit{{$rand_id}}').MdPersianDateTimePicker({
            targetTextSelector: '#date_exit{{$rand_id}}',

        });
        $('#date_get_back{{$rand_id}}').MdPersianDateTimePicker({
            targetTextSelector: '#date_get_back{{$rand_id}}',
        });

    });
</script>