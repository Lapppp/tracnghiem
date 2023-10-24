@php $i = 1 @endphp
@forelse ($searchShowRoom as $showItem)
    <div class="itshop">
        <h4><span>0{{$i}}</span>{{ $showItem->name ?? '' }}</h4>
        <div>
            <div class="cmd9">
                <p>{{ $showItem->address ?? '' }}</p>
                <a href="tel:{{ !empty($showItem->phone) ? \App\Helpers\StringHelper::getNumberFromString($showItem->phone) :'' }}">{{ $showItem->phone }} </a>
            </div>
            <div class="cmd3">
                <a target="_blank" href="{{ !empty($showItem->url) ? $showItem->url :'#' }}">Chỉ đường</a>
            </div>
        </div>
    </div>
    @php $i++ @endphp
@empty
    <div class="itshop">Không tìm thấy của hàng bạn chọn</div>
@endforelse
