<?php $rand_id = rand(1, 8000); ?>
@if(!$building['archived'])
<form method="POST" class="form-ajax-submit" action="{{route('submit_project_end',['id',$building['id']])}}">
    @csrf
    <input type="hidden" name="id" value="{{$building['id']}}">

    <div class="form-group row">

        <label for="actual_end_date_{{$rand_id}}"
               class="col-md-5 col-form-label text-md-right">{{ __('messages.actual_end_date') }}</label>
        <div class="col-md-7">
            <input id="actual_end_date_{{$rand_id}}" type="text" class="form-control @error('actual_end_date') is-invalid @enderror"
                   name="actual_end_date"
                   value="{{$building['end_date_actual']? miladi_to_shamsi_date($building['end_date_actual']):""}}" autofocus>
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
<script>
    $('#actual_end_date_{{$rand_id}}').MdPersianDateTimePicker({
        targetTextSelector: '#actual_end_date_{{$rand_id}}',
    });
</script>
@else
    <form method="POST" class="form-ajax-submit" action="{{route('submit_project_reopen',['id',$building['id']])}}">
        @csrf
        <input type="hidden" name="id" value="{{$building['id']}}">


        <div class="form-group row ">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-block btn-info">
                    {{ __('messages.re_open_project') }}
                </button>
            </div>
        </div>


    </form>
@endif