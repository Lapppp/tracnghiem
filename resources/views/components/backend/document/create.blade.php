<x-layout.backend>
    <div class="card mb-5 w-lg-1000px">
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title">
                <h2 class="fw-bolder">Nhập các thông tin bên dưới</h2>
            </div>
            <!--begin::Card title-->
        </div>
        <div class="card-body pt-9 pb-0">
            <form id="kt_modal_new_target_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data" action="{{ $isEdit == 0 ? Route('backend.document.store') : Route('backend.document.update',['id'=>$posts->id]) }}" method="post">
                @if($isEdit == 1)
                    @method('PUT')
                @endif
                @csrf
                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Tiêu đề</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Tên của một tiêu đề" aria-label="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid" placeholder="Nhập tiêu đề" name="name" id="name" value="{{ old('name',!empty($posts) ? $posts->name : '') }}">
                    @if ($errors->has('name'))
                        <div class="fv-plugins-message-container invalid-feedback">
                            <div data-field="name" data-validator="notEmpty">{{ $errors->first('name') }}</div>
                        </div>
                    @endif

                </div>
                <!--end::Input group-->


                <!--begin::Input group-->
                <div class="row g-9 mb-8">
                    <!--begin::Col-->
                    <div class="col-md-6 fv-row fv-plugins-icon-container">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span>Mã số trực tuyến</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Mã số trực tuyến" aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="Nhập mã số trực tuyến" name="code" id="code" value="{{ old('code',!empty($posts) ? $posts->code : '') }}">
                        @if ($errors->has('code'))
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div data-field="code" data-validator="notEmpty">{{ $errors->first('code') }}</div>
                            </div>
                        @endif

                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-6 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span>Số đơn</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Số đơn" aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="Nhập số đơn" name="code_number" id="code_number" value="{{ old('code_number',!empty($posts) ? $posts->code_number : '') }}">
                        @if ($errors->has('code_number'))
                            <div class="fv-plugins-message-container invalid-feedback">
                                <div data-field="code_number" data-validator="notEmpty">{{ $errors->first('code_number') }}</div>
                            </div>
                    @endif
                        <!--end::Input-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->


                <!--begin::Input group-->
                <div class="row g-9 mb-8">

                    <!--begin::Col-->
                    <div class="col-md-4 fv-row fv-plugins-icon-container">
                        <label class=" fs-6 fw-bold mb-2">Ngày tạo đơn</label>
                        <!--begin::Input-->
                        <div class="position-relative d-flex align-items-center">
                            <!--begin::Icon-->
                            <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                            <span class="svg-icon svg-icon-2 position-absolute mx-4">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="black"></path>
																		<path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="black"></path>
																		<path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="black"></path>
																	</svg>
																</span>
                            <!--end::Svg Icon-->
                            <!--end::Icon-->
                            <!--begin::Datepicker-->
                            <input class="form-control form-control-solid ps-12 flatpickr-input" value="{{ old('created_at',!empty($posts) && !empty($posts->created_at) ? date('d-m-Y',strtotime($posts->created_at)) : '') }}" placeholder="Chọn ngày tạo đơn" name="created_at" type="text" id="created_at" readonly="readonly">
                            <!--end::Datepicker-->
                        </div>

                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-md-4 fv-row fv-plugins-icon-container">
                        <label class=" fs-6 fw-bold mb-2">Ngày nộp đơn</label>
                        <!--begin::Input-->
                        <div class="position-relative d-flex align-items-center">
                            <!--begin::Icon-->
                            <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                            <span class="svg-icon svg-icon-2 position-absolute mx-4">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="black"></path>
																		<path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="black"></path>
																		<path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="black"></path>
																	</svg>
																</span>
                            <!--end::Svg Icon-->
                            <!--end::Icon-->
                            <!--begin::Datepicker-->
                            <input class="form-control form-control-solid ps-12 flatpickr-input" value="{{ old('date_of_filing',!empty($posts) && !empty($posts->date_of_filing) ? date('d-m-Y',strtotime($posts->date_of_filing)) : '') }}" placeholder="Chọn ngày nộp đơn" name="date_of_filing" type="text" id="date_of_filing" readonly="readonly">
                            <!--end::Datepicker-->
                        </div>

                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-4 fv-row">
                        <label class=" fs-6 fw-bold mb-2">Ngày tiếp nhận đơn</label>
                        <!--begin::Input-->
                        <div class="position-relative d-flex align-items-center">
                            <!--begin::Icon-->
                            <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                            <span class="svg-icon svg-icon-2 position-absolute mx-4">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="black"></path>
																		<path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="black"></path>
																		<path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="black"></path>
																	</svg>
																</span>
                            <!--end::Svg Icon-->
                            <!--end::Icon-->
                            <!--begin::Datepicker-->
                            <input class="form-control form-control-solid ps-12 flatpickr-input" value="{{ old('received_date',!empty($posts) && !empty($posts->received_date) ? date('d-m-Y',strtotime($posts->received_date)) : '') }}" placeholder="Chọn ngày tiếp nhận đơn" name="received_date" type="text" id="received_date" readonly="readonly">
                            <!--end::Datepicker-->
                        </div>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->


                    <div class="row g-9 mb-8">
                        <!--begin::Col-->
                        <div class="col-md-9 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span>Chủ đơn</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Trạng thái sẽ thay đổi" aria-label="Specify a target name for future usage and reference"></i>
                            </label>
                            <!--end::Label-->
                            <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2" data-hide-search="true" data-placeholder="Chọn vai trò" name="user_id" id="user_id" data-select2-id="select2-data-10-gouk" tabindex="-1" aria-hidden="true">
                                <option value="0">Chọn chủ đơn</option>
                                @if(!empty($posts) && $posts->user_id)
                                    <option value="{{ $posts->user_id }}" {{ old('user_id',!empty($posts) ? $posts->user_id : '') ? "selected" : "" }}>
                                        {{ $posts->user->name ?? '' }}
                                    </option>
                                @endif
                            </select>

                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-md-3 fv-row fv-plugins-icon-container">
                            <label class=" fs-6 fw-bold mb-2">Chọn chủ đơn</label>
                            <!--begin::Input-->
                            <div class="position-relative d-flex align-items-center">
                                <a href="#" class="btn btn-danger" id="changeUser">Chọn chủ đơn khác</a>
                            </div>

                        </div>
                        <!--end::Col-->
                    </div>





                    <!--begin::Input group-->
                <div class="row g-9 mb-8">
                    <!--begin::Col-->
                    <div class="col-md-6 fv-row fv-plugins-icon-container">
                        <label class=" fs-6 fw-bold mb-2">Danh mục</label>
                        <select class="form-select form-select-solid" id data-control="select2" data-placeholder="Chọn danh mục" name="category_id" data-select2-id="select2-data-10-gou8" tabindex="-1" aria-hidden="true">
                            <option value="" data-select2-id="select2-data-12-dbw9">Chọn danh mục...</option>
                            @foreach ($category as $key => $value)
                                <option value="{{ $value->id }}" {{ old('category_id',!empty($posts) ? $posts->category_id : '') == $value->id ? "selected" : "" }}>{{ $value->name  }}</option>
                            @endforeach
                        </select>

                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-6 fv-row">
                        <label class=" fs-6 fw-bold mb-2">Tùy chọn</label>
                        <!--begin::Input-->
                        <div class="position-relative d-flex align-items-center">
                            <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2" data-hide-search="true" data-placeholder="Chọn vai trò" name="options" data-select2-id="select2-data-10-gou7" tabindex="-1" aria-hidden="true">
                                @foreach ($options as $key => $value)
                                    <option value="{{ $key }}" {{ old('options',!empty($posts) ? $posts->options : '') == $key ? "selected" : "" }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>


                        <!--end::Input-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                    <div class="d-flex flex-column mb-8">
                        <label class="fs-6 fw-bold mb-2">Diễn tả nội dung ngắn</label>
                        <textarea class="form-control form-control-solid" rows="3" name="short_description" placeholder="Nhập nội dung ngắn">{{ old('short_description',!empty($posts) ? $posts->short_description : '') }}</textarea>
                    </div>

                    <div class="d-flex flex-column mb-8">
                        <label class="fs-6 fw-bold mb-2">Nội dung bài viết</label>
                        <textarea id="description" name="description" id="text" cols="30" rows="10">{{ old('description',!empty($posts) ? $posts->description : '') }}</textarea>
                        <script src={{ url('ckeditor/ckeditor.js') }}></script>
                        <script>
                            CKEDITOR.replace( 'description', {

                                filebrowserBrowseUrl     : "{{ route('ckfinder_browser') }}",
                                filebrowserImageBrowseUrl: "{{ route('ckfinder_browser') }}?type=Images&token=123",
                                filebrowserFlashBrowseUrl: "{{ route('ckfinder_browser') }}?type=Flash&token=123",
                                filebrowserUploadUrl     : "{{ route('ckfinder_connector') }}?command=QuickUpload&type=Files",
                                filebrowserImageUploadUrl: "{{ route('ckfinder_connector') }}?command=QuickUpload&type=Images",
                                filebrowserFlashUploadUrl: "{{ route('ckfinder_connector') }}?command=QuickUpload&type=Flash",
                            } );
                            CKEDITOR.config.height = 500;
                        </script>
                        @include('ckfinder::setup')
                    </div>

                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span>Trạng thái</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Trạng thái sẽ thay đổi" aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2" data-hide-search="true" data-placeholder="Chọn vai trò" name="status" data-select2-id="select2-data-10-gou0" tabindex="-1" aria-hidden="true">
                            @foreach ($status as $key => $value)
                                <option value="{{ $key }}" {{ old('status',!empty($posts) ? $posts->status : '') == $key ? "selected" : "" }}>{{ $value }}</option>
                            @endforeach
                        </select>

                    </div>
                    <!--end::Input group-->


                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="image">
                            <span>Chọn hình ảnh nhãn hiệu</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="chọn file hình ảnh từ máy tính" aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input class="form-control" type="file" id="image" name="image" accept="image/*">

                    </div>
                    <!--end::Input group-->


                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="files">
                            <span>Chọn tập tin hồ sơ</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="chọn file hồ sơ từ máy tính" aria-label="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input class="form-control" type="file" id="files" name="files[]" multiple="multiple">

                    </div>
                    <!--end::Input group-->


                    @if(!empty($posts) && $posts->image()->get()->count() > 0)
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">

                        <table id="kt_file_manager_list" data-kt-filemanager-table="files" class="table align-middle table-row-dashed fs-6 gy-5">
                            <!--begin::Table head-->
                            <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-250px">Tên tập tin</th>
                                <th class="w-50px">Ngày tạo</th>
                                <th class="w-80px">Tải tập tin</th>
                            </tr>
                            <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fw-bold text-gray-600">
                            @foreach($posts->image()->get() as $image)
                                 <tr id="deleteImage_{{ $image->id }}">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <!--begin::Svg Icon | path: icons/duotune/files/fil003.svg-->
                                        <span class="svg-icon svg-icon-2x svg-icon-primary me-4">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																	<path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z" fill="black" />
																	<path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black" />
																</svg>
															</span>
                                        <!--end::Svg Icon-->
                                        <span href="#" class="text-gray-800 text-hover-primary">{{ $image->filename }}</span>
                                    </div>
                                </td>
                                <!--end::Name=-->
                                <!--begin::Last modified-->
                                <td>{{ $image->created_at ? date('d/m/Y',strtotime($image->created_at)) : '-' }}</td>
                                <!--end::Last modified-->
                                <!--begin::Actions-->
                                <td class="text-end" data-kt-filemanager-table="action_dropdown">
                                    <div class="d-flex justify-content-end">
                                        <!--begin::Share link-->

                                        <!--begin::More-->
                                        <div class="ms-2">
                                            <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen052.svg-->
                                                <span class="svg-icon svg-icon-5 m-0">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<rect x="10" y="10" width="4" height="4" rx="2" fill="black" />
																			<rect x="17" y="10" width="4" height="4" rx="2" fill="black" />
																			<rect x="3" y="10" width="4" height="4" rx="2" fill="black" />
																		</svg>
																	</span>
                                                <!--end::Svg Icon-->
                                            </button>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-150px py-4" data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="{{ Route('backend.document.download',['id'=>$image->id]) }}" class="menu-link px-3">Tải tập tin</a>
                                                </div>
                                                <!--end::Menu item-->

                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link text-danger px-3 deleteImage" data-id="{{ $image->id }}" data-kt-filemanager-table-filter="delete_row">Xóa</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu-->
                                        </div>
                                        <!--end::More-->
                                    </div>
                                </td>
                                <!--end::Actions-->
                            </tr>
                            @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>

                    </div>
                    @endif



                <div class="text-end">
                    <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Nhập lại</button>
                    <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                        @if($isEdit == 1)
                            <span class="indicator-label">Cập nhật</span>
                        @else
                            <span class="indicator-label">Tạo mới</span>
                        @endif
                        <span class="indicator-progress">Please wait...
															<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
                <!--end::Actions-->
                <div class="mb-10"></div>
            </form>
        </div>

    </div>


    <!--begin::Modal-->
    <div class="modal fade" tabindex="-1" id="kt_modal_1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tìm kiếm chủ đơn</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <div class="mb-10">
                        <label for="" class="form-label">Chọn chủ đơn</label>
                        <select class="form-select form-select-solid" id="js-example-data-ajax" data-control="select2" data-dropdown-parent="#kt_modal_1" data-placeholder="Nhập số điện thoại chủ đơn" data-allow-clear="true">
                            <option></option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="updateUser">Cập nhật</button>
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal-->

    <x-slot name="javascript">
        <script type="text/javascript">
            $(document).ready(function() {

                $('[name="created_at"]').flatpickr({
                    dateFormat: "d-m-Y",
                });
                $('[name="date_of_filing"]').flatpickr({
                    dateFormat: "d-m-Y",
                });

                $('[name="received_date"]').flatpickr({
                    dateFormat: "d-m-Y",
                });


                $(document).on('click', '#status', function(){

                    if ($(this).is(":checked")) {
                        $(this).val(1);
                    } else {
                        $(this).val(0);
                    }
                });

                $(document).on("click",'#changeUser',function(event){
                    event.preventDefault();
                    $('#kt_modal_1').modal('show');
                });


                $("#js-example-data-ajax").select2({
                    ajax: {
                        url: baseUrl +"/users/search",
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                q: params.term, // search term
                                page: params.page
                            };
                        },
                        processResults: function (data, params) {
                            params.page = params.page || 1;
                            return {
                                results: data.data.data,
                                pagination: {
                                    more: (params.page * 30) < data.total_count
                                }
                            };
                        },
                        cache: true
                    },
                    placeholder: 'Search for a repository',
                    minimumInputLength: 1,
                    templateResult: formatRepo,
                    templateSelection: formatRepoSelection
                });

                function formatRepo (repo) {

                    if (repo.loading) {
                        return repo.text;
                    }

                    var span = $("<span>", {
                        text: " " + repo.name
                    });
                    return span;
                }

                function formatRepoSelection (repo) {
                    return repo.name || repo.text;
                }

                $(document).on("click",'#updateUser',function(event){
                    event.preventDefault();
                    $('#kt_modal_1').modal('hide');
                    let data = $('#js-example-data-ajax').select2('data');

                    let id = $('#user_id :selected').val();
                    if(id != data[0].id) {
                        let newOption = new Option(data[0].name, data[0].id, true, true);
                        $('#user_id').append(newOption).trigger('change');
                    }
                });


                $(document).on('click','.deleteImage',function(event)
                {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Bạn có chắc là muốn xóa không?',
                        showDenyButton: true,
                        confirmButtonText: 'Đồng ý',
                        denyButtonText: `Không`,
                        customClass: {
                            confirmButton: "btn btn-primary btn-sm",
                            denyButton: "btn btn-danger btn-sm"
                        }
                    }).then((result) => {
                        if (result.isConfirmed)
                        {
                            var id = $(this).data("id");
                            let token = $("meta[name='csrf-token']").attr("content");
                            $.ajax(
                                {
                                    url: baseUrl+"/document/deleteImage/"+id,
                                    type: 'POST',
                                    data: {
                                        "id": id,
                                        "_token": token,
                                    },
                                    success: function (json) {
                                        if(json.status == 'success'){

                                            let timerInterval;
                                            Swal.fire({
                                                title: 'Vui lòng đợi...',
                                                html: '',
                                                timer: 1000,
                                                timerProgressBar: true,
                                                didOpen: () => {
                                                    Swal.showLoading()
                                                    timerInterval = setInterval(() => {
                                                    }, 100)
                                                },
                                                willClose: () => {
                                                    clearInterval(timerInterval)
                                                }
                                            }).then((result) => {
                                                if (result.dismiss === Swal.DismissReason.timer) {
                                                   // window.location.reload();
                                                    $('#deleteImage_'+id).hide();
                                                }
                                            })

                                        }else {
                                            Swal.fire(json.message, '', 'danger')
                                        }
                                    }
                                });

                            //Swal.fire('Saved!', '', 'success')
                        }
                    })
                });




            });
        </script>
    </x-slot>
</x-layout.backend>
