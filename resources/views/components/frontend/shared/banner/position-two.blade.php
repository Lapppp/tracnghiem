@if($isMobile == 1)
    <section class="ctn a5">
        @if($bannerPositionTwo)
            @if($bannerPositionTwo->mobile() && $bannerPositionTwo->mobile()['url'])
                <img src="{{ asset('frontend') }}/assets/img/spinner.gif" class="lozad" data-src="{{ str_replace(Str::of($bannerPositionTwo->mobile()['url'])->basename(),Str::of($bannerPositionTwo->mobile()['url'])->basename(),asset('storage/banner/'.$bannerPositionTwo->mobile()['url'])) }}" alt="{{ $bannerPositionTwo->name ?? '' }}" class="banner-mobile">
            @else
                <img src="{{ asset('frontend') }}/assets/img/spinner.gif" class="lozad" data-src="{{ asset('/frontend/assets') }}/a/i/m-bn1.jpg" alt="banner" class="banner-mobile">
            @endif
        @else
            <img src="{{ asset('frontend') }}/assets/img/spinner.gif" class="lozad" data-src="{{ asset('/frontend/assets') }}/a/i/m-bn1.jpg" alt="banner" class="banner-mobile">
        @endif

    </section>
@else
    <section class="ctn a5">
        @if($bannerPositionTwo)
            @if($bannerPositionTwo->default() && $bannerPositionTwo->default()['url'])
                <img src="{{ asset('frontend') }}/assets/img/spinner.gif" class="lozad" data-src="{{ str_replace(Str::of($bannerPositionTwo->default()['url'])->basename(),Str::of($bannerPositionTwo->default()['url'])->basename(),asset('storage/banner/'.$bannerPositionTwo->default()['url'])) }}" alt="{{ $bannerPositionTwo->name ?? '' }}" class="banner-pc">
            @else
                <img src="{{ asset('frontend') }}/assets/img/spinner.gif" class="lozad" data-src="{{ asset('/frontend/assets') }}/a/i/banner1.jpg')}}" alt="banner" class="banner-pc">
            @endif
        @else
            <img src="{{ asset('frontend') }}/assets/img/spinner.gif" class="lozad" data-src="{{ asset('/frontend/assets') }}/a/i/banner1.jpg')}}" alt="banner" class="banner-pc">
        @endif
    </section>
@endif

