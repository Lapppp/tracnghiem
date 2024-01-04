<x-layout.question>
    <x-slot name="counter">
        <style>
            .vr {
                display: inline-block;
                align-self: stretch;
                width: 1px;
                min-height: 1em;
                background-color: currentColor;
                opacity: .25;
            }
        </style>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo_area pt-5 ps-5">
                        <input type="hidden" name="counterHidden" id="counterHidden" value="0">
                        <input type="hidden" name="test_id_test" id="test_id_test" value="0">
                        <a href="{{ Route('frontend.home.index') }}">
                            <img src="{{ asset('/frontend/questions')}}/assets/images/logo/logo.png" alt="image-not-found">
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 d-none d-sm-block">
                    <div class="count_box d-flex float-end pt-5 pe-5">
                        <div class="count_clock countdown_timer d-flex align-items-center pe-5 me-3" data-countdown="{{ !empty($test->start_date) ? date("Y/m/d",strtotime($test->start_date)) : '' }}">
                        </div>
                        <!-- <div id="countdown"></div> -->
                        <!-- Step Progress bar -->
                        <div class="count_progress" id="showPercent">
                     <span class="progress-left">
                        <span class="progress_bar"></span>
                     </span>
                            <span class="progress-right">
                        <span class="progress_bar"></span>
                     </span>
                            <div class="progress-value">
                                <div id="value">100%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <form class="multisteps_form bg-white position-relative overflow-hidden" style="max-width: none;background: none" id="wizard" method="POST" action="">


        @foreach($parts as $key => $part)
            <!------------------------- Step-1 ----------------------------->
            <div class="multisteps_form_panel step active p-3" style="display: block;">
                <div class="alert alert-dark" role="alert">
                    <p class="m-0 fw-bold">{{ $part->name ?? '' }}</p>
                    @if($part->short_description)
                        <p class="m-0">{!! $part->short_description !!}</p>
                    @endif

                    @if($part->description)
                        <p class="m-0">{!! $part->description !!}</p>
                    @endif
                </div>

                @if($part->type != 1)
                    @if($part->posts()->count() > 0)
                        @php $iq = 1 @endphp
                     @foreach($part->posts()->get() as $k => $questions)
                            <div class="alert alert-warning" role="alert">
                                <span class="fw-bold">Câu {{ $k + $iq }}:</span> {{ $questions->name ?? '' }}
                            </div>

                            @if($questions->answers()->count() > 0)
                                @php
                                    $alphabet = 'A';
                                @endphp
                                <div class="row pt-2 mt-1 form_items">
                                     @foreach($questions->answers()->get() as $q => $answer)
                                        <div class="col-6">
                                            <ul class="list-unstyled p-0">
                                                <li class="step_1 animate__animated animate__fadeInRight"
                                                    data-answer_id="{{ $answer->id }}"
                                                    data-part_id="{{ $part->id }}"
                                                    data-test_id="{{ $test->id }}"
                                                    data-question_id="{{ $questions->id }}">
                                                    <input id="opt_{{ $answer->id }}" type="radio" name="stp_1_select_option_{{ $questions->id }}" value="{{ $answer->id }}">
                                                    <label for="opt_{{ $answer->id }}"><b>{{ $alphabet }}.</b> {{ $answer->description ?? '' }} </label>
                                                </li>
                                            </ul>
                                        </div>
                                        @php
                                            $alphabet++;
                                        @endphp
                                     @endforeach
                                </div>
                            @endif
                     @endforeach
                    @endif
                @else
                    @if($part->posts()->count() > 0)
                        @php $iq = 1 @endphp
                        @foreach($part->posts()->get() as $k => $questions)
                            <div class="alert alert-warning" role="alert">
                                <span class="fw-bold">Câu {{ $k + $iq }}:</span> {{ $questions->name ?? '' }}
                            </div>

                            @if($questions->questionMultiples()->count() > 0)
                                @php
                                    $alphabet = 'A';
                                @endphp
                                <div class="row pt-2 mt-1 form_items">
                                    @foreach($questions->questionMultiples()->get() as $q => $answer)
                                        <div class="col-6 border-bottom ">
                                            <ul class="list-unstyled p-0">
                                                <li class="step_2 animate__animated animate__fadeInRight"
                                                    data-answer_id="{{ $answer->id }}"
                                                    data-part_id="{{ $part->id }}"
                                                    data-test_id="{{ $test->id }}"
                                                    data-group="{{ $answer->group_question }}"
                                                    data-question_id="{{ $questions->id }}">
                                                    <input id="opt_{{ $answer->id }}_a" type="radio" name="stp_1_select_option_{{ $answer->id }}_a" value="a">
                                                    <label for="opt_{{ $answer->id }}_a"><b>A.</b> {{ $answer->a ?? '' }} </label>
                                                </li>
                                                <li class="step_2 animate__animated animate__fadeInRight"
                                                    data-answer_id="{{ $answer->id }}"
                                                    data-part_id="{{ $part->id }}"
                                                    data-test_id="{{ $test->id }}"
                                                    data-group="{{ $answer->group_question }}"
                                                    data-question_id="{{ $questions->id }}">
                                                    <input id="opt_{{ $answer->id }}_b" type="radio" name="stp_1_select_option_{{ $answer->id }}_a" value="b">
                                                    <label for="opt_{{ $answer->id }}_b"><b>B.</b> {{ $answer->b ?? '' }} </label>
                                                </li>
                                                <li class="step_2 animate__animated animate__fadeInRight"
                                                    data-answer_id="{{ $answer->id }}"
                                                    data-part_id="{{ $part->id }}"
                                                    data-test_id="{{ $test->id }}"
                                                    data-group="{{ $answer->group_question }}"
                                                    data-question_id="{{ $questions->id }}">
                                                    <input id="opt_{{ $answer->id }}_c" type="radio" name="stp_1_select_option_{{ $answer->id }}_a" value="c">
                                                    <label for="opt_{{ $answer->id }}_c"><b>C.</b> {{ $answer->c ?? '' }} </label>
                                                </li>
                                                <li class="step_2 animate__animated animate__fadeInRight"
                                                    data-answer_id="{{ $answer->id }}"
                                                    data-part_id="{{ $part->id }}"
                                                    data-test_id="{{ $test->id }}"
                                                    data-group="{{ $answer->group_question }}"
                                                    data-question_id="{{ $questions->id }}">
                                                    <input id="opt_{{ $answer->id }}_d" type="radio" name="stp_1_select_option_{{ $answer->id }}_a" value="d">
                                                    <label for="opt_{{ $answer->id }}_d"><b>D.</b> {{ $answer->d ?? '' }} </label>
                                                </li>
                                            </ul>
                                        </div>
                                        @php
                                            $alphabet++;
                                        @endphp
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                    @endif
                @endif


            </div>
        @endforeach

    </form>

    <x-slot name="css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" integrity="sha256-sWZjHQiY9fvheUAOoxrszw9Wphl3zqfVaz1kZKEvot8=" crossorigin="anonymous">
    </x-slot>

    <x-slot name="javascript">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js" integrity="sha256-t0FDfwj/WoMHIBbmFfuOtZv1wtA977QCfsFR3p1K4No=" crossorigin="anonymous"></script>
        <script type="text/javascript">
            var c = {{ $test->score_time ? $test->score_time * 60 : 900  }};
            var t;
            $(document).ready(function() {

                $(document).on('click', '.step_2',function(){
                    let group = $(this).data('group');
                    $("li[data-group='"+group+"']").removeClass("active")
                    $(this).addClass("active");
                });
                $(document).on('click', '.step_1',function(){
                    //$(".step_1").removeClass("active");
                    let question_id = $(this).data('question_id');
                    $("li[data-question_id='"+question_id+"']").removeClass("active")
                    $(this).addClass("active");

                    /*
                    let token = $("meta[name='csrf-token']").attr("content");
                    let answer_id = $(this).data('answer_id');
                    let pivot_id = $(this).data('pivot_id');
                    let order_by = $(this).data('order_by');
                    let test_id = $(this).data('test_id');
                    let question_id = $(this).data('question_id');
                    let test_id_test = $('#test_id_test').val();
                    $('#prev_btn').attr('data-answer_id',answer_id);
                    $('#nextBtn').attr('data-answer_id',answer_id);
                    $.ajax({
                        url: "{{ Route('frontend.tests.store',['id'=>$test->id]) }}",
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "answer_id": answer_id,
                            "pivot_id": pivot_id,
                            "order_by": order_by,
                            "test_id": test_id,
                            "question_id": question_id,
                            "test_id_test": test_id_test,
                            "_token": token,
                        },
                        success: function (dataJson) {

                        }
                    })
                    */

                });


                // ================== CountDown function ================
                $('.countdown_timer').each(function(){
                    $('[data-countdown]').each(function() {
                        var $this = $(this), finalDate = $(this).data('countdown');
                        $this.countdown(finalDate, function(event) {
                            var $this = $(this).html(event.strftime(''
                                +'<img  src="{{ asset('/frontend/questions')}}/assets/images/watch/watch.png" alt="image-not-found">'
                                + '<span class="pe-5 counter" id="timer">%M:%S</span>'));
                        });
                    });
                });


                // Progress bar counter ======================
                var timer = {{ $test->score_time ? $test->score_time * 60 : 900  }};
                function animateValue() {
                    timer--;
                    document.getElementById("value").innerHTML = timer;
                    if(timer <= 0) {
                        window.location.href = BASE_URL+'/bai-kiem-tra/ket-qua/';
                    }
                    setTimeout(animateValue, 1000)
                }
                animateValue();

                function timedCount()
                {
                    if(c == 185) {
                       // return false;
                    }

                    var hours = parseInt( c / 3600 ) % 24;
                    var minutes = parseInt( c / 60 ) % 60;
                    var seconds = c % 60;
                    var result = (minutes < 10 ? "0" + minutes : minutes) + ":" + (seconds  < 10 ? "0" + seconds : seconds);
                   // var result = (hours < 10 ? "0" + hours : hours) + ":" + (minutes < 10 ? "0" + minutes : minutes) + ":" + (seconds  < 10 ? "0" + seconds : seconds);
                    $('#timer').html(result);

                    if(c == 0 ) {
                        window.location.href = BASE_URL+'/bai-kiem-tra/ket-qua/';
                    }
                    c = c - 1;
                    t = setTimeout(function()
                    {
                        timedCount()
                    },1000);
                }
                timedCount();

            });




        </script>
    </x-slot>
</x-layout.question>

