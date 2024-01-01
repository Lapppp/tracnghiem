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

                <div class="accordion-item">
                    <h2 class="accordion-header" id="kt_accordion_1_header_1">
                        <button class="accordion-button fs-4 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_1" aria-expanded="true" aria-controls="kt_accordion_1_body_1">
                            Accordion Item #1
                        </button>
                    </h2>
                    <div id="kt_accordion_1_body_1" class="position-relative accordion-collapse collapse show" aria-labelledby="kt_accordion_1_header_1" data-bs-parent="#kt_accordion_1">
                            <button type="button" class="btn btn-primary btn-sm" style="position: absolute;right: 16px;top:10px;z-index: 1">Thêm câu hỏi</button>
                        <div class="accordion-body">
                            <table class="table table-row-bordered">
                                <thead>
                                <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                                    <th scope="col" style="width: 7%"><b>STT</b></th>
                                    <th scope="col"><b>Tên câu hỏi</b></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">
                                        <input type="number" class="form-control form-control-sm">
                                    </th>
                                    <td>Mark</td>

                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!--end::Accordion-->
        </div>
    </div>

    @include('components.backend.quiz.test.nextModal',['post'=>$posts])
    <x-slot name="javascript">
        <script type="text/javascript">
            $(document).ready(function() {
                var test_id = {{ $posts->id ?? 0 }};
                $(document).on('click', '#createPart', function(event) {
                    event.preventDefault();
                    $('#kt_modal_part').modal('show');
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
                            }
                        });
                    }

                });


            });
        </script>
    </x-slot>
</x-layout.backend>
