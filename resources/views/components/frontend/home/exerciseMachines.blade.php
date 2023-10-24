<!--<section class="a4" id="s-allmay">
    <div class="ctn">
        <div class="title1">
            <h2>{{ $exerciseMachinesCategory->name ?? '' }}</h2>
        </div>

        <ul class="pro-tab">
            @foreach ($exerciseMachinesCategory->childrenCategories as $key => $value)
                <li class="tabl @if($key==0) active-pro @endif" href="#tab6-{{$key}}">{{ $value->name ?? '' }}</li>
            @endforeach
        </ul>
        <div class="pro-content">
            @foreach ($exerciseMachinesCategory->childrenCategories as $k => $value)
                <div class="tab-content @if($k==0) tab-show @endif" id="tab6-{{$k}}">

                    @foreach($value->productsActive()->get() as $post)
                        <div class="cxs6 csm6 cmd3 item-product">
                            <div>
                                <div class="top-itprd">
                                    @if($post->default() && $post->default()['url'])
                                        <img src="{{ str_replace(Str::of($post->default()['url'])->basename(),Str::of($post->default()['url'])->basename(),asset('storage/products/'.$post->default()['url'])) }}" alt="{{ $post->name ?? '' }}">
                                    @endif
                                    <div class="list-button">
                                        <a href="#" class="AddCart" data-id="{{ $post->id }}"  data-qlt="{{ 1 }}"></a>
                                        <a href=""></a>
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
            @endforeach
        </div>
        <a href="#" class="seemore">Xem toàn bộ sản phẩm</a>
    </div>
</section>

-->