<x-layout.frontend>

    <!-- Start breadcrumb section -->
    <section class="breadcrumb__section breadcrumb__bg" style="@include('components.frontend.shared.banner.bg_banner')">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="breadcrumb__content text-center">
                        <h1 class="breadcrumb__content--title text-white mb-25">Kết quả bài kiểm tra</h1>
                        <ul class="breadcrumb__content--menu d-flex justify-content-center">
                            <li class="breadcrumb__content--menu__items"><a class="text-white"
                                                                            href="{{ Route('frontend.home.index') }}">Trang
                                    chủ</a></li>
                            <li class="breadcrumb__content--menu__items"><span class="text-white">{{ $test->title ?? '' }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumb section -->

    <!-- Start contact section -->
    <style type="text/css">
        .list-group-item {
            padding:1rem 1rem !important;
            border-bottom: none !important;
            font-weight: normal !important;
        }
    </style>
    <section class="contact__section section--padding">
        <div class="container">
            <div class="section__heading text-center mb-40">
                <h2 class="section__heading--maintitle">{{ $test->title ?? '' }}</h2>
            </div>
            <div class="main__contact--area position__relative">

                <div class="contact__form" style="margin-left: 0px !important;">
                    <div class="alert alert-info" role="alert">
                       Tổng số câu đúng là: {{ $questionsCorrect }} câu
                    </div>
                    <form class="contact__form--inner" action="{{ Route('frontend.contact.store') }}">

                        @foreach($questions as $key => $question)
                            <div class="row">
                                <div class="col-12">
                                    <div class="contact__form--list mb-15">
                                        <h3 class="contact__form--title mb-2">Câu {{ $key + 1 }}: {{ $question->name ?? '' }}</h3>
                                        @if($question->answers()->count() > 0)
                                            <ul class="list-group list-group-flush">
                                                @php
                                                    $alphabet = 'A';
                                                @endphp

                                                @foreach($question->answers()->get() as $k => $val)
                                                    <li class="list-group-item">
                                                        <b>{{ $alphabet }}.</b> {{ $val->description ?? '' }}
                                                        @if($val->is_correct)
                                                            <p class="mt-1 mb-1">
                                                                <span class="badge bg-success">{{ $alphabet }} . Là câu trả lời đúng</span>
                                                                <a href="#" data-modal-id="popup" id="showViewBaiGiai_{{ $question->id }}"  title="{{ $question->name ?? '' }}" class="viewBaiGiai" data-id="{{ $question->id }}">
                                                                    <span class="badge bg-primary ">{{ $alphabet }} Xem bài giải</span>
                                                                </a>
                                                            </p>
                                                            <div hidden  id="viewBaiGiai_{{ $question->id }}">{!! $question->description ?? 'Đang cập nhật' !!}</div>
                                                        @endif

                                                        @if($question->pivot->is_correct == $val->id)
                                                            <p class="mt-1 mb-1"><span  class="badge bg-warning">{{ $alphabet }} . Là bạn trả lời</span></p>
                                                        @endif

                                                        @php
                                                            $alphabet++;
                                                        @endphp
                                                    </li>
                                                @endforeach

                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </form>
                </div>

            </div>
        </div>
    </section>
    <!-- End contact section -->

    @include('components.frontend.tests.modalbox')
    <button id="scroll__top"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M112 244l144-144 144 144M256 120v292"/></svg></button>

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

    <x-slot name="javascript">
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

            document.addEventListener("copy", (e) => {e.preventDefault();}, false);
            document.addEventListener('contextmenu', event => { event.preventDefault(); });
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

            $(document).ready(function() {

                $(document).on('keydown', function(e) {
                    if((e.ctrlKey || e.metaKey) && (e.key == "p" || e.charCode == 16 || e.charCode == 112 || e.keyCode == 80) ){
                        e.cancelBubble = true;
                        e.preventDefault();
                        e.stopImmediatePropagation();
                    }
                });

                var modal = $('.modal_box');
                var span = $('.close_box');

                $(document).on('click','a.viewBaiGiai',function (event) {
                    event.preventDefault();
                    let id = $(this).data('id');
                    let content = $('#viewBaiGiai_'+id).html();
                    $('#showContentBaiGia').html(content);
                    modal.show();
                })

                span.click(function () {
                    modal.hide();
                });

                $(window).on('click', function (e) {
                    if ($(e.target).is('.modal_box')) {
                        modal.hide();
                    }
                });

            })
        </script>
    </x-slot>

</x-layout.frontend>
