<x-layout.frontend>
    <!-- Start breadcrumb section -->
    <section class="breadcrumb__section breadcrumb__bg" style="@include('components.frontend.shared.banner.bg_banner')">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="breadcrumb__content text-center">
                        <h1 class="breadcrumb__content--title text-white mb-25">Thông tin tài khoản</h1>
                        <ul class="breadcrumb__content--menu d-flex justify-content-center">
                            <li class="breadcrumb__content--menu__items"><a class="text-white"
                                                                            href="{{ Route('frontend.home.index') }}">Trang chủ</a></li>
                            <li class="breadcrumb__content--menu__items"><span class="text-white">Thông tin tài khoản</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumb section -->

    <!-- Start login section  -->
    <div class="login__section section--padding">



        <div class="container">
            @if($user->expiry_date)
                @php
                    $now = time(); // or your date as well
                    $your_date = strtotime($user->expiry_date);
                    $diff = $your_date - $now;
                    $days =  round($diff / (60 * 60 * 24));
                @endphp

                @if($days < 5)
                    <div class="alert alert-danger" role="alert">
                        <p class="m-0 p-0">Thời gian hết hạn còn <button type="button" class="btn btn-success btn-sm">{{ $days }}</button> ngày</p>
                        <p class="m-0 p-0">Vui lòng liên hệ với admin để cập nhật thêm</p>
                    </div>
                @else
                    <div class="alert alert-success" role="alert">
                        <p class="m-0 p-0">Thời gian hết hạn còn <button type="button" class="btn btn-success btn-sm">{{ $days }}</button> ngày</p>
                    </div>
                @endif

            @endif
            <form action="{{ Route('frontend.users.update') }}" method="post">
                @csrf
                <div class="login__section--inner">
                    <div class="row row-cols-md-1 row-cols-1">
                        <div class="col">
                            <div class="account__login register">
                                <div class="account__login--header mb-25">
                                    <h2 class="account__login--header__title h3 mb-10">Cập nhật thông tin tài khoản</h2>
                                </div>
                                <div class="account__login--inner">
                                    <input class="account__login--input" name="nameRegister" id="nameRegister"
                                           placeholder="Nhập họ và tên đầy đủ" type="text" value="{{ $user->name ?? '' }}">
                                    <input class="account__login--input" id="emailRegister"
                                           placeholder="Nhập địa chỉ email" type="text" value="{{ $user->email ?? '' }}">
                                    <input class="account__login--input" id="passwordRegister"
                                           placeholder="Nhập mật khẩu" type="password">
                                    <input class="account__login--input" id="rePasswordRegister"
                                           placeholder="Nhập lại mật khẩu" type="password">
                                    <button class="account__login--btn primary__btn mb-10" type="button" id="RegisterCreate">Cập nhật</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End login section  -->

    <x-slot name="css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" integrity="sha256-sWZjHQiY9fvheUAOoxrszw9Wphl3zqfVaz1kZKEvot8=" crossorigin="anonymous">
    </x-slot>

    <x-slot name="javascript">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js" integrity="sha256-t0FDfwj/WoMHIBbmFfuOtZv1wtA977QCfsFR3p1K4No=" crossorigin="anonymous"></script>
        <script type="text/javascript">

            $(document).ready(function () {
                const validateEmail = (email) => {
                    return email.match(
                        /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                    );
                };

                $(document).on('click','button#RegisterCreate',function (e) {
                    let nameRegister = $('#nameRegister').val();
                    let emailRegister = $('#emailRegister').val();
                    let passwordRegister = $('#passwordRegister').val();
                    let rePasswordRegister = $('#rePasswordRegister').val();


                    if(nameRegister.trim().length <= 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Thông báo',
                            text: 'Vui lòng nhập họ tên đầy đủ',
                        })

                        $('#nameRegister').focus();
                        return false;
                    }else if(emailRegister.trim().length <= 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Thông báo',
                            text: 'Vui lòng nhập email',
                        })
                        $('#emailRegister').focus();
                        return false;
                    }else if(!validateEmail(emailRegister)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Thông báo',
                            text: 'Địa chỉ email không hợp lệ',
                        })
                        $('#emailRegister').focus();
                        return false;
                    } else {

                        let token = $("meta[name='csrf-token']").attr("content");
                        let data = {
                            name:nameRegister,
                            email:emailRegister,
                            password:passwordRegister,
                            password_confirmation:rePasswordRegister,
                            _token:token
                        };
                        $.ajax({
                            type: 'POST',
                            url: "{{ Route('frontend.users.update') }}",
                            dataType: 'json',
                            data:data,
                            success: function (jsonResponse) {
                                if(jsonResponse.status =='fail') {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Thông báo',
                                        text: jsonResponse.message
                                    })
                                }else {

                                    Swal.fire({
                                        text: "Cập nhật thành công",
                                        icon: "success",
                                        confirmButtonColor: "#3085d6",
                                        confirmButtonText: "OK"
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href ='{{ Route('frontend.home.index') }}';
                                        }
                                    });
                                }
                            }
                        })
                    }
                })
            })
        </script>
    </x-slot>
</x-layout.frontend>
