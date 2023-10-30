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
                action=""
                method="post">
                @csrf


                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="files">
                        <span> Chọn tập tin </span> <a href="{{ url('/template/users.xlsx') }}" class="ms-1"> Download template </a>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title=""
                           data-bs-original-title="Tải file này về máy"
                           aria-label="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input class="form-control" type="file" id="file" name="file"
                           accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">

                </div>
                <!--end::Input group-->
                <div class="text-end">
                    <button type="button" id="kt_modal_new_target_submit" class="btn btn-primary">
                            <span class="indicator-label">Submit</span>
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

                $(document).on('click', '#kt_modal_new_target_submit', function(event) {

                    let form = $('#kt_modal_new_target_form')[0];
                    let formData = new FormData(form);
                    event.preventDefault();

                    $.ajax({
                        url: "{{ Route('backend.users.insertImport') }}",
                        method: "POST",
                        processData: false,
                        contentType: false,
                        data: formData,
                        success: function (data) {
                            if(data.status == 'fail') {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Thông báo',
                                    text: data.message
                                })
                            }else{
                                let timerInterval;
                                Swal.fire({
                                    title: 'Vui lòng đợi...',
                                    html: 'Đã thêm thành công',
                                    timer: 1000,
                                    timerProgressBar: true,
                                    didOpen: () => {
                                        Swal.showLoading()
                                        timerInterval = setInterval(
                                            () => {}, 100)
                                    },
                                    willClose: () => {
                                        clearInterval(timerInterval)
                                    }
                                }).then((result) => {
                                    if (result.dismiss === Swal
                                        .DismissReason.timer) {
                                        window.location.reload();
                                    }
                                })
                            }
                        },
                        error: function (e) {
                            //error
                        }
                    });

                });

            });
        </script>
    </x-slot>
</x-layout.backend>
