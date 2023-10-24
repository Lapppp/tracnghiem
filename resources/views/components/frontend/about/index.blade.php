<x-layout.frontend>
    <!-- breadcrum -->
    <section id="breadcrum">
        <div class="ctn">
            <h1>{{ $post->category->name ?? '' }}</h1>
            <div class="bread">
                <ul>
                    <li>
                        <a href="{{ Route('frontend.home.index') }}">Trang chủ</a>
                    </li>

                    <li><a href="{{ Route('frontend.news.index') }}">{{ $post->category->name ?? '' }}</a></li>
                    <li>{{ $post->name ?? '' }}</li>

                </ul>
            </div>
        </div>
    </section>
    <!-- end breadcrum -->


    <section class="ctn page-single-blog">
        <div class="ctn entry-content">
            <div class="cmd12 single-prd">
                <div class="cmd8">
                    <div class="description-prd">
                        <h2>{{ $post->name ?? '' }}</h2>
                        {!! $post->description ?? '' !!}
                    </div>

                    <!-- Đánh giá bình luận của khách hàng -->
                    <p class="title-single">đánh giá bình luận của khách hàng</p>
                    <div class="comment-prd" style="display: none">
                        <p>updating...</p>
                    </div>
                    <!-- End đánh giá bình luận -->
                </div>
                <div class="cmd4 sidebar-prd">

                    <!-- list category blog -->
                    <div class="dmsibar">
                        <p class="title-single">danh mục tin tức - hoạt động</p>
                        <ul>
                            @foreach($category as $key =>$item)
                                <li>
                                    <a href="{{ Route('frontend.news.category',['id'=>$item->id,'name'=>Str::slug($item->name.'', '-').'.html']) }}">
                                        {{ $item->name ?? '' }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- end list category blog -->

                    <!-- new blog -->
                    <div class="dmsibar">
                        <p class="title-single">Các tin khác</p>
                        <ul>
                            @foreach($otherNews as $key => $value)
                                <li>
                                    <a href="{{ Route('frontend.news.show',['id'=>$value->id,'name'=>Str::slug($value->name.'', '-').'.html']) }}">{{ $value->name }}</a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                    <!-- end new blog -->


                    <!-- sản phẩm mua kèm -->
                    <div class="prd-buywith">
                        <p class="title-single">sản phẩm được quan tâm</p>
                        <div class="sl-sbprd">

                            @foreach($products as $key => $value)
                                <div class="cmd12 itprd-diff">
                                    <div>
                                        <div class="top-itprd">
                                            <a href="{{ Route('frontend.product.edit',['slug'=>$value->slug]) }}">
                                                @if($value->default() && $value->default()['url'])
                                                    <img src="{{ str_replace(Str::of($value->default()['url'])->basename(),'thumb_'.Str::of($value->default()['url'])->basename(),asset('storage/products/'.$value->default()['url'])) }}" alt="{{ $value->name ?? '' }}">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="bot-itprd">
                                            <h3><a href="{{ Route('frontend.product.edit',['slug'=>$value->slug]) }}">{{ $value->name ?? '' }}</a></h3>
                                            <ul class="price">
                                                <li>{{ !empty($value->discount) ? number_format($value->discount,0, '.', '.') : number_format($value->price,0, '.', '.')  }} <span>đ</span></li>
                                                @if($value->discount)
                                                    <li>Giá cũ: {{ !empty($value->discount) ? number_format($value->price,0, '.', '.') : ''}} <span>đ</span></li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <!-- end sản phẩm mua kèm -->
                </div>
    </section>

    <!-- bài viết liên quan -->
    <section class="ctn">
        <div class="cmd12" id="recent-prd">
            <p class="ttsp">Bài viết liên quan</p>
            <div id="sl-recentprd">
                @foreach($otherSameNews as $key => $item)
                    <div class="cmd4">
                        <div class="it-post">
                            <a href="{{ Route('frontend.news.show',['id'=>$item->id,'name'=>Str::slug($item->name.'', '-').'.html']) }}">
                                @if($item->default() && $item->default()['url'])
                                    <img alt="{{ $item->name ?? '' }}" class="img-responsive" src="{{ str_replace(Str::of($item->default()['url'])->basename(),Str::of($item->default()['url'])->basename(),asset('storage/products/'.$item->default()['url'])) }}">
                                @endif
                            </a>
                            <h3><a href="{{ Route('frontend.news.show',['id'=>$item->id,'name'=>Str::slug($item->name.'', '-').'.html']) }}">{{ $item->name ?? '' }}</a></h3>
                            <p>{{ !empty($item->description) ? \App\Helpers\StringHelper::cutWordString($item->description) : '' }}</p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- end bài viết liên quan -->

    <div class="clear"></div>
    <div class="line-xam"></div>

</x-layout.frontend>

