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
    <link href="../../../../global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/css/layout.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/css/components.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/css/colors.min.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
    @yield('css')

    <!-- Core JS files -->
    <script src="{{ URL::asset('/public/global_assets/js/main/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('/public/global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('/public/global_assets/js/plugins/loaders/blockui.min.js') }}"></script>
    <script src="{{ URL::asset('/public/global_assets/js/plugins/ui/ripple.min.js') }}"></script>

    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{ URL::asset('/public/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/public/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    @yield('js')

    <script src="{{ URL::asset('/public/assets/js/app.js') }}"></script>
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

<body class="withscript navbar-top {{isset($sidebar_collapse) ? "sidebar-xs" : ""}}">
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