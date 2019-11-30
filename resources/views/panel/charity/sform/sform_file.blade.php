<form method="POST" id="" class="form-ajax-submit" action="{{route('sform_file_update')}}"
      autocomplete="off">
    @csrf
<input type="hidden" name="file_id" value="{{ $sform['id'] }}">
    <div class="row">
        <div class="col-md-5">
            <div class="card alpha-indigo ">

                <div class="form-group row p-2">
                    @foreach($sform->fields as $field)
                        <div class="col-md-12 font-size-lg font-weight-bolder">
                            <label for="title" class="col-form-label text-md-right">{{ $field['key'] }} :</label>
                            <span class="text text-blue-800">{{ $field['value'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
        <div class="col-md-7">
            <div class="row mb-3">
            <div class="col-md-12">

                <label for="description"
                       class=" col-form-label text-md-right">{{ __('messages.description') }}</label>
                <textarea id="description" type="number" class="form-control"
                          name="description"></textarea>
            </div>
            </div>
            <div class="row mb-3">
            <div class="col-md-5">

                    <select name="file_status" class="form-control">
                        <option  disabled>{{trans('messages.status')}}</option>
                        <option {{$sform['status']==0 ? "selected":""}} value="0">{{trans('words.new')}}</option>
                        <option {{$sform['status']==1 ? "selected":""}} value="1">{{trans('words.inProgress')}}</option>
                        <option {{$sform['status']==2 ? "selected":""}} value="2">{{trans('words.closed')}}</option>
                    </select>

            </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="form-group">
        <button type="submit" class="btn float-right btn-info">
            {{ __('messages.save') }} <i class="icon-arrow-left5"></i>
        </button>
    </div>
</form>
