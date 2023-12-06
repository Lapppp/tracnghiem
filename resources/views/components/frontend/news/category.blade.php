<x-layout.frontend>
    <!-- Start breadcrumb section -->
    <section class="breadcrumb__section breadcrumb__bg">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="breadcrumb__content text-center">
                        <h1 class="breadcrumb__content--title text-white mb-25">{{ $category->name ?? '' }}</h1>
                        <ul class="breadcrumb__content--menu d-flex justify-content-center">
                            <li class="breadcrumb__content--menu__items"><a class="text-white" href="{{ Route('frontend.test.index') }}">Trang chủ</a></li>
                            <li class="breadcrumb__content--menu__items"><span class="text-white">{{ $category->name ?? '' }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumb section -->

    <!-- Start blog section -->
    <section class="blog__section section--padding">
        <div class="container">
            <div class="section__heading text-center mb-50">
                <h2 class="section__heading--maintitle">{{ $title ?? '' }}</h2>
            </div>
            <div class="blog__section--inner">
                <div class="row row-cols-lg-3 row-cols-md-2 row-cols-sm-2 row-cols-sm-u-2 row-cols-1 mb--n30">

                    @foreach($news as $key =>$value)
                        <div class="col mb-30">
                            <div class="blog__items">
                                <div class="blog__thumbnail">
                                    <a class="blog__thumbnail--link" href="{{ Route('frontend.news.show',['id'=>$value->id,'name'=>Str::slug($value->name.'', '-').'.html']) }}">
                                        @if($value->default() && $value->default()['url'])
                                            <img class="blog__thumbnail--img" src="{{ str_replace(Str::of($value->default()['url'])->basename(),'thumb_'.Str::of($value->default()['url'])->basename(),asset('storage/products/'.$value->default()['url'])) }}" alt="product-img">
                                        @endif
                                    </a>
                                </div>
                                <div class="blog__content">
                                    <span class="blog__content--meta" style="display: none">{{ !empty($value->created_at) ? date('d-m-Y',strtotime($value->created_at)) : '' }}</span>
                                    <h3 class="blog__content--title"><a href="{{ Route('frontend.news.show',['id'=>$value->id,'name'=>Str::slug($value->name.'', '-').'.html']) }}">{{ $value->name }}</a></h3>
                                    <a class="blog__content--btn primary__btn" href="{{ Route('frontend.news.show',['id'=>$value->id,'name'=>Str::slug($value->name.'', '-').'.html']) }}">Xem chi tiết </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if(!empty($pager))
                    <div class="pagination__area bg__gray--color">
                        <nav class="pagination justify-content-center">
                            {!! $pager !!}
                        </nav>
                    </div>
                @endif

            </div>
        </div>
    </section>
    <!-- End blog section -->
</x-layout.frontend>
