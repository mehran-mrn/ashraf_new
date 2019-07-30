<?php $rand_id = rand(1, 8000); ?>
<script>
    $(document).ready(function () {

        CKEDITOR.replace('description', {
            language: 'fa',
            uiColor: '#9AB8F3',
            extraPlugins: 'filebrowser',
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
        });
    });
</script>
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
                       class=" col-form-label text-md-right">{{ __('messages.title') }}</label>

                <div class="col-md-6">
                    <input id="title" type="text" class="form-control"
                           name="title"
                           value="{{$payment_title['title'] or ""}}" autocomplete="title" autofocus>

                </div>

            </div>

            <div class="form-group row">

                <label for="description" class=" col-form-label text-md-right">{{ __('messages.description') }}</label>

                <div class="col-md-12">
                    <textarea id="description" type="number" class="form-control"
                              name="description">{{$payment_title['description'] or ""}}</textarea>

                </div>

            </div>
            <div class="form-group row">

                <div class="col-md-2">

                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary"><i
                                class="icon-image5"></i>{{__('messages.select_image')}}</a>
                </div>
                <div class="col-md-10">

                    <input id="thumbnail" readonly="readonly" class="form-control" type="text" name="filepath">

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