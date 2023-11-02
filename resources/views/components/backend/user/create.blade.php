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



                    <!--begin::Input group-->
                    <div class="d-flex flex-stack mb-2 pt-0 pb-15">
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


                    <div class="d-flex flex-column mb-8">
                        <label class="fs-6 fw-bold mb-2">Ghi chú khách hàng</label>
                        <textarea class="form-control form-control-solid" rows="5" name="description" placeholder="Nhập nội dung ngắn">{{ old('description',!empty($admin) ? $admin->description : '') }}</textarea>
                    </div>

                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="files">
                            <span>Chọn tập tin</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="chọn file hình ảnh từ máy tính" aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input class="form-control" type="file" id="image" name="image"  accept="image/*">

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

                function getRandomNum(length) {

                    return (Math.pow(10,length).toString().slice(length-1) +
                            Math.floor((Math.random()*Math.pow(10,length))+1).toString()).slice(-length);
                }

            });
        </script>
    </x-slot>
</x-layout.backend>
