<x-layout.backend>

    <x-slot name="toolbar">
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Tables</h1>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-200 border-start mx-4"></span>
                    <!--end::Separator-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-200 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Widgets</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-200 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-dark">Tables</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->

                <!--end::Actions-->
            </div>
            <!--end::Container-->
        </div>
    </x-slot>

    <div class="card">
        <!--begin::Body-->
        <div class="card-body p-lg-17">
            <!--begin::Hero-->
            <div class="position-relative mb-17">
                <!--begin::Overlay-->
                <div class="overlay overlay-show">
                    <!--begin::Image-->
                    <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-250px" style="background-image:url('{{ asset('/backend/assets/media/stock/2000x800/1.jpg') }}')"></div>
                    <!--end::Image-->
                    <!--begin::layer-->
                    <div class="overlay-layer rounded bg-black" style="opacity: 0.4"></div>
                    <!--end::layer-->
                </div>
                <!--end::Overlay-->
                <!--begin::Heading-->
                <div class="position-absolute text-white mb-8 ms-10 bottom-0">
                    <!--begin::Title-->
                    <h3 class="fs-2qx fw-bolder mb-3 m">Careers at KeenThemes</h3>
                    <!--end::Title-->
                    <!--begin::Text-->
                    <div class="fs-5 fw-bold">You sit down. You stare at your screen. The cursor blinks.</div>
                    <!--end::Text-->
                </div>
                <!--end::Heading-->
            </div>
            <!--end::-->
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-lg-row mb-17">
                <!--begin::Content-->
                <div class="flex-lg-row-fluid me-0 me-lg-20">
                    <!--begin::Form-->
                    <form action="" class="form mb-15 fv-plugins-bootstrap5 fv-plugins-framework" method="post" id="kt_careers_form">
                        <!--begin::Input group-->
                        <div class="row mb-5">
                            <!--begin::Col-->
                            <div class="col-md-6 fv-row fv-plugins-icon-container">
                                <!--begin::Label-->
                                <label class="required fs-5 fw-bold mb-2">First Name</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid" placeholder="" name="first_name">
                                <!--end::Input-->
                                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-6 fv-row fv-plugins-icon-container">
                                <!--end::Label-->
                                <label class="required fs-5 fw-bold mb-2">Last Name</label>
                                <!--end::Label-->
                                <!--end::Input-->
                                <input type="text" class="form-control form-control-solid" placeholder="" name="last_name">
                                <!--end::Input-->
                                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-5">
                            <!--begin::Col-->
                            <div class="col-md-6 fv-row fv-plugins-icon-container">
                                <!--begin::Label-->
                                <label class="required fs-5 fw-bold mb-2">Email</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-solid" placeholder="" name="email">
                                <!--end::Input-->
                                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-6 fv-row">
                                <!--end::Label-->
                                <label class="fs-5 fw-bold mb-2">Mobile No</label>
                                <!--end::Label-->
                                <!--end::Input-->
                                <input type="text" class="form-control form-control-solid" placeholder="" name="mobileno">
                                <!--end::Input-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-5">
                            <!--begin::Col-->
                            <div class="col-md-6 fv-row fv-plugins-icon-container">
                                <!--begin::Label-->
                                <label class="required fs-5 fw-bold mb-2">Age</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid" placeholder="" name="age">
                                <!--end::Input-->
                                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-6 fv-row fv-plugins-icon-container">
                                <!--end::Label-->
                                <label class="required fs-5 fw-bold mb-2">City</label>
                                <!--end::Label-->
                                <!--end::Input-->
                                <input type="text" class="form-control form-control-solid" placeholder="" name="city">
                                <!--end::Input-->
                                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-5 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                <span class="required">Position</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Your payment statements may very based on selected position" aria-label="Your payment statements may very based on selected position"></i>
                            </label>
                            <!--end::Label-->
                            <!--begin::Select-->
                            <select name="position" data-control="select2" data-placeholder="Select a position..." class="form-select form-select-solid select2-hidden-accessible" data-select2-id="select2-data-10-zruq" tabindex="-1" aria-hidden="true">
                                <option value="Web Developer" data-select2-id="select2-data-12-cbwp">Web Developer</option>
                                <option value="Web Designer">Web Designer</option>
                                <option value="Art Director">Art Director</option>
                                <option value="Finance Manager">Finance Manager</option>
                                <option value="Project Manager">Project Manager</option>
                                <option value="System Administrator">System Administrator</option>
                            </select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-11-1eph" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-position-2i-container" aria-controls="select2-position-2i-container"><span class="select2-selection__rendered" id="select2-position-2i-container" role="textbox" aria-readonly="true" title="Web Developer">Web Developer</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                            <!--end::Select-->
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-5">
                            <!--begin::Col-->
                            <div class="col-md-6 fv-row fv-plugins-icon-container">
                                <!--begin::Label-->
                                <label class="required fs-5 fw-bold mb-2">Expected Salary</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid" placeholder="" name="salary">
                                <!--end::Input-->
                                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-6 fv-row fv-plugins-icon-container">
                                <!--end::Label-->
                                <label class="required fs-5 fw-bold mb-2">Srart Date</label>
                                <!--end::Label-->
                                <!--end::Input-->
                                <input type="text" class="form-control form-control-solid flatpickr-input" placeholder="" name="start_date" readonly="readonly">
                                <!--end::Input-->
                                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-5 fv-row">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bold mb-2">Website (If Any)</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control form-control-solid" placeholder="" name="website">
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-5">
                            <label class="fs-6 fw-bold mb-2">Experience (Optional)</label>
                            <textarea class="form-control form-control-solid" rows="2" name="experience" placeholder=""></textarea>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8">
                            <label class="fs-6 fw-bold mb-2">Application</label>
                            <textarea class="form-control form-control-solid" rows="4" name="application" placeholder=""></textarea>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Separator-->
                        <div class="separator mb-8"></div>
                        <!--end::Separator-->
                        <!--begin::Submit-->
                        <button type="submit" class="btn btn-primary" id="kt_careers_submit_button">
                            <!--begin::Indicator-->
                            <span class="indicator-label">Apply Now</span>
                            <span class="indicator-progress">Please wait...
														<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            <!--end::Indicator-->
                        </button>
                        <!--end::Submit-->
                        <div></div></form>
                    <!--end::Form-->
                </div>
                <!--end::Content-->
                <!--begin::Sidebar-->
                <div class="flex-lg-row-auto w-100 w-lg-275px w-xxl-350px">
                    <!--begin::Careers about-->
                    <div class="card bg-light">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Top-->
                            <div class="mb-7">
                                <!--begin::Title-->
                                <h2 class="fs-1 text-gray-800 w-bolder mb-6">About Us</h2>
                                <!--end::Title-->
                                <!--begin::Text-->
                                <p class="fw-bold fs-6 text-gray-600">First, a disclaimer – the entire process of writing a blog post often takes more than a couple of hours, even if you can type eighty words as per minute and your writing skills are sharp.</p>
                                <!--end::Text-->
                            </div>
                            <!--end::Top-->
                            <!--begin::Item-->
                            <div class="mb-8">
                                <!--begin::Title-->
                                <h4 class="text-gray-700 w-bolder mb-0">Requirements</h4>
                                <!--end::Title-->
                                <!--begin::Section-->
                                <div class="my-2">
                                    <!--begin::Row-->
                                    <div class="d-flex align-items-center mb-3">
                                        <!--begin::Bullet-->
                                        <span class="bullet me-3"></span>
                                        <!--end::Bullet-->
                                        <!--begin::Label-->
                                        <div class="text-gray-600 fw-bold fs-6">Experience with JavaScript</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <div class="d-flex align-items-center mb-3">
                                        <!--begin::Bullet-->
                                        <span class="bullet me-3"></span>
                                        <!--end::Bullet-->
                                        <!--begin::Label-->
                                        <div class="text-gray-600 fw-bold fs-6">Good time-management skills</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <div class="d-flex align-items-center mb-3">
                                        <!--begin::Bullet-->
                                        <span class="bullet me-3"></span>
                                        <!--end::Bullet-->
                                        <!--begin::Label-->
                                        <div class="text-gray-600 fw-bold fs-6">Experience with React</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Bullet-->
                                        <span class="bullet me-3"></span>
                                        <!--end::Bullet-->
                                        <!--begin::Label-->
                                        <div class="text-gray-600 fw-bold fs-6">Experience with HTML / CSS</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="mb-8">
                                <!--begin::Title-->
                                <h4 class="text-gray-700 w-bolder mb-0">Our Achievements</h4>
                                <!--end::Title-->
                                <!--begin::Section-->
                                <div class="my-2">
                                    <!--begin::Row-->
                                    <div class="d-flex align-items-center mb-3">
                                        <!--begin::Bullet-->
                                        <span class="bullet me-3"></span>
                                        <!--end::Bullet-->
                                        <!--begin::Label-->
                                        <div class="text-gray-600 fw-bold fs-6">Experience with JavaScript</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <div class="d-flex align-items-center mb-3">
                                        <!--begin::Bullet-->
                                        <span class="bullet me-3"></span>
                                        <!--end::Bullet-->
                                        <!--begin::Label-->
                                        <div class="text-gray-600 fw-bold fs-6">Good time-management skills</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <div class="d-flex align-items-center mb-3">
                                        <!--begin::Bullet-->
                                        <span class="bullet me-3"></span>
                                        <!--end::Bullet-->
                                        <!--begin::Label-->
                                        <div class="text-gray-600 fw-bold fs-6">Experience with React</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Bullet-->
                                        <span class="bullet me-3"></span>
                                        <!--end::Bullet-->
                                        <!--begin::Label-->
                                        <div class="text-gray-600 fw-bold fs-6">Experience with HTML / CSS</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Link-->
                            <a href="../../demo1/dist/pages/blog/post.html" class="link-primary fs-6 fw-bold">Explore More</a>
                            <!--end::Link-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Careers about-->
                </div>
                <!--end::Sidebar-->
            </div>
        </div>
        <!--end::Body-->
    </div>

</x-layout.backend>

