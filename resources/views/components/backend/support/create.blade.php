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
            <form id="kt_modal_new_target_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data" action="{{ $isEdit == 0 ? Route('backend.support.store') : Route('backend.support.update',['id'=>$posts->id]) }}" method="post">
                @if($isEdit == 1)
                    @method('PUT')
                @endif
                @csrf

                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Điện thoại 1</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="hotline" data-bs-original-title="hotline" aria-label="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid"  name="hotline" id="hotline" value="{{ old('hotline',!empty($posts) ? $posts->hotline : '') }}">
                    @if ($errors->has('hotline'))
                        <div class="fv-plugins-message-container invalid-feedback">
                            <div data-field="hotline" data-validator="notEmpty">{{ $errors->first('hotline') }}</div>
                        </div>
                    @endif
                </div>
                <!--end::Input group-->


                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span>Điện thoại 2</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Tư vấn" data-bs-original-title="Tư vấn" aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid"  name="advise" id="advise" value="{{ old('advise',!empty($posts) ? $posts->advise : '') }}">
                        @if ($errors->has('advise'))
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div data-field="certificate" data-validator="notEmpty">{{ $errors->first('certificate') }}</div>
                            </div>
                        @endif
                    </div>
                    <!--end::Input group-->


                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Email 1</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Bảo hành" data-bs-original-title="Bảo hành" aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid"  name="insurance" id="insurance" value="{{ old('insurance',!empty($posts) ? $posts->insurance : '') }}">
                        @if ($errors->has('insurance'))
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div data-field="insurance" data-validator="notEmpty">{{ $errors->first('insurance') }}</div>
                            </div>
                        @endif
                    </div>
                    <!--end::Input group-->


                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span>Email 2</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Email" aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid"  name="email" id="email" value="{{ old('email',!empty($posts) ? $posts->email : '') }}">
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
                            <span class="required">Địa chỉ</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Email" aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="product_consultation" name="product_consultation" id="product_consultation" value="{{ old('product_consultation',!empty($posts) ? $posts->product_consultation : '') }}">
                        @if ($errors->has('product_consultation'))
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div data-field="product_consultation" data-validator="notEmpty">{{ $errors->first('product_consultation') }}</div>
                            </div>
                        @endif
                    </div>
                    <!--end::Input group-->


                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Facebook</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="technical_assistance" aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="technical_assistance" name="technical_assistance" id="technical_assistance" value="{{ old('technical_assistance',!empty($posts) ? $posts->technical_assistance : '') }}">
                        @if ($errors->has('technical_assistance'))
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div data-field="technical_assistance" data-validator="notEmpty">{{ $errors->first('technical_assistance') }}</div>
                            </div>
                        @endif
                    </div>
                    <!--end::Input group-->


                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Youtube</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="free_call_center" aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="free_call_center" name="free_call_center" id="free_call_center" value="{{ old('free_call_center',!empty($posts) ? $posts->free_call_center : '') }}">
                        @if ($errors->has('free_call_center'))
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div data-field="free_call_center" data-validator="notEmpty">{{ $errors->first('free_call_center') }}</div>
                            </div>
                        @endif
                    </div>
                    <!--end::Input group-->



                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Zalo</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="free_call_center" aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="zalo" name="zalo" id="zalo" value="{{ old('zalo',!empty($posts) ? $posts->zalo : '') }}">
                        @if ($errors->has('zalo'))
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div data-field="zalo" data-validator="notEmpty">{{ $errors->first('zalo') }}</div>
                            </div>
                        @endif
                    </div>
                    <!--end::Input group-->



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
