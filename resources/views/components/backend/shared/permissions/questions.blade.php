@if(Auth::guard('backend')->user()->canany(['list_questions','list_questions_all','create_questions','delete_questions']))
    <div data-kt-menu-trigger="click" class="menu-item @if($controller =='QuestionsController') show @endif menu-accordion">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                                               <span class="svg-icon svg-icon-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.0021 10.9128V3.01281C13.0021 2.41281 13.5021 1.91281 14.1021 2.01281C16.1021 2.21281 17.9021 3.11284 19.3021 4.61284C20.7021 6.01284 21.6021 7.91285 21.9021 9.81285C22.0021 10.4129 21.5021 10.9128 20.9021 10.9128H13.0021Z" fill="currentColor"></path>
                                                <path opacity="0.3" d="M11.0021 13.7128V4.91283C11.0021 4.31283 10.5021 3.81283 9.90208 3.91283C5.40208 4.51283 1.90209 8.41284 2.00209 13.1128C2.10209 18.0128 6.40208 22.0128 11.3021 21.9128C13.1021 21.8128 14.7021 21.3128 16.0021 20.4128C16.5021 20.1128 16.6021 19.3128 16.1021 18.9128L11.0021 13.7128Z" fill="currentColor"></path>
                                                <path opacity="0.3" d="M21.9021 14.0128C21.7021 15.6128 21.1021 17.1128 20.1021 18.4128C19.7021 18.9128 19.0021 18.9128 18.6021 18.5128L13.0021 12.9128H20.9021C21.5021 12.9128 22.0021 13.4128 21.9021 14.0128Z" fill="currentColor"></path>
                                                </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <span class="menu-title">Câu hỏi</span>
                                            <span class="menu-arrow"></span>
                                        </span>
        <div class="menu-sub menu-sub-accordion">

            @if(Auth::guard('backend')->user()->can(['list_questions_all']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='index' && $controller =='QuestionsController') active @endif" href="{{ Route('backend.questions.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                        <span class="menu-title">Danh sách</span>
                    </a>
                </div>
            @endif

            @if(Auth::guard('backend')->user()->can(['create_questions']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='create' && $controller =='QuestionsController') active @endif" href="{{ Route('backend.questions.create') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                        <span class="menu-title">Tạo câu hỏi</span>
                    </a>
                </div>
            @endif

                @if(Auth::guard('backend')->user()->can(['create_questions']))
                    <div class="menu-item">
                        <a class="menu-link @if($actionName =='createEnglish' && $controller =='QuestionsController') active @endif" href="{{ Route('backend.questions.createEnglish') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                            <span class="menu-title">Tạo câu hỏi tiếng anh</span>
                        </a>
                    </div>
                @endif

            @if(Auth::guard('backend')->user()->can(['import_excel_questions']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='import' && $controller =='QuestionsController') active @endif" href="{{ Route('backend.questions.import') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                        <span class="menu-title">Import câu hỏi</span>
                    </a>
                </div>
            @endif

            @if(Auth::guard('backend')->user()->can(['list_category_questions_all']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='category' && $controller =='QuestionsController') active @endif" href="{{ Route('backend.questions.category') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                        <span class="menu-title">Danh mục</span>
                    </a>
                </div>
            @endif

            @if(Auth::guard('backend')->user()->can(['create_category_questions']))
                <div class="menu-item">
                    <a class="menu-link @if($actionName =='createCategory' && $controller =='QuestionsController') active @endif" href="{{ Route('backend.questions.category.create') }}">
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
