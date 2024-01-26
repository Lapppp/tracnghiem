<div class="modal fade" tabindex="-1" id="kt_modal_part_update_{{ $part->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Sửa Part</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-square-fill"></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">

                <div class="mb-3 row">
                    <label for="part_name" class="col-sm-2 col-form-label">Tên Part</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" id="part_name_update_{{ $part->id }}" value="{{ $part->name ?? '' }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="part_name" class="col-sm-2 col-form-label">Sắp xếp</label>
                    <div class="col-sm-10">
                        <input type="number"  class="form-control" id="order_update_{{ $part->id }}" value="{{ $part->order ?? 0 }}" style="width: 15%">
                    </div>
                </div>


                <div class="mb-3 row">
                    <label for="short_description" class="col-sm-2 col-form-label">Nội dung ngắn</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="short_description_update_{{ $part->id }}" rows="2">{!! $part->short_description ?? '' !!}</textarea>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="description" class="col-sm-2 col-form-label">Nội dung câu hỏi</label>
                    <div class="col-sm-10">
                        <textarea class="form-control update_description"  id="description_update_{{ $part->id }}" rows="7">{!! $part->description ?? '' !!}</textarea>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary updatePartNew" data-id="{{ $part->id }}">Cập nhật</button>
            </div>
        </div>
    </div>
</div>
