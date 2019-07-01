<?php $rand_id = rand(1, 8000); ?>
<script>
    $( document ).ready(function() {

        var route_prefix = {{env('url')}}"/laravel-filemanager";

    (function ($) {

        $.fn.filemanager = function (type, options) {
            type = type || 'file';

            this.on('click', function (e) {
                var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
                var target_input = $('#' + $(this).data('input'));
                var target_preview = $('#' + $(this).data('preview'));
                window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
                window.SetUrl = function (items) {
                    var file_path = items.map(function (item) {
                        console.log(item.url);
                        return item.url;
                    }).join(',');

                    // set the value of the desired input to image url
                    target_input.val('').val(file_path).trigger('change');

                    // clear previous preview
                    target_preview.html('');

                    // set or change the preview image src
                    items.forEach(function (item) {
                        target_preview.append(
                            $('<img>').css('height', '5rem').attr('src', item.thumb_url)
                        );
                    });

                    // trigger change event
                    target_preview.trigger('change');
                };
                return false;
            });
        }

    })(jQuery);

    $('#lfmMain').filemanager('image', {prefix: route_prefix});
    });

</script>
<form method="POST" id="" class="" action="{{route('submit_project_data')}}"
      autocomplete="off">
    @csrf
    @if(!empty($project))
        <input type="hidden" name="project_id" value="{{$project['id']}}">
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="form-group row">

                <label for="project_title"
                       class="col-md-3 col-form-label text-md-right">{{ __('messages.project_title') }}</label>
                <div class="col-md-6">
                    <input id="project_title" type="text" class="form-control @error('capacity') is-invalid @enderror"
                           name="project_title"
                           value="" autocomplete="capacity" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
            </span>
                    @enderror
                </div>

            </div>
            <div class="form-group row">

                <label for="start_date_{{$rand_id}}"
                       class="col-md-3 col-form-label text-md-right">{{ __('messages.start_date') }}</label>
                <div class="col-md-6">
                    <input id="start_date_{{$rand_id}}" type="text" class="form-control @error('capacity') is-invalid @enderror"
                           name="start_date"
                           value="" autocomplete="capacity" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
            </span>
                    @enderror
                </div>

            </div>
            <div class="form-group row">

                <label for="end_date_{{$rand_id}}"
                       class="col-md-3 col-form-label text-md-right">{{ __('messages.end_date') }}</label>
                <div class="col-md-6">
                    <input id="end_date_{{$rand_id}}" type="text" class="form-control @error('capacity') is-invalid @enderror"
                           name="end_date"
                           value="" autocomplete="capacity" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
            </span>
                    @enderror
                </div>

            </div>
            <div class="form-group row">

                <label for="description"
                       class="col-md-3 col-form-label text-md-right">{{ __('messages.description') }}</label>
                <div class="col-md-6">
                    <textarea id="description" class="form-control @error('capacity') is-invalid @enderror"
                           name="description"
                              value=""  autofocus></textarea>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
            </span>
                    @enderror
                </div>

            </div>

            <div class="form-group row">
                <label for="image" class="col-md-3 col-form-label text-md-right" >{{ __('messages.image') }}</label>

                <span id="image" class="col-lg-6 input-group-btn">
                    <a id="lfmMain" data-input="thumbnail" data-preview="holder"
                       class="btn btn-outline-primary m-2"><i class="icon-image2"></i> {{__('messages.select_image')}}</a>
                </span>
                <input id="thumbnail" class="form-control" type="text" name="filepath"
                       readonly="readonly">
                <img id="holder" style="margin-top:15px;max-height:100px;">
            </div>


            <div class="form-group row">

                <label for="type_selection_{{$rand_id}}"
                       class="col-md-3 col-form-label text-md-right">{{ __('messages.building_types') }}</label>
                <div class="col-md-6">
                    <select id="type_selection_{{$rand_id}}" name="project_type" class="form-control select-search"
                            data-fouc>
                        @foreach(get_provinces() as $province)
                            <option value="{{$province['id']}}">{{$province['name']}}</option>
                        @endforeach
                    </select>
                </div>


            </div>
            <div class="form-group row">

                <label for="select_province_{{$rand_id}}"
                       class="col-md-3 col-form-label text-md-right">{{ __('messages.province') }}</label>
                <div class="col-md-6">
                    <select id="select_province_{{$rand_id}}" name="province_id" class="form-control select-search"
                            data-fouc>
                        @foreach(get_provinces() as $province)
                            <option value="{{$province['id']}}">{{$province['name']}}</option>
                        @endforeach
                    </select>
                </div>


            </div>
            <div class="form-group row">

                <label for="select_city_{{$rand_id}}"
                       class="col-md-3 col-form-label text-md-right">{{ __('messages.city') }}</label>
                <div class="col-md-6">
                    <select id="select_city_{{$rand_id}}" name="city_id" class="form-control select-search" data-fouc>
                        @foreach(get_cites() as $city)
                            <option value="{{$city['id']}}">{{$city['name']}}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="form-group row">

                <label for="address"
                       class="col-md-3 col-form-label text-md-right">{{ __('messages.address') }}</label>
                <div class="col-md-6">
                    <textarea id="address" type="text" class="form-control @error('capacity') is-invalid @enderror"
                              name="address"
                              value=""  autofocus></textarea>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
            </span>
                    @enderror
                </div>

            </div>
            <div class="form-group row">
                <label for="lat"
                       class="col-md-3 col-form-label text-md-right">{{ __('messages.lat') }}</label>
                <div class="col-md-3">

                    <input id="lat" type="number" class="form-control "
                           name="lat"
                           value=""  autofocus>
                </div>

            </div>
            <div class="form-group row">

                <label for="long"
                       class="col-md-3 col-form-label text-md-right">{{ __('messages.long') }}</label>
                <div class="col-md-3">

                <input id="long" type="text" class="form-control "
                       name="long"
                       value="" autocomplete="capacity" autofocus>
                </div>
            </div>
            <div class="form-group row">
                    <div class="form-group col-md-3">
                        <label for="usr" class=" col-form-label text-md-right">{{trans('messages.coordination')}}</label>

                    </div>
                    <div class="form-group col-md-8">
                        <div class="location-picker ">
                            <input type="hidden" id="txtLocation" data-type='location-store' />

                            <div class='map-container'>
                                <div id="map" data-type='map'></div>
                            </div>
                        </div>

                    </div>

            </div>
        </div>
    </div>
    <hr>
    <div class="form-group row ">
        <div class="col-md-2 ">
            <button type="submit" class="btn btn-block btn-info">
                {{ __('messages.save_and_continue') }} <i class="icon-arrow-left5"></i>
            </button>
        </div>
    </div>
</form>

<script>
    $(document).ready(function () {
        $("#type_selection_{{$rand_id}}").select2();
        $("#select_province_{{$rand_id}}").select2();
        $("#select_city_{{$rand_id}}").select2();


        $('#start_date_{{$rand_id}}').MdPersianDateTimePicker({
            targetTextSelector: '#start_date_{{$rand_id}}',
        });
        $('#end_date_{{$rand_id}}').MdPersianDateTimePicker({
            targetTextSelector: '#end_date_{{$rand_id}}',
        });


    });
</script>