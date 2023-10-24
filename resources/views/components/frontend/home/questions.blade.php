<section id="a73">
    <section class="ctn a73">
        <div class="title1">
            <h2>câu hỏi thường gặp</h2>
        </div>
        <div>
            <img src="{{ asset('/frontend/assets')}}/a/i/5-mb.png" class="banner-mobile" alt="faq">
            <div class="cxs12 csm7 cmd7">
                <div id="accordion">
                    @php $i = 1 @endphp
                    @foreach($questions as $question =>$value)
                        <div class="item-accordion">
                            <h3><span>0{{$i}}</span>{{ $value->name ?? '' }}</h3>
                            <p><b>Trả lời:</b> {{ $value->answer ?? '' }}</p>
                        </div>
                        @php $i++ @endphp
                    @endforeach

                </div>
            </div>
            <div class="cxs12 csm5 cmd5">
                <img src="{{ asset('/frontend/assets')}}/a/i/5.png" class="banner-pc" alt="faq">
            </div>
        </div>
    </section>
</section>
