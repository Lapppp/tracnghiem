<x-layout.customer>
    <div class="card mb-5 w-lg-700px">
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title">
                <h2 class="fw-bolder">Thông tin tài khoản</h2>
            </div>
            <!--begin::Card title-->
        </div>
        <div class="card-body pt-9 pb-0">
            <form id="kt_modal_new_target_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data" action="{{ $isEdit == 0 ? Route('backend.users.store') : Route('backend.users.update',['id'=>$admin->id]) }}" method="post">
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
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Điện thoại</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Nhập điện thoại của bạn để sau này đăng nhập vào hệ thống" aria-label="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid" placeholder="Nhập số điện thoại" name="phone" id="phone" value="{{ old('phone',!empty($admin) ? $admin->phone : '') }}">
                    @if ($errors->has('phone'))
                    <div class="fv-plugins-message-container invalid-feedback">
                        <div data-field="phone" data-validator="notEmpty">{{ $errors->first('phone') }}</div>
                    </div>
                    @endif
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
                        <span>Vai trò</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Vài trò để phân quyền khi đăng nhập vào hệ thống" aria-label="Specify a target name for future usage and reference"></i>
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

                @if(count($regions) > 0)
                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span>Vùng,miền</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Chọn khách hàng vùng, miền" aria-label="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2" data-hide-search="true" data-placeholder="Chọn vùng,miền" name="region_id" id="region_id" data-select2-id="select2-data-10-gou2" tabindex="-1" aria-hidden="true">
                        @foreach ($regions as $key => $region)
                        <option value="{{ $region->id }}" data-code="{{ $region->code }}" @if (old('region_id',!empty($admin) && ($admin->region_id == $region->id) ? $admin->region_id : '')) selected="selected" @endif>{{ $region->name }}</option>
                        @endforeach
                    </select>

                </div>
                <!--end::Input group-->
                @endif


                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span>Mã nhân viên</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Mật khẩu này dùng để đăng nhập" aria-label="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid" placeholder="Nhập mã nhân viên" name="code" id="code" value="{{ old('code',!empty($admin) ? $admin->code : '') }}">
                    @if ($errors->has('code'))
                    <div class="fv-plugins-message-container invalid-feedback">
                        <div data-field="code" data-validator="notEmpty">{{ $errors->first('code') }}</div>
                    </div>
                    @endif
                </div>
                <!--end::Input group-->


                @if(count($departments) > 0)
                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Chọn phòng ban quản lý khách hàng này </span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Chọn phòng ban quản lý khách hàng này" aria-label="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2" data-hide-search="true" data-placeholder="Chọn phòng ban quản lý khách hàng này" name="department_id" data-select2-id="select2-data-10-gou3" tabindex="-1" aria-hidden="true">
                        <option value="" data-select2-id="select2-data-12-dbw9">Chọn phòng ban quản lý khách hàng này</option>
                        @foreach ($departments as $key => $department)
                        <option value="{{ $department->id }}" @if (old('department_id',!empty($admin) && ($admin->department_id == $department->id) ? $admin->department_id : '')) selected="selected" @endif>{{ $department->name }}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('department_id'))
                    <div class="fv-plugins-message-container invalid-feedback">
                        <div data-field="password" data-validator="notEmpty">{{ $errors->first('department_id') }}</div>
                    </div>
                    @endif

                </div>
                <!--end::Input group-->
                @endif



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
                        <input class="form-check-input" type="checkbox" id="status" name="status" value="{{ !empty($admin) ? $admin->status : 0 }}" @if (!empty($admin) && !empty($admin->status)) checked="checked" @endif
                        />
                        <span class="form-check-label fw-bold text-muted">Chọn/Không chọn</span>
                    </label>
                    <!--end::Switch-->
                </div>
                <!--end::Input group-->


                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="files">
                        <span>Chọn tập tin</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="chọn file hình ảnh từ máy tính" aria-label="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input class="form-control" type="file" id="image" name="image" accept="image/*">

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

                let code = $('#code').val();
                if (code.trim().length <= 0) {
                    let addCode = $('#region_id').find(':selected').data('code') + '' + getRandomNum(3)
                    $('#code').val(addCode);
                }

                $("#region_id").on("select2:select", function(e) {
                    var data = e.params.data;
                    let addCode = $('#region_id').find(':selected').data('code') + '' + getRandomNum(3)
                    let code = $('#code').val();

                    @if($isEdit == 1)
                    if (code.trim().length <= 0) {
                        $('#code').val(addCode);
                    }
                    @else
                    $('#code').val(addCode);
                    @endif
                })


                $('[name="birthday"]').flatpickr({
                    dateFormat: "d-m-Y",
                });
                $(document).on('click', '#status', function() {

                    if ($(this).is(":checked")) {
                        $(this).val(1);
                    } else {
                        $(this).val(0);
                    }
                });

                function getRandomNum(length) {

                    return (Math.pow(10, length).toString().slice(length - 1) +
                        Math.floor((Math.random() * Math.pow(10, length)) + 1).toString()).slice(-length);
                }

            });
        </script>
    </x-slot>
    </x-layout.backend>