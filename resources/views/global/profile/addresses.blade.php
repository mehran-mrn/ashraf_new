@extends('layouts.global.global_layout')
@section('title',__('messages.my_profile'). " |")
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('js')
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/uploaders/dropzone.min.js')}}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/validation/validate.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/global/js/localization/messages_fa.js') }}"></script>
    <script src="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.js') }}"></script>

    <script src="{{ URL::asset('/node_modules/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <script src="{{asset('public/assets/global/js/leatflat/leaflet.js')}}"></script>
    <script>
        $(document).ready(function () {
            var mymap = L.map('mapid').setView([35.70000, 51.3769549], 11);
            L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=sk.eyJ1IjoibWlsYWRrYXJkZ2FyIiwiYSI6ImNqenU2cjIweDAxeGozY283eGF0NXgxamwifQ.Zf18DPBuHLhHR8FIONTtWg', {
                attribution: '',
                maxZoom: 18,
                id: 'mapbox.streets',
                accessToken: 'sk.eyJ1IjoibWlsYWRrYXJkZ2FyIiwiYSI6ImNqenU2cjIweDAxeGozY283eGF0NXgxamwifQ.Zf18DPBuHLhHR8FIONTtWg'
            }).addTo(mymap);

            mymap.on('click', function (e) {
                $(".leaflet-marker-pane").html("");
                $(".leaflet-shadow-pane").html("");
                var marker = L.marker([e.latlng.lat, e.latlng.lng]).addTo(mymap);
                marker.bindPopup("<span>{{__('messages.your_location')}}: </span>" + e.latlng.lat + " | " + e.latlng.lng + "<br>").openPopup();
                $("#lat").val(e.latlng.lat);
                $("#lon").val(e.latlng.lng);
            });
            $("#frm_add_address").validate({
                lang: "fa",
                rules: {
                    province: {
                        required: true,
                    },
                    cities: {
                        required: true,
                    },
                    address: {
                        required: true,
                        minlength: 3
                    },
                    receiver: {
                        required: true,
                        minlength: 5,
                        maxlength: 100,
                    },
                    mobile: {
                        minlength: 11,
                        maxlength: 11,
                        number: true
                    },
                    phone: {
                        minlength: 11,
                        maxlength: 11,
                        number: true
                    }
                },
                submitHandler: function (form) {
                    var form_btn = $(form).find('button[type="submit"]');
                    var form_result_div = '#form-result';
                    $(form_result_div).remove();
                    form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
                    var form_btn_old_msg = form_btn.html();
                    form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
                    $(form).ajaxSubmit({
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                        },
                        success: function (data) {

                            if (data.message.status === 200) {
                                PNotify.success({
                                    text: data.message.message,
                                    delay: 3000,
                                });
                                $(form).find('.form-control').val('');
                                setTimeout(function () {
                                    window.location.reload();
                                },2000)
                            }
                            form_btn.prop('disabled', false).html(form_btn_old_msg);
                            $(form_result_div).html(data.message).fadeIn('slow');
                            setTimeout(function () {
                                $(form_result_div).fadeOut('slow')
                            }, 6000);
                        }, error: function (error) {
                            $.each(error.responseJSON.errors, function (i, item) {
                                PNotify.error({
                                    text: item,
                                    delay: 3000,
                                });
                            });
                            form_btn.prop('disabled', false).html(form_btn_old_msg);
                            setTimeout(function () {
                                return window.location.reload();
                            }, 1000);
                        }
                    });
                }
            });
            $(document).on('change', '#province', function () {
                var pro = $(this).val();
                $.ajax({
                    url: "{{route('get_city_list')}}",
                    type: "post",
                    data: {proID: pro},
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                    },
                    success: function (response) {
                        $("#cities").html("");
                        $.each(response, function (i, item) {
                            $("#cities").append("<option value='" + response[i].id + "'>" + response[i].name + "</option>");
                        });
                    }, error: function (error) {
                        $.each(error.responseJSON.errors, function (i, item) {
                            PNotify.error({
                                text: item,
                                delay: 3000,
                            });
                        });
                    }
                });
            })
            $(document).on('click', '.btn-delete', function () {
                var id = $(this).data('id');
                Swal.fire({
                    title: '{{__('messages.delete')}}',
                    text: "{{__('messages.are_you_sure')}}",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{{__('messages.yes_i_sure')}}',
                    cancelButtonText: '{{__('messages.cancel')}}'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{route('store_order_delete_address')}}",
                            type: "DELETE",
                            data: {id: id},
                            headers: {
                                'X-CSRF-TOKEN': $('input[name="_token"]').val()
                            },
                            success: function (response) {
                                $.each(response, function (index, value) {
                                    PNotify.success({
                                        text: value.message,
                                        delay: 3000,
                                    });
                                })
                                setTimeout(function () {
                                    return window.location.reload();
                                }, 1000);
                            }, error: function (response) {
                                var errors = response.responseJSON.errors;
                                $.each(errors, function (index, value) {
                                    PNotify.error({
                                        delay: 3000,
                                        title: index,
                                        text: value,
                                    });
                                });
                            }
                        });
                    }
                })
            })
        })
    </script>
