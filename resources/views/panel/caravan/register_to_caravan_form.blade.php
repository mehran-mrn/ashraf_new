@extends('layouts.panel.panel_layout')
@section('js')
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/wizards/steps.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/inputs/inputmask.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/validation/validate.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/extensions/cookie.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/demo_pages/form_wizard_rtl.js') }}"></script>

@endsection
@section('content')
    <?php
    $active_sidbare = ['caravans']
    ?>
<?php $rand_id = rand(1, 8000); ?>
    <!-- Remote content source -->
    <div class="content">
        <div class="row">
            <div class="col-md-12">

            <div class="card">
        <div class="card-header bg-white header-elements-inline">
            <h6 class="card-title">{{trans('messages.new_register')}}</h6>

        </div>

        <form class="wizard-form steps-async" action="#" data-fouc>
            <h6>{{trans('messages.national_code')}}</h6>
            <fieldset data-mode="async" data-url="{{route('register_to_caravan_national_code',['caravan_id'=>'2'])}}"></fieldset>

            <h6>{{trans('messages.additional_info')}}</h6>
            <fieldset data-mode="async" data-url="{{route('register_to_caravan_national_code',['caravan_id'=>'2'])}}"></fieldset>

            <h6>{{trans('messages.doc_upload')}}</h6>
            <fieldset data-mode="async" data-url="../../../../global_assets/demo_data/wizard/experience.html"></fieldset>

            <h6>{{trans('messages.final_submit')}}</h6>
            <fieldset data-mode="async" data-url="../../../../global_assets/demo_data/wizard/additional.html"></fieldset>
        </form>
    </div>
    <!-- /remote content source -->


        </div>
        </div>
    </div>

@endsection
