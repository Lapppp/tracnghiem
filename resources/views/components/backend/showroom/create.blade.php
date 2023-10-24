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
            <form id="kt_modal_new_target_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data" action="{{ $isEdit == 0 ? Route('backend.showroom.store') : Route('backend.showroom.update',['id'=>$posts->id]) }}" method="post">
                @if($isEdit == 1)
                    @method('PUT')
                @endif
                @csrf

                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Tên ShowRoom</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Tên của ShowRoom" aria-label="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid" placeholder="Nhập tên ShowRoom" name="name" id="name" value="{{ old('name',!empty($posts) ? $posts->name : '') }}">
                    @if ($errors->has('name'))
                        <div class="fv-plugins-message-container invalid-feedback">
                            <div data-field="name" data-validator="notEmpty">{{ $errors->first('name') }}</div>
                        </div>
                    @endif
                </div>
                <!--end::Input group-->



                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span>Địa chỉ</span>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid" placeholder="Nhập địa chỉ" name="address" id="address" value="{{ old('address',!empty($posts) ? $posts->address : '') }}">
                    @if ($errors->has('address'))
                        <div class="fv-plugins-message-container invalid-feedback">
                            <div data-field="address" data-validator="notEmpty">{{ $errors->first('address') }}</div>
                        </div>
                    @endif
                </div>
                <!--end::Input group-->


            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span>Điện thoại</span>
                </label>
                <!--end::Label-->
                <input type="text" class="form-control form-control-solid" placeholder="Nhập Điện thoại" name="phone" id="phone" value="{{ old('phone',!empty($posts) ? $posts->phone : '') }}">
                @if ($errors->has('phone'))
                    <div class="fv-plugins-message-container invalid-feedback">
                        <div data-field="phone" data-validator="notEmpty">{{ $errors->first('phone') }}</div>
                    </div>
                @endif
            </div>
            <!--end::Input group-->


            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span>Địa chỉ URL showroom</span>
                </label>
                <!--end::Label-->
                <input type="text" class="form-control form-control-solid" placeholder="Địa chỉ URL showroom" name="url" id="url" value="{{ old('url',!empty($posts) ? $posts->url : '') }}">
                @if ($errors->has('url'))
                    <div class="fv-plugins-message-container invalid-feedback">
                        <div data-field="url" data-validator="notEmpty">{{ $errors->first('url') }}</div>
                    </div>
                @endif
            </div>
            <!--end::Input group-->


            <!--begin::Input group-->
            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span>Tỉnh/TP</span>
                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Trạng thái sẽ thay đổi" aria-label="Specify a target name for future usage and reference"></i>
                </label>
                <!--end::Label-->
                <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2"  data-placeholder="Chọn vai trò" name="province_id" id="province_id" data-select2-id="select2-data-10-gou0" tabindex="-1" aria-hidden="true">
                    @foreach ($provinces as $key => $value)
                        <option value="{{ $value->id }}" {{ old('province_id',!empty($posts) ? $posts->province_id : '') == $value->id ? "selected" : "" }}>{{ $value->name ?? '' }}</option>
                    @endforeach
                </select>

            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span>Quận/Huyện</span>
                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Trạng thái sẽ thay đổi" aria-label="Specify a target name for future usage and reference"></i>
                </label>
                <!--end::Label-->
                <select class="form-select form-select-solid select2-hidden-accessible" data-control="select2"  data-placeholder="Chọn quận/huyện" name="district_id" id="district_id" data-select2-id="select2-data-9-gou0" tabindex="-1" aria-hidden="true">
                </select>

            </div>
            <!--end::Input group-->

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

    <x-slot name="javascript">
        <script type="text/javascript">
            $(document).ready(function() {

                @if($isEdit == 1)

                    let province_id = {{ !empty($posts) ? $posts->province_id : 0 }};
                    let district_id = {{ !empty($posts) ? $posts->district_id : 0 }};
                    loadDistrict(province_id,district_id);
                @else
                    var province_id = 79;
                    $('#province_id').val(province_id).trigger('change');
                    var district_id =  0;
                    loadDistrict(province_id,district_id)
                @endif



                $('#province_id').on('select2:select', function (e) {
                    var data = e.params.data;
                    $.ajax({
                        type: 'get',
                        url: '{{ Route('backend.showroom.districts') }}',
                        data: {
                            'province_id': data.id,
                            'district_id': 0
                        },
                        success:function(dataJson){
                            $('#district_id').html(dataJson.data.jsonHtml);
                        }
                    });

                });

                $('[name="birthday"]').flatpickr({
                    dateFormat: "d-m-Y",
                });
                $(document).on('click', '#status', function(){

                    if ($(this).is(":checked")) {
                        $(this).val(1);
                    } else {
                        $(this).val(0);
                    }
                });

                function loadDistrict(province_id,district_id) {
                    $.ajax({
                        type: 'get',
                        url: '{{ Route('backend.showroom.districts') }}',
                        data: {
                            'province_id':province_id,
                            'district_id':district_id
                        },
                        success:function(dataJson){
                            $('#district_id').html(dataJson.data.jsonHtml);
                        }
                    });
                }

            });
        </script>
    </x-slot>
</x-layout.backend>
