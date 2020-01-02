@extends('layouts.global.global_layout')
@section('js')
    <script
            src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/validation/validate.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/global/js/localization/messages_fa.js') }}"></script>
    <script src="{{ URL::asset('/node_modules/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <script src="{{asset('public/assets/global/js/leatflat/leaflet.js')}}"></script>
    <script
            src="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.js"></script>
    <script>
        $(document).ready(function () {
            var map = L.map('mapid').setView([35.700, 51.400], 11);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                accessToken: 'sk.eyJ1IjoibWlsYWRrYXJkZ2FyIiwiYSI6ImNqenU2cjIweDAxeGozY283eGF0NXgxamwifQ.Zf18DPBuHLhHR8FIONTtWg'
            }).addTo(map);
            map.on('click', function (e) {
                $(".leaflet-marker-pane").html("");
                $(".leaflet-shadow-pane").html("");
                var marker = L.marker([e.latlng.lat, e.latlng.lng]).addTo(map);
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
                                $("#frm_add_address").toggleClass('hidden');
                                $(form).find('.form-control').val('');
                            }
                            form_btn.prop('disabled', false).html(form_btn_old_msg);
                            $(form_result_div).html(data.message).fadeIn('slow');
                            setTimeout(function () {
                                return window.location.href = "/order/information/";
                            }, 2000);
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
            $('#meeting_date').MdPersianDateTimePicker({
                targetTextSelector: '#meeting_date',
                enableTimePicker: false,
                disableBeforeToday: true,
                englishNumber: true
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
            $('.clockpicker').clockpicker();
        })

    </script>
@stop
@section('css')
    <link
            href="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.style.css') }}"
            rel="stylesheet" type="text/css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.css"/>
    <link rel="stylesheet" href="{{ URL::asset('public/assets/global/js/leatflat/leaflet.css')}}"/>
    <style>
        .border {
            border: 2px solid #88e0a1 !important;
        }

        #mapid {
            height: 400px;
        }
    </style>
