@if(Auth::guard('backend')->user()->canany(['list_admins','create_admins','delete_admin']))
    <div data-kt-menu-trigger="click"
         class="menu-item @if($controller =='AdminController') show @endif menu-accordion">
                                            <span class="menu-link">
                                                <span class="menu-icon">
                                                    <!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none">
                                                            <path
                                                                d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                                                                fill="black"/>
                                                            <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4"
                                                                  fill="black"/>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                                <span class="menu-title">Tài khoản Administrator</span>
                                                <span class="menu-arrow"></span>
                                            </span>
        <div class="menu-sub menu-sub-accordion menu-active-bg">
            @if(Auth::guard('backend')->user()->can(['list_admins']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='index' && $controller =='AdminController' ) active @endif "
                       href="{{ Route('backend.admin.index') }}">
                                                                <span class="menu-bullet">
                                                                    <span class="bullet bullet-dot"></span>
                                                                </span>
                        <span class="menu-title">Danh sách</span>
                    </a>
                </div>
            @endif
            @if(Auth::guard('backend')->user()->can(['create_admins']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='create' && $controller =='AdminController') active @endif "
                       href="{{ Route('backend.admin.create') }}">
                                                                <span class="menu-bullet">
                                                                    <span class="bullet bullet-dot"></span>
                                                                </span>
                        <span class="menu-title">Tạo tài khoản mới</span>
                    </a>
                </div>
            @endif
        </div>
    </div>
@endif
