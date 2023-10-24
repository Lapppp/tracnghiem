@if(Auth::guard('backend')->user()->canany(['list_product','list_product_all','create_product','delete_product']))
    <div data-kt-menu-trigger="click" class="menu-item @if($controller =='ProductController') show @endif menu-accordion">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <span class="svg-icon svg-icon-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                                                            <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />
                                                            <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />
                                                            <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />
												        </svg>
                                                    </span>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <span class="menu-title">Sản phẩm</span>
                                            <span class="menu-arrow"></span>
                                        </span>
        <div class="menu-sub menu-sub-accordion">

            @if(Auth::guard('backend')->user()->can(['list_product_all']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='index' && $controller =='ProductController') active @endif" href="{{ Route('backend.product.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                        <span class="menu-title">Danh sách</span>
                    </a>
                </div>
            @endif

            @if(Auth::guard('backend')->user()->can(['create_product']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='create' && $controller =='ProductController') active @endif" href="{{ Route('backend.product.create') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                        <span class="menu-title">Tạo sản phẩm mới</span>
                    </a>
                </div>
            @endif


            @if(Auth::guard('backend')->user()->can(['list_category_product_all']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='category' && $controller =='ProductController') active @endif" href="{{ Route('backend.product.category') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                        <span class="menu-title">Danh mục</span>
                    </a>
                </div>
            @endif

            @if(Auth::guard('backend')->user()->can(['create_category_product']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='createCategory' && $controller =='ProductController') active @endif" href="{{ Route('backend.product.category.create') }}">
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
