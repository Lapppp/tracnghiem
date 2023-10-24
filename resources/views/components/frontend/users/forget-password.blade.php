<x-layout.frontend>
    <x-slot name="css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </x-slot>
<!-- page forgot password -->
<section class="ctn page-fgp">
    <div class="cmd12">
        <div class="ibox-content">

            <h2>Quên mật khẩu</h2>
            <p>
                Nhập email của bạn và password sẽ được tạo lại!
            </p>

            <div>
                <form action="">
                    <input type="text" id="email" name="email" placeholder="Email address">
                    <button type="button" id="sendPassword"> <i class="fa fa-spinner fa-spin" id="loadingSendPassword" style="display: none"></i> Gửi mật khẩu mới</button>
                </form>
                <a class="login-bt" id="reLogin">Đăng nhập lại</a>
            </div>

        </div>
    </div>
</section>
<!-- end page forgot password -->

    <div class="space"></div>

</x-layout.frontend>
