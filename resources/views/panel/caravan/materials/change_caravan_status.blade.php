@if(in_array($caravan['status'],["1","2","3","4"]) and $status =="next")

    <form method="POST" id="" class="" action="{{route('change_caravan_status')}}" autocomplete="off">
    @csrf
    <input type="hidden" name="caravan_id" value="{{$caravan['id']}}">

    <div class="row">
        <div class="col-md-12">
            <span class="text-info">
                @switch($caravan['status'])
                    @case("1")
                    {{trans('messages.close_caravan_registration_warn')}}
                    @break
                    @case("2")
                    {{trans('messages.arrive_caravan_warn')}}
                    @break
                    @case("3")
                    {{trans('messages.exit_caravan_warn')}}
                    @break
                    @case("4")
                    {{trans('messages.archive_caravan_warn')}}
                    @break
                @endswitch
            </span>

        </div>

    </div>
    <hr>
    <div class="form-group row ">
        <div class="col-md-4 ">
            <button type="submit" class="btn btn-block btn-info">
                {{ __('messages.save_and_continue') }} <i class="icon-arrow-left5"></i>
            </button>
        </div>
    </div>
</form>
@endif

@if(in_array($caravan['status'],["1","2"]) and $status =="cancel")
    <form method="POST" id="" class="" action="{{route('cancel_caravan_status')}}" autocomplete="off">
        @csrf
        <input type="hidden" name="caravan_id" value="{{$caravan['id']}}">

        <div class="row">
            <div class="col-md-12">
            <span class="text-danger">
                {{trans('messages.cancel_caravan_warn')}}
            </span>

            </div>

        </div>
        <hr>
        <div class="form-group row ">
            <div class="col-md-4 ">
                <button type="submit" class="btn btn-block btn-danger">
                    {{ __('messages.cancel_caravan') }} <i class="icon-trash"></i>
                </button>
            </div>
        </div>
    </form>
@endif

@if(in_array($caravan['status'],["0","2","3","4","5"]) and $status =="back")
    <form method="POST" id="" class="" action="{{route('back_caravan_status')}}" autocomplete="off">
        @csrf
        <input type="hidden" name="caravan_id" value="{{$caravan['id']}}">

        <div class="row">
            <div class="col-md-12">
            <span class="text-danger">
                {{trans('messages.back_caravan_status_warn')}}
            </span>

            </div>

        </div>
        <hr>
        <div class="form-group row ">
            <div class="col-md-4 ">
                <button type="submit" class="btn btn-block btn-warning">
                    {{ __('messages.back_caravan_status') }} <i class="icon-arrow-right5"></i>
                </button>
            </div>
        </div>
    </form>
@endif

