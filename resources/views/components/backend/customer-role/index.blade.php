<x-layout.backend>
    @include('components.backend.shared.messages')
    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">Danh sách vai trò người dùng</span>
            </h3>
            <div class="card-toolbar">
                <!--begin::Menu-->
                <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                    <span class="svg-icon svg-icon-2">
													<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
															<rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
															<rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
															<rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
														</g>
													</svg>
												</span>
                    <!--end::Svg Icon-->
                </button>
                <!--begin::Menu 2-->
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px" data-kt-menu="true">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <div class="menu-content fs-6 text-dark fw-bolder px-3 py-4">Xem nhanh</div>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="separator mb-3 opacity-75"></div>
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->
                    @if(Auth::guard('backend')->user()->can(['create_customer_role']))
                    <div class="menu-item px-3">
                        <a href="{{ Route('backend.customer_role.create') }}" class="menu-link px-3">Tạo vai trò</a>
                    </div>
                    @endif
                    <!--end::Menu item-->

                </div>
                <!--end::Menu 2-->
                <!--end::Menu-->
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
                        <th class="ps-4 min-w-300px rounded-start">Tên vai trò</th>
                        <th class="min-w-125px">Guard</th>
                        <th class="min-w-125px">Comission</th>
                        <th class="min-w-200px">Ngày tạo</th>
                        <th class="min-w-150px">Ngày cập nhật</th>
                        <th class="min-w-200px text-end rounded-end"></th>
                    </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                    @if(count($roles) > 0)
                        @foreach($roles as $role)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-5">
                                                                            <span class="symbol-label bg-light">
                                                                                <img src="{{ Avatar::create($role->customize_name)->toBase64() }}" class="h-75 align-self-end" alt="" />
                                                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="{{ Route('backend.customer_role.edit',['id'=>$role->id]) }}" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $role->customize_name }}</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted fw-bold text-muted d-block fs-7">{{ $role->guard_name }}</span>
                                </td>
                                <td>
                                    <span class="text-muted fw-bold text-muted d-block fs-7">-</span>
                                </td>
                                <td>
                                    <span class="text-muted fw-bold text-muted d-block fs-7">
                                        {{ $role->created_at ? date('d/m/Y',strtotime($role->created_at)) :'' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-muted fw-bold text-muted d-block fs-7 mt-1">{{ $role->updated_at ? date('d/m/Y',strtotime($role->updated_at)) :'' }}</span>
                                </td>
                                <td class="text-end">
                                    @if(Auth::guard('backend')->user()->can(['edit_customer_role']))
                                        <a href="{{ Route('backend.customer_role.edit',['id'=>$role->id]) }}" class="btn btn-bg-light btn-color-muted btn-active-color-primary btn-sm px-4 me-2">Sửa</a>
                                    @endif
                                    @if(Auth::guard('backend')->user()->can(['delete_customer_role']))
                                    <a href="#" class="btn btn-bg-light btn-color-muted btn-active-color-primary btn-sm px-4">Xóa</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @endif

                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table container-->
        </div>
        <!--begin::Body-->
    </div>
</x-layout.backend>
