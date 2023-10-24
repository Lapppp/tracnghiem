<!DOCTYPE html>
<html lang="en">
<head><base href="../../../">
    <meta charset="utf-8" />
    <title>Login</title>
    <meta name="description" content="Craft admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
    <meta name="keywords" content="Craft, bootstrap, Angular 10, Vue, React, Laravel, admin themes, free admin themes, bootstrap admin, bootstrap dashboard" />
    <link rel="canonical" href="#" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ asset('/backend/assets/media/logos/favicon.ico') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ asset('/backend/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/backend/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
</head>
<body id="kt_body" class="bg-white header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
{{$slot}}
<script src="{{ asset('/backend/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('/backend/assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('/backend/assets/js/jquery/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('/backend/assets/js/custom/authentication/sign-in/general.js') }}"></script>
</body>
</html>
