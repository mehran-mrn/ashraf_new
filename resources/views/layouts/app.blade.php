<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{__('messages.login_to_ashraf_crm')}}</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="../../../../global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/panel/global_assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/panel/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/panel/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/panel/css/layout.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/panel/css/components.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/panel/css/colors.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/public/assets/panel/css/fonts.css') }}" rel="stylesheet" type="text/css">

    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/main/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/loaders/blockui.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/ui/ripple.min.js') }}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>

    <script src="{{ URL::asset('/public/assets/panel/js/app.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/demo_pages/login.js') }}"></script>
    <!-- /theme JS files -->
    <style>
        body{
            font-family: IRANSans !important;
        }
    </style>
</head>

<body class="bg-slate-800 ">
@yield('content')

</body>
</html>
