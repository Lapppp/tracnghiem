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
            div.scrollYX{
                height:300px;
                overflow-x: hidden;
                overflow-y: auto;
            }

        </style>
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

    <form class="multisteps_form bg-white position-relative overflow-hidden" style="max-width: none;background: none" id="wizard" method="POST" action="">

        @if($test->description)
            <div class="alert alert-light border-bottom" role="alert">
               {!! $test->description !!}
            </div>
        @endif

        @foreach($parts as $key => $part)
            <!------------------------- Step-1 ----------------------------->
            <div class="multisteps_form_panel step active p-3" style="display: block;">
                <div class="alert alert-dark" role="alert">
                    <p class="m-0 fw-bold">{{ $part->name ?? '' }}</p>
                    @if($part->short_description)
                        <p class="m-0">{!! $part->short_description !!}</p>
                    @endif

                    @if($part->description)
                        <div class="m-0">{!! $part->description !!}</div>
                    @endif
                </div>

                <div class="scrollYX">
                @if($part->type != 1)
                    @if($part->posts()->count() > 0)
                        @php $iq = 1 @endphp
                     @foreach($part->posts()->get() as $k => $questions)
                            <div class="alert alert-warning me-3 ms-3" role="alert">
                                <span class="fw-bold">Câu {{ $k + $iq }}:</span> {{ $questions->name ?? '' }}
                            </div>

                            @if($questions->answers()->count() > 0)
                                @php
                                    $alphabet = 'A';
                                @endphp
                                <div class="row pt-2 mt-1 form_items me-3 ms-3">
                                     @foreach($questions->answers()->get() as $q => $answer)
                                        <div class="col-6">
                                            <ul class="list-unstyled p-0">
                                                <li class="step_1 animate__animated animate__fadeInRight" style="white-space:normal"
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


                        <div class="row me-3 ms-3">
                        @foreach($part->posts()->get() as $k => $questions)

                                <div class="col-md-6">
                            <div class="alert alert-warning " role="alert">
                                <span class="fw-bold">Câu {{ $k + $iq }}:</span> {{ $questions->name ?? '' }}
                            </div>

                            @if($questions->questionMultiples()->count() > 0)
                                @php
                                    $alphabet = 'A';
                                @endphp
                                <div class="row pt-2 mt-1 form_items">
                                    @foreach($questions->questionMultiples()->get() as $q => $answer)
                                        <div class="col-md-12">
                                            <ul class="list-unstyled p-0">
                                                <li class="step_2 animate__animated animate__fadeInRight"
                                                    data-answer_id="{{ $answer->id }}"
                                                    data-part_id="{{ $part->id }}"
                                                    data-test_id="{{ $test->id }}"
                                                    data-group="{{ $answer->group_question }}"
                                                    data-is_correct="{{ $answer->is_correct }}"
                                                    data-chosen="a"
                                                    data-question_id="{{ $questions->id }}">
                                                    <input id="opt_{{ $answer->id }}_a" type="radio" name="stp_1_select_option_{{ $answer->id }}_a" value="a">
                                                    <label for="opt_{{ $answer->id }}_a"><b>A.</b> {{ $answer->a ?? '' }} </label>
                                                </li>
                                                <li class="step_2 animate__animated animate__fadeInRight"
                                                    data-answer_id="{{ $answer->id }}"
                                                    data-part_id="{{ $part->id }}"
                                                    data-test_id="{{ $test->id }}"
                                                    data-chosen="b"
                                                    data-is_correct="{{ $answer->is_correct }}"
                                                    data-group="{{ $answer->group_question }}"
                                                    data-question_id="{{ $questions->id }}">
                                                    <input id="opt_{{ $answer->id }}_b" type="radio" name="stp_1_select_option_{{ $answer->id }}_a" value="b">
                                                    <label for="opt_{{ $answer->id }}_b"><b>B.</b> {{ $answer->b ?? '' }} </label>
                                                </li>
                                                <li class="step_2 animate__animated animate__fadeInRight"
                                                    data-answer_id="{{ $answer->id }}"
                                                    data-part_id="{{ $part->id }}"
                                                    data-test_id="{{ $test->id }}"
                                                    data-chosen="c"
                                                    data-is_correct="{{ $answer->is_correct }}"
                                                    data-group="{{ $answer->group_question }}"
                                                    data-question_id="{{ $questions->id }}">
                                                    <input id="opt_{{ $answer->id }}_c" type="radio" name="stp_1_select_option_{{ $answer->id }}_a" value="c">
                                                    <label for="opt_{{ $answer->id }}_c"><b>C.</b> {{ $answer->c ?? '' }} </label>
                                                </li>
                                                <li class="step_2 animate__animated animate__fadeInRight"
                                                    data-answer_id="{{ $answer->id }}"
                                                    data-part_id="{{ $part->id }}"
                                                    data-test_id="{{ $test->id }}"
                                                    data-chosen="d"
                                                    data-is_correct="{{ $answer->is_correct }}"
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
                            </div>

                        @endforeach
                        </div>
                    @endif
                @endif
                </div>

            </div>
        @endforeach

            <div class="mt-3 mb-3 border-top">
                <div class="d-grid gap-2 col-2 mx-auto mt-3">
                    <button class="btn btn-primary" type="button" id="NopBai">Nộp Bài</button>
                </div>
            </div>
    </form>



    <button id="scroll__top"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M112 244l144-144 144 144M256 120v292"/></svg></button>

    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('/frontend/questions')}}/assets/vendor/scrollbar/prettify.css" />
        <link rel="stylesheet" href="{{ asset('/frontend/questions')}}/assets/vendor/scrollbar/jquery.scrollbar.css" />
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
            document.addEventListener('dragover', event => event.preventDefault());
            document.addEventListener('drop', event => event.preventDefault());
            document.addEventListener("keyup", function (event) {
                var keyCode = event.keyCode ? event.keyCode : event.which;
                if (keyCode == 44) {
                    stopPrntScr();
                }
            });

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
            var c = {{ $test->score_time ? $test->score_time * 60 : 900  }};
            var t;
            document.addEventListener("copy", (e) => {e.preventDefault();}, false);
            document.addEventListener('contextmenu', event => { event.preventDefault(); });
            $(document).ready(function() {
                $(document).on('keydown', function(e) {
                    if((e.ctrlKey || e.metaKey) && (e.key == "p" || e.charCode == 16 || e.charCode == 112 || e.keyCode == 80) ){
                        e.cancelBubble = true;
                        e.preventDefault();

                        e.stopImmediatePropagation();
                    }
                });
                disableSelection(document.body);
                $(document).on('click', '.step_2',function(){


                    let group = $(this).data('group');
                    $("li[data-group='"+group+"']").removeClass("active")
                    $(this).addClass("active");
                    let token = $("meta[name='csrf-token']").attr("content");
                    let answer_id = $(this).data('answer_id');
                    let part_id = $(this).data('part_id');
                    let test_id = $(this).data('test_id');
                    let question_id = $(this).data('question_id');
                    let is_correct = $(this).data('is_correct');
                    let chosen = $(this).data('chosen');
                    $.ajax({
                        url: "{{ Route('frontend.tests.updateEnglish',['id'=>$test->id,'name'=>Str::slug($test->title.'', '-').'.html'])}}",
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "answer_id": answer_id,
                            "part_id": part_id,
                            "test_id": test_id,
                            "question_id": question_id,
                            "_token": token,
                            "is_correct": is_correct,
                            "chosen": chosen,
                        },
                        success: function (dataJson) {
                          //  window.location.href = '{{ Route('frontend.tests.resultEnglish',['id'=>$test->id,'name'=>Str::slug($test->title.'', '-').'.html']) }}';
                        }
                    })
                    return false;
                });


                $(document).on('click', '.step_1',function(){
                    //$(".step_1").removeClass("active");
                    let question_id = $(this).data('question_id');
                    $("li[data-question_id='"+question_id+"']").removeClass("active")
                    $(this).addClass("active");

                    let token = $("meta[name='csrf-token']").attr("content");
                    let answer_id = $(this).data('answer_id');
                    let part_id = $(this).data('part_id');
                    let test_id = $(this).data('test_id');
                    $.ajax({
                        url: "{{ Route('frontend.tests.updateEnglish',['id'=>$test->id,'name'=>Str::slug($test->title.'', '-').'.html'])}}",
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "answer_id": answer_id,
                            "part_id": part_id,
                            "test_id": test_id,
                            "question_id": question_id,
                            "_token": token,
                        },
                        success: function (dataJson) {

                        }
                    })
                    return false;

                });

                $(document).on('click', '#NopBai',function(){

                    Swal.fire({
                        title: 'Bạn làm xong bài kiểm tra, Bạn có muốn dừng bài kiểm tra và xem kết quả?',
                        showCancelButton: true,
                        confirmButtonText: 'Đồng ý',
                        cancelButtonText:'Đóng'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '{{ Route('frontend.tests.resultEnglish',['id'=>$test->id,'name'=>Str::slug($test->title.'', '-').'.html']) }}';
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
                        window.location.href = '{{ Route('frontend.tests.resultEnglish',['id'=>$test->id,'name'=>Str::slug($test->title.'', '-').'.html']) }}';
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
                        window.location.href = '{{ Route('frontend.tests.resultEnglish',['id'=>$test->id,'name'=>Str::slug($test->title.'', '-').'.html']) }}';
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

