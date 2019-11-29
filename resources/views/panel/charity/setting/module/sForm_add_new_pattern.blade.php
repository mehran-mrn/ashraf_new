<?php $rand_id = rand(1, 8000); ?>
@if(empty($sForm_pattern))
<form method="POST" id="" class="form-ajax-submit" action="{{route('sForm.store')}}"
      autocomplete="off">
    @csrf
    <div class="row">
        <div class="col-md-5">
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="title" class="col-form-label text-md-right">{{ __('messages.title') }}</label>
                    <input id="title" type="text" class="form-control" name="title" min="100" max="900000000"
                           value="" autocomplete="title" autofocus>
                </div>
                <div class="col-md-12">
                    <label for="title" class="col-form-label text-md-right">{{ __('messages.image') }}</label>
                    <input type="file" name="pic" accept="image/*">
                </div>
                <div class="col-md-12">
                    <div class="card bordered border-slate-800 mt-4">
                        <div class="card-header bg-slate-300">
                            {{trans('messages.custom_fields')}}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <button type="button"
                                        class="btn btn-outline-success btn-sm add-field float-right"><i
                                            class="icon-plus2"></i> {{__('messages.add_new',['item'=>trans('messages.item')])}}
                                </button>
                            </div>
                            <div class="field-box"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <label for="description"
                   class=" col-form-label text-md-right">{{ __('messages.description') }}</label>
            <textarea id="description" type="number" class="form-control"
                      name="description"></textarea>
        </div>
    </div>
    <hr>
    <div class="form-group">
        <button type="submit" class="btn float-right btn-info">
            {{ __('messages.save') }} <i class="icon-arrow-left5"></i>
        </button>
    </div>
</form>
@else
<form method="POST" id="" class="form-ajax-submit" action="{{route('sForm.update',[$sForm_pattern['id']])}}"
      autocomplete="off">
    @csrf
    @method('patch')
        <input type="hidden" name="sForm_pattern_id" value="{{$sForm_pattern['id']}}">
    <div class="row">
        <div class="col-md-5">
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="title" class="col-form-label text-md-right">{{ __('messages.title') }}</label>
                    <input id="title" type="text" class="form-control" name="title" min="100" max="900000000"
                           value="{{$sForm_pattern['title'] }}" autocomplete="title" autofocus>
                </div>
                <div class="col-md-12">
                    <label for="title" class="col-form-label text-md-right">{{ __('messages.image') }}</label>
                    <input type="file" name="pic" accept="image/*">
                </div>
                <div class="col-md-12">
                    <div class="card bordered border-slate-800 mt-4">
                        <div class="card-header bg-slate-300">
                            {{trans('messages.custom_fields')}}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <button type="button"
                                        class="btn btn-outline-success btn-sm add-field float-right"><i
                                            class="icon-plus2"></i> {{__('messages.add_new',['item'=>trans('messages.item')])}}
                                </button>
                            </div>
                            <div class="old-field-box">
                                <?php $randomNumber = 1; ?>
                                @if($sForm_pattern['fields'])
                                    @foreach($sForm_pattern['fields'] as $field)
                                        <div class="row pb-1 pt-1 counter-row-{{$randomNumber}}">
                                            <div class="d-inline-block">
                                                <div class="col-md-2">
                                                    <button type="button" data-row-id=""
                                                            onclick="removeRow({{$randomNumber}})"
                                                            class="btn btn-outline-danger btn-xs"><i class="icon-x"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" placeholder="{{__('messages.title')}}"
                                                       value="{{$field['label']}}"
                                                       class="form-control" required="required"
                                                       name="new_field_title[{{$randomNumber}}]">
                                            </div>
                                            <div class="col-md-3">
                                                <select name="field_type[{{$randomNumber}}]" class="form-control ">
                                                    <option value="0" {{$field['type'] == 0 ?"selected":""}} >{{trans('messages.input')}}</option>
                                                    <option value="1" {{$field['type'] == 1 ?"selected":""}}>{{trans('messages.textarea')}}</option>
                                                    <option value="2" {{$field['type'] == 2 ?"selected":""}}>{{trans('messages.number')}}</option>
                                                    <option value="3" {{$field['type'] == 3 ?"selected":""}}>{{trans('messages.date_input')}}</option>
                                                    <option value="4" {{$field['type'] == 4 ?"selected":""}}>{{trans('messages.time_input')}}</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="hidden" name="new_field_id[{{$randomNumber}}]"
                                                       value="{{$field['id']}}">
                                                <select name="field_requirement[{{$randomNumber}}]"
                                                        class="form-control ">
                                                    <option value="0" {{$field['require'] == 0 ?"selected":""}} >{{trans('messages.optional')}}</option>
                                                    <option value="1" {{$field['require'] == 1 ?"selected":""}} >{{trans('messages.required')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <?php $randomNumber++; ?>
                                    @endforeach
                                @endif
                                <input type="hidden" value="{{$randomNumber}}" id="randomNumber">
                            </div>
                            <div class="field-box"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <label for="description"
                   class=" col-form-label text-md-right">{{ __('messages.description') }}</label>
            <textarea id="description" type="number" class="form-control"
                      name="description">{!!$sForm_pattern['description']!!}</textarea>
        </div>
    </div>
    <hr>
    <div class="form-group">
        <button type="submit" class="btn float-right btn-info">
            {{ __('messages.save') }} <i class="icon-arrow-left5"></i>
        </button>
    </div>
</form>
@endif
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
        $(".add-field").on('click', function () {
            var x = Math.floor((Math.random() * 10000) + 1);

            $(".field-box").append(
                '<div class="row pb-1 pt-1 counter-row-' + x + '">' +
                '<div class="d-inline-block">' +
                '<div class="col-md-2">' +
                '<button type="button" data-row-id="' + x + '" onclick="removeRow(' + x + ')" class="btn btn-outline-danger btn-xs"><i class="icon-x"></i></button>' +
                '</div>' +
                '</div>' +
                '<div class="col-md-4">' +
                '<input type="text" placeholder="{{__('messages.title')}}"  value="" class="form-control" required="required" name="new_field_title[' + x + ']">' +
                '</div>' +
                '<div class="col-md-3">' +
                '<select name="field_type[' + x + ']" class="form-control ">\n' +
                '<option value="0" >{{trans('messages.input')}}</option>\n' +
                '<option value="1" >{{trans('messages.textarea')}}</option>\n' +
                '<option value="2" >{{trans('messages.number')}}</option>\n' +
                '<option value="3" >{{trans('messages.date_input')}}</option>\n' +
                '<option value="4" >{{trans('messages.time_input')}}</option>\n' +
                '</select>' +
                '</div>' +
                '<div class="col-md-2">' +
                '<select name="field_requirement[' + x + ']" class="form-control ">\n' +
                '<option value="0" >{{trans('messages.optional')}}</option>\n' +
                '<option value="1" >{{trans('messages.required')}}</option>\n' +
                '</select>' +
                '</div>' +
                '</div>'
            );
            $("#randomNumber").val(x);
        })
    });


    function removeRow(x) {
        var rowID = x;
        $(".counter-row-" + rowID).remove();
    }
</script>