@stop
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('/public/vendor/laravel-filemanager/css/dropzone.min.css') }}">
    <link href="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.style.css') }}"
          rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('public/assets/global/js/leatflat/leaflet.css')}}"/>
    <style>
        .border {
            border: 2px solid #88e0a1 !important;
        }

        #mapid {
            height: 280px;
        }

    </style>

@stop
@section('content')

    <div class="main-content">
        <section class="divider">
            <div class="container pt-30">
                {{@csrf_field()}}

                <div class="row">
                    <div class="col-md-12">
                        <label><i class="fa fa-angle-left"></i> {{__('messages.addresses')}}</label>
                        <table class="table table-bordered border text-center" style="vertical-align: middle">
                            <tbody>
                            @forelse($userInfo['addresses'] as $tra)
                                <tr>
                                    <td colspan="1" class="col-md-1 success" style="vertical-align: middle">
                                        <i class="fa fa-check-square-o fa-3x text-success align-middle text-center"></i>
                                    </td>
                                    <td class="align-middle" style="vertical-align: middle">
                                        <i class="fa fa-map-pin fa-2x pull-right mr-20"></i>
                                        <span class="pull-right btn  btn-sm align-middle mr-20">{{$tra['address']}}</span>
                                        <button class="btn btn-default btn-sm pull-right btn-delete"
                                                data-id="{{$tra['id']}}">{{__('messages.delete')}}</button>
                                        <span class="pull-left btn  btn-sm align-middle ml-20 text-success">{{$tra["receiver"]}}</span><strong
                                                class="pull-left btn  btn-sm">{{__('messages.receiver_name').": "}} </strong>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">{{__('messages.no_any_address_submit')}}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 pt-30">
                        <hr>
                        <label><i class="fa fa-angle-left"></i> {{__('messages.add_new_address')}}</label>
                        <form action="{{route('store_order_add_address')}}" id="frm_add_address" method="post"
                              class="border">
                            <div class="row add-address m-20">
                                <div class="col-md-6 col-xs-12 form-group ">
                                    <div class="col-md-6 col-xs-12 form-group">
                                        <label for="province">{{__('messages.province')}}</label>
                                        <select name="province" required="required" id="province" class="form-control">
                                            <option value="">{{__('messages.please_select')}}</option>
                                            @foreach($provinces as $province)
                                                <option value="{{$province['id']}}">{{$province['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-xs-12 form-group">
                                        <label for="cities">{{__('messages.city')}}</label>
                                        <select name="cities" required="required" id="cities" class="form-control">

                                        </select>
                                    </div>
                                    <div class="col-md-12 col-xs-12 form-group">
                                        <label for="address">{{__('messages.address')}}</label>
                                        <textarea name="address" id="address" class="form-control" required="required"
                                                  cols="30" rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12 form-group">
                                    <div class="col-md-6 col-xs-12">
                                        <label for="receiver">{{__('messages.receiver_name')}}</label>
                                        <input type="text" class="form-control" required="required" name="receiver">
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <label for="zip_code">{{__('messages.zip_code')}}</label>
                                        <input type="text" class="form-control" name="zip_code">
                                    </div>
                                    <div class="col-md-6 col-xs-12 form-group pt-10">
                                        <label for="phone">{{__('messages.phone')}}</label>
                                        <input type="text" class="form-control input-sm" dir="ltr" name="phone">
                                    </div>
                                    <div class="col-md-6 col-xs-12 form-group pt-10">
                                        <label for="mobile">{{__('messages.mobile')}}</label>
                                        <input type="text" class="form-control" dir="ltr" name="mobile">
                                    </div>
                                </div>
                                <div class="col-md-12 col-xs-12 form-group">
                                    <div id="mapid"></div>
                                    <input type="hidden" name="lat" id="lat">
                                    <input type="hidden" name="lon" id="lon">
                                </div>
                                <div class="col-md-12 col-xs-12 form-group">
                                    <button type="submit"
                                            class="btn btn-block btn-success">{{__('messages.submit')}}</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop