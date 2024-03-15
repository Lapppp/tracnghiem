<!------------------------- Step-1 ----------------------------->
<div class="multisteps_form_panel step active" style="display: block;">
    <div class="question_title text-center text-uppercase">
        <h1 class="animate__animated animate__fadeInRight animate_25ms">Câu {{ $question->pivot->order_by }}: {{ $question->name ?? '' }}</h1>
    </div>
    <div class="question_number text-center text-uppercase text-white">
        <span class="rounded-pill">Tổng cộng có {{ $total }} câu</span>
    </div>
    <div class="row pt-5 mt-4 form_items">

        @if(count($answers) > 0)
            @php
                $alphabet = 'A';
                $date = !empty($checkTest->updated_at) ? date('Y-m-d',strtotime($checkTest->updated_at)) : 0;
            @endphp
            @foreach($answers as $key => $value)
                <div class="col-12">
                    <ul class="list-unstyled p-0">
                        <li class="step_1 animate__animated animate__fadeInRight {{ \App\Helpers\StringHelper::getAnimation($key) }} @if(!empty($checkTest) && $checkTest->is_correct == $value->id && $checkTest->is_reset == 1) active @endif"
                            data-answer_id="{{ $value->id }}"
                            data-pivot_id="{{ $question->pivot->id}}"
                            data-order_by="{{ $question->pivot->order_by}}"
                            data-test_id="{{ $test->id }}"
                            data-question_id="{{ $question->id }}">
                            <input id="opt_{{ $value->id }}" type="radio" name="stp_1_select_option" value="{{ $value->id }}">
                            <label for="opt_{{ $value->id }}"><b><span style="-webkit-text-fill-color:white" class="badge bg-primary">{{ $alphabet }}</span></b> {{ $value->description ?? '' }} </label>
                        </li>
                    </ul>
                </div>
                @php
                    $alphabet++;
                @endphp
            @endforeach

        @endif
    </div>
</div>
<!---------- Form Button ---------->
<div class="form_btn">
    <div class="form_btn">
        <button type="button"
                class="prev_btn position-absolute text-uppercase border-0"
                id="prevBtn"
                data-answer_id="{{ !empty($checkTest) && $checkTest->is_correct ? $checkTest->is_correct : 0  }}"
                data-pivot_id="{{ $question->pivot->id}}"
                data-order_by="{{ $question->pivot->order_by}}"
                data-test_id="{{ $test->id }}"
                data-question_id="{{ $question->id }}"
        > <span><i class="fas fa-arrow-left"></i></span> Quay lại</button>
        <button type="button"
                class="next_btn rounded-pill position-absolute text-uppercase text-white"
                id="nextBtn"
                data-answer_id="{{ !empty($checkTest) && $checkTest->is_correct ? $checkTest->is_correct : 0  }}"
                data-pivot_id="{{ $question->pivot->id}}"
                data-order_by="{{ $question->pivot->order_by}}"
                data-test_id="{{ $test->id }}"
                data-question_id="{{ $question->id }}"
        >Tiếp theo</button>
    </div>
</div>
