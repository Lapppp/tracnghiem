<x-layout.backend>

    @include('components.backend.shared.messages')
    <div class="card mb-5 mb-xl-8">

        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">Danh sách</span>
            </h3>
            <div class="card-toolbar">
                @if(Auth::guard('backend')->user()->can(['brand_create']))
                <a href="{{ Route('backend.brand.create') }}" class="btn btn-sm btn-light-primary">
                    <!--begin::Svg Icon | path: icons/duotone/Communication/Add-user.svg-->
                    <span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                     viewBox="0 0 24 24" version="1.1">
													<path
                                                        d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                                        fill="#000000" fill-rule="nonzero" opacity="0.3"/>
													<path
                                                        d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                                        fill="#000000" fill-rule="nonzero"/>
												</svg>
											</span>
                    <!--end::Svg Icon-->Tạo mới</a>
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
                        <th class="ps-4 min-w-325px rounded-start">Tên thương hiệu</th>
                        <th class="min-w-125px">Ngày tạo</th>
                        <th class="min-w-125px">Ngày cập nhật</th>
                        <th class="min-w-25px text-end rounded-end"></th>
                    </tr>
                    </thead>
                    <tbody>

                    @if(count($items) > 0)
                        @foreach($items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-5"></div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="{{ Route('backend.brand.edit',['id'=>$item->id]) }}" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $item->name }}</a>
                                        </div>
                                    </div>
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

                                <td class="text-end">

                                    @if(Auth::guard('backend')->user()->can(['brand_edit']))
                                    <a href="{{ Route('backend.brand.edit',['id'=>$item->id]) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Sửa" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    @endif

                                    @if(Auth::guard('backend')->user()->can(['brand_delete']))
                                    <a href="#" data-bs-toggle="tooltip" data-id="{{ $item->id }}" data-bs-placement="top" title="Xóa" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm deleteAction">
                                        <i class="bi bi-trash"></i>
                                        <!--end::Svg Icon-->
                                    </a>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    @else
                        @include('components.backend.shared.band')
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

{{--            @includeIf('components.backend.shared.pagination', ['total' => count($items)])--}}


        </div>
        <!--begin::Body-->
    </div>


    <x-slot name="javascript">
        <script type="text/javascript">
            $(document).ready(function() {

                $(document).on('click','.deleteAction',function(event)
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
                            let id = $(this).data("id");
                            let token = $("meta[name='csrf-token']").attr("content");
                            $.ajax(
                                {
                                    url: baseUrl+"/brand/delete/"+id,
                                    type: 'DELETE',
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

            });
        </script>
    </x-slot>

</x-layout.backend>
