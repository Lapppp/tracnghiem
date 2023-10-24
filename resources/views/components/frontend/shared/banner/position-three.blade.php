@if($isMobile == 1)
    <section class="ctn a5">
        @if($bannerPositionThree)
            @if($bannerPositionThree->mobile() && $bannerPositionThree->mobile()['url'])
                <img src="{{ asset('frontend') }}/assets/img/spinner.gif" class="lozad" data-src="{{ str_replace(Str::of($bannerPositionThree->mobile()['url'])->basename(),Str::of($bannerPositionThree->mobile()['url'])->basename(),asset('storage/banner/'.$bannerPositionThree->mobile()['url'])) }}" alt="{{ $bannerPositionThree->name ?? '' }}" class="banner-mobile">
            @else
                <img src="{{ asset('frontend') }}/assets/img/spinner.gif" class="lozad" data-src="{{ asset('/frontend/assets') }}/a/i/m-bn1.jpg" alt="banner" class="banner-mobile">
            @endif
        @else
            <img src="{{ asset('frontend') }}/assets/img/spinner.gif" class="lozad" data-src="{{ asset('/frontend/assets') }}/a/i/m-bn1.jpg" alt="banner" class="banner-mobile">
        @endif

    </section>
@else
    <section class="ctn a5">
        @if($bannerPositionThree)
            @if($bannerPositionThree->default() && $bannerPositionThree->default()['url'])
                <img src="{{ asset('frontend') }}/assets/img/spinner.gif" class="lozad" data-src="{{ str_replace(Str::of($bannerPositionThree->default()['url'])->basename(),Str::of($bannerPositionThree->default()['url'])->basename(),asset('storage/banner/'.$bannerPositionThree->default()['url'])) }}" alt="{{ $bannerPositionThree->name ?? '' }}" class="banner-pc">
            @else
                <img src="{{ asset('frontend') }}/assets/img/spinner.gif" class="lozad" data-src="{{ asset('/frontend/assets') }}/a/i/banner1.jpg')}}" alt="banner" class="banner-pc">
            @endif
        @else
            <img src="{{ asset('frontend') }}/assets/img/spinner.gif" class="lozad" data-src="{{ asset('/frontend/assets') }}/a/i/banner1.jpg')}}" alt="banner" class="banner-pc">
        @endif
    </section>
@endif

