@if(Auth::guard('backend')->user()->canany(['list_question','list_question_all','question_create','question_delete','question_edit']))
    <div data-kt-menu-trigger="click" class="menu-item @if($controller =='CommentController') show @endif menu-accordion">
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path opacity="0.3" d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z" fill="currentColor"></path>
														<rect x="6" y="12" width="7" height="2" rx="1" fill="currentColor"></rect>
														<rect x="6" y="7" width="12" height="2" rx="1" fill="currentColor"></rect>
													</svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <span class="menu-title">Đánh giá sản phẩm</span>
                                            <span class="menu-arrow"></span>
                                        </span>
        <div class="menu-sub menu-sub-accordion">

                <div class="menu-item">
                    <a class="menu-link @if($actionName =='index' && $controller =='CommentController') active @endif" href="{{ Route('backend.comments.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                        <span class="menu-title">Danh sách</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link @if($actionName =='create' && $controller =='CommentController') active @endif" href="{{ Route('backend.comments.create') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                        <span class="menu-title">Tạo mới</span>
                    </a>
                </div>





        </div>
    </div>
@endif
