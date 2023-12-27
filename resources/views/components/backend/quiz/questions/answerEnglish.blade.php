<?php

use App\Helpers\StringHelper;
$code = 'A';
$group = StringHelper::generateRandomCode('', 10);
?>
@if($isEdit == 0)
    @for ($i = 0; $i < 4; $i++)
        @php
            $id = StringHelper::generateRandomCode('', 10);
            $c = $code++;
        @endphp
        <div class="row">
            <div class="col-md-9">
                <div class="mb-10">
                    <label for="exampleFormControlInput_{{ $id }}" data-id="{{ $id }}"
                           class="form-label addNewText">{{ $c }}</label>
                    <input type="text" class="form-control form-control-solid" name="answers[{{$group}}][]"
                           placeholder="Nhập câu trả lời" id="exampleFormControlInput_{{ $id }}"/>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-check form-check-custom form-check-solid mt-5 pt-5">
                    <input class="form-check-input valueCorrect" data-id="{{ $id }}" type="radio" name="correct[{{$group}}]"
                           value="{{ strtolower($c) }}" id="flexRadioDefault_{{ $id }}"/>
                    <label class="form-check-label valueCorrect" data-id="{{ $id }}" for="flexRadioDefault_{{ $id }}">
                        Trả lời đúng
                    </label>
                </div>
            </div>
        </div>
    @endfor
    <div class="row border-top mb-2">
        <div class="col-md-12">
            <input type="hidden" name="groups[{{$group}}]">
        </div>
    </div>
@else
    @foreach($listAnswers as $key =>$value)
        @php
            $id = $value->id;
            $a = $value->a;
            $b = $value->b;
            $c = $value->c;
            $d = $value->d;
            $is_correct = $value->is_correct;
            $group_question = $value->group_question;
        @endphp
        <div class="row">
            <div class="col-md-9">
                <div class="mb-10">
                    <label for="exampleFormControlInput_{{ $id }}_a" data-id="{{ $id }}_a" class="form-label labelAnswerAjax">A</label>
                    <input type="text" class="form-control form-control-solid" name="answers[{{ $group_question }}][]" value="{{ $a ?? '' }}"
                           placeholder="Nhập câu trả lời" id="exampleFormControlInput_{{ $id }}_a" />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-check form-check-custom form-check-solid mt-5 pt-5">
                    <input class="form-check-input valueCorrect" type="radio"  name="correct[{{ $group_question }}][]"
                           id="flexRadioDefault_{{ $id }}_a"  data-id="{{ $id }}" data-correct="a" @if ($is_correct == 'a') checked="checked" @endif/>
                    <label class="form-check-label valueCorrect" data-id="{{ $id }}" data-correct="a" for="flexRadioDefault_{{ $id }}_a">
                        Trả lời đúng
                    </label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-9">
                <div class="mb-10">
                    <label for="exampleFormControlInput_{{ $id }}_b" data-id="{{ $id }}_b" class="form-label labelAnswerAjax">B</label>
                    <input type="text" class="form-control form-control-solid" name="answers[{{ $group_question }}][]" value="{{ $b ?? '' }}"
                           placeholder="Nhập câu trả lời" id="exampleFormControlInput_{{ $id }}_b" />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-check form-check-custom form-check-solid mt-5 pt-5">
                    <input class="form-check-input valueCorrect" type="radio"  name="correct[{{ $group_question }}][]"
                           id="flexRadioDefault_{{ $id }}_b"  data-id="{{ $id }}" data-correct="b" @if ($is_correct == 'b') checked="checked" @endif/>
                    <label class="form-check-label valueCorrect" data-id="{{ $id }}" data-correct="b" for="flexRadioDefault_{{ $id }}_b">
                        Trả lời đúng
                    </label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-9">
                <div class="mb-10">
                    <label for="exampleFormControlInput_{{ $id }}_c" data-id="{{ $id }}_c" class="form-label labelAnswerAjax">C</label>
                    <input type="text" class="form-control form-control-solid" name="answers[{{ $group_question }}][]" value="{{ $c ?? '' }}"
                           placeholder="Nhập câu trả lời" id="exampleFormControlInput_{{ $id }}_c" />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-check form-check-custom form-check-solid mt-5 pt-5">
                    <input class="form-check-input valueCorrect" type="radio"  name="correct[{{ $group_question }}][]"
                           id="flexRadioDefault_{{ $id }}_c" data-id="{{ $id }}" data-correct="c" @if ($is_correct == 'c') checked="checked" @endif/>
                    <label class="form-check-label valueCorrect" data-id="{{ $id }}" data-correct="c" for="flexRadioDefault_{{ $id }}_c">
                        Trả lời đúng
                    </label>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-9">
                <div class="mb-10">
                    <label for="exampleFormControlInput_{{ $id }}_d" data-id="{{ $id }}_d" class="form-label labelAnswerAjax">D</label>
                    <input type="text" class="form-control form-control-solid" name="answers[{{ $group_question }}][]" value="{{ $d ?? '' }}"
                           placeholder="Nhập câu trả lời" id="exampleFormControlInput_{{ $id }}_d" />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-check form-check-custom form-check-solid mt-5 pt-5">
                    <input class="form-check-input valueCorrect" type="radio"  name="correct[{{ $group_question }}][]"
                           id="flexRadioDefault_{{ $id }}_d" data-id="{{ $id }}" data-correct="d" @if ($is_correct == 'd') checked="checked" @endif/>
                    <label class="form-check-label valueCorrect" data-id="{{ $id }}" data-correct="d" for="flexRadioDefault_{{ $id }}_d">
                        Trả lời đúng
                    </label>
                </div>
            </div>
        </div>
        <div class="row border-top mb-2">
            <div class="col-md-12">
                <input type="hidden" name="groups[{{ $group_question }}]">
                <input type="hidden" name="is_correct[{{ $group_question }}]" id="is_correct_{{ $id }}" value="{{ $is_correct }}">
            </div>
        </div>

    @endforeach
@endif
