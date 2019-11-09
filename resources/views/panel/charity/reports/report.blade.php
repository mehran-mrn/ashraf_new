@extends('layouts.panel.panel_layout')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('js')
    <script src="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/visualization/d3/d3.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/visualization/d3/d3_tooltip.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#start_date_btn').MdPersianDateTimePicker({
                targetTextSelector: '#start_date',
                fromDate: true,
                groupId: 'dateRangeSelector1',
                enableTimePicker: true,
                englishNumber: true
            });
            $('#end_date_btn').MdPersianDateTimePicker({
                targetTextSelector: '#end_date',
                toDate: true,
                groupId: 'dateRangeSelector1',
                enableTimePicker: true,
                englishNumber: true

            });
            $('.form-check-input-styled').uniform();

            $(document).on("submit", '#frm_report', function (e) {
                e.preventDefault();
                $.ajax({
                    url: '{{route('charity_reports_ajax')}}',
                    type: 'post',
                    data: $(this).serialize(),
                    success: function (response) {
                        $("#res").html(response)
                    },
                    error: function (error) {
                        console.log(error)
                    }
                });
            })
        });
    </script>
@endsection
@section('css')
    <link href="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.style.css') }}"
          rel="stylesheet" type="text/css">
@stop
@php
    $active_sidbare = ['charity', 'charity_reports']
@endphp
@section('content')
    <section>
        <div class="content">
            <section>
                <div class="card">
                    <div class="card-header pb-0">
                        <h6 class="card-title text-black">{{__('messages.Charity')}} | {{__('messages.reports')}}</h6>
                        <hr>
                    </div>
                    <div class="card-body">
                        <form action="" id="frm_report">
                            @csrf
                            <div class="d-flex justify-content-center">
                                <div class="m-2">
                                    <div class="form-group">
                                        <label for="from">{{__('messages.from')}}</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" readonly="readonly" id="start_date"
                                                   name="start_date"
                                                   required="required"
                                                   value="{{jdate("Y-m-d 00:00:01",time())}}">
                                            <button class="btn btn-outline-dark btn-sm" type="button"
                                                    id="start_date_btn"><i
                                                        class="icon-calendar"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-2">
                                    <div class="form-group">
                                        <label for="to">{{__('messages.to')}}</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" readonly="readonly" id="end_date"
                                                   name="end_date"
                                                   required="required"
                                                   value="{{jdate("Y-m-d 23:59:59",time())}}">
                                            <button class="btn btn-outline-dark btn-sm" type="button" id="end_date_btn">
                                                <i class="icon-calendar"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="m-2">
                                    <div class="form-group mb-3 mb-md-2">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input-styled" checked
                                                       data-fouc>
                                                {{__('messages.charity_vow')}}
                                            </label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input-styled" checked
                                                       data-fouc>
                                                {{__('messages.charity_donate')}}
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input-styled" checked
                                                       data-fouc>
                                                {{__('messages.charity_period')}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="m-2">
                                    <button type="submit" class="btn btn-success">{{__('messages.reports')}}</button>
                                </div>
                            </div>
                        </form>
                        <div id="res"></div>
                    </div>
                </div>
            </section>
        </div>
    </section>
@stop
