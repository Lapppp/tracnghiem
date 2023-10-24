<x-layout.backend>
    <div class="card mb-5 w-lg-1000px">
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title">
                <h2 class="fw-bolder">Nhập các thông tin bên dưới</h2>
            </div>
            <!--begin::Card title-->
        </div>
        <div class="card-body pt-9 pb-0">
            <form id="kt_modal_new_target_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data" action="{{ $isEdit == 0 ? Route('backend.department.store') : Route('backend.department.update',['id'=>$posts->id]) }}" method="post">
                @if($isEdit == 1)
                    @method('PUT')
                @endif
                @csrf

                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Tên phòng ban</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Tên của một phòng ban trong công ty" aria-label="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid" placeholder="Nhập tên phòng ban" name="name" id="name" value="{{ old('name',!empty($posts) ? $posts->name : '') }}">
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
                            <span>Mã phòng ban</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Mã của một phòng ban" aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="Nhập một mã phòng ban" name="code" id="code" value="{{ old('code',!empty($posts) ? $posts->code : '') }}">
                        @if ($errors->has('code'))
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div data-field="name" data-validator="notEmpty">{{ $errors->first('code') }}</div>
                            </div>
                        @endif
                    </div>
                    <!--end::Input group-->



                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span>Trạng thái</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Trạng thái sẽ thay đổi" aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2" data-hide-search="true" data-placeholder="Chọn vai trò" name="status" data-select2-id="select2-data-10-gou0" tabindex="-1" aria-hidden="true">
                            @foreach ($status as $key => $value)
                                <option value="{{ $key }}" {{ old('status',!empty($posts) ? $posts->status : '') == $key ? "selected" : "" }}>{{ $value }}</option>
                            @endforeach
                        </select>

                    </div>
                    <!--end::Input group-->


                        @if(count($users))
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span>Chọn nhân viên</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Thêm nhân viên vào trong phòng ban" aria-label="Specify a target name for future usage and reference"></i>
                                </label>
                                <!--end::Label-->
                                <select class="form-select form-select-solid select2-hidden-accessible"
                                        data-control="select2"
                                        data-hide-search="true"
                                        data-placeholder="Chọn nhân viên"
                                        name="users[]"
                                        id="users"
                                        data-select2-id="select2-data-10-gou1"
                                        multiple="multiple"
                                        tabindex="-1" aria-hidden="true">
                                    @foreach ($users as $key => $user)
                                        <option value="{{ $user->id }}"
                                                @if (in_array(old('users',!empty($posts) && !empty($users_selected) ? $user->id : ''),$users_selected)) selected="selected" @endif
                                        >{{ $user->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <!--end::Input group-->
                        @endif



                @if(count($users_manager))
                    <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span>Chọn trưởng phòng</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Đây là trưởng phòng của phòng ban" aria-label="Specify a target name for future usage and reference"></i>
                            </label>
                            <!--end::Label-->
                            <select class="form-select form-select-solid select2-hidden-accessible"
                                    data-control="select2"
                                    data-hide-search="true"
                                    data-placeholder="Chọn nhân viên"
                                    name="manager"
                                    id="manager"
                                    data-select2-id="select2-data-10-gou2"
                                    tabindex="-1" aria-hidden="true">
                                @foreach ($users_manager as $key => $manager)
                                    <option value="{{ $manager->id }}"
                                            @if (old('manager',!empty($posts) && !empty($users_manager_selected) && $users_manager_selected == $manager->id  ? $users_manager_selected : '')) selected="selected" @endif
                                    >{{ $manager->name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <!--end::Input group-->
                    @endif




                    <div class="text-end">
                    <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Nhập lại</button>
                    <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                        @if($isEdit == 1)
                            <span class="indicator-label">Cập nhật</span>
                        @else
                            <span class="indicator-label">Tạo mới</span>
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
