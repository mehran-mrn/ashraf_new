<span class="text-gray">{{__('messages.email')}}: </span>
<span class="text-black">{{$userInfo['email']}}</span>
@if(!$userInfo['email_verified_at'] and false)
    <span class="badge badge-danger">{{__('messages.not_valid')}}</span>
    <a href="{{route('global_profile_send_email')}}"
       class="btn btn-success btn-block ajaxload-popup">{{__('messages.send_verify_email')}}</a>
@elseif(false)
    <i class="fa fa-check text-success"></i>
@else
@endif