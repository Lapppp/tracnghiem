<div class="accordion-item">
    <h2 class="accordion-header" id="kt_accordion_1_header_{{ $part->id }}">
        <button class="accordion-button fs-4 fw-semibold" type="button" data-bs-toggle="collapse"
                data-bs-target="#kt_accordion_1_body_{{ $part->id }}" aria-expanded="true" aria-controls="kt_accordion_1_body_{{ $part->id }}">
            {{ $part->name ?? '' }}
        </button>
    </h2>
    <div id="kt_accordion_1_body_{{ $part->id }}" class="position-relative accordion-collapse collapse show"
         aria-labelledby="kt_accordion_1_header_{{ $part->id }}" data-bs-parent="#kt_accordion_1">
        <button type="button" class="btn btn-primary btn-sm AddQuestionPart" data-id="{{ $part->id }}" data-type="{{ $part->type }}" style="position: absolute;right: 16px;top:10px;z-index: 1">
            Thêm câu hỏi
        </button>
        <div class="accordion-body">
            <table class="table table-row-bordered">
                <thead>
                <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                    <th scope="col" style="width: 7%"><b>STT</b></th>
                    <th scope="col"><b>Tên câu hỏi</b></th>
                </tr>
                </thead>
                <tbody id="contentQuestion_{{ $part->id }}">

                </tbody>
            </table>
        </div>
    </div>
</div>
