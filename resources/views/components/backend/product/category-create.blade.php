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
            <form id="kt_modal_new_target_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data" action="{{ $isEdit == 0 ? Route('backend.product.category.store') : Route('backend.product.category.update',['id'=>$posts->id]) }}" method="post">
                @if($isEdit == 1)
                    @method('PUT')
                @endif
                @csrf
                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Tên danh mục</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Tên của một danh mục" aria-label="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid" placeholder="Nhập tên danh mục" name="name" id="name" value="{{ old('name',!empty($posts) ? $posts->name : '') }}">
                    @if ($errors->has('name'))
                        <div class="fv-plugins-message-container invalid-feedback">
                            <div data-field="name" data-validator="notEmpty">{{ $errors->first('name') }}</div>
                        </div>
                    @endif

                </div>
                <!--end::Input group-->




                     @if(count($category_parents) > 0)
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span>Danh mục cha</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Danh mục cha" aria-label="Specify a target name for future usage and reference"></i>
                            </label>
                            <!--end::Label-->
                            <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2" data-hide-search="true" data-placeholder="Chọn danh mục cha" name="category_id" data-select2-id="select2-data-10-gou0" tabindex="-1" aria-hidden="true">
                                <option value="0">----</option>
                                @foreach ($category_parents as $key => $value)
                                    <option value="{{ $value->id }}" {{ old('category_id',!empty($posts) ? $posts->category_id : '') == $value->id ? "selected" : "" }}>{{ $value->name ?? '' }}</option>
                                @endforeach
                            </select>

                        </div>
                        <!--end::Input group-->
                        @endif


                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Slug</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Tên của slug" aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="Nhập tên slug" name="slug" id="slug" value="{{ old('slug',!empty($posts) ? $posts->slug : '') }}">
                        @if ($errors->has('slug'))
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div data-field="slug" data-validator="notEmpty">{{ $errors->first('slug') }}</div>
                            </div>
                        @endif

                    </div>
                    <!--end::Input group-->

                    <div class="d-flex flex-column mb-8">
                        <label class="fs-6 fw-bold mb-2">Diễn tả nội dung ngắn</label>
                        <textarea class="form-control form-control-solid" rows="3" name="description" placeholder="Nhập nội dung ngắn">{{ old('description',!empty($posts) ? $posts->description : '') }}</textarea>
                    </div>


                    <div class="d-flex flex-column mb-8">
                        <label class="fs-6 fw-bold mb-2">SEO Meta Title</label>
                        <textarea class="form-control form-control-solid" rows="3" name="meta_title" placeholder="Nhập nội dung ngắn">{{ old('meta_title',!empty($posts) ? $posts->meta_title : '') }}</textarea>
                    </div>


                    <div class="d-flex flex-column mb-8">
                        <label class="fs-6 fw-bold mb-2">SEO Description</label>
                        <textarea class="form-control form-control-solid" rows="3" name="meta_description" placeholder="Nhập nội dung ngắn">{{ old('meta_description',!empty($posts) ? $posts->meta_description : '') }}</textarea>
                    </div>


                    <div class="d-flex flex-column mb-8">
                        <label class="fs-6 fw-bold mb-2">SEO Keywords</label>
                        <textarea class="form-control form-control-solid" rows="3" name="meta_keywords" placeholder="Nhập nội dung ngắn">{{ old('meta_keywords',!empty($posts) ? $posts->meta_keywords : '') }}</textarea>
                    </div>

                    <div class="d-flex flex-column mb-8">
                        <label class="fs-6 fw-bold mb-2">Mô tả chi tiết danh mục</label>
                        <textarea class="form-control form-control-solid" rows="3" name="contentCate" placeholder="Nhập nội dung ngắn">{{ old('contentCate',!empty($posts) ? $posts->contentCate : '') }}</textarea>
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
                                                <img src="{{ str_replace(Str::of($value->url)->basename(),Str::of($value->url)->basename(),asset('storage/category/'.$value->url)) }}" alt="">
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
        @include('components.backend.shared.slug')
        <script type="text/javascript">
            $(document).ready(function()
            {

                $(document).on('click', '.updateImage', function(event){

                    let id = $(this).data("id");
                    let post_id = $(this).data("post_id");
                    let token = $("meta[name='csrf-token']").attr("content");

                    event.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: baseUrl + '/product/updateCategoryImageDefault',
                        dataType:'json',
                        data:{"_token": token,image_id:id,post_id:post_id},
                        success: function (json) {
                            $('input:radio[name="image_default"]').prop('checked', false);
                            $('#flexCheckDefault'+id).prop('checked', true);

                        }
                    });
                })
            })
        </script>
        <script src={{ url('ckeditor/ckeditor.js') }}></script>
            <script>
                CKEDITOR.replace( 'contentCate', {

                    filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
                    filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images&mymy=1') }}',
                    filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
                    filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&mymy=1') }}',
                    filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&mymy=1') }}',
                    filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash&mymy=1') }}'
                } );
                CKEDITOR.config.height = 500;
            </script>
        @include('components.backend.shared.deleteImage')
    </x-slot>
</x-layout.backend>
