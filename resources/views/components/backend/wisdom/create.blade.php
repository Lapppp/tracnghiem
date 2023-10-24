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
            <form id="kt_modal_new_target_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data" action="{{ $isEdit == 0 ? Route('backend.wisdom.store') : Route('backend.wisdom.update',['id'=>$posts->id]) }}" method="post">
                @if($isEdit == 1)
                    @method('PUT')
                @endif
                @csrf
                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Tiêu đề</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Tên của một tiêu đề" aria-label="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid" placeholder="Nhập tiêu đề" name="name" id="name" value="{{ old('name',!empty($posts) ? $posts->name : '') }}">
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
                        <label class=" fs-6 fw-bold mb-2">Danh mục</label>
                        <select class="form-select form-select-solid select2-hidden-accessible" id data-control="select2" data-hide-search="true" data-placeholder="Chọn danh mục" name="category_id" data-select2-id="select2-data-10-gou8" tabindex="-1" aria-hidden="true">
                            <option value="" data-select2-id="select2-data-12-dbw9">Chọn danh mục...</option>
                            @foreach ($category as $key => $value)
                                <option value="{{ $value->id }}" {{ old('category_id',!empty($posts) ? $posts->category_id : '') == $value->id ? "selected" : "" }}>{{ $value->name  }}</option>
                            @endforeach
                        </select>

                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-6 fv-row">
                        <label class=" fs-6 fw-bold mb-2">Tùy chọn</label>
                        <!--begin::Input-->
                        <div class="position-relative d-flex align-items-center">
                            <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2" data-hide-search="true" data-placeholder="Chọn vai trò" name="options" data-select2-id="select2-data-10-gou7" tabindex="-1" aria-hidden="true">
                                @foreach ($options as $key => $value)
                                    <option value="{{ $key }}" {{ old('options',!empty($posts) ? $posts->options : '') == $key ? "selected" : "" }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>


                        <!--end::Input-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                    <div class="d-flex flex-column mb-8">
                        <label class="fs-6 fw-bold mb-2">Diễn tả nội dung ngắn</label>
                        <textarea class="form-control form-control-solid" rows="3" name="short_description" placeholder="Nhập nội dung ngắn">{{ old('short_description',!empty($posts) ? $posts->short_description : '') }}</textarea>
                    </div>

                    <div class="d-flex flex-column mb-8">
                        <label class="fs-6 fw-bold mb-2">Nội dung bài viết</label>
                        <textarea id="description" name="description" id="text" cols="30" rows="10">{{ old('description',!empty($posts) ? $posts->description : '') }}</textarea>
                        <script src={{ url('ckeditor/ckeditor.js') }}></script>
                        <script>
                            CKEDITOR.replace( 'description', {

                                filebrowserBrowseUrl     : "{{ route('ckfinder_browser') }}",
                                filebrowserImageBrowseUrl: "{{ route('ckfinder_browser') }}?type=Images&token=123",
                                filebrowserFlashBrowseUrl: "{{ route('ckfinder_browser') }}?type=Flash&token=123",
                                filebrowserUploadUrl     : "{{ route('ckfinder_connector') }}?command=QuickUpload&type=Files",
                                filebrowserImageUploadUrl: "{{ route('ckfinder_connector') }}?command=QuickUpload&type=Images",
                                filebrowserFlashUploadUrl: "{{ route('ckfinder_connector') }}?command=QuickUpload&type=Flash",
                            } );
                            CKEDITOR.config.height = 500;
                        </script>
                        @include('ckfinder::setup')
                    </div>

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



                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="files">
                            <span>Chọn tập tin</span>
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
