@if(Auth::guard('backend')->user()->canany(['list_wisdom','list_wisdom_all','create_wisdom','delete_wisdom']))
    <div data-kt-menu-trigger="click" class="menu-item @if($controller =='WisdomController') show @endif menu-accordion">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <span class="svg-icon svg-icon-2">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path opacity="0.3" d="M21 18.3V4H20H5C4.4 4 4 4.4 4 5V20C10.9 20 16.7 15.6 19 9.5V18.3C18.4 18.6 18 19.3 18 20C18 21.1 18.9 22 20 22C21.1 22 22 21.1 22 20C22 19.3 21.6 18.6 21 18.3Z" fill="black" />
																		<path d="M22 4C22 2.9 21.1 2 20 2C18.9 2 18 2.9 18 4C18 4.7 18.4 5.29995 18.9 5.69995C18.1 12.6 12.6 18.2 5.70001 18.9C5.30001 18.4 4.7 18 4 18C2.9 18 2 18.9 2 20C2 21.1 2.9 22 4 22C4.8 22 5.39999 21.6 5.79999 20.9C13.8 20.1 20.1 13.7 20.9 5.80005C21.6 5.40005 22 4.8 22 4Z" fill="black" />
																	</svg>
																</span>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <span class="menu-title">Quản trị tài sản trí tuệ</span>
                                            <span class="menu-arrow"></span>
                                        </span>
        <div class="menu-sub menu-sub-accordion">

            @if(Auth::guard('backend')->user()->can(['list_wisdom_all']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='index' && $controller =='WisdomController') active @endif" href="{{ Route('backend.wisdom.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                        <span class="menu-title">Danh sách</span>
                    </a>
                </div>
            @endif

            @if(Auth::guard('backend')->user()->can(['create_wisdom']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='create' && $controller =='WisdomController') active @endif" href="{{ Route('backend.wisdom.create') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                        <span class="menu-title">Tạo bài viết</span>
                    </a>
                </div>
            @endif


            @if(Auth::guard('backend')->user()->can(['list_category_wisdom_all']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='category' && $controller =='WisdomController') active @endif" href="{{ Route('backend.wisdom.category') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                        <span class="menu-title">Danh mục</span>
                    </a>
                </div>
            @endif

            @if(Auth::guard('backend')->user()->can(['create_category_wisdom']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='createCategory' && $controller =='WisdomController') active @endif" href="{{ Route('backend.wisdom.category.create') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                        <span class="menu-title">Tạo danh mục</span>
                    </a>
                </div>
            @endif


        </div>
    </div>
@endif
