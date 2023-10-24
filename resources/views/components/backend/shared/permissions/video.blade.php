@if(Auth::guard('backend')->user()->canany(['list_video','list_video_all','video_create','video_delete','video_edit']))
    <div data-kt-menu-trigger="click" class="menu-item @if($controller =='VideoController') show @endif menu-accordion">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"  viewBox="0 0 24 24">
                                                      <path   d="M6 3a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM1 3a2 2 0 1 0 4 0 2 2 0 0 0-4 0z" fill="black"/>
                                                      <path  d="M9 6h.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 7.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 16H2a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h7zm6 8.73V7.27l-3.5 1.555v4.35l3.5 1.556zM1 8v6a1 1 0 0 0 1 1h7.5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1z" fill="black"/>
                                                      <path  d="M9 6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM7 3a2 2 0 1 1 4 0 2 2 0 0 1-4 0z" fill="black"/>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <span class="menu-title">Videos</span>
                                            <span class="menu-arrow"></span>
                                        </span>
        <div class="menu-sub menu-sub-accordion">

            @if(Auth::guard('backend')->user()->can(['list_video_all']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='index' && $controller =='VideoController') active @endif" href="{{ Route('backend.video.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                        <span class="menu-title">Danh sách</span>
                    </a>
                </div>
            @endif

            @if(Auth::guard('backend')->user()->can(['video_create']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='create' && $controller =='VideoController') active @endif" href="{{ Route('backend.video.create') }}">
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
