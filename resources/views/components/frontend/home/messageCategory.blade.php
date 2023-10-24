<section class="a4" id="pro-ghe">
    <div class="ctn">
        <div class="title1">
            <h2>{{ $messageCategory->name ?? '' }}</h2>
        </div>

        <ul class="pro-tab">
            @php $i = 1 @endphp
            @foreach ($messageCategory->childrenCategories as $key => $value)
                <li class="tabl @if($key==0) active-pro @endif" href="#tab{{$i}}">{{ $value->name ?? '' }}</li>
                @php $i++ @endphp
            @endforeach

        </ul>
        <div class="pro-content">
            @php $n = 1 ; @endphp
            @foreach ($messageCategory->childrenCategories as $k => $value)
                <div class="tab-content @if($k==0) tab-show @endif" id="tab{{$n}}">

                    @foreach($value->productsActive()->limit(12)->get() as $post)
                        <div class="cxs6 csm6 cmd3 item-product">
                            <div>
                                <div class="top-itprd">
                                    @if($post->default() && $post->default()['url'])
                                        <a href="{{ Route('frontend.product.edit',['slug'=>$post->slug]) }}"><img src="{{ str_replace(Str::of($post->default()['url'])->basename(),Str::of($post->default()['url'])->basename(),asset('storage/products/'.$post->default()['url'])) }}" alt="{{ $post->name ?? '' }}"></a>
                                    @endif
                                    <div class="list-button">
                                        <a href="#" class="AddCart" data-id="{{ $post->id }}"  data-qlt="{{ 1 }}"></a>
                                        <a href="#" class="AddFavourite" data-id="{{ $post->id }}"></a>
                                        <a href="{{ Route('frontend.product.edit',['slug'=>$post->slug]) }}"></a>
                                    </div>
                                </div>
                                <div class="bot-itprd">
                                    <div class="star"></div>
                                    <h3><a href="{{ Route('frontend.product.edit',['slug'=>$post->slug]) }}">{{ $post->name ?? '' }}</a></h3>
                                    <ul class="price">
                                        <li>{{ !empty($post->discount) ? number_format($post->discount,0, '.', '.') : number_format($post->price,0, '.', '.')  }} <span>đ</span></li>
                                        @if($post->discount)
                                            <li>Giá cũ: {{ !empty($post->discount) ? number_format($post->price,0, '.', '.') : ''}} <span>đ</span></li>
                                        @endif
                                    </ul>
                                    @if($post->description_gift)
                                        <div class="gif">
                                        {!! html_entity_decode($post->description_gift) ?? '' !!}
                                        </div>
                                    @else
                                        <ul class="gif">
                                            <li>Quà tặng: 499.000đ</li>
                                            <li>Ưu đãi thêm (5%) cho khách hàng thân thiết</li>
                                        </ul>
                                    @endif
                                </div>

                                @if($post->percent)
                                    <span class="ic-sale">{{ $post->percent }}%</span>
                                @else
                                    <span class="ic-sale">Hot</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                @php $n++ @endphp
            @endforeach

        </div>
        <a href="{{ Route('frontend.product.edit',['slug'=>'ghe-massage']) }}" class="seemore">Xem toàn bộ sản phẩm</a>
    </div>
</section>

