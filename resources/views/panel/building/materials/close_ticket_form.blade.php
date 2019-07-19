<?php $rand_id = rand(1, 8000); ?>

<form method="POST" id="" class="form-ajax-submit" action="{{route('close_building_ticket',['ticket_id'=>$ticket_id])}}"
      autocomplete="off">
    @csrf
    <input type="hidden" name="ticket_id" value="{{$ticket_id}}">

    @if($ticket['closed'])
        <p class="d-block font-size-lg font-weight-black text-info-800">
            {{trans('messages.confirm_re_open_ticket')}}
        </p>
    @else
        @if($ticket['ticket_type'] ==0)
            <p class="d-block font-size-lg font-weight-black text-info-800">
                {{trans('messages.ticket_set_predict_percent',['percent'=>$ticket['predict_percent']])}}
            </p>
            <div class="form-group row">

                <div class="col-md-4">

                    <label for="actual_percent" class="label text-info-800">
                        {{trans('messages.actual_percent')}}:
                    </label>
                </div>
                <div class="col-md-4">

                    <input class="form-control input-lg font-size-lg text-info-800" name="actual_percent" type="text">
                </div>
            </div>
        @endif
    @endif
    <hr>
    <div class="form-group row ">
        <div class="col-md-6 ">
            <button type="submit" class="btn btn-block btn-info">
                @if($ticket['closed'])
                    {{ __('messages.approve') }}
                @else
                {{ __('messages.archive_ticket') }}
                @endif <i class="icon-floppy-disk"></i>
            </button>
        </div>
    </div>
</form>

