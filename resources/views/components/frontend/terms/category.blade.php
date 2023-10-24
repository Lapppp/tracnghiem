<x-layout.frontend>
    <!-- breadcrum -->
    <section id="breadcrum">
        <div class="ctn">
            <h1>{{ $category->name ?? '' }}</h1>
            <div class="bread">
                <ul>
                    <li>
                        <a href="{{ Route('frontend.home.index') }}">Trang chủ</a>
                    </li>

                    <li>{{ $category->name ?? '' }}</li>

                </ul>
            </div>
        </div>
    </section>
    <!-- end breadcrum -->

    <section class="ctn page-blog">
        @foreach($news as $key => $item)
            <div class="cxs12 csm4 cmd4">
                <div class="it-post">
                    <a href="{{ Route('frontend.news.show',['id'=>$item->id,'name'=>Str::slug($item->name.'', '-')]) }}">
                        @if($item->default() && $item->default()['url'])
                            <img alt="{{ $item->name ?? '' }}" class="img-responsive" src="{{ str_replace(Str::of($item->default()['url'])->basename(),Str::of($item->default()['url'])->basename(),asset('storage/products/'.$item->default()['url'])) }}">
                        @else
                            <img src="{{ Avatar::create($item->name)->toBase64() }}" class="i" alt="{{ $item->name ?? '' }}"/>
                        @endif
                    </a>
                    <h3><a href="{{ Route('frontend.news.show',['id'=>$item->id,'name'=>Str::slug($item->name.'', '-')]) }}">{{ $item->name ?? '' }}</a></h3>
                    <p>{{ !empty($item->description) ? \App\Helpers\StringHelper::cutWordString($item->description) : '' }}</p>
                </div>
            </div>
        @endforeach

    </section>

    <div class="clear"></div>
    <div class="line-xam"></div>

</x-layout.frontend>
