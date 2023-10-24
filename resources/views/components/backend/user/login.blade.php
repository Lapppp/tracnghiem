<x-layout.login>
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Aside-->
            <div class="d-flex flex-column flex-lg-row-auto w-xl-600px" style="background-color: #F2C98A">
                <!--begin::Header-->
                <div class="d-flex flex-column text-center p-10 pt-lg-20">
                    <!--begin::Logo-->
                    <a href="index.html" class="py-9">
                        <img alt="Logo" src="{{ asset('/backend/assets/media/logos/logo-3.svg') }}" class="h-70px" />
                    </a>
                    <!--end::Logo-->
                    <!--begin::Title-->
                    <h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #986923;">Welcome to Administrator</h1>
                    <!--end::Title-->
                    <!--begin::Description-->
                    <p class="fw-bold fs-2" style="color: #986923;">Discover Amazing Administrators
                        <br />with great build tools</p>
                    <!--end::Description-->
                </div>
                <!--end::Header-->
                <!--begin::Illustration-->
                <div class="d-flex flex-row-fluid bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-size-lg-auto bgi-position-y-bottom min-h-100px min-h-lg-350px" style="background-image: url({{ asset('/backend/assets/media/svg/illustrations/checkout.svg') }})"></div>
                <!--end::Illustration-->
            </div>
            <!--begin::Aside-->
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid py-10">
                <!--begin::Content-->

                <div class="d-flex flex-center flex-column flex-column-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-500px p-10 p-lg-15 mx-auto">
                        <!--begin::Form-->
                        <form class="form w-100" novalidate="novalidate"  method="post" action="{{ Route('backend.admin.login') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <!--begin::Heading-->
                            <div class="text-center mb-10">
                                <!--begin::Title-->
                                <h1 class="text-dark mb-3">Sign In to Administrator</h1>
                                <!--end::Title-->
                                <!--begin::Link-->
                                <div class="text-gray-400 fw-bold fs-4" >New Here?
                                    <a href="authentication/flows/aside/sign-up.html" class="link-primary fw-bolder">Create an Account</a></div>
                                <!--end::Link-->
                            </div>

                            @if($errors->any())
                                <div class="text-center mb-10">
                                    <div class="alert alert-danger" role="alert">
                                        {{$errors->first()}}
                                    </div>
                                </div>
                            @endif
                            <!--begin::Heading-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-10">
                                <!--begin::Label-->
                                <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-lg form-control-solid" type="text" name="email" autocomplete="off" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-10">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack mb-2">
                                    <!--begin::Label-->
                                    <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                                    <!--end::Label-->
                                    <!--begin::Link-->
                                    <a style="display: none;" href="authentication/flows/aside/password-reset.html" class="link-primary fs-6 fw-bolder">Forgot Password ?</a>
                                    <!--end::Link-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Input-->
                                <input class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Actions-->
                            <div class="text-center">
                                <!--begin::Submit button-->
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary fw-bolder me-3 my-2">
                                    <span class="indicator-label">Sign In</span>
                                    <span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <!--end::Submit button-->
                                <!--begin::Google link-->
                                <a href="#" class="btn btn-light-primary btn-lg fw-bolder my-2" style="display: none;">
                                    <img alt="Logo" src="{{ asset('/backend/assets/media/svg/social-icons/google.svg') }}" class="h-20px me-3" />Sign in with Google</a>
                                <!--end::Google link-->
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Content-->
                <!--begin::Footer-->
                <div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
                    <!--begin::Links-->
                    <div class="d-flex flex-center fw-bold fs-6">
                        <a href="#" class="text-muted text-hover-primary px-2" target="_blank">About</a>
                        <a href="#" class="text-muted text-hover-primary px-2" target="_blank">Support</a>
                        <a href="#" class="text-muted text-hover-primary px-2" target="_blank">Purchase</a>
                    </div>
                    <!--end::Links-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
</x-layout.login>
