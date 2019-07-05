@extends('layouts.panel.panel_layout')
@section('js')
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.js') }}"></script>
    <script src="http://www.openlayers.org/api/OpenLayers.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
    <script src="{{ URL::asset('/public/assets/panel/js/location-picker.js') }}"></script>

@endsection
@section('css')
    <link href="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.style.css') }}" rel="stylesheet" type="text/css">
    <style>
        #map { height: 400px; width:100%;}
        .map-container { margin-top: 10px;}


        textarea {width:100%}


    </style>
@endsection

@section('content')
    <?php
    $active_sidbare = ['building', 'building_dashboard']
    ?>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header bg-light">
                        <button type="button" class="btn btn-outline-info btn-lg modal-ajax-load"
                                data-ajax-link="{{route('load_new_building_form')}}" data-toggle="modal"
                                data-modal-title="{{trans('messages.add_new_building')}}"
                                data-modal-size="modal-lg"
                                data-target="#general_modal"><i
                                    class="icon-home8 mr-2"></i> {{trans('messages.add_new_building')}}
                        </button>
                    </div>

                    <div class="card-body">

                        @foreach($projects->chunk(3) as $chunk)
                            <div class="row">
                                @foreach($chunk as $project)
                                    <div class="col-md-4">

                                        <div class="card">

                                            <div class="card-img-actions px-1 pt-1">
                                                <img class="card-img img-fluid img-absolute "
                                                     src="{{'/'.$project['media']['url']}}" alt="">
                                                <div class="card-img-actions-overlay  card-img bg-dark-alpha">

                                                </div>
                                            </div>

                                            <div class="card-body">
                                                <h6 class="font-weight-semibold"><b>{{$project['title']}}</b></h6>
                                                {{$project['description']}} |
                                                <button type="button" class="float-right btn alpha-info border-info-400 text-info-800 btn-icon rounded-round ml-2
                                             modal-ajax-load"
                                                        data-ajax-link="{{route('load_new_building_form',['project_id'=>$project['id']])}}"
                                                        data-toggle="modal"
                                                        data-modal-title="{{trans('messages.edit_item',['item'=>trans('messages.host')])}}"
                                                        data-target="#general_modal"
                                                        data-modal-size="modal-lg">
                                                    <i class="icon-pencil"></i>
                                                </button>
                                                <button type="button"
                                                        class="legitRipple swal-alert float-right btn alpha-pink border-pink-400 text-pink-800 btn-icon rounded-round ml-2"
                                                        data-ajax-link="{{route('delete_caravan_host',['host_id'=>$project['id']])}}"
                                                        data-method="POST"
                                                        data-csrf="{{csrf_token()}}"
                                                        data-title="{{trans('messages.delete_item',['item'=>trans('messages.host')])}}"
                                                        data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.host')])}}"
                                                        data-type="warning"
                                                        data-cancel="true"
                                                        data-confirm-text="{{trans('messages.delete')}}"
                                                        data-cancel-text="{{trans('messages.cancel')}}">
                                                <i class="icon-trash"></i>
                                                </button>
                                            </div>
                                        </div>


                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
