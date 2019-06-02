<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @yield('meta')
    <title>{{trans('messages.html_title')}}</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/panel/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/panel/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/panel/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/panel/css/layout.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/panel/css/components.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/panel/css/colors.min.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
    @yield('css')

    <!-- Core JS files -->
    <script src="{{ URL::asset('/public/assets/panel/js/main/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/js/main/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/js/plugins/loaders/blockui.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/js/plugins/ui/ripple.min.js') }}"></script>

    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{ URL::asset('/public/assets/panel/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/js/plugins/forms/selects/select2.min.js') }}"></script>
    @yield('js')

    <script src="{{ URL::asset('/public/assets/panel/js/app.js') }}"></script>
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

<body class="{{isset($sidebar_collapse) ? "sidebar-xs" : ""}}">
@include('layouts.panel.navbar')
    <!-- Page content -->
    <div class="page-content">
        @include('layouts.panel.sidebar')
        <!-- Main content -->
            <div class="content-wrapper">
                @yield('content')
            </div>
    </div>
    <!-- /page content -->
</body>
</html>
