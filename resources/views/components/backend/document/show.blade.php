<x-layout.backend>
    <x-slot name="css">
        <style type="text/css">
            .custom-file-input.selected:lang(en)::after {
                content: "" !important;
            }
            input[type="file"] {
                display: none;
            }
            .custom-file {
                overflow: hidden;
            }

            .custom-file-input {
                white-space: nowrap;
            }
        </style>
    </x-slot>

    @if(!empty($user))
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <!--begin::Card header-->
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">THÔNG TIN KHÁCH HÀNG</h3>
            </div>
            <!--end::Card title-->
            <!--begin::Action-->
        </div>
        <!--begin::Card header-->
        <!--begin::Card body-->
        <div class="card-body p-9">
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">Tên khách hàng</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                    <span class="fw-bolder fs-6 text-gray-800">{{ $user->name ?? '' }}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->

            <!--begin::Input group-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">Điện thoại</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 d-flex align-items-center">
                    <span class="fw-bolder fs-6 text-gray-800 me-2">{{ $user->phone ?? '' }}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">Email</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                    <a href="mailto:{{ $user->email ?? '' }}?subject=Thư phản hồi" class="fw-bold fs-6 text-gray-800 text-hover-primary">{{ $user->email ?? '' }}</a>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">Địa chỉ</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                    <span class="fw-bolder fs-6 text-gray-800">----</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

        </div>
        <!--end::Card body-->
    </div>
    @endif
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <!--begin::Card header-->
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">THÔNG TIN CHI TIẾT HỒ SƠ</h3>
            </div>
            <!--end::Card title-->
            <!--begin::Action-->
            <a href="{{ Route('backend.document.edit',['id'=>$post->id]) }}" class="btn btn-primary align-self-center">Sửa hồ sơ</a>
            <!--end::Action-->
        </div>
        <!--begin::Card header-->
        <!--begin::Card body-->
        <div class="card-body p-9">
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">Tên hồ sơ</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                    <span class="fw-bolder fs-6 text-gray-800">{{ $post->name }}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Input group-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">Ngày tạo đơn</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <span class="fw-bold text-gray-800 fs-6">{{ $post->created_at && !empty($post->created_at)  ? date('d/m/Y',strtotime($post->created_at)) :'' }}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">Ngày nộp đơn</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 d-flex align-items-center">
                    <span class="fw-bolder fs-6 text-gray-800 me-2">{{ $post->date_of_filing && !empty($post->date_of_filing)  ? date('d/m/Y',strtotime($post->date_of_filing)) :'' }}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">Ngày tiếp nhận đơn</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                    <span class="fw-bolder fs-6 text-gray-800 me-2">{{ $post->received_date && !empty($post->received_date)  ? date('d/m/Y',strtotime($post->received_date)) :'' }}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="row mb-10">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">Trạng thái hồ sơ</label>
                <!--begin::Label-->
                <!--begin::Label-->
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">
                        {{ $status[$post->status] }}
                    </span>
                </div>
                <!--begin::Label-->
            </div>
            <!--end::Input group-->

                @if(Auth::guard('backend')->user()->hasAnyRole('nhan-vien-ke-toan','truong-phong-ke-toan') && $post->status == 2)
                    <!--begin::Notice-->
                    <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
                        <!--begin::Icon-->
                        <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                        <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
                                                            <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="black" />
                                                            <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="black" />
                                                        </svg>
                                                    </span>
                        <!--end::Svg Icon-->
                        <!--end::Icon-->
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack flex-grow-1">
                            <!--begin::Content-->
                            <div class="fw-bold">
                                <h4 class="text-gray-900 fw-bolder">Chúng tôi cần sự chú ý của bạn!</h4>
                                <div class="fs-6 text-gray-700">Hồ sơ này đã thanh toán. Cần bạn xác nhận thanh toán hồ sơ, Vui lòng click
                                    <a class="fw-bolder btn btn-primary" href="#" data-id="{{ $post->id }}" id="updateStatusPayment">Xác nhận đã thanh toán</a>
                                </div>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Notice-->
                @endif


        </div>
        <!--end::Card body-->
    </div>

    <!--begin::Row-->
    <div class="row gy-5 gx-xl-10">
        <!--begin::Col-->
        <div class="col-xl-6">
            <!--begin::List Widget 5-->
            <div class="card card-xl-stretch mb-xl-10">
                <!--begin::Header-->
                <div class="card-header align-items-center border-0 mt-4">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="fw-bolder mb-2 text-dark">THÔNG TIN TRẠNG THÁI</span>
                        @if($post->comments()->get()->count() > 0)
                            <span class="text-muted fw-bold fs-7">Có {{ $post->comments()->get()->count() }} trạng thái</span>
                        @endif
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-5">
                    <!--begin::Timeline-->
                    <div class="timeline-label">

                        @if($post->comments()->get()->count() > 0)
                            @foreach($post->comments()->get() as $key => $comment)
                                <!--begin::Item-->
                                <div class="timeline-item">
                                    <!--begin::Label-->
                                    <div class="timeline-label fw-bolder text-gray-800 fs-6">{{ !empty($comment->created_at) ? date('H:s',strtotime($comment->created_at)) :'' }}</div>
                                    <!--end::Label-->
                                    <!--begin::Badge-->
                                    <div class="timeline-badge">
                                        <i class="fa fa-genderless @if($loop->odd) text-danger @else text-primary @endif fs-1"></i>
                                    </div>
                                    <!--end::Badge-->
                                    <!--begin::Desc-->
                                    <div class="timeline-content fw-bolder text-gray-800 ps-3">
                                        {{ !empty($comment->created_at) ? date('d/m/Y',strtotime($comment->created_at)) :'' }} {{ $comment->message }}
                                        @if($post->image()->where('comment_id',$comment->id)->get()->count()> 0)
                                            @foreach($post->image()->where('comment_id',$comment->id)->get() as $k=>$v)
                                            <div><a href="{{ Route('backend.document.download',['id'=>$v->id]) }}" class="text-primary">{{ $v->filename?? '' }}</a></div>
                                            @endforeach
                                        @endif

                                    </div>
                                    <!--end::Desc-->
                                </div>
                                <!--end::Item-->
                                @endforeach
                         @endif

                    </div>
                    <!--end::Timeline-->

                    <div class="separator mb-4 mt-7"></div>
                    <!--begin::Reply input-->
                    <form class="position-relative mb-6" method="post" enctype="multipart/form-data" action="" id="laravel-ajax-file-upload">
                        @csrf
                        <input name="post_id" type="hidden" value="{{ $post->id }}">
                        <textarea class="form-control border-0 p-0 pe-10 resize-none min-h-25px" name="message" id="message" data-kt-autosize="true" rows="1" placeholder="Nhập dòng trạng thái hồ sơ.."></textarea>
                        <div class="position-absolute top-0 end-0 me-n5">

                                <input type="file" class="custom-file-input" id="customFileInput" name="customFileInput[]" aria-describedby="customFileInput" multiple="multiple">
                                <label class="custom-file-label" for="customFileInput" data-bs-toggle="tooltip" data-bs-placement="top" title="Chọn một hoặc nhiều tập tin từ máy tính"><span class="btn btn-icon btn-sm btn-active-color-primary pe-0 me-2">
															<!--begin::Svg Icon | path: icons/duotune/communication/com008.svg-->
															<span class="svg-icon svg-icon-3 mb-3">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																	<path opacity="0.3" d="M4.425 20.525C2.525 18.625 2.525 15.525 4.425 13.525L14.825 3.125C16.325 1.625 18.825 1.625 20.425 3.125C20.825 3.525 20.825 4.12502 20.425 4.52502C20.025 4.92502 19.425 4.92502 19.025 4.52502C18.225 3.72502 17.025 3.72502 16.225 4.52502L5.82499 14.925C4.62499 16.125 4.62499 17.925 5.82499 19.125C7.02499 20.325 8.82501 20.325 10.025 19.125L18.425 10.725C18.825 10.325 19.425 10.325 19.825 10.725C20.225 11.125 20.225 11.725 19.825 12.125L11.425 20.525C9.525 22.425 6.425 22.425 4.425 20.525Z" fill="black" />
																	<path d="M9.32499 15.625C8.12499 14.425 8.12499 12.625 9.32499 11.425L14.225 6.52498C14.625 6.12498 15.225 6.12498 15.625 6.52498C16.025 6.92498 16.025 7.525 15.625 7.925L10.725 12.8249C10.325 13.2249 10.325 13.8249 10.725 14.2249C11.125 14.6249 11.725 14.6249 12.125 14.2249L19.125 7.22493C19.525 6.82493 19.725 6.425 19.725 5.925C19.725 5.325 19.525 4.825 19.125 4.425C18.725 4.025 18.725 3.42498 19.125 3.02498C19.525 2.62498 20.125 2.62498 20.525 3.02498C21.325 3.82498 21.725 4.825 21.725 5.925C21.725 6.925 21.325 7.82498 20.525 8.52498L13.525 15.525C12.325 16.725 10.525 16.725 9.32499 15.625Z" fill="black" />
																</svg>
															</span>
                                        <!--end::Svg Icon-->
														</span>
                                </label>

                            <button class="btn btn-primary btn-sm" type="submit">Gửi</button>

                        </div>
                    </form>
                    <!--edit::Reply input-->

                </div>
                <!--end: Card Body-->
            </div>
            <!--end: List Widget 5-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-6">
            <!--begin::Tables Widget 5-->
            <div class="card card-xl-stretch mb-5 mb-xl-10">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">CÁC TẬP TIN HỒ SƠ</span>
                        <span class="text-muted mt-1 fw-bold fs-7">
                            @if(!empty($post) && $post->image()->get()->count() > 0)
                                Tổng cộng : {{ $post->image()->get()->count() }} tập tin
                            @endif
                        </span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <div class="tab-content">
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade show active" id="kt_table_widget_5_tab_1">
                            <!--begin::Table container-->
                            <div class="table-responsive">

                                <table id="kt_file_manager_list" data-kt-filemanager-table="files" class="table align-middle table-row-dashed fs-6 gy-5">
                                    <!--begin::Table head-->
                                    <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="min-w-250px">Tên tập tin</th>
                                        <th class="w-50px">Ngày tạo</th>
                                        <th class="w-100px">Tải tập tin</th>
                                    </tr>
                                    <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="fw-bold text-gray-600">
                                    @if(!empty($post) && $post->image()->get()->count() > 0)
                                        @foreach($post->image()->get() as $image)
                                            <tr id="deleteImage_{{ $image->id }}">
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Svg Icon | path: icons/duotune/files/fil003.svg-->
                                                        <span class="svg-icon svg-icon-2x svg-icon-primary me-4">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z" fill="black" />
                                                                        <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black" />
                                                                    </svg>
                                                                </span>
                                                        <!--end::Svg Icon-->
                                                        <span href="#" class="text-gray-800 text-hover-primary">{{ $image->filename }}</span>
                                                    </div>
                                                </td>
                                                <!--end::Name=-->
                                                <!--begin::Last modified-->
                                                <td>{{ $image->created_at ? date('d/m/Y',strtotime($image->created_at)) : '-' }}</td>
                                                <!--end::Last modified-->
                                                <!--begin::Actions-->
                                                <td class="text-end" data-kt-filemanager-table="action_dropdown">
                                                    <div class="d-flex justify-content-end">
                                                        <!--begin::Share link-->

                                                        <!--begin::More-->
                                                        <div class="ms-2">
                                                            <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                                <!--begin::Svg Icon | path: icons/duotune/general/gen052.svg-->
                                                                <span class="svg-icon svg-icon-5 m-0">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                <rect x="10" y="10" width="4" height="4" rx="2" fill="black" />
                                                                                <rect x="17" y="10" width="4" height="4" rx="2" fill="black" />
                                                                                <rect x="3" y="10" width="4" height="4" rx="2" fill="black" />
                                                                            </svg>
                                                                        </span>
                                                                <!--end::Svg Icon-->
                                                            </button>
                                                            <!--begin::Menu-->
                                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-150px py-4" data-kt-menu="true">
                                                                <!--begin::Menu item-->
                                                                <div class="menu-item px-3">
                                                                    <a href="{{ Route('backend.document.download',['id'=>$image->id]) }}" class="menu-link px-3">Tải tập tin</a>
                                                                </div>
                                                                <!--end::Menu item-->

                                                                <!--begin::Menu item-->
                                                                <div class="menu-item px-3">
                                                                    <a href="#" class="menu-link text-danger px-3 deleteImage" data-id="{{ $image->id }}" data-kt-filemanager-table-filter="delete_row">Xóa</a>
                                                                </div>
                                                                <!--end::Menu item-->
                                                            </div>
                                                            <!--end::Menu-->
                                                        </div>
                                                        <!--end::More-->
                                                    </div>
                                                </td>
                                                <!--end::Actions-->
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--begin::Table-->
                            </div>
                            <!--end::Table-->
                        </div>
                        <!--end::Tap pane-->

                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Tables Widget 5-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

    <x-slot name="javascript">
        <script type="text/javascript">
            $(document).ready(function()
            {
                $(document).on('click','.deleteImage',function(event)
                {
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
                        if (result.isConfirmed)
                        {
                            var id = $(this).data("id");
                            let token = $("meta[name='csrf-token']").attr("content");
                            $.ajax(
                                {
                                    url: baseUrl+"/document/deleteImage/"+id,
                                    type: 'POST',
                                    data: {
                                        "id": id,
                                        "_token": token,
                                    },
                                    success: function (json) {
                                        if(json.status == 'success'){

                                            let timerInterval;
                                            Swal.fire({
                                                title: 'Vui lòng đợi...',
                                                html: '',
                                                timer: 1000,
                                                timerProgressBar: true,
                                                didOpen: () => {
                                                    Swal.showLoading()
                                                    timerInterval = setInterval(() => {
                                                    }, 100)
                                                },
                                                willClose: () => {
                                                    clearInterval(timerInterval)
                                                }
                                            }).then((result) => {
                                                if (result.dismiss === Swal.DismissReason.timer) {
                                                     window.location.reload();
                                                   // $('#deleteImage_'+id).hide();
                                                }
                                            })

                                        }else {
                                            Swal.fire(json.message, '', 'danger')
                                        }
                                    }
                                });

                            //Swal.fire('Saved!', '', 'success')
                        }
                    })
                });


                $('#laravel-ajax-file-upload').submit(function(e)
                {
                    e.preventDefault();
                    let message = $('#message').val();
                    if(message.trim().length <=0) {

                        Swal.fire({
                            title: 'Vui lòng nhập trạng thái',
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: "btn btn-primary btn-sm",
                                denyButton: "btn btn-danger btn-sm"
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#message').focus();
                            }
                        })

                    }else {
                        var formData = new FormData(this);
                        $.ajax({
                            type:'POST',
                            url: "{{ Route('backend.document.uploadImage') }}",
                            data: formData,
                            cache:false,
                            contentType: false,
                            processData: false,
                            success: (dataJson) => {
                                if(dataJson.status == 'success'){
                                    this.reset();
                                    let timerInterval;
                                    Swal.fire({
                                        title: 'Vui lòng đợi...',
                                        html: '',
                                        timer: 1000,
                                        timerProgressBar: true,
                                        didOpen: () => {
                                            Swal.showLoading()
                                            timerInterval = setInterval(() => {
                                            }, 100)
                                        },
                                        willClose: () => {
                                            clearInterval(timerInterval)
                                        }
                                    }).then((result) => {
                                        if (result.dismiss === Swal.DismissReason.timer) {
                                            window.location.reload();
                                        }
                                    })

                                }else {
                                    Swal.fire(dataJson.message, '', 'danger')
                                }
                            },
                            error: function(data){
                                console.log(data);
                            }
                        });
                    }

                });


                $(document).on('click','#updateStatusPayment',function(event){
                    event.preventDefault();
                    var id = $(this).data("id");
                    let token = $("meta[name='csrf-token']").attr("content");
                    $.ajax(
                        {
                            url: '{{ Route('backend.document.changeStatus',['id'=>$post->id]) }}',
                            type: 'PUT',
                            data: {
                                "id": id,
                                "_token": token,
                                "status": 3,
                            },
                            success: function (json) {
                                if(json.status == 'success'){

                                    let timerInterval;
                                    Swal.fire({
                                        title: 'Vui lòng đợi...',
                                        html: '',
                                        timer: 1000,
                                        timerProgressBar: true,
                                        didOpen: () => {
                                            Swal.showLoading()
                                            timerInterval = setInterval(() => {
                                            }, 100)
                                        },
                                        willClose: () => {
                                            clearInterval(timerInterval)
                                        }
                                    }).then((result) => {
                                        if (result.dismiss === Swal.DismissReason.timer) {
                                             window.location.reload();
                                        }
                                    })

                                }else {
                                    Swal.fire(json.message, '', 'danger')
                                }
                            }
                        });


                });



            });

        </script>
    </x-slot>

</x-layout.backend>
