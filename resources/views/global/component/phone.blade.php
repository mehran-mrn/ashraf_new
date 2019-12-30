<span class="text-gray">{{__('messages.phone')}}: </span>
<span class="{{!\Illuminate\Support\Facades\Auth::user()->phone_verified_at? "text-danger":"text-black"}}">{{\Illuminate\Support\Facades\Auth::user()->phone}}</span>

@if(!\Illuminate\Support\Facades\Auth::user()->phone_verified_at)
    <span class="badge badge-danger">{{__('messages.not_valid')}}</span>
    <form method="get" class="form-ajax-submit" action="{{route('global_profile_send_sms')}}">
        <button data-height="30px" class="btn btn-warning btn-xs m-0 font-14" type="submit" style="height: 45px;">
            {{__('messages.send_verify_sms')}}</button>
    </form>


    <form method="post" class="form-ajax-submit" action="{{route('global_profile_verify_mobile')}}">

    <div class="input-group">

@csrf
        <input type="text" value="" name="code" placeholder="کد تایید شماره" class="form-control input-sm font-16" data-height="30px" id="mce-EMAIL-footer" style="height: 45px;">
        <span class="input-group-btn">

                  <button data-height="30px" class="btn btn-success btn-xs m-0 font-14" type="submit" style="height: 45px;">
                      {{__('messages.check')}}</button>

                </span>
    </div>

    </form>



@else
    <i class="fa fa-check text-success"></i>
@endif