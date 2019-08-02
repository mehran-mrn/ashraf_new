@extends('layouts.global.global_layout')
@section('content')
    <!-- Start main-content -->
    <div class="main-content">
        <!-- Section: inner-header -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-5"
                 data-bg-img="{{URL::asset('public/assets/global/images/bg/bg1.jpg')}}">
            <div class="container pt-90 pb-50">
                <!-- Section Content -->
                <div class="section-content pt-100">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="title text-white">{{__("messages.tableau_and_wreath")}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="main-content">
            <div class="container">
                <h1>{{$charity['title']}}</h1>
                <div class="container m-30 text-justify">{!! $charity['description']!!}</div>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        @foreach($charity['fields'] as $fi)
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{$fi['label']}}</label>
                                    @switch($fi['type'])
                                        @case(0)
                                        <input type="text" class="form-control" name="field[{{$fi['id']}}]">
                                        @break
                                        @case(1)
                                        <textarea name="field[{{$fi['id']}}]" class="form-control"
                                                  id="field[{{$fi['id']}}]" cols="30" rows="3"></textarea>
                                        @break
                                        @case(2)
                                        <input type="number" class="form-control" name="field[{{$fi['id']}}]">
                                        @break
                                        @case(3)
                                        <input type="date" class="form-control" name="field[{{$fi['id']}}]">
                                        @break
                                        @case(4)
                                        <input type="time" class="form-control" name="field[{{$fi['id']}}]">
                                        @break
                                    @endswitch
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="amount">{{__('messages.amount')}}</label>
                                <input type="number" min="{{$charity['min']}}" max="{{$charity['max']}}"
                                       class="form-control" name="amount">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="">{{__('messages.payment_gateway')}}</label>
                            <select name="gateway" id="gateway" class="form-control">
                                @foreach($gateways as $gateway)
                                    <option value="{{$gateway['id']}}">{{$gateway['bank']['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group pt-20">
                                <button class="btn btn-success pull-left">{{__("messages.pay")}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end main-content -->
    </div>
@stop
