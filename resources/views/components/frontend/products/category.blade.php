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
                <li><a href="{{ Route('frontend.products.category',['id'=>$category->id]) }}">{{ $category->name ?? '' }}</a></li>
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
                                        <a href="{{ Route('frontend.product.edit',['slug'=>$post->slug]) }}"><img src="{{ asset('frontend') }}/assets/img/spinner.gif" class="lozad" data-src="{{ str_replace(Str::of($post->default()['url'])->basename(),Str::of($post->default()['url'])->basename(),asset('storage/products/'.$post->default()['url'])) }}" alt="{{ $post->name ?? '' }}"></a>
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

    <x-slot name="javascript">
        <script>
            $( document ).ready(function() {

                $(document).on('change','#color,#price,#sort_id',function (event) {
                    let color = $('#color').val();
                    let price = $('#price').val();
                    let sort_id = $('#sort_id').val();
                    window.location.href = '{{ Route('frontend.products.category',['id'=>$category->id]) }}'+'/?color='+color+'&price='+price+'&sort_id='+sort_id
                })
            });
        </script>
    </x-slot>

    <div class="clear"></div>
    
    @if($category->contentCate)
        <div class="ctn textcate">{!! $category->contentCate ?? '' !!}</div> 
    @else
        
    @endif
    <div class="line-xam"></div>
</x-layout.frontend>
