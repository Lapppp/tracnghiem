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
            <form id="kt_modal_new_target_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data" action="{{ $isEdit == 0 ? Route('backend.video.store') : Route('backend.video.update',['id'=>$posts->id]) }}" method="post">
                @if($isEdit == 1)
                    @method('PUT')
                @endif
                @csrf

                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Tên Video</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Tên của một video" aria-label="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid" placeholder="Nhập tên video" name="name" id="name" value="{{ old('name',!empty($posts) ? $posts->name : '') }}">
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
                            <span class="required">Tên Video</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Tên của Liên kết Youtube" aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="Liên kết Youtube" name="url" id="url" value="{{ old('name',!empty($posts) ? $posts->url : '') }}">
                        @if ($errors->has('url'))
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div data-field="url" data-validator="notEmpty">{{ $errors->first('url') }}</div>
                            </div>
                        @endif
                    </div>
                    <!--end::Input group-->


                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="files">
                            <span>Chọn tập tin hình ảnh</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="chọn file hình ảnh từ máy tính" aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input class="form-control" type="file" id="files" name="files[]" multiple="multiple" accept="image/*">

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
