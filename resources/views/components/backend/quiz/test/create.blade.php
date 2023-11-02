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
                action="{{ $isEdit == 0 ? Route('backend.test.store') : Route('backend.test.update', ['id' => $posts->id]) }}"
                method="post">
                @if ($isEdit == 1)
                    @method('PUT')
                @endif
                @csrf
                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Tên bài kiểm tra</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title=""
                            data-bs-original-title="Tên của bài kiểm tra"
                            aria-label="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid" placeholder="Nhập bài kiểm tra"
                        name="title" id="title" value="{{ old('name', !empty($posts) ? $posts->title : '') }}">
                    @if ($errors->has('title'))
                        <div class="fv-plugins-message-container invalid-feedback">
                            <div data-field="title" data-validator="notEmpty">{{ $errors->first('title') }}</div>
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
                            data-control="select2" data-hide-search="false" data-placeholder="Chọn danh mục"
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
                    @if(!empty($subjects))
                        <!--begin::Col-->
                            <div class="col-md-6 fv-row">
                                <label class="fs-6 fw-bold mb-2">Chuyên đề</label>
                                <!--begin::Input-->
                                <div class="position-relative d-flex align-items-center">
                                    <select class="form-select form-select-solid select2-hidden-accessible"
                                            data-control="select2" data-hide-search="false" data-placeholder="Chọn chuyên đề"
                                            name="subject_id" data-select2-id="select2-data-10-gou7" tabindex="-1" aria-hidden="true">
                                        @foreach ($subjects as $key => $value)
                                            <option value="{{ $value->id }}"
                                                {{ old('subject_id', !empty($posts) ? $posts->subject_id : '') == $key ? 'selected' : '' }}>
                                                {{ $value->title ?? '' }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <!--end::Input-->
                            </div>
                            <!--end::Col-->
                    @endif
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                    <div class="row g-9 mb-8">
                            <!--begin::Input group-->
                            <div class="col-md-6 fv-row fv-plugins-icon-container">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Thời gian kiểm tra/phút</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title=""
                                       data-bs-original-title="Thời gian của bài kiểm tra"
                                       aria-label="Specify a target name for future usage and reference"></i>
                                </label>
                                <!--end::Label-->
                                <input type="text" class="form-control form-control-solid" placeholder="Nhập thời gian (số phút) của bài kiểm tra"
                                       name="score_time" id="score_time" value="{{ old('score_time', !empty($posts) ? $posts->score_time : 15) }}">
                                @if ($errors->has('score_time'))
                                    <div class="fv-plugins-message-container invalid-feedback">
                                        <div data-field="score_time" data-validator="notEmpty">{{ $errors->first('score_time') }}</div>
                                    </div>
                                @endif

                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="col-md-6 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span>Chọn vị trí</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title=""
                                       data-bs-original-title="Vị trí sẽ thay đổi"
                                       aria-label="Specify a target name for future usage and reference"></i>
                                </label>
                                <!--end::Label-->
                                <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2"
                                        data-hide-search="true" data-placeholder="Chọn vị trí" name="position" id="position"
                                        data-select2-id="select2-data-10-gou1" tabindex="-1" aria-hidden="true">
                                    @foreach ($trends as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ old('position', !empty($posts) ? $posts->position : '') == $key ? 'selected' : '' }}>
                                            {{ $value }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <!--end::Input group-->
                    </div>


                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#kt_modal_2">
                        Thêm câu hỏi vào bài kiểm tra
                    </button>

                <div class="d-flex flex-column mb-8" id="list-answers">
                    <input name="questions" id="questions" type="hidden" value="{{ $questions_select }}">
                </div>
                <div class="d-flex flex-column mb-8">
                    <label class="fs-6 fw-bold mb-2">Nội dung diễn giải</label>
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


    <div class="modal bg-body fade" tabindex="-1" id="kt_modal_2">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content shadow-none">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 border-end" style="min-height: 500px">
                                <form class="row g-3">
                                    <div class="col-md-6">
                                        <label for="questions_name" class="form-label">Tên câu hỏi hoặc mã câu hỏi</label>
                                        <input type="text" class="form-control" placeholder="Nhập tên câu hỏi hoặc mã câu hỏi" id="questions_name">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="category_id_search" class="form-label">Danh mục</label>
                                        <select id="category_id_search" class="form-select">
                                            <option value="0" selected>chọn danh mục</option>
                                            @foreach ($category as $key => $value)
                                                <option value="{{ $value->id }}"
                                                    {{ old('category_id', !empty($posts) ? $posts->category_id : '') == $value->id ? 'selected' : '' }}>
                                                    {{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <button type="button" class="btn btn-primary" id="searchQuestion">Tìm kiếm</button>
                                    </div>
                                    <p class="fw-bold mb-0" id="showResult" style="display: none">Kết quả tìm kiếm</p>
                                    <hr class="mb-0" id="showResultHR" style="display: none">
                                    <ul class="list-group list-group-flush" id="showListSearchQuestion"></ul>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <p class="fw-bold">DANH SÁCH CÂU HỎI ĐÃ CHỌN</p>
                                <hr>
                                <ul class="list-group list-group-flush" id="showListChoseQuestion">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="javascript">
        <script type="text/javascript">
            $(document).ready(function() {

                //<i class="bi bi-bookmark-x"></i>

                $(document).on('click', '.addQuestion', function(event) {
                    let question_id = $(this).data('id');
                    let question_name = $(this).data('name');
                    let find  = $("ul#showListChoseQuestion").find("[data-id='" + question_id + "']").data('id');
                    if(!find) {
                        let strQuestion = `<li class="list-group-item d-flex justify-content-between align-items-center" id="showHideQuestion_${question_id}">${question_name}
                                        <button type="button" class="btn btn-danger btn-sm deleteQuestion" data-question="deleteQuestion" data-id="${question_id}">
                                            <i class="bi bi-bookmark-x"></i> Xóa
                                        </button>
                                    </li>`;

                        $("ul#showListChoseQuestion").append(strQuestion);
                    }
                    getListQuestionChose();

                });

                $(document).on('click', '#searchQuestion', function(event) {
                    let questions_name = $('#questions_name').val();
                    let category_id = $('#category_id_search').val();
                    let token = $("meta[name='csrf-token']").attr("content");
                    $.ajax({
                        type: 'POST',
                        url: '{{ Route('backend.test.search.question') }}',
                        dataType: 'json',
                        data: {
                            "_token": token,
                            search: questions_name,
                            category_id: category_id
                        },
                        success: function(json) {
                            $('#showResult').show()
                            $('#showResultHR').show()
                           $('#showListSearchQuestion').html(json.data.jsonResult);
                        }
                    });
                });

                $(document).on('click', '.deleteQuestion', function(event) {
                    let id = $(this).data("id");
                    Swal.fire({
                        title: 'Bạn có muốn xóa không?',
                        showCancelButton: true,
                        confirmButtonText: 'Đồng ý',
                        cancelButtonText: `Đóng`,
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            $('#showHideQuestion_'+id).remove();
                            getListQuestionChose();
                        }
                    })

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

                $('#kt_modal_2').on('shown.bs.modal', function () {

                    let questions = $('#questions').val();
                    let token = $("meta[name='csrf-token']").attr("content");
                    if(questions.trim().length > 0) {
                        $.ajax({
                            type: 'POST',
                            url: '{{ Route('backend.test.load.question') }}',
                            dataType: 'json',
                            data: {
                                "_token": token,
                                questions: questions
                            },
                            success: function(json) {
                                $('ul#showListChoseQuestion').html(json.data.jsonResult);
                                getListQuestionChose()
                            }
                        });
                    }

                });

                function getListQuestionChose() {
                    // $.each($("button[data-question='" + current +"']"), function (index, item) {
                    //
                    // });
                    var lsId = [];
                    $.each($("button[data-question='deleteQuestion']"), function (index, item) {
                        let id = $(this).data('id');
                        lsId.push(id);
                    });

                    $('#questions').val(lsId);

                }
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
