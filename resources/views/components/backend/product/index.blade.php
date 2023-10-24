<x-layout.backend>

    @include('components.backend.shared.messages')
    <div class="card mb-5 mb-xl-8">
        <form method="get" action="">
        <!--begin::Header-->
        <div class="card-header align-items-center py-5 gap-2 gap-md-5">

            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-1 position-absolute ms-4">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
															<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
														</svg>
													</span>
                    <!--end::Svg Icon-->
                    <input type="text" data-kt-ecommerce-product-filter="search" value="{{ $params['search'] ?? '' }}" name="search" id="search" class="form-control form-control-solid w-250px ps-14" placeholder="Nhập tên sản phẩm" />
                </div>
                <!--end::Search-->
            </div>
            <!--end::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">

                <div class="w-200px mw-200px">
                    <!--begin::Select2-->
                    <select class="form-select form-select-solid" name="category_id" id="category_id" data-control="select2" data-hide-search="false" data-placeholder="Trạng thái" data-kt-ecommerce-product-filter="status">
                        <option value="0">Tất cả</option>
                        @foreach ($category as $key => $value)
                            @if(count($value->childrenCategories()->get()) > 0)
                                <optgroup label="{{ $value->name ?? '' }}">
                                    @foreach($value->childrenCategories as $k =>$v)
                                        <option value="{{ $v->id }}" {{ old('category_id',isset($params['category_id']) && !empty($params['category_id']) ? $params['category_id'] : '') == $v->id ? "selected" : "" }}>{{ $v->name  }}</option>
                                    @endforeach
                                </optgroup>
                            @else
                                <option value="{{ $value->id }}" {{ old('category_id',isset($params['category_id']) && !empty($params['category_id']) ? $params['category_id'] : '') == $value->id ? "selected" : "" }}>{{ $value->name  }}</option>
                            @endif
                        @endforeach
                    </select>
                    <!--end::Select2-->
                </div>


                <div class="w-100 mw-150px">
                    <!--begin::Select2-->
                    <select class="form-select form-select-solid" name="status" id="status" data-control="select2" data-hide-search="true" data-placeholder="Trạng thái" data-kt-ecommerce-product-filter="status">
                        <option value="0">Tất cả</option>
                        @foreach ($status as $key => $value)
                            <option value="{{ $key }}" {{  isset($statusSearch) && $statusSearch == $key ? "selected" : "" }}>{{ $value }}</option>
                        @endforeach
                    </select>
                    <!--end::Select2-->
                </div>
                <!--begin::Add product-->
                <button  class="btn btn-primary" type="submit">Tìm kiếm</button>
                <button  class="btn btn-danger" type="button" id="exportExcel">
                    <span class="spinner-border spinner-border-sm" role="status" style="display: none" id="loadingExport" aria-hidden="true"></span> Xuất Excel
                </button>

                @if(Auth::guard('backend')->user()->can(['create_product']))
                    <a href="{{ Route('backend.product.create') }}" class="btn  btn-light-primary">
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

                <!--end::Add product-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Header-->
        </form>

        <!--begin::Body-->
        <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table align-middle gs-0 gy-4">
                    <!--begin::Table head-->
                    <thead>
                    <tr class="fw-bolder text-muted bg-light">
                        <th class="ps-4 w-25 rounded-start">Tiêu đề</th>
                        <th class="min-w-125px">Ngày tạo</th>
                        <th class="min-w-125px">Ngày cập nhật</th>
                        <th class="min-w-125px">Tùy chọn</th>
                        <th class="min-w-125px">Trạng thái</th>
                        <th class="min-w-25px text-end rounded-end"></th>
                    </tr>
                    </thead>
                    <tbody>

                    @if(count($items) > 0)
                        @foreach($items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-5">
                                            @if($item->default() && $item->default()['url'])
                                                <img src="{{ str_replace(Str::of($item->default()['url'])->basename(),'thumb_50x50_'.Str::of($item->default()['url'])->basename(),asset('storage/products/'.$item->default()['url'])) }}"
                                                     class=""
                                                     alt=""/>
                                            @else
                                                <img src="{{ Avatar::create($item->name)->toBase64() }}"
                                                     class=""
                                                     alt=""/>
                                            @endif
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $item->name }}</a>
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
                                <td>
                                    @if($item->options == 1)
                                        <span class="badge badge-light-primary fs-7 fw-bold">{{ $options[$item->options] }}</span>
                                    @else
                                        <span class="badge badge-light-danger fs-7 fw-bold">{{ $options[$item->options] }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->status == 1)
                                        <span class="badge badge-light-primary fs-7 fw-bold">{{ $status[$item->status] }}</span>
                                    @else
                                        <span class="badge badge-light-danger fs-7 fw-bold">{{ $status[$item->status] }}</span>
                                    @endif
                                </td>
                                <td class="text-end">

                                    <a href="{{ Route('frontend.product.edit',['slug'=>$item->slug]) }}" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Xem trang" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <i class="bi bi-arrow-up-right"></i>
                                    </a>

                                    @if(Auth::guard('backend')->user()->can(['edit_product']))
                                    <a href="{{ Route('backend.product.edit',['id'=>$item->id]) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Sửa" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    @endif

                                    @if(Auth::guard('backend')->user()->can(['delete_product']))
                                    <a href="#" data-bs-toggle="tooltip" data-id="{{ $item->id }}" data-bs-placement="top" title="Xóa" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm deleteAction">
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
                                    url: baseUrl+"/product/delete/"+id,
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


                $(document).on('click','#exportExcel',function(event) {
                    let token = $("meta[name='csrf-token']").attr("content");
                    let search = $('#search').val();
                    let status = $('#status').val();
                    let category_id = $('#category_id').val();
                    $('#loadingExport').show();
                    $('#exportExcel').attr('disabled','disabled');
                    $.ajax({
                        type: "POST",
                        url: "{{ Route('backend.product.export') }}",
                        dataType: "json",
                        data: {_token: token,search:search,status:status,category_id:category_id},
                        success: function (jsonResponse) {
                            $('#loadingExport').hide();
                            $('#exportExcel').removeAttr('disabled');
                            if (jsonResponse.status == 'success') {

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
                                       window.location.href = jsonResponse.data.url;
                                    }
                                })

                            }else {
                                Swal.fire(jsonResponse.message, '', 'danger')
                            }

                        }
                    })

                });


            });
        </script>
    </x-slot>

</x-layout.backend>
