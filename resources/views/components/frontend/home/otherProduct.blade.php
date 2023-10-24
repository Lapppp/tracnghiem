<section class="a6 ctn" id="s-spdiff">
    <div class="title1">
        <h2>Thiết bị thể thao</h2>
    </div>
    <div class="slpro-diff">
        @foreach($otherProduct as $key=>$post)
            <div class="cmd4 itprd-diff">
                <div>
                    <div class="top-itprd">
                        @if($post->default() && $post->default()['url'])
                            <a href="{{ Route('frontend.product.edit',['slug'=>$post->slug]) }}"><img src="{{ asset('frontend') }}/assets/img/spinner.gif" class="lozad" data-src="{{ str_replace(Str::of($post->default()['url'])->basename(),Str::of($post->default()['url'])->basename(),asset('storage/products/'.$post->default()['url'])) }}" alt="{{ $post->name ?? '' }}"></a>
                        @endif
                    </div>
                    <div class="bot-itprd">
                        <h3><a href="{{ Route('frontend.product.edit',['slug'=>$post->slug]) }}">{{ $post->name ?? '' }}</a></h3>
                        <ul class="price">
                            <li>{{ !empty($post->discount) ? number_format($post->discount,0, '.', '.') : number_format($post->price,0, '.', '.')  }} <span>đ</span></li>
                            @if($post->discount)
                                <li>Giá cũ: {{ !empty($post->discount) ? number_format($post->price,0, '.', '.') : ''}} <span>đ</span></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
