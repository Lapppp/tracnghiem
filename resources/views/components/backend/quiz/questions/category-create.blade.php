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
            <form id="kt_modal_new_target_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                enctype="multipart/form-data"
                action="{{ $isEdit == 0 ? Route('backend.questions.category.store') : Route('backend.questions.category.update', ['id' => $posts->id]) }}"
                method="post">
                @if ($isEdit == 1)
                    @method('PUT')
                @endif
                @csrf
                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Tên danh mục</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title=""
                            data-bs-original-title="Tên của một danh mục"
                            aria-label="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid" placeholder="Nhập tên danh mục"
                        name="name" id="name" value="{{ old('name', !empty($posts) ? $posts->name : '') }}">
                    @if ($errors->has('name'))
                        <div class="fv-plugins-message-container invalid-feedback">
                            <div data-field="name" data-validator="notEmpty">{{ $errors->first('name') }}</div>
                        </div>
                    @endif

                </div>
                <!--end::Input group-->


                @if (count($category_parents) > 0)
                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container"
                        style="display: none !important">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span>Danh mục cha</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title=""
                                data-bs-original-title="Danh mục cha"
                                aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2"
                            data-hide-search="true" data-placeholder="Chọn danh mục cha" name="category_id"
                            data-select2-id="select2-data-10-gou0" tabindex="-1" aria-hidden="true">
                            <option value="0">----</option>
                            @foreach ($category_parents as $key => $value)
                                <option value="{{ $value->id }}"
                                    {{ old('category_id', !empty($posts) ? $posts->category_id : '') == $value->id ? 'selected' : '' }}>
                                    {{ $value->name ?? '' }}</option>
                            @endforeach
                        </select>

                    </div>
                    <!--end::Input group-->
                @endif

                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container" style="display: none !important">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Slug</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title=""
                            data-bs-original-title="Tên của slug"
                            aria-label="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid" placeholder="Nhập tên slug"
                        name="slug" id="slug" value="{{ old('slug', !empty($posts) ? $posts->slug : '') }}">
                    @if ($errors->has('slug'))
                        <div class="fv-plugins-message-container invalid-feedback">
                            <div data-field="slug" data-validator="notEmpty">{{ $errors->first('slug') }}</div>
                        </div>
                    @endif

                </div>
                <!--end::Input group-->


                <div class="d-flex flex-column mb-8">
                    <label class="fs-6 fw-bold mb-2">Diễn tả nội dung ngắn</label>
                    <textarea class="form-control form-control-solid" rows="3" name="description" placeholder="Nhập nội dung ngắn">{{ old('description', !empty($posts) ? $posts->description : '') }}</textarea>
                </div>



                <div class="text-end">
                    <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                        @if ($isEdit == 1)
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
    </x-slot>
</x-layout.backend>
