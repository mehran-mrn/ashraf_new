<?php $rand_id = rand(1, 8000); ?>
<form method="POST" id="" class="form-ajax-submit" action="{{route('charity_payment_title_add')}}"
      autocomplete="off">
    @csrf
    @if(!empty($payment_title))
        <input type="hidden" name="period_id" value="{{$payment_title['id']}}">
    @endif
    <div class="row">
        <div class="col-md-12">

            <div class="form-group row">

                <label for="title"
                       class="col-md-4 col-form-label text-md-right">{{ __('messages.title') }}</label>

                <div class="col-md-6">
                    <input id="title" type="text" class="form-control"
                           name="title"
                           value="{{$payment_title['title'] or ""}}" autocomplete="title" autofocus>

                </div>

            </div>

            <div class="form-group row">

                <label for="day_interval" class="col-md-4 col-form-label text-md-right">{{ __('messages.period_interval') }}
                <span>{{__('messages.in_days')}}</span></label>

                <div class="col-md-6">
                    <input id="day_interval" type="number" class="form-control"
                           name="day_interval"
                           value="{{$payment_title['day_interval'] or ""}}" >

                </div>

            </div>


        </div>

    </div>
    <hr>
    <div class="form-group row ">
        <div class="col-md-6 ">
            <button type="submit" class="btn btn-block btn-info">
                {{ __('messages.save') }} <i class="icon-arrow-left5"></i>
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
        $('#date_exit_{{$rand_id}}').MdPersianDateTimePicker({
            targetTextSelector: '#date_exit_{{$rand_id}}',

        });
        $('#date_get_back_{{$rand_id}}').MdPersianDateTimePicker({
            targetTextSelector: '#date_get_back_{{$rand_id}}',
        });

    });
</script>