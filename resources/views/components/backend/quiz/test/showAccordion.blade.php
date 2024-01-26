@if($parts->count() > 0)
    @foreach($parts as $key => $part)
    <div class="accordion-item">
        <h2 class="accordion-header" id="kt_accordion_1_header_{{ $part->id }}">

            <button class="accordion-button fs-4 fw-semibold @if($key != 0) collapsed @endif" type="button" data-bs-toggle="collapse"
                    data-bs-target="#kt_accordion_1_body_{{ $part->id }}" aria-expanded="false" aria-controls="kt_accordion_1_body_{{ $part->id }}">
                {{ $part->name ?? '' }}
            </button>
        </h2>
        <div id="kt_accordion_1_body_{{ $part->id }}" class="position-relative accordion-collapse collapse @if($key == 0) show @endif"
             aria-labelledby="kt_accordion_1_header_{{ $part->id }}" data-bs-parent="#kt_accordion_1">
            <button type="button" class="btn btn-primary btn-sm EditPart" data-bs-toggle="modal" data-bs-target="#kt_modal_part_update_{{ $part->id }}" data-id="{{ $part->id }}" data-type="{{ $part->type }}" style="position: absolute;right: 153px;top:10px;z-index: 1">
                Sửa Part
            </button>
            @include('components.backend.quiz.test.nextEditModal',['part'=>$part])
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
                    @foreach($part->posts as $question)
                        <tr>
                            <th scope="row">
                                <input type="number" value="{{ $question->pivot->order }}" data-post_id="{{ $question->id }}" data-question_part_question="{{ $question->pivot->id }}" data-part_id="{{ $question->pivot->part_id }}" class="form-control form-control-sm updateOrderBy">
                            </th>
                            <td>{{ $question->name ?? '' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endforeach
@endif


