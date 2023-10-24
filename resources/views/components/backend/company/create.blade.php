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
            <form id="kt_modal_new_target_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data" action="{{ $isEdit == 0 ? Route('backend.company.store') : Route('backend.company.update',['id'=>$posts->id]) }}" method="post">
                @if($isEdit == 1)
                    @method('PUT')
                @endif
                @csrf

                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Tên công ty</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Tên công ty" aria-label="Specify a target name for future usage and reference"></i>
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
                            <span class="required">Giấy CNĐKDN</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Tên của Liên kết Youtube" aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="Liên kết Youtube" name="certificate" id="certificate" value="{{ old('certificate',!empty($posts) ? $posts->certificate : '') }}">
                        @if ($errors->has('certificate'))
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
                            <span class="required">Cấp bởi</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Cấp bởi" aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="Cấp bởi" name="granted_by" id="granted_by" value="{{ old('granted_by',!empty($posts) ? $posts->granted_by : '') }}">
                        @if ($errors->has('granted_by'))
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div data-field="granted_by" data-validator="notEmpty">{{ $errors->first('granted_by') }}</div>
                            </div>
                        @endif
                    </div>
                    <!--end::Input group-->


                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Địa chỉ đăng ký kinh doanh</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Địa chỉ đăng ký kinh doanh" aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="Địa chỉ đăng ký kinh doanh" name="address" id="address" value="{{ old('address',!empty($posts) ? $posts->address : '') }}">
                        @if ($errors->has('address'))
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div data-field="address" data-validator="notEmpty">{{ $errors->first('address') }}</div>
                            </div>
                        @endif
                    </div>
                    <!--end::Input group-->



                    <div class="d-flex flex-column mb-8">
                        <label class="fs-6 fw-bold mb-2">Google Header</label>
                        <textarea class="form-control form-control-solid" rows="3" name="meta_header" placeholder="Nhập nội dung ngắn">{{ old('meta_header',!empty($posts) ? $posts->meta_header : '') }}</textarea>
                    </div>


                    <div class="d-flex flex-column mb-8">
                        <label class="fs-6 fw-bold mb-2">Google Body</label>
                        <textarea class="form-control form-control-solid" rows="3" name="meta_body" placeholder="Nhập nội dung ngắn">{{ old('meta_body',!empty($posts) ? $posts->meta_body : '') }}</textarea>
                    </div>


                    <div class="d-flex flex-column mb-8">
                        <label class="fs-6 fw-bold mb-2">SEO Meta Title Trang chủ</label>
                        <textarea class="form-control form-control-solid" rows="3" name="meta_title" placeholder="Nhập nội dung ngắn">{{ old('meta_title',!empty($posts) ? $posts->meta_title : '') }}</textarea>
                    </div>


                    <div class="d-flex flex-column mb-8">
                        <label class="fs-6 fw-bold mb-2">SEO Description Trang chủ</label>
                        <textarea class="form-control form-control-solid" rows="3" name="meta_description" placeholder="Nhập nội dung ngắn">{{ old('meta_description',!empty($posts) ? $posts->meta_description : '') }}</textarea>
                    </div>


                    <div class="d-flex flex-column mb-8">
                        <label class="fs-6 fw-bold mb-2">SEO Keywords Trang chủ</label>
                        <textarea class="form-control form-control-solid" rows="3" name="meta_keywords" placeholder="Nhập nội dung ngắn">{{ old('meta_keywords',!empty($posts) ? $posts->meta_keywords : '') }}</textarea>
                    </div>

                    <div class="d-flex flex-column mb-8">
                        <label class="fs-6 fw-bold mb-2">Về công ty</label>
                        <textarea class="form-control form-control-solid" rows="3" name="textCate" placeholder="Nhập nội dung ngắn">{{ old('textCate',!empty($posts) ? $posts->textCate : '') }}</textarea>
                    </div>


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
          <script src={{ url('ckeditor/ckeditor.js') }}></script>
            <script>
                CKEDITOR.replace( 'textCate', {

                    filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
                    filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images&mymy=1') }}',
                    filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
                    filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&mymy=1') }}',
                    filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&mymy=1') }}',
                    filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash&mymy=1') }}'
                } );
                CKEDITOR.config.height = 500;
            </script>
    </x-slot>
</x-layout.backend>
