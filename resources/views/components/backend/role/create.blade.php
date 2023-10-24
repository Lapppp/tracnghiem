<x-layout.backend>
    <div class="card mb-5 w-lg-700px">
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title">
                <h2 class="fw-bolder">Thông tin vai trò</h2>
            </div>
            <!--begin::Card title-->
        </div>
        <div class="card-body pt-9 pb-0">
            <form id="kt_modal_new_target_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{ $isEdit == 0 ? Route('backend.role.store') : Route('backend.role.update',['id'=>$admin->id]) }}" method="post">
                @if($isEdit == 1)
                    @method('PUT')
                @endif
                @csrf
                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Tên vai trò</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="Tên vai trò bắt buộc phải nhập" aria-label="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid" placeholder="Nhập họ tên" name="name" id="name" value="{{ old('name',!empty($admin) ? $admin->customize_name : '') }}">
                    @if ($errors->has('name'))
                        <div class="fv-plugins-message-container invalid-feedback">
                            <div data-field="name" data-validator="notEmpty">{{ $errors->first('name') }}</div>
                        </div>
                    @endif

                </div>


                    <div class="table-responsive">
                        <!--begin::Table-->
                        @if(count($permissions) > 0)
                            @foreach($permissions as $key => $permission)
                                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                    <!--begin::Table head-->
                                    <thead>
                                    <tr class="fw-bolder text-muted">
                                        <th class="w-25px">
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input permission_parent"
                                                       type="checkbox" value="{{ $permission->id }}"
                                                       data-id="{{ $permission->id }}"
                                                       name="permissions[]"
                                                       @if(!empty($permissions_roles) && in_array($permission->id,$permissions_roles)) checked="checked" @endif
                                                       id="permission_parent_{{ $permission->id }}" />
                                            </div>
                                        </th>
                                        <th class="min-w-150px"><label for="permission_parent_{{ $permission->id }}">{{ $permission->customize_name }}</label></th>
                                    </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>
                                        @if($permission->children()->count() > 0)
                                             @foreach($permission->children()->get() as $k => $value)
                                                <tr>
                                                    <td>
                                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input widget-9-check permission_child"
                                                                   @if(!empty($permissions_roles) && in_array($value->id,$permissions_roles)) checked="checked" @endif
                                                                   name="permissions[]"
                                                                   type="checkbox" value="{{ $value->id }}"
                                                                   data-id="{{ $value->id }}"
                                                                   data-parent="{{ $permission->id }}"
                                                                   id="permission_child_{{ $value->id }}" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="d-flex justify-content-start flex-column">
                                                                <label for="permission_child_{{ $value->id }}">
                                                                    <span class="text-muted fw-bold text-muted d-block fs-7">{{ $value->customize_name }}</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                    <!--end::Table body-->
                                </table>

                                @if (!$loop->last)
                                    <div class="separator mx-1 my-4"></div>
                                @endif

                            @endforeach
                        @endif
                        <!--end::Table-->
                    </div>





                    <div class="text-center">
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

                $(document).on('click','.permission_parent',function(){
                    var id = $(this).data('id');
                    if($(this).is(":checked")){
                        $('input[data-parent="'+ id +'"]').each(function(){
                            $(this).prop("checked", true);
                        });

                    }else{
                        $('input[data-parent="'+ id +'"]').each(function(){
                            $(this).prop("checked", false);
                        });
                    }
                });


                $(document).on('click','.permission_child',function(){
                    var id = $(this).data('id');
                    var parent_id = $(this).data('parent');
                    if($(this).is(":checked")){
                        $('#permission_parent_'+parent_id).prop("checked", true);
                    }else{

                        var arr = [];
                        $('input[data-parent='+parent_id+']:checked').each(function () {
                            arr.push($(this).val());
                        });

                        if(arr.length <= 0){
                            $('#permission_parent_'+parent_id).prop("checked", false);
                        }

                    }
                });


            });
        </script>
    </x-slot>
</x-layout.backend>
