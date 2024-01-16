<!--begin::Aside menu-->
<div class="aside-menu flex-column-fluid">
    <!--begin::Aside Menu-->
    <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
         data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
         data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
         data-kt-scroll-offset="0">
        <!--begin::Menu-->
        <div
            class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
            id="#kt_aside_menu" data-kt-menu="true">
            <div class="menu-item">
                <div class="menu-content pb-2">
                    <span class="menu-section text-muted text-uppercase fs-8 ls-1">Dashboard</span>
                </div>
            </div>
            <div class="menu-item">
                <a class="menu-link" href="{{ Route('backend.dashboard.index') }}">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none">
													<rect x="2" y="2" width="9" height="9" rx="2" fill="black"/>
													<rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2"
                                                          fill="black"/>
													<rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2"
                                                          fill="black"/>
													<rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2"
                                                          fill="black"/>
												</svg>
											</span>
                                            <!--end::Svg Icon-->
										</span>
                    <span class="menu-title">Default</span>
                </a>
            </div>

            <div class="menu-item">
                <div class="menu-content pt-8 pb-2">
                    <span class="menu-section text-muted text-uppercase fs-8 ls-1">Administrator</span>
                </div>
            </div>


            @include('components.backend.shared.permissions.admin')
            @include('components.backend.shared.permissions.role-admin')
            @include('components.backend.shared.permissions.document')
            @include('components.backend.shared.permissions.order')
            @include('components.backend.shared.permissions.product')
            @include('components.backend.shared.permissions.news')
            @include('components.backend.shared.permissions.questions')
            @include('components.backend.shared.permissions.wisdom')
            @include('components.backend.shared.permissions.research')
            @include('components.backend.shared.permissions.guide')
            @include('components.backend.shared.permissions.terms')
            @include('components.backend.shared.permissions.banner')
            @include('components.backend.shared.permissions.bgbanner')
            @include('components.backend.shared.permissions.department')
            @include('components.backend.shared.permissions.region')
            @include('components.backend.shared.permissions.brand')
            @include('components.backend.shared.permissions.unit')
            @include('components.backend.shared.permissions.subject')
            @include('components.backend.shared.permissions.test')
            @include('components.backend.shared.permissions.advise')
            @include('components.backend.shared.permissions.video')
            @include('components.backend.shared.permissions.showroom')
            @include('components.backend.shared.permissions.question')
            @include('components.backend.shared.permissions.comment')
            @include('components.backend.shared.permissions.company')
            @include('components.backend.shared.permissions.support')
            @include('components.backend.shared.permissions.user')

            <div class="menu-item">
                <div class="menu-content">
                    <div class="separator mx-1 my-4"></div>
                </div>
            </div>

        </div>
        <!--end::Menu-->
    </div>
    <!--end::Aside Menu-->
</div>
<!--end::Aside menu-->
