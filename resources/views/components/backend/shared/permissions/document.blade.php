@if(Auth::guard('backend')->user()->canany(['list_document','list_document_all','create_document','delete_document']))
    <div data-kt-menu-trigger="click" class="menu-item @if($controller =='DocumentController') show @endif menu-accordion">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <span class="svg-icon svg-icon-2">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                                                        <path opacity="0.3" d="M8.9 21L7.19999 22.6999C6.79999 23.0999 6.2 23.0999 5.8 22.6999L4.1 21H8.9ZM4 16.0999L2.3 17.8C1.9 18.2 1.9 18.7999 2.3 19.1999L4 20.9V16.0999ZM19.3 9.1999L15.8 5.6999C15.4 5.2999 14.8 5.2999 14.4 5.6999L9 11.0999V21L19.3 10.6999C19.7 10.2999 19.7 9.5999 19.3 9.1999Z" fill="black" />
                                                                        <path d="M21 15V20C21 20.6 20.6 21 20 21H11.8L18.8 14H20C20.6 14 21 14.4 21 15ZM10 21V4C10 3.4 9.6 3 9 3H4C3.4 3 3 3.4 3 4V21C3 21.6 3.4 22 4 22H9C9.6 22 10 21.6 10 21ZM7.5 18.5C7.5 19.1 7.1 19.5 6.5 19.5C5.9 19.5 5.5 19.1 5.5 18.5C5.5 17.9 5.9 17.5 6.5 17.5C7.1 17.5 7.5 17.9 7.5 18.5Z" fill="black" />
                                                                    </svg>
																</span>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <span class="menu-title">Hồ sơ</span>
                                            <span class="menu-arrow"></span>
                                        </span>
        <div class="menu-sub menu-sub-accordion">

            @if(Auth::guard('backend')->user()->can(['list_document_all']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='index' && $controller =='DocumentController') active @endif" href="{{ Route('backend.document.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                        <span class="menu-title">Danh sách</span>
                    </a>
                </div>
            @endif

            @if(Auth::guard('backend')->user()->can(['create_document']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='create' && $controller =='DocumentController') active @endif" href="{{ Route('backend.document.create') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                        <span class="menu-title">Tạo hồ sơ</span>
                    </a>
                </div>
            @endif


            @if(Auth::guard('backend')->user()->can(['list_category_document_all']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='category' && $controller =='DocumentController') active @endif" href="{{ Route('backend.document.category') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                        <span class="menu-title">Danh mục</span>
                    </a>
                </div>
            @endif

            @if(Auth::guard('backend')->user()->can(['create_category_document']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='createCategory' && $controller =='DocumentController') active @endif" href="{{ Route('backend.document.category.create') }}">
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
