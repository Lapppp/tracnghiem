@if(Auth::guard('backend')->user()->canany(['list_test','list_test_all','test_create','test_delete','test_edit']))
    <div data-kt-menu-trigger="click" class="menu-item @if($controller =='TestsController') show @endif menu-accordion">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                                                <span class="svg-icon svg-icon-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.3" d="M11.8 5.2L17.7 8.6V15.4L11.8 18.8L5.90001 15.4V8.6L11.8 5.2ZM11.8 2C11.5 2 11.2 2.1 11 2.2L3.8 6.4C3.3 6.7 3 7.3 3 7.9V16.2C3 16.8 3.3 17.4 3.8 17.7L11 21.9C11.3 22 11.5 22.1 11.8 22.1C12.1 22.1 12.4 22 12.6 21.9L19.8 17.7C20.3 17.4 20.6 16.8 20.6 16.2V7.9C20.6 7.3 20.3 6.7 19.8 6.4L12.6 2.2C12.4 2.1 12.1 2 11.8 2Z" fill="currentColor"></path>
                                                    <path d="M11.8 8.69995L8.90001 10.3V13.7L11.8 15.3L14.7 13.7V10.3L11.8 8.69995Z" fill="currentColor"></path>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <span class="menu-title">Bài kiểm tra</span>
                                            <span class="menu-arrow"></span>
                                        </span>
        <div class="menu-sub menu-sub-accordion">

            @if(Auth::guard('backend')->user()->can(['list_test_all']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='index' && $controller =='TestsController') active @endif" href="{{ Route('backend.test.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                        <span class="menu-title">Danh sách</span>
                    </a>
                </div>
            @endif

            @if(Auth::guard('backend')->user()->can(['test_create']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='create' && $controller =='TestsController') active @endif" href="{{ Route('backend.test.create') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                        <span class="menu-title">Tạo mới</span>
                    </a>
                </div>
            @endif


                @if(Auth::guard('backend')->user()->can(['test_create']))
                    <div class="menu-item">
                        <a class="menu-link @if($actionName =='createEnglish' && $controller =='TestsController') active @endif" href="{{ Route('backend.test.createEnglish') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                            <span class="menu-title">Tạo bài kiểm tra Tiếng Anh</span>
                        </a>
                    </div>
                @endif



        </div>
    </div>
@endif
