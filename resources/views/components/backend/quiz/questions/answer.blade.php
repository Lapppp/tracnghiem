<?php $code  = 'A';?>
@for ($i = 0; $i < 4; $i++)
    <div class="row">
        <div class="col-md-9">
            <div class="mb-10">
                <label for="exampleFormControlInput_{{ $i }}" data-id="{{ $i }}" class="form-label addNewText">{{ $code++ }}</label>
                <input type="text" class="form-control form-control-solid" name="answers[]"
                       placeholder="Nhập câu trả lời" id="exampleFormControlInput_{{ $i }}" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-check form-check-custom form-check-solid mt-5 pt-5">
                <input class="form-check-input valueCorrect" data-id="{{ $i }}" type="radio" name="correct"
                       id="flexRadioDefault_{{ $i }}" />
                <label class="form-check-label valueCorrect" data-id="{{ $i }}" for="flexRadioDefault_{{ $i }}">
                    Trả lời đúng
                </label>
            </div>
        </div>
    </div>
@endfor
