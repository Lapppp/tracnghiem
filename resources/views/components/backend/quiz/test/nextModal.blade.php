<div class="modal fade" tabindex="-1" id="kt_modal_part">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tạo Part mới</h3>

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
                        <input type="text"  class="form-control" id="part_name">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="part_name" class="col-sm-2 col-form-label">Sắp xếp</label>
                    <div class="col-sm-10">
                        <input type="number"  class="form-control" id="order" value="0" style="width: 15%">
                    </div>
                </div>


                <div class="mb-3 row">
                    <label for="type" class="col-sm-2 col-form-label">Câu hỏi nhiều câu trả lời</label>
                    <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example" id="type">
                            @foreach($type as $key =>$value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>


                <div class="mb-3 row">
                    <label for="short_description" class="col-sm-2 col-form-label">Nội dung ngắn</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="short_description" rows="2"></textarea>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="description" class="col-sm-2 col-form-label">Nội dung câu hỏi</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="description" rows="7"></textarea>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" id="createPartNew">Tạo mới</button>
            </div>
        </div>
    </div>
</div>
