<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ !empty($title) ? 'Luyện Thi Công Chức - '.$title : 'Luyện Thi Công Chức' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/frontend/questions')}}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/frontend/questions')}}/assets/css/animate.min.css">
    <link rel="stylesheet" href="{{ asset('/frontend/questions')}}/assets/css/style.css">
    @if(isset($css))
        {{$css}}
    @endif
    <script type="text/javascript">
        var BASE_URL = '{{ url('') }}';
    </script>
</head>
<body>
<div class="wrapper overflow-hidden">
    <!-- Top content -->
    @if(isset($counter))
        {{$counter}}
    @endif
    <div class="container">
        {{ $slot }}
    </div>
</div>
<script src="{{ asset('/frontend/questions')}}/assets/js/jquery-3.6.0.min.js"></script>
<script src="{{ asset('/frontend/questions')}}/assets/js/bootstrap.min.js"></script>
<script src="{{ asset('/frontend/questions')}}/assets/js/countdown.js"></script>
<script src="{{ asset('/frontend/questions')}}/assets/js/jquery.validate.min.js"></script>
@if(isset($javascript))
    {{$javascript}}
@endif
</body>
</html>
