<x-layout.backend>
    @include('components.backend.shared.messages')
    <div class="card mb-5 mb-xl-8">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">Danh sách các Part của bài kiểm tra</span>
            </h3>
            <div class="card-toolbar">
                @if (Auth::guard('backend')->user()->can(['test_create']))
                    <a href="#" class="btn btn-sm btn-light-primary" id="createPart">
                        <!--begin::Svg Icon | path: icons/duotone/Communication/Add-user.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"
                                 version="1.1">
                                <path
                                    d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                    fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                <path
                                    d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                    fill="#000000" fill-rule="nonzero" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->Tạo Part mới
                    </a>
                @endif
            </div>
        </div>
        <!--end::Header-->

        <!--begin::Body-->
        <div class="card-body py-3">

            <!--begin::Accordion-->
            <div class="accordion" id="kt_accordion_1">
                @include('components.backend.quiz.test.showAccordion',['parts'=>$parts])
            </div>
            <!--end::Accordion-->
        </div>
    </div>

    @include('components.backend.quiz.test.nextModal',['post'=>$posts])


    <div class="modal bg-body fade" tabindex="-1" id="kt_modal_2">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content shadow-none">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12" style="min-height: 500px">
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
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#description').summernote({
                    placeholder: 'Nội dung câu hỏi',
                    tabsize: 2,
                    height: 300
                });
                $('.update_description').summernote({
                    placeholder: 'Nội dung câu hỏi',
                    tabsize: 2,
                    height: 300
                });

                var test_id = {{ $posts->id ?? 0 }};
                $(document).on('click', '#createPart', function(event) {
                    event.preventDefault();
                    $('#kt_modal_part').modal('show');
                });


                $(document).on('change', '.updateOrderBy', function(event) {
                    let id = $(this).data('question_part_question');
                    let order = $(this).val();
                    let token = $("meta[name='csrf-token']").attr("content");
                    $.ajax({
                        url: baseUrl + "/test/updateQuestionPart/"+id,
                        type: 'POST',
                        data: {
                            "_token": token,
                            id: id,
                            order:order
                        },
                        success: function (json) {

                        }
                    });
                });
                $(document).on('click', '#searchQuestion', function(event) {
                    let questions_name = $('#questions_name').val();
                    let category_id = $('#category_id_search').val();
                    let token = $("meta[name='csrf-token']").attr("content");
                    let type = $(this).data('type');
                    $.ajax({
                        type: 'POST',
                        url: '{{ Route('backend.test.search.question') }}',
                        dataType: 'json',
                        data: {
                            "_token": token,
                            search: questions_name,
                            category_id: category_id,
                            type:type
                        },
                        success: function(json) {
                            $('#showResult').show()
                            $('#showResultHR').show()
                            $('#showListSearchQuestion').html(json.data.jsonResult);
                        }
                    });
                });

                $(document).on('click', '.addQuestion', function(event) {
                    let part_id = $('#searchQuestion').data('id');
                    let post_id = $(this).data('id');
                    let token = $("meta[name='csrf-token']").attr("content");
                    let data = {
                        "test_id": test_id,
                        "part_id": part_id,
                        "post_id": post_id,
                        "_token": token,
                    };

                    $.ajax({
                        url: baseUrl + "/test/addQuestionPart",
                        type: 'POST',
                        data: data,
                        success: function (json) {
                            $('#contentQuestion_'+part_id).html(json.data.jsonResult);
                            $('#doneQuestion_'+post_id).html('Đã thêm')
                        }
                    });
                });

                $(document).on('click', 'button.AddQuestionPart', function(event) {
                    let id = $(this).data('id');
                    let type = $(this).data('type');
                    $('#searchQuestion').attr('data-id',id);
                    $('#searchQuestion').attr('data-type',type);
                    $('#kt_modal_2').modal('show');
                });


                $(document).on('click', '#createPartNew', function(event) {
                    let part_name = $('#part_name').val();
                    let order = $('#order').val();
                    let type = $('#type').val();
                    let short_description = $('#short_description').val();
                    let description = $('#description').val();
                    let token = $("meta[name='csrf-token']").attr("content");
                    let data = {
                        "test_id": test_id,
                        "part_name": part_name,
                        "type": type,
                        "short_description": short_description,
                        "description": description,
                        "_token": token,
                        "order": order,
                    };
                    if(part_name.trim().length <= 0) {
                        $('#part_name').focus();
                    }else if (description.trim().length <= 0) {
                        $('#description').focus();
                    }else {

                        $.ajax({
                            url: baseUrl + "/test/createPart",
                            type: 'POST',
                            data: data,
                            success: function (json) {
                                $('#kt_accordion_1').append(json.data.jsonResult)
                                $('#kt_modal_part').modal('hide');
                                window.location.reload()
                            }
                        });
                    }

                });


                $(document).on('click', 'button.updatePartNew', function(event) {
                    let id = $(this).data('id');
                    let part_name = $('#part_name_update_'+id).val();
                    let order = $('#order_update_'+id).val();
                    let short_description = $('#short_description_update_'+id).val();
                    let description = $('#description_update_'+id).val();
                    let token = $("meta[name='csrf-token']").attr("content");
                    let data = {
                        "part_id": id,
                        "name": part_name,
                        "short_description": short_description,
                        "description": description,
                        "_token": token,
                        "order": order,
                    };
                    if(part_name.trim().length <= 0) {
                        $('#part_name_update_'+id).focus();
                    }else if (description.trim().length <= 0) {
                        $('#description_update_'+id).focus();
                    }else {

                        $.ajax({
                            url: baseUrl + "/test/updatePart",
                            type: 'POST',
                            data: data,
                            success: function (json) {
                                window.location.reload()
                            }
                        });
                    }

                });


              //  CKEDITOR.replace('description');
               // CKEDITOR.config.height = 500;
                //CKEDITOR.config.removePlugins = 'easyimage, cloudservices, exportpdf';

               // CKEDITOR.replace( 'description' );


            });
        </script>
    </x-slot>
</x-layout.backend>
