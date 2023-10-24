@if(Auth::guard('backend')->user()->canany(['list_advise','list_advise_all','advise_create','advise_delete','advise_edit']))
    <div data-kt-menu-trigger="click" class="menu-item @if($controller =='AdviseController') show @endif menu-accordion">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                                                <span class="svg-icon svg-icon-2">
													<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path opacity="0.3" d="M7 20.5L2 17.6V11.8L7 8.90002L12 11.8V17.6L7 20.5ZM21 20.8V18.5L19 17.3L17 18.5V20.8L19 22L21 20.8Z" fill="currentColor"></path>
														<path d="M22 14.1V6L15 2L8 6V14.1L15 18.2L22 14.1Z" fill="currentColor"></path>
													</svg>
												</span>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <span class="menu-title">Thông tin liên hệ</span>
                                            <span class="menu-arrow"></span>
                                        </span>
        <div class="menu-sub menu-sub-accordion">

            @if(Auth::guard('backend')->user()->can(['list_advise_all']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='index' && $controller =='AdviseController') active @endif" href="{{ Route('backend.advise.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                        <span class="menu-title">Danh sách</span>
                    </a>
                </div>
            @endif

            @if(Auth::guard('backend')->user()->can(['advise_create']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='create' && $controller =='AdviseController') active @endif" href="{{ Route('backend.advise.create') }}">
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
