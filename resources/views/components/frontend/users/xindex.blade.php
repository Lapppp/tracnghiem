<x-layout.customer>

    @include('components.backend.shared.messages')
    <div class="card mb-5 mb-xl-8">

        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">Danh sách Khách hàng</span>
            </h3>
            <div class="card-toolbar">
                @if(Auth::guard('backend')->user()->can(['create_user']))
                <a href="{{ Route('backend.users.create') }}" class="btn btn-sm btn-light-primary">
                    <!--begin::Svg Icon | path: icons/duotone/Communication/Add-user.svg-->
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                            <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->Tạo mới
                </a>
                @endif
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table align-middle gs-0 gy-4">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="fw-bolder text-muted bg-light">
                            <th class="ps-4 min-w-250px rounded-start">Họ tên</th>
                            <th class="min-w-80px" data-bs-toggle="tooltip" data-bs-placement="top" title="Mã nhân viên">Code</th>
                            <th class="min-w-125px">Email</th>
                            <th class="min-w-125px">Ngày tạo</th>
                            <th class="min-w-150px">Ngày cập nhật</th>
                            <th class="min-w-100px">Trạng thái</th>
                            <th class="min-w-150px text-end rounded-end"></th>
                        </tr>
                    </thead>
                    <tbody>

                        @if(count($items) > 0)
                        @foreach($items as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-50px me-5">
                                        @if($item->default()['url'])
                                        <img src="{{ str_replace(Str::of($item->default()['url'])->basename(),'thumb_50x50_'.Str::of($item->default()['url'])->basename(),asset('storage/avatar/'.$item->default()['url'])) }}" class="" alt="" />
                                        @else
                                        <img src="{{ Avatar::create($item->name)->toBase64() }}" class="" alt="" />
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-start flex-column">
                                        <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $item->name }}</a>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="text-muted fw-bold text-muted d-block fs-7" data-bs-toggle="tooltip" data-bs-placement="top" title=" {{ $item->code }} là mã nhân viên của  {{ $item->name }} ">{{ $item->code }}</span>
                            </td>

                            <td>
                                <span class="text-muted fw-bold text-muted d-block fs-7">{{ $item->email }}</span>
                            </td>
                            <td>
                                <span class="text-muted fw-bold text-muted d-block fs-7">
                                    {{ $item->created_at ? date('d-m-Y',strtotime($item->created_at)) : '' }}
                                </span>

                            </td>
                            <td>
                                <span class="text-muted fw-bold text-muted d-block fs-7">
                                    {{ $item->updated_at ? date('d-m-Y',strtotime($item->updated_at)) : '' }}
                                </span>
                            </td>
                            <td>
                                @if($item->status)
                                <span class="badge badge-light-primary fs-7 fw-bold">Đang hoạt động</span>
                                @else
                                <span class="badge badge-light-danger fs-7 fw-bold">Ngừng hoạt động</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ Route('backend.users.edit',['id'=>$item->id]) }}" data-id="{{ $item->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Những người phụ trách khách hàng: {{ $item->name }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 showUser">
                                    <i class="bi bi-people"></i>
                                </a>

                                @if(Auth::guard('backend')->user()->can(['edit_user']))
                                <a href="{{ Route('backend.users.edit',['id'=>$item->id]) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Sửa tài khoản" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                @endif

                                @if(Auth::guard('backend')->user()->can(['delete_user']))
                                <a href="#" data-bs-toggle="tooltip" data-id="{{ $item->id }}" data-bs-placement="top" title="Xóa tài khoản" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm deleteAction">
                                    <i class="bi bi-trash"></i>
                                    <!--end::Svg Icon-->
                                </a>
                                @endif

                            </td>
                        </tr>
                        @endforeach
                        @else
                        @include('components.backend.shared.user')
                        @endif

                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table container-->


            <!--begin::Pagination-->
            @if(count($items) > 0)
            {!! $pager !!}
            @endif

            {{-- @includeIf('components.backend.shared.pagination', ['total' => count($items)])--}}


        </div>
        <!--begin::Body-->
    </div>


    <div class="modal fade" id="usersModalScrollable" tabindex="-1" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">NHỮNG NGƯỜI PHỤ TRÁCH KHÁCH HÀNG</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="showListApproved">
                    <form id="kt_modal_new_target_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data" action="" method="post">

                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span>Người phụ trách chính</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Chọn Người phụ trách chính" aria-label="Specify a target name for future usage and reference"></i>
                            </label>
                            <!--end::Label-->
                            <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2" data-placeholder="Chọn Người phụ trách chính" name="user_main" id="user_main" data-dropdown-parent="#showListApproved" data-select2-id="select2-data-10-gou2" tabindex="-1" aria-hidden="true">
                            </select>

                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span>Người phụ trách phụ</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Chọn Người phụ trách phụ" aria-label="Specify a target name for future usage and reference"></i>
                            </label>
                            <!--end::Label-->
                            <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2" data-placeholder="Chọn Người phụ trách phụ" name="user_sub" id="user_sub" data-select2-id="select2-data-10-gou3" data-dropdown-parent="#showListApproved" tabindex="-1" aria-hidden="true">
                            </select>

                        </div>
                        <!--end::Input group-->

                    </form>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="0" id="department_id" name="department_id">
                    <input type="hidden" value="0" id="user_id" name="user_id">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="updateUser">Cập nhật</button>
                </div>
            </div>
        </div>
    </div>


    <x-slot name="javascript">
        <script type="text/javascript">
            $(document).ready(function() {

                $(document).on('click', '#updateUser', function(event) {
                    let user_id = $('#user_id').val();
                    let token = $("meta[name='csrf-token']").attr("content");
                    let data = {
                        user_id: user_id,
                        _token: token,
                        department_id: $('#department_id').val(),
                        user_main: $('#user_main').val(),
                        user_sub: $('#user_sub').val(),
                    };
                    $.ajax({
                        url: baseUrl + "/users/update-ajax",
                        type: 'POST',
                        data: data,
                        success: function(json) {
                            window.location.reload();
                        }
                    });
                });


                $(document).on('click', 'a.showUser', function(event) {
                    event.preventDefault();
                    let id = $(this).data("id");
                    $('#user_id').val(id);
                    //$('#user_main').select2({ minimumResultsForSearch: -1 });
                    let token = $("meta[name='csrf-token']").attr("content");
                    $.ajax({
                        url: baseUrl + "/users/ajax",
                        type: 'POST',
                        data: {
                            "id": id,
                            "_token": token,
                        },
                        success: function(json) {
                            // $('#showListApproved').html(json.data.returnHTML);
                            //user_main
                            //user_sub
                            $('#department_id').val(json.data.department.id);
                            if (json.data.users.length > 0) {
                                $('#user_main').html('').select2({
                                    data: json.data.users
                                });
                                $('#user_sub').html('').select2({
                                    data: json.data.users
                                });

                                $('#user_main').val(json.data.main).trigger('change');
                                $('#user_sub').val(json.data.sub).trigger('change');
                            }
                            $('#usersModalScrollable').modal('show');
                        }
                    });
                });
                $(document).on('click', '.deleteAction', function(event) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Bạn có chắc là muốn xóa không?',
                        showDenyButton: true,
                        confirmButtonText: 'Đồng ý',
                        denyButtonText: `Không`,
                        customClass: {
                            confirmButton: "btn btn-primary btn-sm",
                            denyButton: "btn btn-danger btn-sm"
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let id = $(this).data("id");
                            let token = $("meta[name='csrf-token']").attr("content");
                            $.ajax({
                                url: baseUrl + "/users/delete/" + id,
                                type: 'DELETE',
                                data: {
                                    "id": id,
                                    "_token": token,
                                },
                                success: function(json) {
                                    if (json.status == 'success') {

                                        let timerInterval;
                                        Swal.fire({
                                            title: 'Vui lòng đợi...',
                                            html: '',
                                            timer: 1000,
                                            timerProgressBar: true,
                                            didOpen: () => {
                                                Swal.showLoading()
                                                timerInterval = setInterval(() => {}, 100)
                                            },
                                            willClose: () => {
                                                clearInterval(timerInterval)
                                            }
                                        }).then((result) => {
                                            if (result.dismiss === Swal.DismissReason.timer) {
                                                window.location.reload();
                                            }
                                        })

                                    } else {
                                        Swal.fire(json.message, '', 'danger')
                                    }
                                }
                            });

                            //Swal.fire('Saved!', '', 'success')
                        }
                    })
                });



            });
        </script>
    </x-slot>

</x-layout.customer>