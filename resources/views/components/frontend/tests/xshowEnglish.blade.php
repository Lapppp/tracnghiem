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

    <form class="multisteps_form bg-white position-relative overflow-hidden" style="max-width: none;background: none" id="wizard" method="POST" action="">


        <!------------------------- Step-1 ----------------------------->
        <div class="multisteps_form_panel step active" style="display: block;">
            <div class="alert alert-dark" role="alert">
                <span class="animate__animated animate__fadeInRight animate_25ms">A simple light alert—check it out!</span>
            </div>
            <div class="row pt-2 mt-1 form_items">
                        <div class="col-6">
                            <ul class="list-unstyled p-0">
                                <li class="step_1 animate__animated animate__fadeInRight active "
                                    data-answer_id=""
                                    data-pivot_id=""
                                    data-order_by=""
                                    data-test_id=""
                                    data-question_id="">
                                    <input id="opt_" type="radio" name="stp_1_select_option" value="">
                                    <label for="opt_"><b>A.</b> rere </label>
                                </li>
                            </ul>
                        </div>
                <div class="col-6">
                    <ul class="list-unstyled p-0">
                        <li class="step_1 animate__animated animate__fadeInRight"
                            data-answer_id=""
                            data-pivot_id=""
                            data-order_by=""
                            data-test_id=""
                            data-question_id="">
                            <input id="opt_" type="radio" name="stp_1_select_option" value="">
                            <label for="opt_"><b>A.</b> rere </label>
                        </li>
                    </ul>
                </div>
                <div class="col-6">
                    <ul class="list-unstyled p-0">
                        <li class="step_1 animate__animated animate__fadeInRight"
                            data-answer_id=""
                            data-pivot_id=""
                            data-order_by=""
                            data-test_id=""
                            data-question_id="">
                            <input id="opt_" type="radio" name="stp_1_select_option" value="">
                            <label for="opt_"><b>A.</b> rere </label>
                        </li>
                    </ul>
                </div>
                <div class="col-6">
                    <ul class="list-unstyled p-0">
                        <li class="step_1 animate__animated animate__fadeInRight"
                            data-answer_id=""
                            data-pivot_id=""
                            data-order_by=""
                            data-test_id=""
                            data-question_id="">
                            <input id="opt_1" type="radio" name="stp_1_select_option" value="">
                            <label for="opt_1"><b>A.</b> rere </label>
                        </li>
                    </ul>
                </div>

            </div>
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

