<form method="POST" id="" class="form-ajax-submit" enctype="multipart/form-data"
      action="{{route('caravan_upload_doc',['caravan_id'=>$caravan['id']])}}"
      autocomplete="off">
    @csrf
    <input type="hidden" name="caravan_id" value="{{$caravan['id']}}">
    <div class="form-group row">

        <label for="title"
               class="col-md-3 col-form-label text-md-right">{{ __('messages.title') }}</label>
        <div class="col-md-9">

            <input id="title" type="text" class="form-control   @error('title')  @enderror"
                   name="title"
                   value="{{$caravan_doc['title']}}" autocomplete="title" autofocus>
        </div>

    </div>
    <div class="form-group row">

        <label for="description"
               class="col-md-3 col-form-label text-md-right">{{ __('messages.description') }}</label>
        <div class="col-md-9">

                <textarea id="description" class=" form-control @error('description')  @enderror"
                          name="description"
                          value="" autocomplete="description" autofocus>{{$caravan_doc['description']}}</textarea>
        </div>
    </div>

    <div class="form-group row">

        <label for="file"
               class="col-md-3 col-form-label text-md-right">{{ __('messages.file') }}</label>
        <div class="col-md-9">

            <input id="file" type="file" class="" name="file" autofocus>
        </div>

    </div>


    <hr>
    <div class="form-group row ">
        <div class="col-md-5 ">
            <button type="submit" class="btn btn-block btn-info">
                {{trans('messages.upload')}} <i class="icon-upload"></i> </i>
            </button>
        </div>
    </div>
</form>

<script>

</script>