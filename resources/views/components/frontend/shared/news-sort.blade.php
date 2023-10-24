<div class="row" id="category-sidebar-views">
    <h5>Tin xem nhiều</h5>

    @forelse ($newsSort as $key => $item)
        <div class="cate-hotnews-sidebar">
            <div id="cate-views-left">
                <a  href="{{ Route('frontend.news.show',['id'=>$item->id,'name'=>Str::slug($item->name.'', '-').'.html']) }}">
                @if($item->default() && $item->default()['url'])
                    <img alt="{{ $item->name ?? '' }}" class="img-responsive" src="{{ str_replace(Str::of($item->default()['url'])->basename(),'thumb_'.Str::of($item->default()['url'])->basename(),asset('storage/products/'.$item->default()['url'])) }}">
                @else
                    <img src="{{ Avatar::create($item->name)->toBase64() }}" class="i" alt="{{ $item->name ?? '' }}"/>
                @endif
                </a>
            </div>
            <div id="cate-views-right">
                <p><a style="color: #000;"  href="{{ Route('frontend.news.show',['id'=>$item->id,'name'=>Str::slug($item->name.'', '-').'.html']) }}">{{ $item->name ?? '' }}</a></p>
                <p class="timeArticle" style="font-size: 12px;">
                    <span><i class="fa fa-clock-o"></i> </span>
                </p>
            </div>
        </div>
    @empty
    @endforelse
</div>
