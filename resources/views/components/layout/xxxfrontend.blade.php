<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $title ?? 'KenJi' }}</title>
     <script type="text/javascript">if (window.location.protocol == 'http:') { window.location.href =  window.location.href.replace( 'http:', 'https:'); } </script>
    <meta name="robots" content="index, follow">
    <meta charset="utf-8">
    <meta name="theme-color" content="#D73436">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="kenjivietnam.vn">
    <meta name="description" content="{{ $description ??  'Ghế massage KENJI – K8 tự hào là sản phẩm chất lượng được đài truyền hình VTC6 lựa chọn đưa tin trong mục cẩm nang sức khỏe.' }}">
    <meta name="keywords" content="{{ $keywords ?? 'Ghế massage KENJI' }}">
    <meta name="og:title" content="{{ $title ?? 'KenJi' }}">
    <meta name="og:description" content="{{ $description ??  'Ghế massage KENJI – K8 tự hào là sản phẩm chất lượng được đài truyền hình VTC6 lựa chọn đưa tin trong mục cẩm nang sức khỏe.' }}">
    <meta name="og:image" content="{{ $imageSeo ?? asset('/frontend/assets//a/i/logo.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ asset('/frontend/assets/a/i/favicon.png') }}"/>
    <link rel="stylesheet" href="{{ asset('/frontend/assets/a/c/style.css?ver='.time()) }}">
    @if(isset($css))
        {{$css}}
    @endif

    @if(isset($footerCompany->meta_header))
        {!! $footerCompany->meta_header !!}
    @endif
    <script src="{{ asset('/frontend/assets/js/lozad.min.js')}}"></script>
    <script type="text/javascript">
        var baseUrl = '{{ url('') }}';
        const observer = lozad(); // lazy loads elements with default selector as '.lozad'
        observer.observe();
    </script>
</head>

<body>
@include('components.frontend.shared.navbar')
{{ $slot }}
<script src="{{ asset('/frontend/assets/js/jquery/jquery.js') }}"></script>


@include('components.frontend.shared.footer')

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script  type="text/javascript" src="{{ asset('/frontend/assets/a/j/main.js?v='.time()) }}"></script>
<script  type="text/javascript" src="{{ asset('/frontend/assets/js/cart.js?v='.time()) }}"></script>
<script  type="text/javascript" src="{{ asset('/frontend/assets/js/login.js?v='.time()) }}"></script>
<script type="text/javascript" src="{{ asset('frontend') }}/assets/js/location.js?v={{time()}}"></script>
<script type="text/javascript" src="{{ asset('frontend') }}/assets/js/advise.js?v={{time()}}"></script>
<script type="text/javascript" src="{{ asset('frontend') }}/assets/js/user.js?v={{time()}}"></script>
<script type="text/javascript" src="{{ asset('frontend') }}/assets/js/favourite.js?v={{time()}}"></script>
<script type="text/javascript" src="{{ asset('frontend') }}/assets/js/search.js?v={{time()}}"></script>

@if(isset($footerCompany->meta_body))
    {!! $footerCompany->meta_body !!}
@endif

@if(isset($javascript))
    {{$javascript}}
@endif
</body>
</html>
