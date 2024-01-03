@foreach ($questions as $key => $value)
    <li class="list-group-item d-flex justify-content-between align-items-center">{{ $value->name ?? '' }}
        <button type="button" class="btn btn-primary btn-sm addQuestion" data-id="{{ $value->id }}" data-name="{{ $value->name ?? '' }}">
            <i class="bi bi-bookmark-plus"></i> <span id="doneQuestion_{{ $value->id }}">Thêm</span>
        </button>
    </li>
@endforeach
