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
                                                            <p class="mt-1 mb-1"><span class="badge bg-success">{{ $alphabet }} . Là câu trả lời đúng</span></p>
                                                            <div id="viewBaiGiai_{{ $question->id }}" style="display: none">{{ $question->description ?? 'Đang cập nhật' }}</div>
                                                        @endif

                                                        @if($question->pivot->is_correct == $val->id)
                                                            <p class="mt-1 mb-1"><span class="badge bg-warning">{{ $alphabet }} . Là bạn trả lời</span></p>
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

                        <button class="contact__form--btn primary__btn" style="display: none" type="submit">Gửi ngay bây giờ</button>
                    </form>
                </div>

            </div>
        </div>
    </section>
    <!-- End contact section -->


    <div class="modal fade" id="exampleModalLabel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xem bài giải</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="showBaiGiai">
                    dddddddddddddddddddddd
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>


    <x-slot name="javascript">
        <script type="text/javascript">
            $(document).ready(function() {

                $(document).on('click','.viewBaiGiai',function(e) {
                    let id = $(this).data('id');
                    let content = $('#viewBaiGiai_'+id).html()
                    $('#showBaiGiai').html('kkkkkk');
                    $('#exampleModalLabel').modal('show');
                })

            })
        </script>
    </x-slot>

</x-layout.frontend>
