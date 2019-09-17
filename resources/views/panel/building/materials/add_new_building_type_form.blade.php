
<form method="POST" id="" enctype="multipart/form-data" class="form-ajax-submit" action="{{route('submit_project_type_data')}}">
    @csrf
    @if(!empty($building_type))
    <input type="hidden" name="building_type_id" value="{{$building_type['id']}}">
    @endif
    <div class="form-group row">

        <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('messages.project_type_title') }}</label>

        <div class="col-md-6">
            <input id="title" type="text" class="form-control @error('project_type_title') is-invalid @enderror" name="project_type_title"
                   value="{{$building_type['title']}}"  autofocus>

            @error('project_type_title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>




    <div class="form-group row ">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-block btn-info">
                {{ __('messages.save') }}
            </button>
        </div>
    </div>


</form>

