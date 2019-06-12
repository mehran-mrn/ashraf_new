@extends('layouts.panel.panel_layout')
@section('js')
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
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