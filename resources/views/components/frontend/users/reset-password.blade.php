<x-layout.frontend>

    <x-slot name="css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </x-slot>

<!-- page reset password -->

<section class="ctn page-fgp">
    <div class="cmd12">
        <div class="ibox-content">
            <h2>Đặt lại mật khẩu</h2>
            <div>
                <form action="">
                    <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" id="key_id" name="key_id" value="{{ $user->reset_password }}">
                    @csrf
                    <input type="password" id="password" placeholder="Mật khẩu mới">
                    <input type="password" id="rePassword" placeholder="Nhập lại mật khẩu mới">
                    <button type="button" id="updatePassword"> <i class="fa fa-spinner fa-spin" id="loadingSendPassword" style="display: none"></i> Cập nhật</button>
                </form>
            </div>

        </div>
    </div>
</section>
<!-- end page reset password -->
    <div class="space"></div>
</x-layout.frontend>
