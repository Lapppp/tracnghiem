<x-layout.backend>
    <div class="card mb-5 w-lg-700px">
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title">
                <h2 class="fw-bolder">Thông tin tài khoản</h2>
            </div>
            <!--begin::Card title-->
        </div>
        <div class="card-body pt-9 pb-0">
            <form id="kt_modal_new_target_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{ $isEdit == 0 ? Route('backend.admin.store') : Route('backend.admin.update',['id'=>$admin->id]) }}" method="post">
                @if($isEdit == 1)
                    @method('PUT')
                @endif
                @csrf
                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Họ tên</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Họ tên của bạn" aria-label="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid" placeholder="Nhập họ tên" name="name" id="name" value="{{ old('name',!empty($admin) ? $admin->name : '') }}">
                    @if ($errors->has('name'))
                        <div class="fv-plugins-message-container invalid-feedback">
                            <div data-field="name" data-validator="notEmpty">{{ $errors->first('name') }}</div>
                        </div>
                    @endif

                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row g-9 mb-8">
                    <!--begin::Col-->
                    <div class="col-md-6 fv-row fv-plugins-icon-container">
                        <label class="required fs-6 fw-bold mb-2">Giới tính</label>
                        <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2" data-hide-search="true" data-placeholder="Chọn giới tính" name="gender" data-select2-id="select2-data-10-gou9" tabindex="-1" aria-hidden="true">
                            <option value="" data-select2-id="select2-data-12-dbw9">Chọn giới tính...</option>
                            @foreach ($genders as $key => $gender)
                            <option value="{{ $key }}" {{ old('gender',!empty($admin) ? $admin->gender : '') == $key ? "selected" : "" }}>{{ $gender }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('gender'))
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div data-field="gender" data-validator="notEmpty">{{ $errors->first('gender') }}</div>
                            </div>
                        @endif
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-6 fv-row">
                        <label class="required fs-6 fw-bold mb-2">Sinh nhật</label>
                        <!--begin::Input-->
                        <div class="position-relative d-flex align-items-center">
                            <!--begin::Icon-->
                            <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                            <span class="svg-icon svg-icon-2 position-absolute mx-4">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="black"></path>
																		<path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="black"></path>
																		<path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="black"></path>
																	</svg>
																</span>
                            <!--end::Svg Icon-->
                            <!--end::Icon-->
                            <!--begin::Datepicker-->
                            <input class="form-control form-control-solid ps-12 flatpickr-input" value="{{ old('birthday',!empty($admin) ? date('d-m-Y',strtotime($admin->birthday)) : '') }}" placeholder="Chọn ngày sinh" name="birthday" type="text" id="birthday" readonly="readonly">
                            <!--end::Datepicker-->



                        </div>

                        @if ($errors->has('birthday'))
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div data-field="birthday" data-validator="notEmpty">{{ $errors->first('birthday') }}</div>
                            </div>
                    @endif
                        <!--end::Input-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Email</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Nhập email của bạn để sau này đăng nhập vào hệ thống" aria-label="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid" placeholder="Nhập email" name="email" id="email" value="{{ old('email',!empty($admin) ? $admin->email : '') }}">
                    @if ($errors->has('email'))
                        <div class="fv-plugins-message-container invalid-feedback">
                            <div data-field="email" data-validator="notEmpty">{{ $errors->first('email') }}</div>
                        </div>
                    @endif
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Mật khẩu</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Mật khẩu này dùng để đăng nhập" aria-label="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input type="password" class="form-control form-control-solid" placeholder="Nhập mật khẩu" name="password" id="password">
                    @if ($errors->has('password'))
                        <div class="fv-plugins-message-container invalid-feedback">
                            <div data-field="password" data-validator="notEmpty">{{ $errors->first('password') }}</div>
                        </div>
                    @endif
                </div>
                <!--end::Input group-->


                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Vai trò</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Mật khẩu này dùng để đăng nhập" aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2" data-hide-search="true" data-placeholder="Chọn vai trò" name="role[]" data-select2-id="select2-data-10-gou0" tabindex="-1" aria-hidden="true" multiple="multiple">
                            <option value="" data-select2-id="select2-data-12-dbw9">Chọn vai trò...</option>
                            @foreach ($roles as $key => $role)
                                <option value="{{ $role->name }}" @if (in_array(old('role',!empty($admin) ? $role->name : ''),$role_select)) selected="selected" @endif>{{ $role->customize_name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="d-flex flex-stack mb-8 pt-0 pb-15">
                        <!--begin::Label-->
                        <div class="me-5">
                            <label class="fs-6 fw-bold">Trạng thái</label>
                            <div class="fs-7 fw-bold text-muted">Bạn chọn cho tài khoản hoạt động hoặc ngừng hoạt động</div>
                        </div>
                        <!--end::Label-->
                        <!--begin::Switch-->
                        <label class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" id="status" name="status"
                                   value="{{ !empty($admin) ? $admin->status : 0 }}"
                                   @if (!empty($admin) && !empty($admin->status)) checked="checked" @endif
                            />
                            <span class="form-check-label fw-bold text-muted">Chọn/Không chọn</span>
                        </label>
                        <!--end::Switch-->
                    </div>
                    <!--end::Input group-->



                <div class="text-end">
                    <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Nhập lại</button>
                    <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                        @if($isEdit == 1)
                            <span class="indicator-label">Cập nhật tài khoản</span>
                        @else
                            <span class="indicator-label">Tạo tài khoản</span>
                        @endif
                        <span class="indicator-progress">Please wait...
															<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
                <!--end::Actions-->
                <div class="mb-10"></div>
            </form>
        </div>

    </div>

    <x-slot name="javascript">
        <script type="text/javascript">
            $(document).ready(function() {

                $('[name="birthday"]').flatpickr({
                    dateFormat: "d-m-Y",
                });
                $(document).on('click', '#status', function(){

                    if ($(this).is(":checked")) {
                        $(this).val(1);
                    } else {
                        $(this).val(0);
                    }
                });


            });
        </script>
    </x-slot>
</x-layout.backend>
