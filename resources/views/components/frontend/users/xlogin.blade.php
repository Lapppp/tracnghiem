<x-layout.weblogin>
    <div class="page-content bg-lightgray">
    <!-- Main content -->
        <div class="content-wrapper">

        <!-- Content area -->
        <div class="content d-flex justify-content-center mt-5">
            <form method="POST" name="UserSignin" class="login-form" enctype="multipart/form-data" id="fSignin">
                @csrf


                <!-- Login card -->
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <h1>Logo website</h1>
                            <!-- <a href="/">
                                <img src="/img/logo/nhanh_black.png" alt="Phần mềm quản lý bán hàng đa kênh" title="Phần mềm quản lý bán hàng đa kênh">
                            </a> -->
                            <h4 class="m-3 font-weight-semibold">Đăng nhập</h4>
                        </div>
                        @if($errors->any())
                            <div class="text-center mb-10">
                                <div class="alert alert-danger" role="alert">
                                    {{$errors->first()}}
                                </div>
                            </div>
                        @endif
                        <div class="form-group">
                            <div class="input-group">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                                    </span>
                                <input type="text" name="phone" class="form-control" placeholder="Nhập email hoặc số điện thoại" autofocus="autofocus" value=""> </div>
                        </div>
                        <div class="form-group position-relative">
                            <div class="input-group">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </span>
                                <span class="btn-show-pass">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                <input type="password" name="password" class="form-control" placeholder="Mật khẩu" value=""> </div>
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <a href="/password/forgot" class="ml-auto">Quên mật khẩu?</a>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-block" id="btnSignin" value="Đăng nhập">
                        </div>
                        <!--
                        <div class="form-group text-center text-muted content-divider">
                            <span class="px-2">hoặc đăng nhập bằng</span>
                        </div>

                        <div class="form-group text-center">
                            <button type="button" class="btn btn-outline bg-pink-300 border-pink-300 text-pink-300 btn-icon rounded-round border-2" onclick="authSocial('g');return false;"><i class="fab fa-google"></i> Google</button>
                            <button type="button" class="btn btn-outline bg-indigo border-indigo text-indigo btn-icon rounded-round border-2 ml-3" onclick="authSocial('f');return false;"><i class="fab fa-facebook"></i> Facebook</button>
                        </div> -->


                        <div class="form-group text-center text-muted content-divider">
                            <span class="px-2">Bạn chưa có tài khoản?</span>
                        </div>

                        <div class="form-group">
                            <a href="{{ Route('frontend.auth.register') }}" class="btn btn-light btn-block">Đăng ký</a>
                        </div>

                        <span class="form-text text-center text-muted">Bằng cách tiếp tục, hãy xác nhận rằng bạn đã đọc <a href="/terms">chính sách</a> của chúng tôi</span>
                    </div>
                </div>
                <!-- /login card -->
            </form>
        </div>
        <!-- /content area -->

    </div>
    <!-- /main content -->
    </div>
</x-layout.weblogin>