@stop
@section('content')
    <div class="main-content">
        {{@csrf_field()}}
        <section class="">
            <div class="container mt-30 mb-30 p-30">
                <div class="row">
                    <div class="col-md-4 bg-success text-center step_one">
                        <h3 class="badge badge-danger">1</h3><br>
                        <i class="fa fa-user fa-3x text-success mb-10"></i>
                        <h5>{{__('messages.user_information')}}</h5>
                    </div>
                    <div class="col-md-4 text-center step_two">
                        <h3 class="badge badge-danger">2</h3><br>
                        <i class="fa fa-truck fa-3x  mb-10"></i>
                        <h5>{{__('messages.send_information')}}</h5>
                    </div>
                    <div class="col-md-4 text-center step_three">
                        <h3 class="badge badge-danger">3</h3><br>
                        <i class="fa fa-amazon fa-3x mb-10"></i>
                        <h5>{{__('messages.payment_information')}}</h5>
                    </div>
                </div>
                <div class="clearfix"></div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <strong><i class="fa fa-angle-left"></i> {{__('messages.customer_information')}}</strong>
                        <table class="table table-bordered border">
                            <tbody>
                            <tr>
                                <td rowspan="2" colspan="1" class="col-md-1 success"><i
                                            class="fa fa-check-square-o fa-3x text-success mr-20 mt-10"></i></td>
                                <td colspan="4">
                                    <label class="text-secondary">{{__('messages.name_family')}}: </label>
                                    <span>{{$userInfo['people']['name']}} {{$userInfo['people']['family']}}</span>
                                </td>
                                <td colspan="4">
                                    <label class="text-secondary">{{__('messages.phone')}}: </label>
                                    <span>{{$userInfo['people']['phone']}}</span>
                                </td>
                                <td colspan="4">
                                    <label class="text-secondary">{{__('messages.mobile')}}: </label>
                                    <span>{{$userInfo['phone']}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <label class="text-secondary">{{__('messages.zip_code')}}: </label>
                                    <span></span>
                                </td>
                                <td colspan="8">
                                    <label class="text-secondary">{{__('messages.address')}}: </label>
                                    <span class="text-danger">
                                    @forelse($userInfo['addresses'] as $address)
                                            @if($address['default']==1)
                                                {{$address['address']}}
                                            @endif
                                        @empty
                                            {{__('messages.no_any_address_submit')}}
                                        @endforelse
                                    </span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="clearfix"></div>
                        <strong><i class="fa fa-angle-left"></i> {{__('messages.address')}}</strong>
                        <form action="{{route('store_order_add_address')}}" autocomplete="off" id="frm_add_address"
                              method="post"
                              class="border">
                            <div class="row add-address m-20">
                                <div class="col-md-6 col-xs-12 form-group">
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
                                    <div class="col-md-6 col-xs-12 form-group">
                                        <label for="receiver">{{__('messages.receiver_name')}}</label>
                                        <input type="text" class="form-control" required="required" name="receiver">
                                    </div>
                                    <div class="col-md-6 col-xs-12 form-group">
                                        <label for="zip_code">{{__('messages.zip_code')}}</label>
                                        <input type="text" class="form-control" name="zip_code">
                                    </div>
                                    <div class="col-md-6 col-xs-12 form-group">
                                        <label for="phone">{{__('messages.phone')}}</label>
                                        <input type="text" class="form-control input-sm" dir="ltr" name="phone">
                                    </div>
                                    <div class="col-md-6 col-xs-12 form-group">
                                        <label for="mobile">{{__('messages.mobile')}}</label>
                                        <input type="text" class="form-control" dir="ltr" name="mobile">
                                    </div>
                                    <div class="col-md-12 col-xs-12 form-group">
                                        <label for="description">{{__('messages.descriptions')}}</label>
                                        <textarea name="description" id="description" class="form-control" cols="30"
                                                  rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12 form-group ">
                                    <div class="col-md-12 col-xs-12 form-group">
                                        <label for="receiver">{{__('messages.condolences_to')}}</label>
                                        <input type="text" class="form-control" required="required"
                                               name="condolences_to">
                                    </div>
                                    <div class="col-md-6 col-xs-12 form-group">
                                        <label for="receiver">{{__('messages.on_behalf_of')}}</label>
                                        <input type="text" class="form-control" required="required" name="from_as">
                                    </div>
                                    <div class="col-md-6 col-xs-12 form-group">
                                        <label for="receiver">{{__('messages.late_name')}}</label>
                                        <input type="text" class="form-control" required="required" name="late_name">
                                    </div>
                                    <div class="col-md-6 col-xs-12 form-group">
                                        <label for="receiver">{{__('messages.meeting_date')}}</label>
                                        <input type="text" class="form-control" required="required" id="meeting_date"
                                               name="meeting_date">
                                    </div>
                                    <div class="col-md-6 col-xs-12 form-group">
                                        <label for="receiver">{{__('messages.meeting_time')}}</label>
                                        <input type="text" class="form-control clockpicker" required="required"
                                               value="09:30" name="meeting_time">
                                    </div>
                                    <div class="col-md-12 col-xs-12 form-group">
                                        <label for="meeting_address">{{__('messages.meeting_address')}}</label>
                                        <textarea cols="30" rows="4" class="form-control" required="required"
                                                  name="meeting_address" id="meeting_address"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 col-xs-12 form-group">
                                    <label for="mapid">{{__('messages.map_position')}}</label>
                                    <input type="hidden" name="lat" id="lat">
                                    <input type="hidden" name="lon" id="lon">
                                    <div id="mapid"></div>
                                </div>
                                <div class="col-md-12 col-xs-12 form-group">
                                    <button type="submit"
                                            class="btn btn-success pull-left p-10 pr-20 pl-20">{{__('messages.continue_shopping')}}
                                        <i class="fa fa-caret-left pr-10"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
