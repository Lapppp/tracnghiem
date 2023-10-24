<div class="tab-content tab-show" id="tabnew1">
    @forelse ($news as $key =>$item)
        <div class="cxs12 csm4 cmd4">
            <div class="it-post">
                <a href="{{ Route('frontend.product.edit',['slug'=>$item->slug]) }}">
                    @if($item->default() && $item->default()['url'])
                        <img alt="{{ $item->name ?? '' }}" class="img-responsive" src="{{ str_replace(Str::of($item->default()['url'])->basename(),Str::of($item->default()['url'])->basename(),asset('storage/products/'.$item->default()['url'])) }}">
                    @else
                        <img src="{{ Avatar::create($item->name)->toBase64() }}" class="i" alt="{{ $item->name ?? '' }}"/>
                    @endif
                </a>
                <h3><a href="{{ Route('frontend.product.edit',['slug'=>$item->slug]) }}">{{ $item->name }}</a></h3>
                <p>{{ !empty($item->description) ? \App\Helpers\StringHelper::cutWordString($item->description) : '' }}</p>
            </div>
        </div>
    @empty
    @endforelse
</div>
