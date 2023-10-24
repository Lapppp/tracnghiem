<x-layout.backend>

    @include('components.backend.shared.messages')
    <div class="card mb-5 mb-xl-8">

        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">Danh sách</span>
            </h3>
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
                        <th class="ps-4 min-w-125px rounded-start">Tên công ty</th>
                        <th class="ps-4 w-25">Giấy CNĐKDN</th>
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
                                            <a href="{{ Route('backend.company.edit',['id'=>$item->id]) }}" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $item->name }}</a>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <span class="text-muted fw-bold text-muted d-block fs-7">
                                        {{ $item->certificate ?? '' }}
                                    </span>

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

                                    @if(Auth::guard('backend')->user()->can(['company_edit']))
                                    <a href="{{ Route('backend.company.edit',['id'=>$item->id]) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Sửa" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <i class="bi bi-pencil-square"></i>
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
                                    url: baseUrl+"/company/delete/"+id,
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
