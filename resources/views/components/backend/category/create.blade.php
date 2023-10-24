<x-layout.backend>

    <x-slot name="toolbar">
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Category</h1>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-200 border-start mx-4"></span>
                    <!--end::Separator-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ Route('backend.dashboard.index') }}" class="text-muted text-hover-primary">Dashboard</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-200 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ Route('backend.category.index') }}" class="text-muted text-hover-primary">List Category</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-200 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-dark">Create</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->

                <!--end::Actions-->
            </div>
            <!--end::Container-->
        </div>
    </x-slot>

    <div class="card">
        <!--begin::Body-->
        <div class="card-body p-lg-17">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-lg-row mb-17">
                <!--begin::Content-->
                <div class="flex-lg-row-fluid me-0 me-lg-20">

{{--                    @if ($errors->any())--}}
{{--                        <div class="alert alert-danger">--}}
{{--                                @foreach ($errors->all() as $error)--}}
{{--                                    {{ $error }}--}}
{{--                                @endforeach--}}
{{--                        </div>--}}
{{--                @endif--}}



                <!--begin::Form-->
                    <form action="{{ Route('backend.category.store') }}" class="form mb-15 fv-plugins-bootstrap5 fv-plugins-framework" method="post" id="kt_careers_form">
                        @csrf

                        <textarea name="demotext" id="text" cols="30" rows="10"></textarea>
                        <script src={{ url('ckeditor/ckeditor.js') }}></script>
                        <script>
                            CKEDITOR.replace( 'demotext', {

                                filebrowserBrowseUrl     : "{{ route('ckfinder_browser') }}",
                                filebrowserImageBrowseUrl: "{{ route('ckfinder_browser') }}?type=Images&token=123",
                                filebrowserFlashBrowseUrl: "{{ route('ckfinder_browser') }}?type=Flash&token=123",
                                filebrowserUploadUrl     : "{{ route('ckfinder_connector') }}?command=QuickUpload&type=Files",
                                filebrowserImageUploadUrl: "{{ route('ckfinder_connector') }}?command=QuickUpload&type=Images",
                                filebrowserFlashUploadUrl: "{{ route('ckfinder_connector') }}?command=QuickUpload&type=Flash",
                            } );
                        </script>
                        @include('ckfinder::setup')

                        <div class="d-flex flex-column mb-5 fv-row">
                            <label class="required fs-5 fw-bold mb-2">Name</label>
                            <input class="form-control form-control-solid" placeholder="" name="name" id="name">
                            @if ($errors->has('name'))
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div data-field="target_title" data-validator="notEmpty">{{ $errors->first('name') }}</div>
                            </div>
                            @endif
                        </div>

                        <div class="d-flex flex-column mb-5 fv-row">
                            <label class="required fs-5 fw-bold mb-2">English Name</label>
                            <input class="form-control form-control-solid" placeholder="" name="name_en" id="name_en">
                        </div>
                        <!--end::Input group-->

                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8">
                            <label class="fs-6 fw-bold mb-2">Application</label>
                            <textarea class="form-control form-control-solid" rows="4" name="application" placeholder=""></textarea>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Separator-->
                        <div class="separator mb-8"></div>
                        <!--end::Separator-->
                        <!--begin::Submit-->
                        <button type="submit" class="btn btn-primary" id="kt_careers_submit_button">
                            <!--begin::Indicator-->
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
														<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            <!--end::Indicator-->
                        </button>
                        <!--end::Submit-->
                        <div></div></form>
                    <!--end::Form-->
                </div>
                <!--end::Content-->
            </div>
        </div>
        <!--end::Body-->
    </div>

</x-layout.backend>

