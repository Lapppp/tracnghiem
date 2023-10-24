<x-layout.frontend>
<!-- breadcrum -->
<section id="breadcrum">
    <div class="ctn">
        <h1>Sản phẩm</h1>
        <div class="bread">
            <ul>
                <li>
                    <a href="{{ Route('frontend.home.index') }}">Trang chủ</a>
                </li>
                <li><a href="{{ Route('frontend.products.all.index') }}">Sản phẩm</a></li>
            </ul>
        </div>
    </div>
</section>
<!-- end breadcrum -->

    <!-- filter product -->
    <section id="filter-product">
        <div class="ctn">
            <div class="it-filter">
                <div>
                    <select class="select-color" name="sortcolor" id="color">
                        <option value="">Chọn màu sắc</option>
                        @foreach($colors as $key => $color)
                            <option value="{{ $key }}" @if(isset($params['color']) && $params['color'] ==$key) selected="selected" @endif >{{ $color }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="it-filter">
                <div>
                    <select class="select-price" name="sortprice" id="price">
                        <option value="">Chọn mức giá</option>
                        <option value="100000-500000" @if(isset($params['price']) && $params['price'] =='100000-500000') selected="selected" @endif>100.000 - 500.000</option>
                        <option value="500000-1000000" @if(isset($params['price']) && $params['price'] =='500000-1000000') selected="selected" @endif>500.000 - 1.000000</option>
                        <option value="1000000-2000000" @if(isset($params['price']) && $params['price'] =='1000000-2000000') selected="selected" @endif>1.000.000 - 3.000.000</option>
                        <option value="3000000-5000000" @if(isset($params['price']) && $params['price'] =='3000000-5000000') selected="selected" @endif>3.000.000 - 5.000.000</option>
                        <option value="5000000-10000000" @if(isset($params['price']) && $params['price'] =='5000000-10000000') selected="selected" @endif>5.000000 - 10.000.000</option>
                    </select>
                </div>
            </div>
            <div class="it-filter">
                <div>
                    <select class="select-order" name="sortorderby" id="sort_id">
                        <option value="">Chọn thứ tự</option>
                        <option value="0" @if(isset($params['sort_id']) && $params['sort_id'] ==0) selected="selected" @endif>Mới nhất</option>
                        <option value="1" @if(isset($params['sort_id']) && $params['sort_id'] ==1) selected="selected" @endif>Cũ nhất</option>
                    </select>
                </div>
            </div>
        </div>
    </section>
    <!-- end filter product -->


    <section class="a4" id="page-listproduct">
        <div class="ctn">
            <div class="pro-content">
                <div class="tab-content tab-show">

                    @foreach($products as $key => $post)
                        <div class="cxs6 csm6 cmd3 item-product">
                            <div>
                                <div class="top-itprd">
                                    @if($post->default() && $post->default()['url'])
                                        <img src="{{ asset('frontend') }}/assets/img/spinner.gif" class="lozad" data-src="{{ str_replace(Str::of($post->default()['url'])->basename(),Str::of($post->default()['url'])->basename(),asset('storage/products/'.$post->default()['url'])) }}" alt="{{ $post->name ?? '' }}">
                                    @endif
                                    <div class="list-button">
                                        <a href="#" class="AddCart" data-id="{{ $post->id }}"  data-qlt="{{ 1 }}"></a>
                                        <a href="#" class="AddFavourite" data-id="{{ $post->id }}"</a>
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
            </div>
            <a href="#" class="seemore" style="display:none">Xem thêm</a>
        </div>
    </section>
    <!--pagination-->

    <nav aria-label="Page navigation" class="ctn pagination">
    @if(!empty($pager))
        {!! $pager !!}
    @endif
    </nav>

    <!--end pagination-->
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


    <section class="a6 ctn" id="s-spdiff">
        <div class="title1">
            <h2>Sản phẩm mua kèm</h2>
        </div>
        <div class="slpro-diff">
            <div class="cmd4 itprd-diff">
                <div>
                    <div class="top-itprd">
                        <img src="{{ asset('/frontend/assets') }}/a/i/3.png" alt="bao tay">
                    </div>
                    <div class="bot-itprd">
                        <h3><a href="">GHẾ MASSAGE TOÀN THÂN KENJI KJ-6600</a></h3>
                        <ul class="price">
                            <li>9.990.0000 <span>đ</span></li>
                            <li>Giá cũ: 19.980.000 <span>đ</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="cmd4 itprd-diff">
                <div>
                    <div class="top-itprd">
                        <img src="{{ asset('/frontend/assets') }}/a/i/3.png" alt="bao tay">
                    </div>
                    <div class="bot-itprd">
                        <h3><a href="">GHẾ MASSAGE TOÀN THÂN KENJI KJ-6600</a></h3>
                        <ul class="price">
                            <li>9.990.0000 <span>đ</span></li>
                            <li>Giá cũ: 19.980.000 <span>đ</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="cmd4 itprd-diff">
                <div>
                    <div class="top-itprd">
                        <img src="{{ asset('/frontend/assets') }}/a/i/3.png" alt="bao tay">
                    </div>
                    <div class="bot-itprd">
                        <h3><a href="">GHẾ MASSAGE TOÀN THÂN KENJI KJ-6600</a></h3>
                        <ul class="price">
                            <li>9.990.0000 <span>đ</span></li>
                            <li>Giá cũ: 19.980.000 <span>đ</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="cmd4 itprd-diff">
                <div>
                    <div class="top-itprd">
                        <img src="{{ asset('/frontend/assets') }}/a/i/3.png" alt="bao tay">
                    </div>
                    <div class="bot-itprd">
                        <h3><a href="">GHẾ MASSAGE TOÀN THÂN KENJI KJ-6600</a></h3>
                        <ul class="price">
                            <li>9.990.0000 <span>đ</span></li>
                            <li>Giá cũ: 19.980.000 <span>đ</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="cmd4 itprd-diff">
                <div>
                    <div class="top-itprd">
                        <img src="{{ asset('/frontend/assets') }}/a/i/3.png" alt="bao tay">
                    </div>
                    <div class="bot-itprd">
                        <h3><a href="">GHẾ MASSAGE TOÀN THÂN KENJI KJ-6600</a></h3>
                        <ul class="price">
                            <li>9.990.0000 <span>đ</span></li>
                            <li>Giá cũ: 19.980.000 <span>đ</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="cmd4 itprd-diff">
                <div>
                    <div class="top-itprd">
                        <img src="{{ asset('/frontend/assets') }}/a/i/3.png" alt="bao tay">
                    </div>
                    <div class="bot-itprd">
                        <h3><a href="">GHẾ MASSAGE TOÀN THÂN KENJI KJ-6600</a></h3>
                        <ul class="price">
                            <li>9.990.0000 <span>đ</span></li>
                            <li>Giá cũ: 19.980.000 <span>đ</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="cmd4 itprd-diff">
                <div>
                    <div class="top-itprd">
                        <img src="{{ asset('/frontend/assets') }}/a/i/3.png" alt="bao tay">
                    </div>
                    <div class="bot-itprd">
                        <h3><a href="">GHẾ MASSAGE TOÀN THÂN KENJI KJ-6600</a></h3>
                        <ul class="price">
                            <li>9.990.0000 <span>đ</span></li>
                            <li>Giá cũ: 19.980.000 <span>đ</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="cmd4 itprd-diff">
                <div>
                    <div class="top-itprd">
                        <img src="{{ asset('/frontend/assets') }}/a/i/3.png" alt="bao tay">
                    </div>
                    <div class="bot-itprd">
                        <h3><a href="">GHẾ MASSAGE TOÀN THÂN KENJI KJ-6600</a></h3>
                        <ul class="price">
                            <li>9.990.0000 <span>đ</span></li>
                            <li>Giá cũ: 19.980.000 <span>đ</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="a2">
        <div class="ctn">
            <div class="title1">
                <h2>giới thiệu chung</h2>
                <!--@if($about)-->
                <!--    {!! $about->description ?? '' !!}-->
                <!--@endif-->
                <p>Sức khỏe là vàng, là điều quý giá nhất với mỗi người, khi có sức khỏe chúng ta sẽ làm được những điều chúng ta muốn và có một cuộc sống thật ý nghĩa.<br>
				Thời hạn của cuộc đời tùy thuộc sức khỏe, còn sức khỏe thì do cách sống quyết định. Sức khỏe là thứ mà ta không nhìn thấy được, là yếu tố sống còn của mỗi con người. Hãy nâng niu quý trọng sức khỏe, đừng để khi mất rồi mới thấy hối tiếc. Một thân thể không bệnh, một tâm hồn không loạn đó là chân hạnh phúc của con người.</p>
            </div>

            <div>
                <div class="cxs12 csm5 cmd5">
                    <img src="{{ asset('/frontend/assets') }}/a/i/1.png" alt="giới thiệu">
                </div>
                <div class="cxs12 csm7 cmd7">
                    <div>
                        @foreach ($videoHome as $video)
                            @if ($loop->first)
                                <a class="play-video" data-video="{{ $video->url ?? '' }}">
                                    @if($video->default() && $video->default()['url'])
                                        <img  src="{{ str_replace(Str::of($video->default()['url'])->basename(),Str::of($video->default()['url'])->basename(),asset('storage/video/'.$video->default()['url'])) }}">
                                    @endif
                                </a>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>

            <div class="clear"></div>

            <div id="slvd">
                @foreach ($videoHome as $key => $video)
                    @if($key > 0)
                        <div class="cxs12 csm4 cmd4 itvd">
                            <div>
                                <a class="play-video" data-video="{{ $video->url ?? '' }}">
                                    @if($video->default() && $video->default()['url'])
                                        <img   src="{{ str_replace(Str::of($video->default()['url'])->basename(),Str::of($video->default()['url'])->basename(),asset('storage/video/'.$video->default()['url'])) }}">
                                    @endif
                                </a>
                            </div>
                        </div>
                    @endif

                @endforeach

            </div>
        </div>
    </section>


    <x-slot name="javascript">
        <script type="text/javascript" src="{{ asset('frontend') }}/assets/js/products.js?v={{time()}}"></script>
    </x-slot>

</x-layout.frontend>
