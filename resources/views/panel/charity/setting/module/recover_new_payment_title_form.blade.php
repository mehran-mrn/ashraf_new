
<form method="POST" id="" class="form-ajax-submit" action="{{route('charity_payment_title_recover',['payment_pattern_id'=>$payment_pattern['id'],'payment_title_id'=>$payment_title['id']])}}"
      autocomplete="off">
    @csrf
    <input type="hidden" name="payment_pattern_id" value="{{$payment_pattern['id']}}">
    <input type="hidden" name="payment_title_id" value="{{$payment_title['id']}}">

    <div class="row">
        <div class="col-md-12">
            <div class="form-group row">
                {{trans('messages.recover_title_warn')}}
            </div>
        </div>
    </div>
    <hr>
    <div class="form-group row ">
        <div class="col-md-6 ">
            <button type="submit" class="btn btn-block btn-info">
                {{ __('messages.recover') }} <i class="icon-rotate-cw2"></i>
            </button>
        </div>
    </div>
</form>
