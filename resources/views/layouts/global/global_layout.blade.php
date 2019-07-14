<!DOCTYPE html>
<html dir="rtl" lang="en">
<head>

    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name="description" content="ngopress - Nonprofit, Crowdfunding & Charity HTML5 Template"/>
    <meta name="keywords" content="charity,crowdfunding,nonprofit,orphan,Poor,funding,fundrising,ngo,children"/>
    <meta name="author" content="ThemeMascot"/>
@yield('meta')

<!-- Page Title -->
    <title>{{trans('messages.html_title')}}</title>

    <!-- Favicon and Touch Icons -->
    <link href="{{ URL::asset('/public/assets/global/images/favicon.png') }}" rel="shortcut icon" type="image/png">
    <link href="{{ URL::asset('/public/assets/global/images/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <link href="{{ URL::asset('/public/assets/global/images/apple-touch-icon-72x72.png') }}" rel="apple-touch-icon"
          sizes="72x72">
    <link href="{{ URL::asset('/public/assets/global/images/apple-touch-icon-114x114.png') }}" rel="apple-touch-icon"
          sizes="114x114">
    <link href="{{ URL::asset('/public/assets/global/images/apple-touch-icon-144x144.png') }}" rel="apple-touch-icon"
          sizes="144x144">

    <!-- Stylesheet -->
    <link href="{{ URL::asset('/public/assets/global/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/global/css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/global/css/animate.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/global/css/css-plugin-collections.css') }}" rel="stylesheet"/>
    <!-- CSS | menuzord megamenu skins -->
    <link id="menuzord-menu-skins"
          href="{{ URL::asset('/public/assets/global/css/menuzord-skins/menuzord-rounded-boxed.css') }}"
          rel="stylesheet"/>
    <!-- CSS | Main style file -->
    <link href="{{ URL::asset('/public/assets/global/css/style-main.css') }}" rel="stylesheet" type="text/css">
    <!-- CSS | Preloader Styles -->
    <link href="{{ URL::asset('/public/assets/global/css/preloader.css') }}" rel="stylesheet" type="text/css">
    <!-- CSS | Custom Margin Padding Collection -->
    <link href="{{ URL::asset('/public/assets/global/css/custom-bootstrap-margin-padding.css') }}" rel="stylesheet"
          type="text/css">
    <!-- CSS | Responsive media queries -->
    <link href="{{ URL::asset('/public/assets/global/css/responsive.css') }}" rel="stylesheet" type="text/css">
    <!-- CSS | RTL Layout -->
    <link href="{{ URL::asset('/public/assets/global/css/bootstrap-rtl.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/global/css/style-main-rtl.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/global/css/style-main-rtl-extra.css') }}" rel="stylesheet"
          type="text/css">
    <!-- CSS | Style css. This is the file where you can place your own custom css code. Just uncomment it and use it. -->
    <!-- <link href="css/style.css" rel="stylesheet" type="text/css"> -->
    <!-- Revolution Slider 5.x CSS settings -->
    <link href="{{ URL::asset('/public/assets/global/js/revolution-slider/css/settings.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ URL::asset('/public/assets/global/js/revolution-slider/css/layers.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ URL::asset('/public/assets/global/js/revolution-slider/css/navigation.css') }}" rel="stylesheet"
          type="text/css"/>

    <!-- CSS | Theme Color -->
    <link href="{{ URL::asset('/public/assets/global/css/colors/theme-skin-blue.css') }}" rel="stylesheet"
          type="text/css">
    <link href="{{ URL::asset('/public/assets/global/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{URL::asset('node_modules/pnotify/dist/PNotifyBrightTheme.css')}}" rel="stylesheet" type="text/css" />

    @yield('css')
    <style>

    </style>
    <!-- external javascripts -->
    <script src="{{ URL::asset('/public/assets/global/js/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/global/js/jquery-ui.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/global/js/bootstrap.min.js') }}"></script>
    <!-- JS | jquery plugin collection for this theme -->
    <script src="{{ URL::asset('/public/assets/global/js/jquery-plugin-collection.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/global/js/localization/messages_fa.js') }}"></script>

    <!-- Revolution Slider 5.x SCRIPTS -->
    <script
        src="{{ URL::asset('/public/assets/global/js/revolution-slider/js/jquery.themepunch.tools.min.js') }}"></script>
    <script
        src="{{ URL::asset('/public/assets/global/js/revolution-slider/js/jquery.themepunch.revolution.min.js') }}"></script>



    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('js')

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

<body class="rtl">
<div id="wrapper" class="clearfix">
    <!-- preloader -->
    <div id="preloader">
        <div id="spinner">
            <img class="floating" src="{{ URL::asset('/public/assets/global/images/preloaders/13.png') }}" alt="">
            <h5 class="line-height-50 font-18 ml-15">{{trans('messages.Loading...')}}</h5>
        </div>
        <div id="disable-preloader" class="btn btn-default btn-sm">{{trans('messages.Disable_Preloader')}}</div>
    </div>
    <!-- header -->
    @include('layouts.global.navbar')
    @yield('content')
    @include('layouts.global.footer')
    @include('panel.materials.form_notification')

</div>


<!-- Footer Scripts -->

<script type="text/javascript"
        src="{{ URL::asset('/public/assets/global/js/revolution-slider/js/extensions/revolution.extension.actions.min.js') }}"></script>
<script type="text/javascript"
        src="{{ URL::asset('/public/assets/global/js/revolution-slider/js/extensions/revolution.extension.carousel.min.js') }}"></script>
<script type="text/javascript"
        src="{{ URL::asset('/public/assets/global/js/revolution-slider/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
<script type="text/javascript"
        src="{{ URL::asset('/public/assets/global/js/revolution-slider/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script type="text/javascript"
        src="{{ URL::asset('/public/assets/global/js/revolution-slider/js/extensions/revolution.extension.migration.min.js') }}"></script>
<script type="text/javascript"
        src="{{ URL::asset('/public/assets/global/js/revolution-slider/js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script type="text/javascript"
        src="{{ URL::asset('/public/assets/global/js/revolution-slider/js/extensions/revolution.extension.parallax.min.js') }}"></script>
<script type="text/javascript"
        src="{{ URL::asset('/public/assets/global/js/revolution-slider/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script type="text/javascript"
        src="{{ URL::asset('/public/assets/global/js/revolution-slider/js/extensions/revolution.extension.video.min.js') }}"></script>
<script src="{{ URL::asset('node_modules/pnotify/dist/iife/PNotify.js') }}"></script>

<!-- JS | Custom script for all pages -->
<script src="{{ URL::asset('/public/assets/global/js/custom.js') }}"></script>
@yield('footer_js')
<script>
    $(document).ready(function () {
        @if(!$errors->isEmpty())
        @foreach ($errors->all() as $key => $error)
            PNotify.error({
                title: '{{$key}}',
                text: '{{ $error }}',
                delay: 5000,
            });
        @endforeach
        @endif
        @if ($message = Session::get('message'))
            PNotify.success({
                text: '{{$message}}',
                delay: 3000,
            });
        @endif
    });
</script>
</body>
</html>
