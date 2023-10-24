@if(Auth::guard('backend')->user()->canany(['list_support','list_support_all','support_create','support_delete','support_edit']))
    <div data-kt-menu-trigger="click" class="menu-item @if($controller =='SupportController') show @endif menu-accordion">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M13 5.91517C15.8 6.41517 18 8.81519 18 11.8152C18 12.5152 17.9 13.2152 17.6 13.9152L20.1 15.3152C20.6 15.6152 21.4 15.4152 21.6 14.8152C21.9 13.9152 22.1 12.9152 22.1 11.8152C22.1 7.01519 18.8 3.11521 14.3 2.01521C13.7 1.91521 13.1 2.31521 13.1 3.01521V5.91517H13Z" fill="currentColor"></path>
														<path opacity="0.3" d="M19.1 17.0152C19.7 17.3152 19.8 18.1152 19.3 18.5152C17.5 20.5152 14.9 21.7152 12 21.7152C9.1 21.7152 6.50001 20.5152 4.70001 18.5152C4.30001 18.0152 4.39999 17.3152 4.89999 17.0152L7.39999 15.6152C8.49999 16.9152 10.2 17.8152 12 17.8152C13.8 17.8152 15.5 17.0152 16.6 15.6152L19.1 17.0152ZM6.39999 13.9151C6.19999 13.2151 6 12.5152 6 11.8152C6 8.81517 8.2 6.41515 11 5.91515V3.01519C11 2.41519 10.4 1.91519 9.79999 2.01519C5.29999 3.01519 2 7.01517 2 11.8152C2 12.8152 2.2 13.8152 2.5 14.8152C2.7 15.4152 3.4 15.7152 4 15.3152L6.39999 13.9151Z" fill="currentColor"></path>
													</svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <span class="menu-title">Hỗ trợ khách hàng</span>
                                            <span class="menu-arrow"></span>
                                        </span>
        <div class="menu-sub menu-sub-accordion">

            @if(Auth::guard('backend')->user()->can(['list_support_all']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='index' && $controller =='SupportController') active @endif" href="{{ Route('backend.support.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                        <span class="menu-title">Danh sách</span>
                    </a>
                </div>
            @endif

            @if(Auth::guard('backend')->user()->can(['support_create']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='create' && $controller =='SupportController') active @endif" href="{{ Route('backend.support.create') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                        <span class="menu-title">Tạo mới</span>
                    </a>
                </div>
            @endif




        </div>
    </div>
@endif
