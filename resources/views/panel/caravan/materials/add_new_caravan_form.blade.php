<?php $rand_id = rand(1, 8000); ?>
<script>
    function getSubProvince(val) {
        $.ajax({
            type: "POST",
            url: "{{route('get_city_select_option')}}",
            data: {
                '_token': $('meta[name=csrf-token]').attr('content'),
                'id': val,
            },
            success: function(data){
                $("#select_sub_province_{{$rand_id}}").html(data);
                getCity();
            }
        });
    }

</script>
<form method="POST" id="" class="" action="{{route('caravan_data')}}"
      autocomplete="off">
    @csrf
    @if(!empty($caravan))
        <input type="hidden" name="caravan_id" value="{{$caravan['id']}}">
    @endif
    <div class="row">
        <div class="col-md-12">

            <div class="form-group row">
                <label for="title"
                       class="col-md-1 col-form-label text-md-right">{{ __('messages.title') }}</label>

                <div class="col-md-3 mb-2">
                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                           name="title"
                           value="{{$caravan['title']}}" autocomplete="title" autofocus>

                </div>
                <label for="executer"
                       class="col-md-1 col-form-label text-md-right">{{ __('messages.executer') }}</label>

                <div class="col-md-3 mb-2">
                    <input id="executer" type="text" class="form-control @error('executer') is-invalid @enderror"
                           name="executer"
                           value="{{$caravan['executer']}}" autocomplete="executer" autofocus>

                </div>

                <label for="capacity"
                       class="col-md-1 col-form-label text-md-right">{{ __('messages.capacity') }}</label>

                <div class="col-md-3 mb-2">
                    <input id="capacity" type="number" class="form-control @error('capacity') is-invalid @enderror"
                           name="capacity"
                           value="{{$caravan['capacity']}}" autocomplete="capacity" autofocus>

                </div>

                <label for="select_host_{{$rand_id}}"
                       class="col-md-1 col-form-label text-md-right">{{ __('messages.name'). " " . __('messages.host')  }}</label>

                <div class="col-md-3 mb-2">
                    <select id="select_host_{{$rand_id}}" name="host_id" class="form-control select-search" data-fouc>
                        @foreach($caravan_hosts as $caravan_host)
                            <option value="{{$caravan_host['id']}}">{{$caravan_host['city_name'].' | '. $caravan_host['name']}}</option>
                        @endforeach
                    </select>
                </div>


                <label for="select_province_{{$rand_id}}"
                       class="col-md-1 col-form-label text-md-right">{{ __('messages.province') }}</label>
                <div class="col-md-3 mb-2">
                    <select id="select_province_{{$rand_id}}" name="province_id" class="form-control select-search"
                            onChange="getSubProvince(this.value);" data-fouc>
                        <option value="0">---</option>

                        @foreach(get_cites_list(1) as $province)
                            <option  value="{{$province['id']}}">{{$province['name']."  "}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <label for="select_sub_province_{{$rand_id}}"
                       class="col-md-1 col-form-label text-md-right">{{ __('messages.sub_province') }}</label>
                <div class="col-md-3 mb-2">
                    <select id="select_sub_province_{{$rand_id}}" name="city_id_2" class="form-control select-search"
                            onChange="getCity(this.value);" data-fouc>
                        <option value="0">---</option>

                    </select>
                </div>


                <label for="budget" class="col-md-1 col-form-label text-md-right">{{ __('messages.budget') }}</label>

                <div class="col-md-3 mb-2">
                    <input id="budget" type="number" class="form-control @error('budget') is-invalid @enderror"
                           name="budget"
                           value="{{$caravan['budget']}}" >

                    @error('budget')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
            </span>
                    @enderror
                </div>

                <label for="select_user_{{$rand_id}}" class="col-md-1 col-form-label text-md-right">{{ __('messages.duty')}}</label>

                <div class="col-md-3 mb-2">
                    <select id="select_user_{{$rand_id}}" name="user_id" class="form-control select-search" data-fouc>
                        @foreach($users as $user)
                            <option value="{{$user['id']}}">{{$user['name']}}</option>
                        @endforeach
                    </select>
                </div>



                <label for="transport"
                       class="col-md-1 col-form-label text-md-right">{{ __('messages.transport_type')}}</label>

                <div class="col-md-3 mb-2">
                    <input id="transport" type="text" class="form-control @error('transport') is-invalid @enderror" name="transport"
                           value="{{$caravan['transport']}}" autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>




                <label for="date_depart_{{$rand_id}}"
                       class="col-md-1 col-form-label text-md-right">{{ __('messages.date'). " " . __('messages.depart')  }}</label>

                <div class="col-md-3 mb-2">
                    <input id="date_depart_{{$rand_id}}" type="text"
                           class="form-control @error('name') is-invalid @enderror" name="start"
                           value="{{$caravan['start']}}" >

                    @error('start')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <label for="date_entrance_{{$rand_id}}"
                       class="col-md-1 col-form-label text-md-right">{{ __('messages.date'). " " . __('messages.entrance')  }}</label>

                <div class="col-md-3 mb-2">
                    <input id="date_entrance_{{$rand_id}}" type="text"
                           class="form-control @error('arrival') is-invalid @enderror" name="arrival"
                           value="{{$caravan['arrival']}}" autofocus>

                    @error('arrival')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>


                <label for="date_exit_{{$rand_id}}"
                       class="col-md-1 col-form-label text-md-right">{{ __('messages.date'). " " . __('messages.exit')  }}</label>

                <div class="col-md-3 mb-2">
                    <input id="date_exit_{{$rand_id}}" type="text"
                           class="form-control @error('departure') is-invalid @enderror" name="departure"
                           value="{{$caravan['departure']}}" autofocus>

                    @error('departure')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>

                <label for="date_get_back_{{$rand_id}}"
                       class="col-md-1 col-form-label text-md-right">{{ __('messages.date'). " " . __('messages.get_back')  }}</label>

                <div class="col-md-3 mb-2">
                    <input id="date_get_back_{{$rand_id}}" type="text"
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
        <div class="col-md-1 ">
            <button type="submit" class="btn btn-block btn-info">
                {{ __('messages.save_and_continue') }} <i class="icon-arrow-left5"></i>
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
        $("#select_province_{{$rand_id}}").select2();
        $("#select_sub_province_{{$rand_id}}").select2();

        $('#date_depart_{{$rand_id}}').MdPersianDateTimePicker({
            targetTextSelector: '#date_depart_{{$rand_id}}',
            enableTimePicker:true,

        });
        $('#date_entrance_{{$rand_id}}').MdPersianDateTimePicker({
            targetTextSelector: '#date_entrance_{{$rand_id}}',
            enableTimePicker:true,

        });
        $('#date_exit_{{$rand_id}}').MdPersianDateTimePicker({
            targetTextSelector: '#date_exit_{{$rand_id}}',
            enableTimePicker:true,

        });
        $('#date_get_back_{{$rand_id}}').MdPersianDateTimePicker({
            targetTextSelector: '#date_get_back_{{$rand_id}}',
            enableTimePicker:true,

        });

    });
</script>