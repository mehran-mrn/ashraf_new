
<form method="POST" id="register_user_panel" class="form-ajax-submit" action="{{ route('submit_building_type_item') }}">
    @csrf

    <input type="hidden" name="type_id" value="{{$type_id}}">

    @if(!empty($type_item))
        <input type="hidden" name="type_item_id" value="{{$type_item['id']}}">
    @endif
    <div class="form-group row">

        <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('messages.title') }}</label>

        <div class="col-md-6">
            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                   value="{{ $type_item['title'] }}"   autofocus>

            @error('title')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">

        <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('messages.description') }}</label>

        <div class="col-md-6">
            <textarea id="description"  class="form-control @error('description') is-invalid @enderror" name="description"
            >{{ $type_item['description'] }}</textarea>

            @error('description')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">

        <label for="percent" class="col-md-4 col-form-label text-md-right">{{ __('messages.percent') }}</label>

        <div class="col-md-6">
            <input id="percent" type="number" min="0" max="100"  class="form-control @error('percent') is-invalid @enderror" name="percent"
                   value="{{ $type_item['percent'] }}"   autofocus>

            @error('percent')
            <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>


    <div class="form-group row ">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-block btn-info">
                {{ __('messages.submit') }}
            </button>
        </div>
    </div>



</form>

<script type="text/javascript">
    $("#register_user_panel").validate({
        lang: "fa",
        rules: {

        },
    });
</script>