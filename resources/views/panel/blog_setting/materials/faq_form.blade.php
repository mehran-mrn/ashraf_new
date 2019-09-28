<?php $rand_id = rand(1, 8000); ?>
<script src="{{URL::asset('/public/assets/panel/js/ckeditor/ckeditor.js')}}"></script>

<form method="POST" id="" class="form-ajax-submit"
      action="{{isset($faq) ?route('faq.update',['faq'=>$faq['id']]):route('faq.store')}}">
    @csrf
    <?php $value = []; ?>
@if(isset($faq))
        @method('patch')
        <input type="hidden" name="faq_id" value="{{$faq['id']}}">
        <?php $value = json_decode($faq['value']); ?>
    @endif

    <div class="form-group row">
        <div class="col-md-12">

            <label for="question" class="col-form-label text-md-right">{{ __('words.question')}}</label>

            <input id="question" type="text" class="form-control" name="question"
                   value="{!! isset($value->question)? $value->question : ""!!}" autocomplete="question" autofocus>


        </div>
        <div class="col-md-12">

            <label for="answer" class="col-form-label text-md-right">{{ __('words.answer')}}</label>

            <textarea class="form-control" name="answer" id="answer_{{$rand_id}}">
                {!! isset($value->answer) ? $value->answer :"" !!}
            </textarea>

        </div>
        <div class="col-md-4">

            <label for="local" class="col-form-label text-md-right">{{ __('messages.language')}}</label>

            <select name="local" class="form-control">
                @foreach($locales as $local)
                <option {!! isset($value->key) and $value->key == $local ? $value->answer :"selected" !!} value="{{$local}}">{{$local}}</option>
                @endforeach
            </select>

        </div>
    </div>


    <div class="form-group row ">
        <div class="col-md-4">
            <button type="submit" class="btn btn-block btn-info">
                {{ __('messages.save') }}
            </button>
        </div>
    </div>


</form>
<script>
    $(document).ready(function () {

        CKEDITOR.replace('answer_{{$rand_id}}', {
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