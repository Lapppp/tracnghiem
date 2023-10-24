<html lang="en">
<!--begin::Head-->
<head><base href="../../">
    <title>KenJi</title>
    <meta name="description" content="KenJi" />
    <meta name="keywords" content="KenJi" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="KenJi" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="KenJi" />
    <link rel="canonical" href="Https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('/backend/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/backend/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="bg-body">
<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Authentication - 404 Page-->
    <div class="d-flex flex-column flex-center flex-column-fluid p-10">
        <!--begin::Illustration-->
        <img src="{{ asset('/backend/assets/media/illustrations/sketchy-1/18.png') }}" alt="" class="mw-100 mb-10 h-lg-450px" />
        <!--end::Illustration-->
        <!--begin::Message-->
        <h1 class="fw-bold mb-10" style="color: #A3A3C7">Xin lỗi, trang bạn đang tìm kiếm không tồn tại!</h1>
        <!--end::Message-->
        <!--begin::Link-->
        <a href="{{Route('frontend.home.index')}}" class="btn btn-primary">Quay về trang chủ</a>
        <!--end::Link-->
    </div>
    <!--end::Authentication - 404 Page-->
</div>
<!--end::Main-->
<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{ asset('/backend/assets/plugins/global/plugins.bundle.jss') }} "></script>
<script src="{{ asset('/backend/assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--end::Javascript-->
</body>
<!--end::Body-->
</html>

{{--@extends('errors::minimal')--}}

{{--@section('title', __('Not Found'))--}}
{{--@section('code', '404')--}}
{{--@section('message', __('Not Found'))--}}


