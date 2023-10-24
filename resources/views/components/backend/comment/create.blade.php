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
            <form id="kt_modal_new_target_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data" action="{{ $isEdit == 0 ? Route('backend.comments.store') : Route('backend.comments.update',['id'=>$posts->id]) }}" method="post">
                @if($isEdit == 1)
                    @method('PUT')
                @endif
                @csrf


                <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Liên kết đến sản phẩm</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Vui lòng nhập nội dung" aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->

                        <div class="input-group input-group-solid flex-nowrap">
                            <span class="input-group-text"> <i class="bi bi-pencil-square fs-4"></i></span>
                            <div class="overflow-hidden flex-grow-1">
                                <select id="product_id" name="product_id" class="form-select form-select-solid rounded-start-0 border-start" data-control="select2" data-placeholder="Chọn liên kết với sản phẩm">
                                    <option></option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" {{ old('status',!empty($posts) ? $posts->commentable_id : '') == $product->id ? "selected" : "" }}>{{ $product->name . ' - Giá: '.$product->price }}</option>
                                    @endforeach


                                </select>
                            </div>
                        </div>

                        @if ($errors->has('product_id'))
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div data-field="product_id" data-validator="notEmpty">{{ $errors->first('product_id') }}</div>
                            </div>
                        @endif
                    </div>
                    <!--end::Input group-->

                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Họ tên</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Vui lòng nhập họ tên" aria-label="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid" placeholder="Nhập họ tên" name="name" id="name" value="{{ old('name',!empty($posts) ? $posts->name : '') }}">
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
                        <span >Email</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Vui lòng nhập email" aria-label="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid" placeholder="Nhập Email" name="email" id="email" value="{{ old('email',!empty($posts) ? $posts->email : '') }}">
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
                            <span >Điện thoại</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Vui lòng nhập phone" aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="Nhập số điện thoại" name="phone" id="phone" value="{{ old('phone',!empty($posts) ? $posts->phone : '') }}">
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
                            <span >Nội dung</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Vui lòng nhập nội dung" aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <textarea class="form-control form-control-solid" rows="3" id="message" name="message" placeholder="Nhập nội dung ngắn">{{ old('message',!empty($posts) ? $posts->message : '') }}</textarea>

                        <script src={{ url('ckeditor/ckeditor.js') }}></script>
                        <script>
                            CKEDITOR.replace( 'message', {

                                filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
                                filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images&mymy=1') }}',
                                filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
                                filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&mymy=1') }}',
                                filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&mymy=1') }}',
                                filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash&mymy=1') }}'
                            } );
                            CKEDITOR.config.height = 500;
                        </script>

                        @if ($errors->has('message'))
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div data-field="message" data-validator="notEmpty">{{ $errors->first('message') }}</div>
                            </div>
                        @endif
                    </div>
                    <!--end::Input group-->



                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span>Số sao đánh giá</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Vui lòng nhập số sao" aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid w-25" placeholder="Nhập số sao" name="number_star" id="number_star" value="{{ old('number_star',!empty($posts) ? $posts->number_star : '5') }}">
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



                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle gs-0 gy-3">
                            <!--begin::Table head-->
                            <thead>
                            <tr>
                                <th class="p-0 w-50px"></th>
                                <th class="p-0 min-w-150px"></th>
                                <th class="p-0 min-w-140px"></th>
                                <th class="p-0 min-w-120px"></th>
                            </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                            @if(!empty($posts) && $posts->image)
                                @foreach($posts->image()->get() as $key => $value)
                                    <tr id="deleteImage_{{ $value->id }}">
                                        <td>
                                            <div class="symbol symbol-50px">
                                                <img src="{{ str_replace(Str::of($value->url)->basename(),Str::of($value->url)->basename(),asset('storage/products/'.$value->url)) }}" alt="">
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $value->filename ?? '' }}</a>
                                        </td>
                                        <td>

                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-danger btn-sm deleteImageAction" data-id="{{ $value->id }}"><i class="bi bi-trash fs-4 me-1"></i> Xóa</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif


                            </tbody>
                            <!--end::Table body-->
                        </table>
                    </div>


                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span>Chọn hình ảnh</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Tên của một đơn vị tính" aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input class="form-control" type="file"  id="files" name="files[]" accept="image/*" multiple="multiple">
                    </div>
                    <!--end::Input group-->


                <div class="text-end">
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

                $('#number_star').keyup(function(e) {
                    if (/\D/g.test(this.value)) {
                        this.value = this.value.replace(/\D/g, '');
                    }
                });

            });

        </script>
        @include('components.backend.shared.deleteImage')
    </x-slot>
</x-layout.backend>
