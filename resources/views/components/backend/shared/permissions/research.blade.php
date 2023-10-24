@if(Auth::guard('backend')->user()->canany(['list_research','list_research_all','create_research','delete_research']))
    <div data-kt-menu-trigger="click" class="menu-item @if($controller =='ResearchController') show @endif menu-accordion">
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
                                            <span class="menu-title">Giới thiệu</span>
                                            <span class="menu-arrow"></span>
                                        </span>
        <div class="menu-sub menu-sub-accordion">

            @if(Auth::guard('backend')->user()->can(['list_research_all']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='index' && $controller =='ResearchController') active @endif" href="{{ Route('backend.research.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                        <span class="menu-title">Danh sách</span>
                    </a>
                </div>
            @endif

            @if(Auth::guard('backend')->user()->can(['create_research']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='create' && $controller =='ResearchController') active @endif" href="{{ Route('backend.research.create') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                        <span class="menu-title">Tạo bài viết</span>
                    </a>
                </div>
            @endif


            @if(Auth::guard('backend')->user()->can(['list_category_research_all']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='category' && $controller =='ResearchController') active @endif" href="{{ Route('backend.research.category') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                        <span class="menu-title">Danh mục</span>
                    </a>
                </div>
            @endif

            @if(Auth::guard('backend')->user()->can(['create_category_research']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='createCategory' && $controller =='ResearchController') active @endif" href="{{ Route('backend.research.category.create') }}">
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
