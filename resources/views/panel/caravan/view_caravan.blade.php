@extends('layouts.panel.panel_layout')
@section('css')
    <link href="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.style.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('js')
    <script src="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.js') }}"></script>
@endsection

@section('content')
    <?php
    $active_sidbare = ['caravans']
    ?>
    <!-- Content area -->
    <div class="content">
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header bg-indigo">
                        <span class="card-title">{{__('messages.persons_list')}}</span>
                    </div>
                    <div class="card-body">
                        @foreach($caravan['persons'] as $person)
                            <span class="text-danger">{{$person['person']['name']}}</span>
                        @endforeach
                    </div>
                </div>

            </div>
            <div class="col-md-3">

                <button class="btn bg-danger btn-block btn-float btn-float-lg modal-ajax-load"
                        data-ajax-link="{{route('register_to_caravan',['caravan_id'=>$caravan['id']])}}"
                        data-toggle="modal"
                        data-modal-title="{{trans('messages.register_form_title')}}"
                        data-target="#general_modal"
                        data-popup="tooltip"
                        data-placement="bottom"
                        data-container="body"
                        data-original-title="{{trans('messages.new_register')}}">
                    <i class="icon-user-plus icon-3x"></i>
                    <span>{{trans('messages.new_register')}}</span>
                </button>
                <span class="divider"><hr></span>
                <div class="card">
                    <div class="card-header bg-primary">
                        <span class="card-title">{{trans('messages.destination')}}</span>
                    </div>
                    <div class="card-img-actions px-1 pt-1">
                        <img class="card-img img-fluid img-absolute "
                             src="{{'/'.$caravan['host']['media']['url']}}" alt="">
                        <div class="card-img-actions-overlay  card-img bg-dark-alpha">

                        </div>
                    </div>

                    <div class="card-body">
                        <h6 class="font-weight-semibold"><b>{{$caravan['host']['name']}}</b></h6>
                        {{$caravan['host']['city_name']}}
                    </div>
                </div>


                <div class="card">
                    <div class="card-header bg-primary">
                        <span class="card-title">{{__('messages.caravan_info')}}</span>
                    </div>
                    <div class="card-body p-0">
                        <ul class=" list-group list-group-flush">
                            <li class="list-group-item list-group-item-action legitRipple">
                                <div>
                                    {{trans('messages.capacity')}}:
                                    <b>{{$caravan['capacity']}}</b>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action legitRipple">
                                <div>
                                    {{trans('messages.province')}} {{trans('messages.departure')}}:
                                    <b>{{get_provinces($caravan['dep_province'])['name']}}</b>

                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action legitRipple">
                                <div>
                                    {{trans('messages.city')}} {{trans('messages.departure')}}:
                                    <b>{{get_cites($caravan['dep_city'])['name']}}</b>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action legitRipple">
                                <div>
                                    {{trans('messages.transport_type').": "}}:
                                    <b>{{$caravan['transport']}}</b>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action legitRipple">
                                <div>
                                    {{trans('messages.date')}}
                                    {{trans('messages.depart')}}:
                                    <b>{{jdate('j F Y',strtotime($caravan['start']))}}</b>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action legitRipple">
                                <div>
                                    {{trans('messages.date')}}
                                    {{trans('messages.entrance')}}:
                                    <b>{{$caravan['arrival']?jdate('j F Y',strtotime($caravan['arrival'])):""}}</b>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action legitRipple">
                                <div>
                                    {{trans('messages.date')}}
                                    {{trans('messages.exit')}}:
                                    <b>{{$caravan['departure']?jdate('j F Y',strtotime($caravan['departure'])):""}}</b>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action legitRipple">
                                <div>
                                    {{trans('messages.date')}}
                                    {{trans('messages.get_back')}}:
                                    <b>{{$caravan['end']?jdate('j F Y',strtotime($caravan['end'])):""}}</b>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action legitRipple">
                                <div>
                                    {{trans('messages.status')}}:
                                    <b>{{trans('messages.registering')}}</b>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-primary">
                        <span class="card-title">{{__('messages.Workflow')}}</span>
                    </div>
                    <div class="card-body p-0">
                        @include('panel.caravan.materials.caravan_timeline')
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-primary">
                        <span class="card-title">Tag's</span>
                    </div>
                    <div class="card-body px-0">

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection