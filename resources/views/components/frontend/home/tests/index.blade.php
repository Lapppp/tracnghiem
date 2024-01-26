<x-layout.frontend>

    @if(count($banners) > 0)
        <!-- Start slider section -->
        <section class="hero__slider--section pt-0 section--padding">
            <div class="hero__slider--inner hero__slider--activation swiper">
                <div class="hero__slider--wrapper swiper-wrapper">

                    @foreach($banners as $key => $value)
                        @if($loop->first)
                            <style type="text/css">
                                .home1__slider--bg {
                                    @if($value->default() && $value->default()['url'] && $isMobile ==0) background: url({{ str_replace(Str::of($value->default()['url'])->basename(),Str::of($value->default()['url'])->basename(),asset('storage/banner/'.$value->default()['url'])) }}); @endif
                                    @if($value->mobile() && $value->mobile()['url'] && $isMobile ==1) background: url({{ str_replace(Str::of($value->mobile()['url'])->basename(),Str::of($value->mobile()['url'])->basename(),asset('storage/banner/'.$value->mobile()['url'])) }}); @endif
                                    background-repeat: no-repeat;
                                    background-attachment: scroll;
                                    background-position: center center;
                                    background-size: cover;
                                }

                                @media only screen and (max-width: 767px) {
                                    .home1__slider--bg {
                                        background-position: 0%;
                                    }
                                }
                            </style>
                            <div class="swiper-slide">
                                <div class="hero__slider--items home1__slider--bg">
                                    <div class="container-fluid">
                                        <div class="hero__slider--items__inner">
                                            <div class="row row-cols-1">
                                                <div class="col">
                                                    <div class="slider__content">
                                                        <p class="slider__content--desc desc1 mb-15" style="display: none">
                                                            <img class="slider__text--shape__icon" src="{{ asset('/frontend') }}/assets/img/icon/text-shape-icon.png" alt="text-shape-icon"> {{ $value->name ?? '' }}
                                                        </p>
                                                        <h2 class="slider__content--maintitle h1">{!! $value->description ?? '' !!}</h2>
                                                        <p class="slider__content--desc desc2 d-sm-2-none mb-40"><br></p>
                                                    @if(!empty($value->url))
                                                            <a class="primary__btn slider__btn bg_orange" href="{{ $value->url }}" target="_blank">Xem chi tiết
                                                                <svg class="primary__btn--arrow__icon" xmlns="http://www.w3.org/2000/svg" width="20.2" height="12.2" viewBox="0 0 6.2 6.2">
                                                                    <path d="M7.1,4l-.546.546L8.716,6.713H4v.775H8.716L6.554,9.654,7.1,10.2,9.233,8.067,10.2,7.1Z" transform="translate(-4 -4)" fill="currentColor"></path>
                                                                </svg>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif


                            @if($key == 1)

                                <style type="text/css">
                                    .home1__slider--bg.two {
                                        @if($value->default() && $value->default()['url'] && $isMobile ==0) background: url({{ str_replace(Str::of($value->default()['url'])->basename(),Str::of($value->default()['url'])->basename(),asset('storage/banner/'.$value->default()['url'])) }}); @endif
                                    @if($value->mobile() && $value->mobile()['url'] && $isMobile ==1) background: url({{ str_replace(Str::of($value->mobile()['url'])->basename(),Str::of($value->mobile()['url'])->basename(),asset('storage/banner/'.$value->mobile()['url'])) }}); @endif
                                        background-repeat: no-repeat;
                                        background-attachment: scroll;
                                        background-position: center center;
                                        background-size: cover;
                                    }

                                    @media only screen and (max-width: 767px) {
                                        .home1__slider--bg.two {
                                            background-position: 0%;
                                        }
                                    }
                                </style>
                                <div class="swiper-slide">
                                    <div class="hero__slider--items home1__slider--bg two">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="hero__slider--items__inner">
                                                        <div class="slider__content">
                                                            <p class="slider__content--desc desc1 mb-15" style="display: none"><img class="slider__text--shape__icon" src="{{ asset('/frontend') }}/assets/img/icon/text-shape-icon.png" alt="text-shape-icon"> {{ $value->name ?? '' }}</p>
                                                            <h2 class="slider__content--maintitle h1">{!! $value->description ?? '' !!}</h2>
                                                            <p class="slider__content--desc desc2 d-sm-2-none mb-40 " ><br></p>
                                                        @if(!empty($value->url))
                                                                <a class="primary__btn slider__btn bg_orange" href="{{ $value->url }}" target="_blank">Xem chi tiết
                                                                    <svg class="slider__btn--arrow__icon" xmlns="http://www.w3.org/2000/svg" width="20.2" height="12.2" viewBox="0 0 6.2 6.2">
                                                                        <path d="M7.1,4l-.546.546L8.716,6.713H4v.775H8.716L6.554,9.654,7.1,10.2,9.233,8.067,10.2,7.1Z" transform="translate(-4 -4)" fill="currentColor"></path>
                                                                    </svg>
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif


                            @if($loop->last)

                                <style type="text/css">
                                    .home1__slider--bg.three {
                                        @if($value->default() && $value->default()['url'] && $isMobile ==0) background: url({{ str_replace(Str::of($value->default()['url'])->basename(),Str::of($value->default()['url'])->basename(),asset('storage/banner/'.$value->default()['url'])) }}); @endif
                                    @if($value->mobile() && $value->mobile()['url'] && $isMobile ==1) background: url({{ str_replace(Str::of($value->mobile()['url'])->basename(),Str::of($value->mobile()['url'])->basename(),asset('storage/banner/'.$value->mobile()['url'])) }}); @endif
                                        background-repeat: no-repeat;
                                        background-attachment: scroll;
                                        background-position: center center;
                                        background-size: cover;
                                    }

                                    @media only screen and (max-width: 767px) {
                                        .home1__slider--bg.three {
                                            background-position: 0%;
                                        }
                                    }
                                </style>
                                <div class="swiper-slide">
                                    <div class="hero__slider--items home1__slider--bg three">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-lg-6 offset-lg-6">
                                                    <div class="hero__slider--items__inner">
                                                        <div class="slider__content text-center">
                                                            <p class="slider__content--desc desc1 mb-15" style="display: none"><img class="slider__text--shape__icon" src="{{ asset('/frontend') }}/assets/img/icon/text-shape-icon.png" alt="text-shape-icon"> {{ $value->name ?? '' }}</p>
                                                            <h2 class="slider__content--maintitle h1">{!! $value->description ?? '' !!}</h2>
                                                            <p class="slider__content--desc desc2 d-sm-2-none mb-40" ><br></p>
                                                        @if(!empty($value->url))
                                                                <a class="primary__btn slider__btn bg_orange" href="{{ $value->url }}" target="_blank">Xem chi tiết
                                                                    <svg class="slider__btn--arrow__icon" xmlns="http://www.w3.org/2000/svg" width="20.2" height="12.2" viewBox="0 0 6.2 6.2">
                                                                        <path d="M7.1,4l-.546.546L8.716,6.713H4v.775H8.716L6.554,9.654,7.1,10.2,9.233,8.067,10.2,7.1Z" transform="translate(-4 -4)" fill="currentColor"></path>
                                                                    </svg>
                                                                </a>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endif

                    @endforeach

                </div>
                <div class="swiper__nav--btn swiper-button-next bg_orange"></div>
                <div class="swiper__nav--btn swiper-button-prev bg_orange"></div>
            </div>
        </section>
        <!-- End slider section -->
    @endif

    <!-- Start product section -->
    <section class="product__section section--padding pt-0">
        <div class="container-fluid">
            <div class="section__heading text-center mb-35">
                <h2 class="section__heading--maintitle">Bài Kiểm Tra</h2>
            </div>
            <ul class="product__tab--one product__tab--primary__btn d-flex justify-content-center mb-50">
                <li class="product__tab--primary__btn__list active" data-toggle="tab" data-target="#newarrival">Mới nhất</li>
                <li class="product__tab--primary__btn__list" data-toggle="tab" data-target="#featured">Hot </li>
                <li class="product__tab--primary__btn__list" data-toggle="tab" data-target="#trending">Xu hướng </li>
            </ul>
            <div class="tab_content">
                <div id="newarrival" class="tab_pane active show">
                    <div class="product__section--inner">
                        <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-2 mb--n30">
                            @include('components.frontend.home.tests.newarrival')
                        </div>
                    </div>
                </div>

                <div id="featured" class="tab_pane">
                    <div class="product__section--inner">
                        <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-2 mb--n30">
                            @include('components.frontend.home.tests.featured')
                        </div>
                    </div>
                </div>
                <div id="trending" class="tab_pane">
                    <div class="product__section--inner">
                        <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-2 mb--n30">
                            @include('components.frontend.home.tests.trending')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End product section -->

     @if(count($news) > 0)
        <!-- Start blog section -->
        <section class="blog__section section--padding pt-0">
            <div class="container-fluid">
                <div class="section__heading text-center mb-40">
                    <h2 class="section__heading--maintitle">Thông tin mới</h2>
                </div>
                <div class="blog__section--inner blog__swiper--activation swiper">
                    <div class="swiper-wrapper">

                        @foreach($news as $key => $item)
                            <div class="swiper-slide">
                                <div class="blog__items">
                                    <div class="blog__thumbnail">
                                        <a class="blog__thumbnail--link" href="{{ Route('frontend.news.show',['id'=>$item->id,'name'=>Str::slug($item->name.'', '-').'.html']) }}">
                                            @if($item->default() && $item->default()['url'])
                                                <img alt="{{ $item->name ?? '' }}" class="blog__thumbnail--img" src="{{ str_replace(Str::of($item->default()['url'])->basename(),'thumb_'.Str::of($item->default()['url'])->basename(),asset('storage/products/'.$item->default()['url'])) }}">
                                            @else
                                                <img src="{{ Avatar::create($item->name)->toBase64() }}" class="blog__thumbnail--img" alt="{{ $item->name ?? '' }}"/>
                                            @endif
                                        </a>
                                    </div>
                                    <div class="blog__content">
                                        <span style="display: none" class="blog__content--meta">{{ !empty($item->created_at) ? date('d/m/Y',strtotime($item->created_at)) : ''  }}</span>
                                        <h3 class="blog__content--title"><a href="{{ Route('frontend.news.show',['id'=>$item->id,'name'=>Str::slug($item->name.'', '-').'.html']) }}">{{ $item->name ?? '' }}</a></h3>
                                        <a class="blog__content--btn primary__btn" href="{{ Route('frontend.news.show',['id'=>$item->id,'name'=>Str::slug($item->name.'', '-').'.html']) }}">Xem chi tiết </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper__nav--btn swiper-button-next bg_orange"></div>
                    <div class="swiper__nav--btn swiper-button-prev bg_orange"></div>
                </div>
            </div>
        </section>
        <!-- End blog section -->
   @endif
</x-layout.frontend>
