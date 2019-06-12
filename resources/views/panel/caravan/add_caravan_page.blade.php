@extends('layouts.panel.panel_layout')
@section('js')
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.js') }}"></script>
@endsection
@section('css')
    <link href="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.style.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <?php
    $active_sidbare = ['caravans']
    ?>

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                <div class="card-body">
                    @include('panel.caravan.materials.add_new_caravan_form')
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection