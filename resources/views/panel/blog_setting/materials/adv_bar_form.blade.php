<?php $rand_id = rand(1, 8000); ?>

<form method="POST" id="" enctype="multipart/form-data" class="form-ajax-submit"
      action="{{route('submit_adv_bar')}}">
    @csrf

    @if(!empty($option))
        <?php
        $value = json_decode($option['value'], true);
        ?>
        <input type="hidden" name="option_id" value="{{$option['id']}}">
    @endif
    <div class="form-group row">
        <div class="col-md-12">
            <div class=" row">


                <div class="col-md-6">
                    <label for="link" class="col-form-label text-md-right">{{ __('messages.link')}}</label>

                    <input id="link" type="text" class="form-control" name="link"
                           value="{{!empty($value)?$value['link']:""}}" autocomplete="link" autofocus>
                </div>


                <div class="col-lg-12">
                    <label for="link" class="col-form-label text-md-right">{{ __('messages.image')}}</label>

                    {{--                                <input name="file[]" type="file" class="file-input-ajax" multiple="true" data-fouc>--}}
                    <input name="image" type="file" multiple/>
                    <span class="text-muted"> 200*120</span>
                </div>

            </div>
        </div>
    </div>


    <div class="form-group row ">
        <div class="col-md-12">
            <button type="submit" class="btn btn-block btn-info">
                {{ __('messages.save') }}
            </button>
        </div>
    </div>


</form>
