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
                action="{{ $isEdit == 0 ? Route('backend.questions.store') : Route('backend.questions.update', ['id' => $posts->id]) }}"
                method="post">
                @if ($isEdit == 1)
                    @method('PUT')
                @endif
                @csrf
                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Tên câu hỏi</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title=""
                            data-bs-original-title="Tên của một câu hỏi"
                            aria-label="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid" placeholder="Nhập tên câu hỏi"
                        name="name" id="name" value="{{ old('name', !empty($posts) ? $posts->name : '') }}">
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
                            <span>Mã câu hỏi (dùng tìm kiếm nhanh)</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title=""
                               data-bs-original-title="Mã câu hỏi (dùng tìm kiếm nhanh)"
                               aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="Nhập mã câu hỏi"
                               name="code" id="code" value="{{ old('code', !empty($posts) ? $posts->code : '') }}">
                        @if ($errors->has('code'))
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div data-field="code" data-validator="notEmpty">{{ $errors->first('code') }}</div>
                            </div>
                        @endif

                    </div>
                    <!--end::Input group-->


                <!--begin::Input group-->
                <div class="row g-9 mb-8">
                    <!--begin::Col-->
                    <div class="col-md-6 fv-row fv-plugins-icon-container">
                        <label class=" fs-6 fw-bold mb-2">Danh mục</label>
                        <select class="form-select form-select-solid select2-hidden-accessible" id
                            data-control="select2" data-hide-search="true" data-placeholder="Chọn danh mục"
                            name="category_id" data-select2-id="select2-data-10-gou8" tabindex="-1" aria-hidden="true">
                            @foreach ($category as $key => $value)
                                <option value="{{ $value->id }}"
                                    {{ old('category_id', !empty($posts) ? $posts->category_id : '') == $value->id ? 'selected' : '' }}>
                                    {{ $value->name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-6 fv-row">
                        <label class=" fs-6 fw-bold mb-2">Tùy chọn</label>
                        <!--begin::Input-->
                        <div class="position-relative d-flex align-items-center">
                            <select class="form-select form-select-solid select2-hidden-accessible"
                                data-control="select2" data-hide-search="true" data-placeholder="Chọn vai trò"
                                name="options" data-select2-id="select2-data-10-gou7" tabindex="-1" aria-hidden="true">
                                @foreach ($options as $key => $value)
                                    <option value="{{ $key }}"
                                        {{ old('options', !empty($posts) ? $posts->options : '') == $key ? 'selected' : '' }}>
                                        {{ $value }}</option>
                                @endforeach
                            </select>
                        </div>


                        <!--end::Input-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <div class="d-flex flex-column mb-8" style="display: none !important">
                    <label class="fs-6 fw-bold mb-2">Diễn tả nội dung ngắn</label>
                    <textarea class="form-control form-control-solid" rows="3" name="short_description"
                        placeholder="Nhập nội dung ngắn">{{ old('short_description', !empty($posts) ? $posts->short_description : '') }}</textarea>
                </div>

                <div class="d-flex flex-column mb-5" id="list-answers">
                    <?php $code = 'A';$is_correct = 0; ?>
                    @if(!empty($questions))

                        @foreach ($questions as $key => $value)
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="mb-10">
                                        <label for="exampleFormControlInput_{{ $value->id }}" data-id="{{ $value->id }}" class="form-label labelAnswerAjax">{{ $code++ }}</label>
                                        <input type="text" class="form-control form-control-solid" name="answers[{{ $value->id }}]" value="{{ $value->description ?? '' }}"
                                               placeholder="Nhập câu trả lời" id="exampleFormControlInput_{{ $value->id }}" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-check-custom form-check-solid mt-5 pt-5">
                                        <input class="form-check-input valueCorrect" type="radio" data-id="{{ $value->id }}" name="correct"
                                               id="flexRadioDefault_{{ $value->id }}" @if ($value->is_correct == 1) checked="checked" @endif/>
                                        <label class="form-check-label valueCorrect" data-id="{{ $value->id }}" for="flexRadioDefault_{{ $value->id }}">
                                            Trả lời đúng
                                        </label>
                                    </div>
                                </div>
                            </div>
                                @if ($value->is_correct == 1)
                                    <?php $is_correct = $value->id;?>
                                @endif
                        @endforeach
                    @else
                        @include('components.backend.quiz.questions.answer')
                    @endif

                </div>

                @if ($isEdit == 0)
                    <div class="d-flex flex-column mb-8">
                        <div class="col-md-6 fv-row fv-plugins-icon-container">
                            <a href="#" class="btn btn-success" id="addAnswer"><i class="bi bi-file-plus fs-4 me-2"></i>Thêm câu trả lời</a>
                        </div>
                    </div>
                @endif


                @if ($isEdit == 1)
                    <div class="d-flex flex-column mb-8">
                        <div class="col-md-6 fv-row fv-plugins-icon-container">
                            <a href="#" class="btn btn-success" data-id="{{ $posts->id }}" id="addAnswerAjax"><i class="bi bi-file-plus fs-4 me-2"></i>Thêm câu trả lời</a>
                        </div>
                    </div>
                @endif

                <div class="d-flex flex-column mb-8">
                    <label class="fs-6 fw-bold mb-2">Bài giải</label>
                    <textarea id="description" name="description" id="text" cols="30" rows="10">{{ old('description', !empty($posts) ? $posts->description : '') }}</textarea>
                    <script src={{ url('ckeditor/ckeditor.js') }}></script>
                    <script>
                        CKEDITOR.replace('description', {
                            filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
                            filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images&mymy=1') }}',
                            filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
                            filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&mymy=1') }}',
                            filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&mymy=1') }}',
                            filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash&mymy=1') }}'
                        });
                        CKEDITOR.config.height = 500;
                    </script>
                </div>

                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span>Trạng thái</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title=""
                            data-bs-original-title="Trạng thái sẽ thay đổi"
                            aria-label="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2"
                        data-hide-search="true" data-placeholder="Chọn vai trò" name="status"
                        data-select2-id="select2-data-10-gou0" tabindex="-1" aria-hidden="true">
                        @foreach ($status as $key => $value)
                            <option value="{{ $key }}"
                                {{ old('status', !empty($posts) ? $posts->status : '') == $key ? 'selected' : '' }}>
                                {{ $value }}</option>
                        @endforeach
                    </select>

                </div>
                <!--end::Input group-->


                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span>SEO Tiêu đề</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title=""
                            data-bs-original-title="Tên của một tiêu đề"
                            aria-label="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid" placeholder="SEO Tiêu đề"
                        name="meta_title" id="meta_title"
                        value="{{ old('meta_title', !empty($posts) ? $posts->meta_title : '') }}">
                </div>
                <!--end::Input group-->

                <div class="d-flex flex-column mb-8">
                    <label class="fs-6 fw-bold mb-2">SEO Keyword</label>
                    <textarea class="form-control form-control-solid" rows="3" name="meta_keywords"
                        placeholder="Nhập nội dung ngắn">{{ old('meta_keywords', !empty($posts) ? $posts->meta_keywords : '') }}</textarea>
                </div>


                <div class="d-flex flex-column mb-8">
                    <label class="fs-6 fw-bold mb-2">SEO Description</label>
                    <textarea class="form-control form-control-solid" rows="3" name="meta_description"
                        placeholder="SEO Description">{{ old('meta_description', !empty($posts) ? $posts->meta_description : '') }}</textarea>
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
                            @if (!empty($posts) && $posts->image)
                                @foreach ($posts->image()->get() as $key => $value)
                                    <tr id="deleteImage_{{ $value->id }}">
                                        <td>
                                            <div class="symbol symbol-50px">
                                                <img src="{{ str_replace(Str::of($value->url)->basename(), Str::of($value->url)->basename(), asset('storage/products/' . $value->url)) }}"
                                                    alt="">
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#"
                                                class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $value->filename ?? '' }}</a>
                                        </td>
                                        <td>

                                        </td>
                                        <td class="text-end">

                                            <input class="form-check-input updateImage" type="radio"
                                                id="flexCheckDefault{{ $value->id }}"
                                                data-post_id="{{ $value->imageable_id }}"
                                                data-id="{{ $value->id }}"
                                                @if ($value->is_default == 1) checked="checked" @endif
                                                name="image_default" value="{{ $value->id }}">
                                            <label class="form-check-label updateImage" data-id="{{ $value->id }}"
                                                for="flexCheckDefault{{ $value->id }}"
                                                data-post_id="{{ $value->imageable_id }}">Ảnh đại diện</label>

                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-danger btn-sm deleteImageAction"
                                                data-id="{{ $value->id }}"><i class="bi bi-trash fs-4 me-1"></i>
                                                Xóa</a>
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
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title=""
                            data-bs-original-title="chọn file hình ảnh từ máy tính"
                            aria-label="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input class="form-control" type="file" id="files" name="files[]" multiple="multiple"
                        accept="image/*">

                </div>
                <!--end::Input group-->



                <div class="text-end">
                    <input type="hidden" name="myAnswer" value="{{ $is_correct ?? 0 }}" id="myAnswer">
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
        <script type="text/javascript">
            $(document).ready(function() {

                function nextCharacter(c) {
                    return String.fromCharCode(c.charCodeAt(0) + 1);
                }

                $(document).on('click', '#addAnswer', function(event) {
                    event.preventDefault();
                    let i  = Math.floor((Math.random() * 104) + 1);
                    let alphabet = nextCharacter($( "#list-answers label.addNewText" ).last().text());

                    let answer = `<div class="row">
                            <div class="col-md-9">
                                <div class="mb-10">
                                    <label for="exampleFormControlInput_${i}" data-id="${i}" class="form-label addNewText">${alphabet}</label>
                                    <input type="text" class="form-control form-control-solid" name="answers[]"
                                           placeholder="Nhập câu trả lời" id="exampleFormControlInput_${i}" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check form-check-custom form-check-solid mt-5 pt-5">
                                    <input class="form-check-input valueCorrect" data-id="${i}" type="radio" name="correct"
                                           id="flexRadioDefault_${i}" />
                                    <label class="form-check-label valueCorrect" data-id="${i}" for="flexRadioDefault_${i}">
                                        Trả lời đúng
                                    </label>
                                </div>
                            </div>
                        </div>`;
                     $('#list-answers').append(answer)
                });

                $(document).on('click', '#addAnswerAjax', function(event) {

                    let token = $("meta[name='csrf-token']").attr("content");
                    let alphabet = nextCharacter($( "#list-answers label.labelAnswerAjax" ).last().text());
                    let post_id = $(this).data("id");
                    event.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: "{{ Route('backend.questions.storeAnswer') }}",
                        dataType: 'json',
                        data: {
                            "_token": token,
                            post_id: post_id,
                            alphabet:alphabet
                        },
                        success: function(jsonResultHtml) {
                            $('#list-answers').append(jsonResultHtml.data.jsonResult)
                        }
                    });

                });


                $(document).on('click', '.updateImage', function(event) {

                    let id = $(this).data("id");
                    let post_id = $(this).data("post_id");
                    let token = $("meta[name='csrf-token']").attr("content");

                    event.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: baseUrl + '/news/updateImageDefault',
                        dataType: 'json',
                        data: {
                            "_token": token,
                            image_id: id,
                            post_id: post_id
                        },
                        success: function(json) {
                            $('input:radio[name="image_default"]').prop('checked', false);
                            $('#flexCheckDefault' + id).prop('checked', true);

                        }
                    });
                })

                // slug bài viết tin tức
                $(document).on('keypress', 'input#name', function() {
                    let slug = slugVietNamese($(this).val(), '-');
                    $('#slug').val(slug);
                });

                $(document).on('change', 'input#name', function() {
                    let slug = slugVietNamese($(this).val(), '-');
                    $('#slug').val(slug);
                });

                $(document).on('change', '.valueCorrect', function() {
                    let id = $(this).data('id');
                    $('#myAnswer').val(id);
                });


                function slugVietNamese(str, separator) {
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
                // end slug

            })
        </script>
        @include('components.backend.shared.deleteImage')
    </x-slot>
</x-layout.backend>
