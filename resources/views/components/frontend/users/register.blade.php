<x-layout.weblogin>
    <!-- Page content -->
    <div class="page-content bg-lightgray">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content d-flex justify-content-center mt-5">
                <form method="POST" name="UserSignUp" action="{{ Route('frontend.auth.store') }}" id="fSignup" class="signup-form" enctype="multipart/form-data" autocomplete="off" >
                @csrf
                    <!-- Signup card -->
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <!-- <a href="/">
                                    <img src="/img/logo/nhanh_black.png" alt="Phần mềm quản lý bán hàng đa kênh" title="Phần mềm quản lý bán hàng đa kênh">
                                </a> -->
                                <h1>Logo Website</h1>
                                <h4 class="m-3 font-weight-semibold">Đăng ký</h4>
                            </div>

                            @if(session()->has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session()->get('error') }}
                            </div>
                            @endif

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                                    </span>
                                    <input type="text"
                                           name="name"
                                           id="name"
                                           class="form-control"
                                           placeholder="Họ và tên *"
                                           oninvalid="this.setCustomValidity('Vui lòng nhập họ tên')"
                                           oninput="this.setCustomValidity('')"
                                           autofocus="autofocus" value="{{ old('name') }}" required>
                                </div>

                                @if ($errors->has('name'))
                                    <div class="invalid-feedback" style="display:block;">{{ $errors->first('name') }}</div>
                                @endif

                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                <span class="input-group-text"><i class="fal fa-envelope-open"></i></span>
                                    </span>
                                    <input type="email" name="email"
                                           class="form-control"
                                           oninvalid="this.setCustomValidity('Vui lòng nhập email')"
                                           oninput="this.setCustomValidity('')"
                                           placeholder="Email *" autofocus="autofocus" value="{{ old('email') }}" required>
                                </div>
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback" style="display:block;">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                            <div class="form-group position-relative">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </span>
                                    <span class="btn-show-pass">
                                <i class="fa fa-eye"></i>
                            </span>
                                    <input type="password" name="password"
                                           oninvalid="this.setCustomValidity('Vui lòng nhập mật khẩu')"
                                           oninput="this.setCustomValidity('')"
                                           class="form-control" placeholder="Mật khẩu *" value="" maxlength="32" required>
                                </div>

                                @if ($errors->has('password'))
                                    <div class="invalid-feedback" style="display:block;">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                            <div class="form-group position-relative">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                                    </span>
                                    <input type="tel" name="phone" id="phone"
                                           oninvalid="this.setCustomValidity('Vui lòng nhập số điện thoại')"
                                           oninput="this.setCustomValidity('')"
                                           class="form-control"
                                           placeholder="Số điện thoại *" value="{{ old('phone') }}" maxlength="11" required>
                                </div>
                                @if ($errors->has('phone'))
                                    <div class="invalid-feedback" style="display:block;">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>
                            <div class="form-group" id="check">
                                <div class="form-check">
                                    <label class="form-check-label ml-2">
                                        <span class="uniform-checker"><span class="fas fa-check"><input type="checkbox" class="form-check-input-styled" checked="checked" data-fouc=""></span></span>
                                        Đồng ý với các <a target="_blank" href="/huong-dan-van-chuyen" style="color: #c90000;text-decoration: underline;">điều khoản</a> của Danhkynhanh
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block" id="btnSignup">Đăng ký</button>
                            </div>
                            <p style="text-align: center;margin-top: 20px;font-size: 13px;">
                                Bạn đã có tài khoản
                                <a href="{{ Route('frontend.auth.login') }}" style="color: #dc0404;font-size: 13px;">đăng nhập ngay</a>
                            </p>

                        </div>
                    </div>
                    <!-- /signup card -->
                </form>
            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->
</x-layout.weblogin>
