<!DOCTYPE html>
<html lang="{{ trim(str_replace('_', '-', app()->getLocale())) }}"
      dir="{{trim(str_replace('_', '-', app()->getLocale())) == 'fa'? 'rtl':'ltr'}}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ Session::token() }}">

    @yield('meta')
    <title>{{trans('messages.html_title')}}</title>
    <link href="{{ URL::asset('/public/assets/global/images/favicon.png') }}" rel="shortcut icon" type="image/png">

    <!-- Global stylesheets -->
    {{--    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">--}}
    <link href="{{ url('/public/assets/panel/global_assets/css/icons/icomoon/styles.css') }}" rel="stylesheet"
          type="text/css">
    <link href="{{ URL::asset('/public/assets/panel/global_assets/css/icons/fontawesome/styles.min.css') }}"
          rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/panel/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/panel/css/bootstrap_limitless.min.css') }}" rel="stylesheet"
          type="text/css">
    <link href="{{ URL::asset('/public/assets/panel/css/layout.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/panel/css/components.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/panel/css/colors.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/panel/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/panel/css/fonts.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
    @yield('css')

<!-- Core JS files -->
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/main/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/loaders/blockui.min.js') }}"></script>
    {{--    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/ui/ripple.min.js') }}"></script>--}}
    <script src="{{ URL::asset('/public/assets/panel/js/selectize/selectize.js')}}"></script>
    <script src="{{ URL::asset('/node_modules/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/js/custom.js') }}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    @yield('js')
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/validation/validate.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/global/js/localization/messages_fa.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/js/app.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/notifications/pnotify.min.js') }}"></script>

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
        $(document).ready(function () {
            @if(!$errors->isEmpty())
            @foreach ($errors->all() as $key => $error)
            new PNotify({
                title: '{{$key}}',
                text: '{{ $error }}',
                type: 'error'
            });

            @endforeach
            @endif
            @if ($message = Session::get('message'))
            new PNotify({
                title: '',
                text: '{{$message}}',
                type: 'success'
            });
            @endif

        });
    </script>
    <!-- /theme JS files -->
</head>
<noscript>
    <!-- Error title -->
    <span class=" text-center content-group">
        <h1 class="error-title offline-title">Unreachable</h1>
        <h5>Sorry, our website needs javascript to be eanable</h5>
    </span>
    <!-- /error title -->
    <style>div {
            display: none;
        }</style>
</noscript>
<?php
if (!isset($active_sidbare)) {
    $active_sidbare = [];
}
?>
<body class="{{in_array("collapse", $active_sidbare) ? 'sidebar-xs' : '' }}">
@include('layouts.panel.navbar')

@include('panel.materials.form_notification')

<!-- Page content -->
<div class="page-content">
@include('layouts.panel.sidebar')
<!-- Main content -->
    <div class="content-wrapper"
         style="background-image: url({{URL::asset('/public/assets/panel/images/b-pattern.png')}});">
        @yield('content')
    </div>
</div>
<!-- /page content -->

<!-- Info modal -->
<div id="general_modal" class="modal fade ">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h6 class="modal-title">Info header</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">

            </div>

        </div>
    </div>
</div>
<!-- /info modal -->


@yield('footer_js')

</body>
</html>
