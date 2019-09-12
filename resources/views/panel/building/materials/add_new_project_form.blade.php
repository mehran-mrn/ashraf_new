<?php $rand_id = rand(1, 8000); ?>
<script>
    function getSubProvince(val) {
        $.ajax({
            type: "POST",
            url: "{{route('get_city_select_option')}}",
            data: {
                '_token': $('meta[name=csrf-token]').attr('content'),
                'id': val,
            },
            success: function(data){
                $("#select_sub_province_{{$rand_id}}").html(data);
                getCity();
            }
        });
    }


    function getCity(val) {
        $.ajax({
            type: "POST",
            url: "{{route('get_city_select_option')}}",
            data: {
                '_token': $('meta[name=csrf-token]').attr('content'),
                'id': val,
            },
            success: function(data){
                $("#select_city_{{$rand_id}}").html(data);
            }
        });
    }

</script>

<form method="POST" id="" class="form-ajax-submit" action="{{route('submit_project_data')}}"
      autocomplete="off">
    @csrf
    @if(!empty($project))
        <input type="hidden" name="project_id" value="{{$project['id']}}">
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="form-group row">

                <label for="project_title"
                       class="col-md-2 col-form-label text-md-right">{{ __('messages.project_title') }}</label>
                <div class="col-md-10">
                    <input id="project_title" type="text" class="form-control @error('capacity') is-invalid @enderror"
                           name="project_title"
                           value="{{$project['title']}}" autocomplete="capacity" autofocus>

                    @error('project_title')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
            </span>
                    @enderror
                </div>

            </div>
            <div class="form-group row">

                <label for="start_date_{{$rand_id}}"
                       class="col-md-2 col-form-label text-md-right">{{ __('messages.start_date') }}</label>
                <div class="col-md-4">
                    <input id="start_date_{{$rand_id}}" type="text" class="form-control @error('capacity') is-invalid @enderror"
                           name="start_date"
                           value="{{$project['start_date']? miladi_to_shamsi_date($project['start_date']):""}}" autocomplete="capacity" autofocus>
                </div>

                <label for="end_date_{{$rand_id}}"
                       class="col-md-2 col-form-label text-md-right">{{ __('messages.end_date') }}</label>
                <div class="col-md-4">
                    <input id="end_date_{{$rand_id}}" type="text" class="form-control @error('capacity') is-invalid @enderror"
                           name="end_date"
                           value="{{$project['end_date_prediction'] ? miladi_to_shamsi_date($project['end_date_prediction']):""}}" autocomplete="capacity" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
            </span>
                    @enderror
                </div>


            </div>
            <div class="form-group row">



                <label for="description"
                       class="col-md-2 col-form-label text-md-right">{{ __('messages.description') }}</label>
                <div class="col-md-10">
                    <textarea id="description" class="form-control @error('capacity') is-invalid @enderror"
                           name="description" >{{$project['description']}}</textarea>

                </div>

            </div>

            <div class="form-group row">
                <label for="image" class="col-md-2 col-form-label text-md-right" >{{ __('messages.image') }}</label>

                <div class="col-lg-4">
                    <input class="form-control form-control-file" type="file" name="image" id="fileToUpload">
                </div>


                <img id="holder" style="margin-top:15px;max-height:100px;">

                <label for="type_selection_{{$rand_id}}"
                       class="col-md-2 col-form-label text-md-right">{{ __('messages.building_types') }}</label>
                <div class="col-md-4">
                    <select id="type_selection_{{$rand_id}}" name="project_type" class="form-control select-search"
                            data-fouc>
                        <option value="0">---</option>
                    @foreach(get_building_type() as $type)
                            <option {{$type['id'] == $project['project_type_id']?"selected":""}} value="{{$type['id']}}">{{$type['title']}} - {{$type['description']}}</option>
                        @endforeach
                    </select>
                </div>


            </div>

            <div class="form-group row">

                <label for="select_province_{{$rand_id}}"
                       class="col-md-2 col-form-label text-md-right">{{ __('messages.province') }}</label>
                <div class="col-md-4">
                    <select id="select_province_{{$rand_id}}" name="province_id" class="form-control select-search"
                            onChange="getSubProvince(this.value);" data-fouc>
                        <option value="0">---</option>

                    @foreach(get_cites_list(1) as $province)
                            <option {{$province['id'] == $project['city_id']?"selected":""}} value="{{$province['id']}}">{{$province['name']."  "}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <label for="select_sub_province_{{$rand_id}}"
                       class="col-md-2 col-form-label text-md-right">{{ __('messages.sub_province') }}</label>
                <div class="col-md-4">
                    <select id="select_sub_province_{{$rand_id}}" name="city_id_2" class="form-control select-search"
                            onChange="getCity(this.value);" data-fouc>
                        <option value="0">---</option>

                    </select>
                </div>
            </div>
            <div class="form-group row">

                <label for="select_city_{{$rand_id}}"
                       class="col-md-2 col-form-label text-md-right">{{ __('messages.city') }}</label>
                <div class="col-md-4">
                    <select id="select_city_{{$rand_id}}" name="city_id_3" class="form-control select-search" data-fouc>
                        <option value="0">---</option>

                    </select>
                </div>
            </div>
            <div class="form-group row">

                <label for="address"
                       class="col-md-2 col-form-label text-md-right">{{ __('messages.address') }}</label>
                <div class="col-md-10">
                    <textarea id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                              name="address" > {{$project['address']}}</textarea>
                </div>

            </div>
            <div class="form-group row">
                <label for="lat"
                       class="col-md-2 col-form-label text-md-right">{{ __('messages.lat') }}</label>
                <div class="col-md-4">

                    <input id="lat" type="text" class="form-control "
                           name="lat"
                           value="{{$project['lat']}}"  autofocus>
                </div>


                <label for="long"
                       class="col-md-2 col-form-label text-md-right">{{ __('messages.long') }}</label>
                <div class="col-md-4">

                <input id="long" type="text" class="form-control "
                       name="long"
                       value="{{$project['long']}}" autocomplete="capacity" autofocus>
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

    $(function(){
        var locationPicker = $('.location-picker').locationPicker({
            zoomControl:false,
            locationChanged : function(data){
                $('#long').val(JSON.stringify(data.location.long));
                $('#lat').val(JSON.stringify(data.location.lat));
            },
            init :{ current_location: true,

            }
        });
    });
    $(document).ready(function () {
        $("#type_selection_{{$rand_id}}").select2();
        $("#select_city_{{$rand_id}}").select2();
        $("#select_province_{{$rand_id}}").select2();
        $("#select_sub_province_{{$rand_id}}").select2();


        $('#start_date_{{$rand_id}}').MdPersianDateTimePicker({
            targetTextSelector: '#start_date_{{$rand_id}}',
        });
        $('#end_date_{{$rand_id}}').MdPersianDateTimePicker({
            targetTextSelector: '#end_date_{{$rand_id}}',
        });


    });
</script>