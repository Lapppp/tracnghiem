@if(count($cookiesProduct) > 0)
    <section id="a61">
        <section class="a6 ctn">
            <div class="title1">
                <h2>Sản phẩm đã xem</h2>
            </div>
            <div class="slpro-diff">

                @foreach($cookiesProduct as $key => $post)
                    <div class="cxs12 csm4 cmd4 itprd-diff">
                        <div>
                            <div class="top-itprd">
                                @if($post->default() && $post->default()['url'])
                                    <a href="{{ Route('frontend.product.edit',['slug'=>$post->slug]) }}"><img src="{{ asset('frontend') }}/assets/img/spinner.gif" class="lozad" data-src="{{ str_replace(Str::of($post->default()['url'])->basename(),'thumb_'.Str::of($post->default()['url'])->basename(),asset('storage/products/'.$post->default()['url'])) }}" alt="{{ $post->name ?? '' }}"></a>
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
    </section>
@endif
