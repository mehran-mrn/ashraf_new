<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @yield('meta')
    <title>{{trans('messages.html_title')}}</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/panel/global_assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/panel/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/panel/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/panel/css/layout.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/panel/css/components.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/panel/css/colors.min.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
    @yield('css')
    <style>


        @font-face {
            font-family: 'Samim';
            src: url("{{ URL::asset('/public/fonts/Samim.eot') }}"); /* IE9 Compat Modes */
            src: url("{{ URL::asset('/public/fonts/Samim.eot?#iefix') }}") format('embedded-opentype'), /* IE6-IE8 */ url("{{ URL::asset('/public/fonts/Samim.woff2') }}") format('woff2'), /* Super Modern Browsers */ url("{{ URL::asset('/public/fonts/Samim.woff') }}") format('woff'), /* Pretty Modern Browsers */ url("{{ URL::asset('/public/fonts/Samim.ttf') }}") format('truetype'), /* Safari, Android, iOS */ url("{{ URL::asset('/public/fonts/Samim.svg#svgFontName') }}") format('svg'); /* Old iOS */
        }

        @font-face {
            font-family: 'BSamim';
            src: url("{{ URL::asset('/public/fonts/Samim-Bold.eot') }}"); /* IE9 Compat Modes */
            src: url("{{ URL::asset('/public/fonts/Samim-Bold.eot?#iefix') }}") format('embedded-opentype'), /* IE6-IE8 */ url("{{ URL::asset('/public/fonts/Samim-Bold.woff2') }}") format('woff2'), /* Super Modern Browsers */ url("{{ URL::asset('/public/fonts/Samim-Bold.woff') }}") format('woff'), /* Pretty Modern Browsers */ url("{{ URL::asset('/public/fonts/Samim-Bold.ttf') }}") format('truetype'), /* Safari, Android, iOS */ url("{{ URL::asset('/public/fonts/Samim-Bold.svg#svgFontName') }}") format('svg'); /* Old iOS */
        }

    </style>
    <style>
        body {
            font-family: Samim !Important;
        }
    </style>
    <!-- Core JS files -->
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/main/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/loaders/blockui.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/ui/ripple.min.js') }}"></script>

    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
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
