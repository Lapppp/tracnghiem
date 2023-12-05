<x-layout.question>
    <x-slot name="counter">
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

    <form class="multisteps_form bg-white position-relative overflow-hidden" id="wizard" method="POST" action="">


        <!------------------------- Step-1 ----------------------------->
        <div class="multisteps_form_panel step active" style="display: block;">
            <div class="question_title text-center text-uppercase">
                <h1 class="animate__animated animate__fadeInRight animate_25ms">{{ $question->name ?? '' }}</h1>
            </div>
            <div class="question_number text-center text-uppercase text-white">
                <span class="rounded-pill">Tổng cộng có {{ $total }} câu</span>
            </div>
            <div class="row pt-2 mt-1 form_items">

                @if(count($answers) > 0)
                    @php
                        $alphabet = 'A';
                    @endphp
                    @foreach($answers as $key => $value)
                        <div class="col-6">
                            <ul class="list-unstyled p-0">
                                <li class="step_1 animate__animated animate__fadeInRight {{ \App\Helpers\StringHelper::getAnimation($key) }} @if(!empty($checkTest) && $checkTest->is_correct == $value->id) active @endif "
                                    data-answer_id="{{ $value->id }}"
                                    data-pivot_id="{{ $question->pivot->id}}"
                                    data-test_id="{{ $test->id }}"
                                    data-question_id="{{ $question->id }}">
                                    <input id="opt_{{ $value->id }}" type="radio" name="stp_1_select_option" value="{{ $value->id }}">
                                    <label for="opt_{{ $value->id }}"><b>{{ $alphabet }}.</b> {{ $value->description ?? '' }} </label>
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
            <button type="button"
                    class="prev_btn position-absolute text-uppercase border-0"
                    id="prevBtn"
                    data-answer_id="{{ !empty($checkTest) && $checkTest->is_correct ? $checkTest->is_correct : 0  }}"
                    data-pivot_id="{{ $question->pivot->id}}"
                    data-test_id="{{ $test->id }}"
                    data-question_id="{{ $question->id }}"
                    > <span><i class="fas fa-arrow-left"></i></span> Quay lại</button>
            <button type="button"
                    class="next_btn rounded-pill position-absolute text-uppercase text-white"
                    id="nextBtn"
                    data-answer_id="{{ !empty($checkTest) && $checkTest->is_correct ? $checkTest->is_correct : 0  }}"
                    data-pivot_id="{{ $question->pivot->id}}"
                    data-test_id="{{ $test->id }}"
                    data-question_id="{{ $question->id }}"
                    >Tiếp theo</button>
        </div>
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

                $(document).on('click', '.step_1',function(){
                    $(".step_1").removeClass("active");
                    $(this).addClass("active");

                    let token = $("meta[name='csrf-token']").attr("content");
                    let answer_id = $(this).data('answer_id');
                    let pivot_id = $(this).data('pivot_id');
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
                            "test_id": test_id,
                            "question_id": question_id,
                            "test_id_test": test_id_test,
                            "_token": token,
                        },
                        success: function (dataJson) {

                        }
                    })

                });

                $(document).on('click','button#prevBtn',function(e){
                    let token = $("meta[name='csrf-token']").attr("content");
                    let answer_id = $(this).data('answer_id');
                    let pivot_id = $(this).data('pivot_id');
                    let test_id = $(this).data('test_id');
                    let question_id = $(this).data('question_id');
                    let test_id_test = $('#test_id_test').val();
                    $.ajax({
                        url: "{{ Route('frontend.tests.previous',['id'=>$test->id]) }}",
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "answer_id": answer_id,
                            "pivot_id": pivot_id,
                            "test_id": test_id,
                            "question_id": question_id,
                            "test_id_test": test_id_test,
                            "_token": token,
                        },
                        success: function (dataJson) {
                            if(dataJson.status == 'fail') {
                                if(dataJson.code == 403){

                                    Swal.fire({
                                        title: 'Bạn cần đăng nhập để trải nghiệm nhiều hơn. Bạn có đồng ý?',
                                        showCancelButton: true,
                                        confirmButtonText: 'Đồng ý',
                                        cancelButtonText:'Đóng'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = '{{ Route('frontend.auth.login') }}';
                                        }
                                    })

                                }else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Thông báo',
                                        text: dataJson.message,
                                    })
                                }
                            }else {
                                if(dataJson.data.responseJson == 'notPreview') {

                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Thông báo',
                                        text: 'Không quay trở lại nữa',
                                    })

                                }else {
                                    $('#wizard').html(dataJson.data.responseJson)
                                }

                            }
                        }
                    })
                });

                $(document).on('click','button#nextBtn',function(e){

                    if(!$("li.step_1").hasClass("active")){
                        Swal.fire({
                            icon: 'error',
                            title: 'Thông báo',
                            text: 'Vui lòng click chọn câu hỏi',
                        })
                    }else {
                        let token = $("meta[name='csrf-token']").attr("content");
                        let answer_id = $(this).data('answer_id');
                        let pivot_id = $(this).data('pivot_id');
                        let test_id = $(this).data('test_id');
                        let question_id = $(this).data('question_id');
                        let test_id_test = $('#test_id_test').val();
                        $.ajax({
                            url: "{{ Route('frontend.tests.next',['id'=>$test->id]) }}",
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                "answer_id": answer_id,
                                "pivot_id": pivot_id,
                                "test_id": test_id,
                                "question_id": question_id,
                                "test_id_test": test_id_test,
                                "_token": token,
                            },
                            success: function (dataJson) {
                                if(dataJson.status == 'fail') {
                                    if(dataJson.code == 403){

                                        Swal.fire({
                                            title: 'Bạn cần đăng nhập để trải nghiệm nhiều hơn. Bạn có đồng ý?',
                                            showCancelButton: true,
                                            confirmButtonText: 'Đồng ý',
                                            cancelButtonText:'Đóng'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.location.href = '{{ Route('frontend.auth.login') }}';
                                            }
                                        })

                                    }else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Thông báo',
                                            text: dataJson.message,
                                        })
                                    }
                                }else {
                                    if(dataJson.data.responseJson == 'xemketqua') {

                                        Swal.fire({
                                            title: 'Bạn có muốn xem kết quả của bài kiểm tra ?',
                                            showCancelButton: true,
                                            confirmButtonText: 'Đồng ý',
                                            cancelButtonText:'Đóng'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                let id = dataJson.data.tesyusertest_id;
                                                window.location.href = BASE_URL+'/bai-kiem-tra/ket-qua/'+id;
                                            }
                                        })

                                    }else {
                                        $('#wizard').html(dataJson.data.responseJson)
                                    }

                                }
                            }
                        })
                    }

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
                        window.location.href = BASE_URL+'/bai-kiem-tra/ket-qua/{{ $checkUserTest ? $checkUserTest->id : 0 }}';
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
                        window.location.href = BASE_URL+'/bai-kiem-tra/ket-qua/{{ $checkUserTest ? $checkUserTest->id : 0 }}';
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

