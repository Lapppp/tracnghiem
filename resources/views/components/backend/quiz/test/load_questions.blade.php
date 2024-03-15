@foreach ($questions as $key => $value)
<li class="list-group-item d-flex justify-content-between align-items-center" id="showHideQuestion_{{ $value->id }}"> <span class="badge badge-success"><b>{{ $key + 1}}. Mã câu hỏi:</b> {{ $value->code ?? '' }}</span>
    <button type="button" class="btn btn-danger btn-sm deleteQuestion" data-id="{{ $value->id }}" data-question="deleteQuestion" data-name="{{ $value->name ?? '' }}">
        <i class="bi bi-bookmark-x"></i> Xóa
    </button>
</li>
@endforeach