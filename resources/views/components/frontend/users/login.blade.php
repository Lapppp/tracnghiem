<x-layout.frontend>
    <!-- Start breadcrumb section -->
    <section class="breadcrumb__section breadcrumb__bg" style="@include('components.frontend.shared.banner.bg_banner')">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="breadcrumb__content text-center">
                        <h1 class="breadcrumb__content--title text-white mb-25">Đăng nhập & Tạo tài khoản mới</h1>
                        <ul class="breadcrumb__content--menu d-flex justify-content-center">
                            <li class="breadcrumb__content--menu__items"><a class="text-white"
                                                                            href="{{ Route('frontend.home.index') }}">Trang chủ</a></li>
                            <li class="breadcrumb__content--menu__items"><span class="text-white">Đăng nhập & Tạo tài khoản mới</span>
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
            <form action="{{ Route('frontend.auth.login') }}" method="post">
                @csrf
                <div class="login__section--inner">
                    <div class="row row-cols-md-2 row-cols-1">
                        <div class="col">
                            <div class="account__login">
                                <div class="account__login--header mb-25">
                                    <h2 class="account__login--header__title h3 mb-10">Đăng nhập</h2>
                                    <p class="account__login--header__desc">Đăng nhập nếu bạn là thành viên cũ.</p>
                                </div>
                                @if($errors->any())
                                    <div class="alert alert-danger" role="alert">
                                        {{ $errors->first() }}
                                    </div>
                                @endif
                                <div class="account__login--inner">
                                    <input class="account__login--input" name="email" id="email"
                                           placeholder="Nhập địa chỉ email" type="text">
                                    <input class="account__login--input" name="password" id="password"
                                           placeholder="Nhập mật khẩu" type="password">
                                    <div
                                        class="account__login--remember__forgot mb-15 d-flex justify-content-between align-items-center" style="display: none !important;">
                                        <div class="account__login--remember position__relative">
                                            <input class="checkout__checkbox--input" id="check1" type="checkbox">
                                            <span class="checkout__checkbox--checkmark"></span>
                                            <label class="checkout__checkbox--label login__remember--label"
                                                   for="check1">
                                                Ghi nhớ</label>
                                        </div>
                                        <button style="display:none!important;" class="account__login--forgot"
                                                type="submit">Forgot Your Password?
                                        </button>
                                    </div>
                                    <button class="account__login--btn primary__btn" type="submit">Đăng nhập</button>
                                    <div class="account__login--divide" >
                                        <span class="account__login--divide__text">OR</span>
                                    </div>
                                    <div class="account__social d-flex justify-content-center mb-15" style="display: none !important;">
                                        <a class="account__social--link facebook" target="_blank"
                                           href="{{ Route('frontend.auth.facebookLogin') }}">Facebook</a>
                                        <a class="account__social--link google" target="_blank"
                                           href="{{ Route('frontend.auth.googleLogin') }}">Google</a>
                                        <a class="account__social--link btn twitter disabled" role="button" aria-disabled="true"  target="_blank"
                                           href="https://twitter.com">Twitter</a>
                                    </div>
                                    <p class="account__login--signup__text" style="display:none!important;">Don,t Have
                                        an Account?
                                        <button type="submit">Sign up now</button>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="account__login register">
                                <div class="account__login--header mb-25">
                                    <h2 class="account__login--header__title h3 mb-10">Tạo tài khoản mới</h2>
                                    <p class="account__login--header__desc">Đăng ký tại đây nếu bạn là thành viên
                                        mới</p>
                                </div>
                                <div class="account__login--inner">
                                    <input class="account__login--input" name="nameRegister" id="nameRegister"
                                           placeholder="Nhập họ và tên đầy đủ" type="text">
                                    <input class="account__login--input" id="emailRegister"
                                           placeholder="Nhập địa chỉ email" type="text">
                                    <input class="account__login--input" id="passwordRegister"
                                           placeholder="Nhập mật khẩu" type="password">
                                    <input class="account__login--input" id="rePasswordRegister"
                                           placeholder="Nhập lại mật khẩu" type="password">
                                    <button class="account__login--btn primary__btn mb-10" type="button" id="RegisterCreate">Tạo mới</button>
                                    <div class="account__login--remember position__relative">
                                        <input class="checkout__checkbox--input" id="checkTerm" type="checkbox">
                                        <span class="checkout__checkbox--checkmark"></span>
                                        <label class="checkout__checkbox--label login__remember--label" for="checkTerm">
                                            Tôi đã đọc và đồng ý với các điều khoản và điều kiện</label>
                                    </div>
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
                    }else if(passwordRegister.trim().length <= 0){
                        Swal.fire({
                            icon: 'error',
                            title: 'Thông báo',
                            text: 'Vui lòng nhập mật khẩu',
                        })
                        $('#passwordRegister').focus();
                        return false;
                    }else if(rePasswordRegister.trim().length <= 0){
                        Swal.fire({
                            icon: 'error',
                            title: 'Thông báo',
                            text: 'Vui lòng nhập lại mật khẩu',
                        })
                        $('#rePasswordRegister').focus();
                        return false;
                    }else if(passwordRegister != rePasswordRegister){
                        Swal.fire({
                            icon: 'error',
                            title: 'Thông báo',
                            text: 'Mật khẩu và nhập lại nhập khẩu phải cùng mật khẩu',
                        })
                        $('#rePasswordRegister').focus();
                        return false;
                    }else if(!$('#checkTerm').is(':checked')){
                        Swal.fire({
                            icon: 'error',
                            title: 'Thông báo',
                            text: 'Vui lòng check tôi đã đọc và đồng ý với các điều khoản và điều kiện',
                        })
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
                            url: "{{ Route('frontend.auth.store') }}",
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
                                    window.location.href ='{{ Route('frontend.home.index') }}';
                                }
                            }
                        })
                    }
                })
            })
        </script>
    </x-slot>
</x-layout.frontend>
