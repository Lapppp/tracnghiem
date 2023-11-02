<x-layout.backend>
    <x-slot name="css">
        <style type="text/css">
            .select2-container--bootstrap5 .select2-dropdown .select2-results__option.select2-results__option--group .select2-results__option {
                padding: 0.75rem 3.25rem !important;
                margin: 0 0;
            }
        </style>
    </x-slot>
    <div class="card mb-5 w-lg-1000px">
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title">
                <h2 class="fw-bolder">Nhập các thông tin bên dưới</h2>
            </div>
            <!--begin::Card title-->
        </div>
        <div class="card-body pt-9 pb-0">
            <form id="kt_modal_new_target_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data" action="{{ $isEdit == 0 ? Route('backend.product.store') : Route('backend.product.update',['id'=>$posts->id]) }}" method="post">
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
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Slug</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Slug" aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="Slug" name="slug" id="slug" value="{{ old('slug',!empty($posts) ? $posts->slug : '') }}">
                        @if ($errors->has('slug'))
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div data-field="slug" data-validator="notEmpty">{{ $errors->first('slug') }}</div>
                            </div>
                        @endif

                    </div>
                    <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row g-9 mb-8">
                    <!--begin::Col-->
                    <div class="col-md-6 fv-row fv-plugins-icon-container">
                        <label class=" fs-6 fw-bold mb-2">Danh mục</label>
                        <select class="form-select form-select-solid select2-hidden-accessible" id data-control="select2" data-hide-search="false" data-placeholder="Chọn danh mục" name="category_id" data-select2-id="select2-data-10-gou1" tabindex="-1" aria-hidden="true">
{{--                            <option value="" data-select2-id="select2-data-12-dbw9">Chọn danh mục...</option>--}}
                            @foreach ($category as $key => $value)
                                @if(count($value->childrenCategories()->get()) > 0)
                                     <optgroup label="{{ $value->name ?? '' }}">
                                        @foreach($value->childrenCategories as $k =>$v)
                                            <option value="{{ $v->id }}" {{ old('category_id',!empty($posts) ? $posts->category_id : '') == $v->id ? "selected" : "" }}>{{ $v->name  }}</option>
                                        @endforeach
                                    </optgroup>
                                @else
                                    <option value="{{ $value->id }}" {{ old('category_id',!empty($posts) ? $posts->category_id : '') == $value->id ? "selected" : "" }}>{{ $value->name  }}</option>
                                @endif
                            @endforeach
                        </select>

                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-6 fv-row">
                        <label class=" fs-6 fw-bold mb-2">Tùy chọn</label>
                        <!--begin::Input-->
                        <div class="position-relative d-flex align-items-center">
                            <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2" data-hide-search="true" data-placeholder="Chọn vai trò" name="options" data-select2-id="select2-data-10-gou2" tabindex="-1" aria-hidden="true">
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
                                filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
                                filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images&mymy=1') }}',
                                filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
                                filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&mymy=1') }}',
                                filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&mymy=1') }}',
                                filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash&mymy=1') }}'
                            } );
                            CKEDITOR.config.height = 500;
                        </script>
                    </div>


                    <div class="d-flex flex-column mb-8">
                        <label class="fs-6 fw-bold mb-2">Thông số kỹ thuật</label>
                        <textarea id="specifications" name="specifications" id="text" cols="30" rows="10">{{ old('specifications',!empty($posts) ? $posts->specifications : '') }}</textarea>
                        <script>
                            CKEDITOR.replace( 'specifications', {

                                filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
                                filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images&mymy=1') }}',
                                filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
                                filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&mymy=1') }}',
                                filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&mymy=1') }}',
                                filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash&mymy=1') }}'
                            } );
                            CKEDITOR.config.height = 500;
                        </script>
                    </div>

                    <div class="d-flex flex-column mb-8">
                        <label class="fs-6 fw-bold mb-2">Chính sách dịch vụ</label>
                        <textarea id="service_policy" name="service_policy" id="text" cols="30" rows="10">{{ old('service_policy',!empty($posts) ? $posts->service_policy : '') }}</textarea>
                        <script>
                            CKEDITOR.replace( 'service_policy', {

                                filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
                                filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
                                filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
                                filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
                                filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
                                filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
                            } );
                            CKEDITOR.config.height = 500;
                        </script>
                    </div>


                    <div class="d-flex flex-column mb-8">
                        <label class="fs-6 fw-bold mb-2">Tại sao chọn Kenji</label>
                        <textarea id="choose_kenji" name="choose_kenji" id="text" cols="30" rows="10">{{ old('choose_kenji',!empty($posts) ? $posts->choose_kenji : '') }}</textarea>
                        <script>
                            CKEDITOR.replace( 'choose_kenji', {

                                filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
                                filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
                                filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
                                filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
                                filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
                                filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
                            } );
                            CKEDITOR.config.height = 500;
                        </script>
                    </div>

                    <div class="d-flex flex-column mb-8">
                        <label class="fs-6 fw-bold mb-2">Quà tặng</label>
                        <textarea id="description_gift" name="description_gift" id="text" cols="30" rows="10">{{ old('description_gift',!empty($posts) ? $posts->description_gift : '<ul class="gif">
                            <li>Quà tặng: 499.000đ</li>
                            <li>Ưu đãi thêm (5%) cho khách hàng thân thiết</li>
                        </ul>') }}</textarea>
                        <script>
                            CKEDITOR.replace( 'description_gift', {

                                filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
                                filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
                                filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
                                filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
                                filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
                                filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
                            } );
                            CKEDITOR.config.height = 500;
                        </script>
                    </div>



                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">
                        <!--begin::Col-->
                        <div class="col-md-4 fv-row fv-plugins-icon-container">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Giá</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Giá" aria-label="Specify a target name for future usage and reference"></i>
                            </label>
                            <input type="text" class="form-control form-control-solid" placeholder="Giá" name="price" id="price" value="{{ old('price',!empty($posts) ? $posts->price : '') }}">

                            @if ($errors->has('price'))
                                <div class="fv-plugins-message-container invalid-feedback">
                                    <div data-field="price" data-validator="notEmpty">{{ $errors->first('price') }}</div>
                                </div>
                            @endif
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-md-4 fv-row">
                            <label class=" fs-6 fw-bold mb-2">Giá giảm</label>
                            <!--begin::Input-->
                            <div class="position-relative d-flex align-items-center">
                                <input type="text" class="form-control form-control-solid" placeholder="Nhập giá giảm" name="discount" id="discount" value="{{ old('discount',!empty($posts) ? $posts->discount : '') }}">
                            </div>
                            <!--end::Input-->
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-md-4 fv-row">
                            <label class=" fs-6 fw-bold mb-2">Số % giảm</label>
                            <!--begin::Input-->
                            <div class="position-relative d-flex align-items-center">
                                <input type="text" class="form-control form-control-solid" placeholder="Nhập % giảm" name="percent" id="percent" value="{{ old('percent',!empty($posts) ? $posts->percent : '') }}">
                            </div>
                            <!--end::Input-->
                        </div>
                        <!--end::Col-->


                    </div>
                    <!--end::Input group-->



                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">
                        <!--begin::Col-->
                        <div class="col-md-6 fv-row fv-plugins-icon-container">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span>Số năm bảo hành</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Nhập số năm bảo hành" aria-label="Specify a target name for future usage and reference"></i>
                            </label>
                            <input type="text" class="form-control form-control-solid" placeholder="Nhập số năm bảo hành" name="warranty" id="warranty" value="{{ old('warranty',!empty($posts) ? $posts->warranty : '') }}">
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-md-6 fv-row">
                            <label class=" fs-6 fw-bold mb-2">Bảo trì</label>
                            <!--begin::Input-->
                            <div class="position-relative d-flex align-items-center">
                                <input type="text" class="form-control form-control-solid" placeholder="Bảo trì" name="maintenance" id="maintenance" value="{{ old('maintenance',!empty($posts) ? $posts->maintenance : '') }}">
                            </div>
                            <!--end::Input-->
                        </div>
                        <!--end::Col-->

                    </div>
                    <!--end::Input group-->


                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">
                        <!--begin::Col-->
                        <div class="col-md-6 fv-row fv-plugins-icon-container">
                            <label class=" fs-6 fw-bold mb-2">Thương hiệu</label>
                            <select class="form-select form-select-solid select2-hidden-accessible" id data-control="select2" data-hide-search="true" data-placeholder="Chọn thương hiệu" name="brand_id" data-select2-id="select2-data-10-gou8" tabindex="-1" aria-hidden="true">
                                @foreach ($brands as $key => $value)
                                    <option value="{{ $value->id }}" {{ old('brand_id',!empty($posts) ? $posts->brand_id : '') == $value->id ? "selected" : "" }}>{{ $value->name  }}</option>
                                @endforeach
                            </select>

                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6 fv-row">
                            <label class=" fs-6 fw-bold mb-2">Đơn vị tính</label>
                            <!--begin::Input-->
                            <div class="position-relative d-flex align-items-center">
                                <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2" data-hide-search="true" data-placeholder="Chọn vai trò" name="unit_id" data-select2-id="select2-data-10-gou7" tabindex="-1" aria-hidden="true">
                                    @foreach ($units as $key => $value)
                                        <option value="{{ $value->id }}" {{ old('unit_id',!empty($posts) ? $posts->unit_id : '') == $value->id ? "selected" : "" }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <!--end::Input-->
                        </div>
                        <!--end::Col-->
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


                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span>Màu sắc</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Màu sắc" aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2" data-hide-search="true" data-placeholder="Chọn Màu sắc" name="color" data-select2-id="select2-data-11-gou0" tabindex="-1" aria-hidden="true">
                            <option value="0">Chọn màu</option>
                            @foreach ($colors as $key => $value)
                                <option value="{{ $key }}" {{ old('color',!empty($posts) ? $posts->color : '') == $key ? "selected" : "" }}>{{ $value }}</option>
                            @endforeach
                        </select>

                    </div>
                    <!--end::Input group-->



                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span>Thời gian giao hàng</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Thời gian giao hàng" aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2" data-hide-search="true" data-placeholder="Chọn Thời gian giao hàng" name="delivery_time" data-select2-id="select2-data-12-gou0" tabindex="-1" aria-hidden="true">
                            <option value="0">Chọn Thời gian giao hàng</option>
                            @foreach ($delivery_time as $key => $value)
                                <option value="{{ $key }}" {{ old('delivery_time',!empty($posts) ? $posts->delivery_time : '') == $key ? "selected" : "" }}>{{ $value }}</option>
                            @endforeach
                        </select>

                    </div>
                    <!--end::Input group-->


                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span>SEO Tiêu đề</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Tên của một tiêu đề" aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="SEO Tiêu đề" name="meta_title" id="meta_title" value="{{ old('meta_title',!empty($posts) ? $posts->meta_title : '') }}">
                    </div>
                    <!--end::Input group-->

                    <div class="d-flex flex-column mb-8">
                        <label class="fs-6 fw-bold mb-2">SEO Keyword</label>
                        <textarea class="form-control form-control-solid" rows="3" name="meta_keywords" placeholder="Nhập nội dung ngắn">{{ old('meta_keywords',!empty($posts) ? $posts->meta_keywords : '') }}</textarea>
                    </div>


                    <div class="d-flex flex-column mb-8">
                        <label class="fs-6 fw-bold mb-2">SEO Description</label>
                        <textarea class="form-control form-control-solid" rows="3" name="meta_description" placeholder="SEO Description">{{ old('meta_description',!empty($posts) ? $posts->meta_description : '') }}</textarea>
                    </div>


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
                                            <input class="form-check-input updateImage" type="radio"   id="flexCheckDefault{{ $value->id }}" data-post_id="{{ $value->imageable_id }}" data-id="{{ $value->id }}" @if($value->is_default == 1) checked="checked" @endif  name="image_default" value="{{ $value->id }}">
                                            <label class="form-check-label updateImage" data-id="{{ $value->id }}" for="flexCheckDefault{{ $value->id }}" data-post_id="{{ $value->imageable_id }}">Ảnh đại diện</label>
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
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="files">
                            <span>Chọn tập tin</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="chọn file hình ảnh từ máy tính" aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input class="form-control" type="file" id="files" name="files[]" multiple="multiple" accept="image/*">

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

                $('#price,#discount,#percent').keyup(function(e) {
                    if (/\D/g.test(this.value)) {
                        this.value = this.value.replace(/\D/g, '');
                    }
                });


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

                $(document).on('keypress', 'input#name', function(){
                    let slug = slugVietNamese($(this).val(),'-');
                    $('#slug').val(slug);
                });

                $(document).on('change', 'input#name', function(){
                    let slug = slugVietNamese($(this).val(),'-');
                    $('#slug').val(slug);
                });

                $(document).on('click', '.updateImage', function(event){

                    let id = $(this).data("id");
                    let post_id = $(this).data("post_id");
                    let token = $("meta[name='csrf-token']").attr("content");

                    event.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: baseUrl + '/product/updateImageDefault',
                        dataType:'json',
                        data:{"_token": token,image_id:id,post_id:post_id},
                        success: function (json) {
                            $('input:radio[name="image_default"]').prop('checked', false);
                            $('#flexCheckDefault'+id).prop('checked', true);

                        }
                    });
                })

                function slugVietNamese(str,separator) {
                    str = str
                        .toLowerCase()
                        .replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a")
                        .replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e")
                        .replace(/ì|í|ị|ỉ|ĩ/g, "i")
                        .replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o")
                        .replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u")
                        .replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y")
                        .replace(/đ/g, "d")
                        .replace(/\s+/g, "-")
                        .replace(/[^A-Za-z0-9_-]/g, "")
                        .replace(/-+/g, "-");
                    if (separator) {
                        return str.replace(/-/g, separator);
                    }
                    return str;
                }


            });
        </script>

        @include('components.backend.shared.deleteImage')
    </x-slot>
</x-layout.backend>
