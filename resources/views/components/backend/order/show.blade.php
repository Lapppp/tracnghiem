<x-layout.backend>

    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-1 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3" style="display: none !important">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Đơn hàng</h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3" style="display: none !important">
                <!--begin::Filter menu-->
                <div class="m-0">
                    <!--begin::Menu toggle-->
                    <a href="#" class="btn btn-sm btn-flex bg-body btn-color-gray-700 btn-active-color-primary fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                        <span class="svg-icon svg-icon-6 svg-icon-muted me-1">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor" />
												</svg>
											</span>
                        <!--end::Svg Icon-->Filter</a>
                    <!--end::Menu toggle-->
                    <!--begin::Menu 1-->
                    <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_62cfa7f4c00d0">
                        <!--begin::Header-->
                        <div class="px-7 py-5">
                            <div class="fs-5 text-dark fw-bold">Filter Options</div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Menu separator-->
                        <div class="separator border-gray-200"></div>
                        <!--end::Menu separator-->
                        <!--begin::Form-->
                        <div class="px-7 py-5">
                            <!--begin::Input group-->
                            <div class="mb-10">
                                <!--begin::Label-->
                                <label class="form-label fw-semibold">Status:</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <div>
                                    <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_62cfa7f4c00d0" data-allow-clear="true">
                                        <option></option>
                                        <option value="1">Approved</option>
                                        <option value="2">Pending</option>
                                        <option value="2">In Process</option>
                                        <option value="2">Rejected</option>
                                    </select>
                                </div>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="mb-10">
                                <!--begin::Label-->
                                <label class="form-label fw-semibold">Member Type:</label>
                                <!--end::Label-->
                                <!--begin::Options-->
                                <div class="d-flex">
                                    <!--begin::Options-->
                                    <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                        <span class="form-check-label">Author</span>
                                    </label>
                                    <!--end::Options-->
                                    <!--begin::Options-->
                                    <label class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                        <span class="form-check-label">Customer</span>
                                    </label>
                                    <!--end::Options-->
                                </div>
                                <!--end::Options-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="mb-10">
                                <!--begin::Label-->
                                <label class="form-label fw-semibold">Notifications:</label>
                                <!--end::Label-->
                                <!--begin::Switch-->
                                <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
                                    <label class="form-check-label">Enabled</label>
                                </div>
                                <!--end::Switch-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Actions-->
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                                <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Form-->
                    </div>
                    <!--end::Menu 1-->
                </div>
                <!--end::Filter menu-->
                <!--begin::Secondary button-->
                <!--end::Secondary button-->
                <!--begin::Primary button-->
                <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Create</a>
                <!--end::Primary button-->
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!-- begin::Invoice 3-->
            <div class="card">
                <!-- begin::Body-->
                <div class="card-body py-20">
                    <!-- begin::Wrapper-->
                    <div class="mw-lg-950px mx-auto w-100">
                        <!-- begin::Header-->
                        <div class="d-flex justify-content-between flex-column flex-sm-row mb-19">
                            <h4 class="fw-bolder text-gray-800 fs-2qx pe-5 pb-7">ĐƠN HÀNG</h4>
                            <!--end::Logo-->
                            <div class="text-sm-end">
                                <!--begin::Logo-->
                                <a href="#" class="d-block mw-150px ms-sm-auto" style="display: none !important;">
                                    <img alt="Logo" src="assets/media/svg/brand-logos/lloyds-of-london-logo.svg" class="w-100" />
                                </a>
                                <!--end::Logo-->
                                <!--begin::Text-->
                                <div class="text-sm-end fw-semibold fs-4 text-muted mt-7">
                                    <div>{{ $post->address ?? '' }}</div>
                                    <div>{{ $post->hamlet->name ?? '' }}, {{ $post->district->name ?? '' }}, {{ $post->province->name ??  ''}}</div>
                                </div>
                                <!--end::Text-->
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="pb-12">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column gap-7 gap-md-10">
                                <!--begin::Message-->
                                <div class="fw-bold fs-2">Khách hàng: {{ $post->full_name ?? '' }}
                                    @if($post->email)
                                        <span class="fs-6">({{ $post->email ?? '' }})</span>,
                                    @endif
                                </div>
                                <!--begin::Message-->
                                <!--begin::Separator-->
                                <div class="separator"></div>
                                <!--begin::Separator-->
                                <!--begin::Order details-->
                                <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bold">
                                    <div class="flex-root d-flex flex-column">
                                        <span class="text-muted">Mã đơn hàng</span>
                                        <span class="fs-5">#{{ $post->code ?? '' }}</span>
                                    </div>
                                    <div class="flex-root d-flex flex-column">
                                        <span class="text-muted">Ngày tạo</span>
                                        <span class="fs-5">{{ !empty($post->created_at) ? date('d-m-Y',strtotime($post->created_at)) : '' }}</span>
                                    </div>
                                    <div class="flex-root d-flex flex-column">
                                        <span class="text-muted">Phone</span>
                                        <span class="fs-5">{{ $post->phone ?? '' }}</span>
                                    </div>
                                    <div class="flex-root d-flex flex-column">
                                        <span class="text-muted">Phương thức thanh toán</span>
                                        <span class="fs-5">{{ !empty($post->paymentMethod) ?  $paymentMethod[$post->paymentMethod] : '' }}</span>
                                    </div>

                                    <div class="flex-root d-flex flex-column">
                                        <span class="text-muted">Khách hàng</span>
                                        <span class="fs-5">{{ !empty($post->source) ?  $source[$post->source] : '' }}</span>
                                    </div>

                                    <div class="flex-root d-flex flex-column" >
                                        <span class="text-muted">Trạng thái đơn hàng</span>

                                        <select class="form-control" id="status" name="status" data-id="{{ $post->id }}">
                                            @foreach($status as $key => $value)
                                                <option value="{{ $key }}" @if($post->status == $key) selected="selected" @endif>{{ $value }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                                <!--end::Order details-->
                                <!--begin::Billing & shipping-->
                                <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bold" style="display: none !important">
                                    <div class="flex-root d-flex flex-column">
                                        <span class="text-muted">Billing Address</span>
                                        <span class="fs-6">Unit 1/23 Hastings Road,
																<br />Melbourne 3000,
																<br />Victoria,
																<br />Australia.</span>
                                    </div>
                                    <div class="flex-root d-flex flex-column">
                                        <span class="text-muted">Shipping Address</span>
                                        <span class="fs-6">Unit 1/23 Hastings Road,
																<br />Melbourne 3000,
																<br />Victoria,
																<br />Australia.</span>
                                    </div>
                                </div>
                                <!--end::Billing & shipping-->
                                <!--begin:Order summary-->
                                <div class="d-flex justify-content-between flex-column">
                                    <!--begin::Table-->
                                    <div class="table-responsive border-bottom mb-9">
                                        <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                            <thead>
                                            <tr class="border-bottom fs-6 fw-bold text-muted">
                                                <th class="min-w-175px pb-2">Tên sản phẩm</th>
                                                <th class="min-w-70px text-end pb-2">Đơn giá</th>
                                                <th class="min-w-80px text-end pb-2">Số lương</th>
                                                <th class="min-w-100px text-end pb-2">Thành tiền</th>
                                            </tr>
                                            </thead>
                                            <tbody class="fw-semibold text-gray-600">
                                            @if($post->ordersDetail()->get())
                                                @php
                                                    $total = 0;
                                                @endphp

                                                @foreach($post->ordersDetail()->get() as $key => $value)
                                                    @php
                                                        $total+= ($value->price * $value->qty);
                                                        $product = $value->product->name ?? '';
                                                    @endphp
                                                    <!--begin::Products-->
                                                    <tr>
                                                        <!--begin::Product-->
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <!--begin::Thumbnail-->
                                                                @if($value->product->default() && $value->product->default()['url'])
                                                                    <a href="{{ Route('frontend.product.edit',['slug'=>$value->product->slug]) }}" target="_blank" class="symbol symbol-50px">
                                                                        <span class="symbol-label" style="background-image:url('{{ str_replace(Str::of($value->product->default()['url'])->basename(),'thumb_'.Str::of($value->product->default()['url'])->basename(),asset('storage/products/'.$value->product->default()['url'])) }}');"></span>
                                                                    </a>
                                                                @endif
                                                                <!--end::Thumbnail-->
                                                                <!--begin::Title-->
                                                                <div class="ms-5">
                                                                    <div class="fw-bold">{{ $product }}</div>
                                                                    <div class="fs-7 text-muted" style="display: none !important">Delivery Date: 14/07/2022</div>
                                                                </div>
                                                                <!--end::Title-->
                                                            </div>
                                                        </td>
                                                        <!--end::Product-->
                                                        <!--begin::SKU-->
                                                        <td class="text-end">{{ $value->price ? number_format($value->price,0, '.', '.') : '' }} <sup>đ</sup></td>
                                                        <!--end::SKU-->
                                                        <!--begin::Quantity-->
                                                        <td class="text-end">{{ $value->qty ? number_format($value->qty,0, '.', '.') : '' }}</td>
                                                        <!--end::Quantity-->
                                                        <!--begin::Total-->
                                                        <td class="text-end">{{ $value->total ? number_format($value->total,0, '.', '.') : '' }} <sup>đ</sup></td>
                                                        <!--end::Total-->
                                                    </tr>
                                                @endforeach
                                            @endif

                                            <!--begin::Subtotal-->
                                            <tr>
                                                <td colspan="3" class="text-end">Tạm tính </td>
                                                <td class="text-end">{{ $total ? number_format($total,0, '.', '.') : 0 }} <sup>đ</sup></td>
                                            </tr>
                                            <!--end::Subtotal-->
                                            <!--begin::VAT-->
                                            <tr>
                                                <td colspan="3" class="text-end">VAT (0%)</td>
                                                <td class="text-end">0.00 <sup>đ</sup></td>
                                            </tr>
                                            <!--end::VAT-->
                                            <!--begin::Shipping-->
                                            <tr>
                                                <td colspan="3" class="text-end">Tiền Shipping</td>
                                                <td class="text-end">0.00 <sup>đ</sup></td>
                                            </tr>
                                            <!--end::Shipping-->
                                            <!--begin::Grand total-->
                                            <tr>
                                                <td colspan="3" class="fs-3 text-dark fw-bold text-end">Tổng tiền</td>
                                                <td class="text-dark fs-3 fw-bolder text-end">{{ $total ? number_format($total,0, '.', '.') : 0 }} <sup>đ</sup></td>
                                            </tr>
                                            <!--end::Grand total-->
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end:Order summary-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Body-->
                        <!-- begin::Footer-->
                        <div class="d-flex flex-stack flex-wrap mt-lg-20 pt-13" style="display: none !important">
                            <!-- begin::Actions-->
                            <div class="my-1 me-5">
                                <!-- begin::Pint-->
                                <button type="button" class="btn btn-success my-1 me-12" onclick="window.print();">Print Invoice</button>
                                <!-- end::Pint-->
                                <!-- begin::Download-->
                                <button type="button" class="btn btn-light-success my-1">Download</button>
                                <!-- end::Download-->
                            </div>
                            <!-- end::Actions-->
                            <!-- begin::Action-->
                            <a href="../../demo1/dist/apps/invoices/create.html" class="btn btn-primary my-1">Create Invoice</a>
                            <!-- end::Action-->
                        </div>
                        <!-- end::Footer-->
                    </div>
                    <!-- end::Wrapper-->
                </div>
                <!-- end::Body-->
            </div>
            <!-- end::Invoice 1-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->

    <x-slot name="javascript">
        <script type="text/javascript">
            $( document ).ready(function() {

                $(document).on('change','#status',function(event){

                    let order_id = $(this).data('id');
                    let status = $(this).val();
                    let token = $("meta[name='csrf-token']").attr("content");
                    $.ajax(
                        {
                            url: '{{ Route('backend.order.update',['id'=>$post->id]) }}',
                            type: 'PUT',
                            data: {
                                "id": '{{$post->id}}',
                                "status": status,
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

                })

            });
        </script>
    </x-slot>


</x-layout.backend>
