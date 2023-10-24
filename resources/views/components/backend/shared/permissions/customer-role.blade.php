@if(Auth::guard('backend')->user()->canany(['list_customer_role','list_customer_role_all','create_customer_role','delete_customer_role','edit_customer_role']))
    <div data-kt-menu-trigger="click" class="menu-item @if($controller =='CustomerRoleController') show @endif menu-accordion">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path opacity="0.3" d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z" fill="black" />
													<path d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z" fill="black" />
												</svg>

                                                </span>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <span class="menu-title">Vai trò khách hàng</span>
                                            <span class="menu-arrow"></span>
                                        </span>
        <div class="menu-sub menu-sub-accordion">
            @if(Auth::guard('backend')->user()->can(['list_customer_role_all']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='index' && $controller =='CustomerRoleController') active @endif" href="{{ Route('backend.customer_role.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                        <span class="menu-title">Danh sách</span>
                    </a>
                </div>
            @endif
            @if(Auth::guard('backend')->user()->can(['create_customer_role']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='create' && $controller =='CustomerRoleController') active @endif" href="{{ Route('backend.customer_role.create') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                        <span class="menu-title">Tạo vai trò</span>
                    </a>
                </div>
            @endif

        </div>
    </div>
@endif
