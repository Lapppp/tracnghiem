<x-layout.question>
    <x-slot name="counter">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo_area pt-5 ps-5">
                        <input type="hidden" name="counterHidden" id="counterHidden" value="0">
                        <input type="hidden" name="test_id_test" id="test_id_test" value="0">
                        <a href="{{ Route('frontend.home.index') }}" style="
                            border: 1px solid;
                            border-radius: 5px;
                            padding: 5px;
                            background: floralwhite;
                            ">
                            @if($footerCompany->default() && $footerCompany->default()['url'])
                                <img class="main__logo--img" src="{{ str_replace(Str::of($footerCompany->default()['url'])->basename(),'thumb_'.Str::of($footerCompany->default()['url'])->basename(),asset('storage/products/'.$footerCompany->default()['url'])) }}" alt="logo-img">
                            @else
                                Trang chủ
                            @endif
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 d-none d-sm-block">
                    <div class="count_box d-flex float-end pt-5">
                        <div class="count_clock countdown_timer d-flex align-items-center" data-countdown="{{ !empty($test->start_date) ? date("Y/m/d",strtotime($test->start_date)) : '' }}">
                        </div>
                        <!-- <div id="countdown"></div> -->
                        <!-- Step Progress bar -->
                        <div class="count_progress" id="showPercent" style="display: none">
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
                <h1 class="animate__animated animate__fadeInRight animate_25ms">Câu {{ $question->pivot->order_by }}: {{ $question->name ?? '' }}</h1>
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
                                    data-order_by="{{ $question->pivot->order_by}}"
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
    </form>
    <button id="scroll__top"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M112 244l144-144 144 144M256 120v292"/></svg></button>
    <x-slot name="css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" integrity="sha256-sWZjHQiY9fvheUAOoxrszw9Wphl3zqfVaz1kZKEvot8=" crossorigin="anonymous">
        <style>
            body {
                -webkit-user-select: none;  /* Chrome all / Safari all */
                -moz-user-select: none;     /* Firefox all */
                -ms-user-select: none;      /* IE 10+ */
                -o-user-select: none;
                user-select: none;
            }
            #scroll__top {
                position: fixed;
                bottom: 80px;
                right: 25px;
                z-index: 99;
                outline: none;
                background-color:#FFC061;
                color: #ffffff;
                -webkit-box-shadow: 0 2px 22px rgba(0, 0, 0, 0.16);
                box-shadow: 0 2px 22px rgba(0, 0, 0, 0.16);
                cursor: pointer;
                -webkit-transform: translateY(50px);
                transform: translateY(50px);
                opacity: 0;
                visibility: hidden;
                -webkit-transition: 0.3s;
                transition: 0.3s;
                line-height: 1;
                width: 3.3rem;
                height: 3.3rem;
                line-height: 1;
                border-radius: 50%;
                border: 0;
            }

            #scroll__top:hover {
                background: #061738;
            }

            #scroll__top.active {
                visibility: visible;
                opacity: 1;
                -webkit-transform: translateY(0);
                transform: translateY(0);
            }

            #scroll__top svg {
                width: 25px;
                line-height: 1;
            }
        </style>
    </x-slot>

    <x-slot name="javascript">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js" integrity="sha256-t0FDfwj/WoMHIBbmFfuOtZv1wtA977QCfsFR3p1K4No=" crossorigin="anonymous"></script>
        <script type="text/javascript">
            var c = {{ $test->score_time ? $test->score_time * 60 : 900  }};
            var t;

            // Back to top
            const scrollTop = document.getElementById("scroll__top");
            if (scrollTop) {
                scrollTop.addEventListener("click", function () {
                    window.scroll({ top: 0, left: 0, behavior: "smooth" });
                });
                window.addEventListener("scroll", function () {
                    if (window.scrollY > 300) {
                        scrollTop.classList.add("active");
                    } else {
                        scrollTop.classList.remove("active");
                    }
                });
            }

            document.addEventListener("copy", (e) => {e.preventDefault();}, false);
            document.addEventListener('contextmenu', event => { event.preventDefault(); });
            document.addEventListener("keyup", function (event) {
                var keyCode = event.keyCode ? event.keyCode : event.which;
                if (keyCode == 44) {
                    stopPrntScr();
                }
            });
            document.addEventListener('dragover', event => event.preventDefault());
            document.addEventListener('drop', event => event.preventDefault());
            window.addEventListener('keydown', function(event) {
                if (event.keyCode === 80 && (event.ctrlKey || event.metaKey) && !event.altKey && (!event.shiftKey || window.chrome || window.opera)) {
                    event.preventDefault();
                    if (event.stopImmediatePropagation) {
                        event.stopImmediatePropagation();
                    } else {
                        event.stopPropagation();
                    }
                    return;
                }
            }, true);

            function stopPrntScr() {
                var inpFld = document.createElement("input");
                inpFld.setAttribute("value", ".");
                inpFld.setAttribute("width", "0");
                inpFld.style.height = "0px";
                inpFld.style.width = "0px";
                inpFld.style.border = "0px";
                document.body.appendChild(inpFld);
                inpFld.select();
                document.execCommand("copy");
                inpFld.remove(inpFld);
            }
            $(document).ready(function() {
                disableSelection(document.body);
                $(document).on('keydown', function(e) {
                    if((e.ctrlKey || e.metaKey) && (e.key == "p" || e.charCode == 16 || e.charCode == 112 || e.keyCode == 80) ){
                        e.cancelBubble = true;
                        e.preventDefault();
                        e.stopImmediatePropagation();
                    }
                });

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

                $(document).on('click','button#prevBtn',function(e){
                    let token = $("meta[name='csrf-token']").attr("content");
                    let answer_id = $(this).data('answer_id');
                    let pivot_id = $(this).data('pivot_id');
                    let order_by = $(this).data('order_by');
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
                            "order_by": order_by,
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
                        let order_by = $(this).data('order_by');
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
                                "order_by": order_by,
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


                function disableSelection(target){
                    $(function() {
                        $(this).bind("contextmenu", function(e) {
                            e.preventDefault();
                        });
                    });
                    if (typeof target.onselectstart!="undefined") //For IE
                        target.onselectstart=function(){return false}
                    else if (typeof target.style.MozUserSelect!="undefined") //For Firefox
                        target.style.MozUserSelect="none"
                    else //All other route (For Opera)
                        target.onmousedown=function(){return false}
                    target.style.cursor = "default";
                }

            });




        </script>
    </x-slot>
</x-layout.question>

