<div class="row">
    <div class="col-md-9">
        <div class="mb-10">
            <label for="exampleFormControlInput_{{ $value->id }}" data-id="{{ $value->id }}" class="form-label labelAnswerAjax">{{ $alphabet }}</label>
            <input type="text" class="form-control form-control-solid" name="answers[{{ $value->id }}]" value="{{ $value->description ?? '' }}"
                   placeholder="Nhập câu trả lời" id="exampleFormControlInput_{{ $value->id }}" />
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-check form-check-custom form-check-solid mt-5 pt-5">
            <input class="form-check-input valueCorrect" type="radio" data-id="{{ $value->id }}" name="correct"
                   id="flexRadioDefault_{{ $value->id }}" @if ($value->is_correct == 1) checked="checked" @endif/>
            <label class="form-check-label valueCorrect" data-id="{{ $value->id }}" for="flexRadioDefault_{{ $value->id }}">
                Trả lời đúng
            </label>
        </div>
    </div>
</div>
