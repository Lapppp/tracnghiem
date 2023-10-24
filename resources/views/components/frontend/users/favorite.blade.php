<x-layout.frontend>

    <!-- breadcrum -->
    <section id="breadcrum">
        <div class="ctn">
            <h1>Sản phẩm ưu thích</h1>
            <div class="bread">
                <ul>
                    <li>
                        <a href="{{ Route('frontend.home.index') }}">Trang chủ</a>
                    </li>
                    <li><a href="{{ Route('frontend.users.favorite') }}">Sản phẩm ưu thích</a></li>

                </ul>
            </div>
        </div>
    </section>
    <!-- end breadcrum -->

    <section class="page-product-favourite ctn">
        @if(!empty($favorite) && $favorite->count() > 0)
            @foreach($favorite as $key => $post)
                <div class="cmd12 item-product" id="removeFavorite_{{ $post->id }}">
                    <div>
                        <span class="btn-delete-product removeFavorite" data-id="{{ $post->id }}"></span>
                        <div class="top-itprd">
                            @if($post->default() && $post->default()['url'])
                                <img  src="{{ str_replace(Str::of($post->default()['url'])->basename(),Str::of($post->default()['url'])->basename(),asset('storage/products/'.$post->default()['url'])) }}" alt="{{ $post->name ?? '' }}">
                            @endif
                            <div class="list-button">
                                <a href="#" class="add-to-cart" data-id="{{ $post->id }}"></a>
                                <a href="#" class="AddFavourite" data-id="{{ $post->id }}"></a>
                                <a href="{{ Route('frontend.product.edit',['slug'=>$post->slug]) }}"></a>
                            </div>
                        </div>
                        <div class="bot-itprd">
                            <div class="item-star">
                                <div class="star"></div>
                                <span>đánh giá</span>
                            </div>
                            <h3><a href="{{ Route('frontend.product.edit',['slug'=>$post->slug]) }}">{{ $post->name ?? '' }}</a></h3>
                            <div class="item-att">
                                <ul class="price">
                                    <li>{{ !empty($post->discount) ? number_format($post->discount,0, '.', '.') : number_format($post->price,0, '.', '.')  }} <span>đ</span></li>
                                    <li>Giá cũ: {{ !empty($post->discount) ? number_format($post->price,0, '.', '.') : ''}} <span>đ</span></li>
                                </ul>
                            </div>


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


                            <div class="infor-product">
                                <ul>
                                    <li><span>Tình trạng:</span> Còn hàng</li>
                                    <li><span>Bảo hành:</span> {{ $post->warranty ?? '1' }} năm</li>
                                    <li><span>Bảo trị:</span> {{ $post->maintenance ?? 'Trọn đời' }}</li>
                                </ul>
                            </div>
                            <div class="end-favourite">
                                <div class="quantity">
                                    <button type="button" id="sub" class="sub">-</button>
                                    <input type="text" id="qlt_{{ $post->id ?? '' }}" value="1" min="0" max="100">
                                    <button type="button" id="add" class="add">+</button>
                                </div>
                                <div>
                                    <a href="#" class="add-to-cart" data-id="{{ $post->id ?? '' }}">Cho vào giỏ</a>
                                    <a href="#" data-id="{{ $post->id ?? '' }}" class="buy-now">Mua ngay</a>
                                    <a href="#" class="buy-pay" style="display:none">Mua trả góp 0 đồng</a>
                                    <a href="#" class="pay-btn" style="display:none">Thanh toán ATM, IB, QR PAY</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        @else
            <div style="display:none">Bạn chưa có sản phẩm yêu thích.</div>
        @endif
    </section>


    <nav aria-label="Page navigation" class="ctn pagination">
        @if(!empty($pager))
            {!! $pager !!}
        @endif
    </nav>

    <section class="ctn a5">
        @if($bannerPositionTwo)
            @if($bannerPositionTwo->default() && $bannerPositionTwo->default()['url'])
                <img src="{{ str_replace(Str::of($bannerPositionTwo->default()['url'])->basename(),Str::of($bannerPositionTwo->default()['url'])->basename(),asset('storage/banner/'.$bannerPositionTwo->default()['url'])) }}" alt="{{ $bannerPositionTwo->name ?? '' }}" class="banner-pc">
                <img src="{{ str_replace(Str::of($bannerPositionTwo->default()['url'])->basename(),Str::of($bannerPositionTwo->default()['url'])->basename(),asset('storage/banner/'.$bannerPositionTwo->default()['url'])) }}" alt="{{ $bannerPositionTwo->name ?? '' }}" class="banner-mobile">
            @endif
        @else
            <img src="{{ asset('/frontend/assets') }}/a/i/banner1.jpg')}}" alt="banner" class="banner-pc">
            <img src="{{ asset('/frontend/assets') }}/a/i/banner1-mb.jpg')}}" alt="banner" class="banner-mobile">
        @endif
    </section>
    <div class="space"></div>


    <x-slot name="javascript">
        <script type="text/javascript">
            $( document ).ready(function() {

            });
        </script>
    </x-slot>
</x-layout.frontend>
