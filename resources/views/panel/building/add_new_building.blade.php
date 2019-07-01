@extends('layouts.panel.panel_layout')
@section('js')
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.js') }}"></script>
    <script src="http://www.openlayers.org/api/OpenLayers.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
    <script src="{{ URL::asset('/public/assets/panel/js/location-picker.js') }}"></script>
    <script>
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
    </script>
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
    $active_sidbare = ['building','add_new_building']
    ?>

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                <div class="card-body">
                    @include('panel.building.materials.add_new_project_form')
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection