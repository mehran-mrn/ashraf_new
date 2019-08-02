<form method="POST" id="" class="form-ajax-submit"
      action="{{route('charity_payment_title_add',['payment_pattern_id'=>$payment_pattern['id'],'payment_title_id'=>$payment_title['id']])}}"
      autocomplete="off">
    @csrf
    <input type="hidden" name="payment_pattern_id" value="{{$payment_pattern['id']}}">

    @if(!empty($payment_title))
        <input type="hidden" name="payment_title_id" value="{{$payment_title['id']}}">
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="title"
                       class=" col-form-label text-md-right">{{ __('messages.title') }}</label>
                <div class="col-md-12">
                    <input id="title" type="text" class="form-control"
                           name="title"
                           value="{{$payment_title['title']}}">
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="form-group ">
            <button type="submit" class="btn float-right btn-info">
                {{ __('messages.save') }} <i class="icon-arrow-left5"></i>
            </button>
    </div>
</form>
