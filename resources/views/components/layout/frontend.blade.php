<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> Luyện Thi Công Chức - {{ $title ?? '' }}</title>
    <meta name="description" content="Morden Bootstrap HTML5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/frontend/') }}/assets/img/favicon.ico">
    <link rel="stylesheet" href="{{ asset('/frontend/') }}/assets/css/plugins/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{ asset('/frontend/') }}/assets/css/plugins/glightbox.min.css">
    <link rel="stylesheet" href="{{ asset('/frontend/') }}/assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/frontend/') }}/assets/css/plugins/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('/frontend/') }}/assets/css/style.css">
    @if(isset($css))
        {{$css}}
    @endif
</head>

<body>
@include('components.frontend.shared.header')
<main class="main__content_wrapper">
    {{ $slot }}
</main>

@include('components.frontend.shared.footer')
<button id="scroll__top"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M112 244l144-144 144 144M256 120v292"/></svg></button>
<script src="{{ asset('/frontend')}}/assets/js/vendor/jquery.js"></script>
<script src="{{ asset('/frontend/assets/js/vendor/popper.js') }}" defer="defer"></script>
<script src="{{ asset('/frontend/assets/js/vendor/bootstrap.min.js') }}" defer="defer"></script>
<script src="{{ asset('/frontend/assets/js/plugins/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('/frontend/assets/js/plugins/glightbox.min.js') }}"></script>
<script src="{{ asset('/frontend/assets/js/plugins/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('/frontend/assets/js/script.js?v='.time()) }}"></script>
<script type="text/javascript">
    $(document).ready(function(){

        $(document).on('click', 'button#homeRegister',function(){

            let email = $('#homeEmail').val();
            if(email.trim().length <=0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Thông báo',
                    text: 'Vui lòng nhập email'
                })
            }else {
                let token = $("meta[name='csrf-token']").attr("content");
                $.ajax({
                    url: "{{ Route('frontend.contact.receive') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        "email": email,
                        "_token": token,
                    },
                    success: function (dataJson) {

                        if(dataJson.status == 'success') {

                            let timerInterval
                            Swal.fire({
                                title: 'Đăng ký thành công',
                                html: 'Thông báo sẽ đóng trong <b></b> milliseconds.',
                                timer: 1000,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading()
                                    const b = Swal.getHtmlContainer().querySelector('b')
                                    timerInterval = setInterval(() => {
                                        b.textContent = Swal.getTimerLeft()
                                    }, 100)
                                },
                                willClose: () => {
                                    clearInterval(timerInterval)
                                }
                            }).then((result) => {
                                /* Read more about handling dismissals below */
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    console.log('I was closed by the timer')
                                }
                            })

                        }else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Thông báo',
                                text: dataJson.message
                            })
                        }

                    }
                })
            }

        })
    })
</script>

@if(isset($javascript))
    {{$javascript}}
@endif
</body>
</html>
