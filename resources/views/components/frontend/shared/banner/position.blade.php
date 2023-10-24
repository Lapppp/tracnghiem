@if($isMobile == 0 && $bannerPosition->count() > 0)
    <section
        @if($controller == 'ProductController' && $action =='show') style="display: none" @endif
    @if($controller == 'CartController' && $action =='index') style="display: none" @endif
        @if($controller == 'OrderController' && $action =='show') style="display: none" @endif
    @if($controller == 'UserController' && $action =='forgotPassword') style="display: none" @endif
        @if($controller == 'UserController' && $action =='resetPassword') style="display: none" @endif
        class="banner pc-banner">


        @php $i = 0; @endphp
        @foreach($bannerPosition as $key => $value)
            @if($value->default() && $value->default()['url'])
                <div>
                    <img
                        src="{{ str_replace(Str::of($value->default()['url'])->basename(),Str::of($value->default()['url'])->basename(),asset('storage/banner/'.$value->default()['url'])) }}"
                        alt="{{ $value->name ?? '' }}">
                </div>
                @php $i++ @endphp
            @endif
        @endforeach


        @if($i == 0)
            <div>
                <img src="{{ asset('/frontend/assets/a/i/pc-bn1.jpg')}}">
            </div>
            <div>
                <img src="{{ asset('/frontend/assets/a/i/banner_2.png')}}">
            </div>
            <div>
                <img src="{{ asset('/frontend/assets/a/i/banner3.png')}}">
            </div>
        @endif

    </section>
@else
        <section
            @if($controller == 'ProductController' && $action =='show') style="display: none" @endif
        @if($controller == 'CartController' && $action =='index') style="display: none" @endif
            @if($controller == 'OrderController' && $action =='show') style="display: none" @endif
        @if($controller == 'UserController' && $action =='forgotPassword') style="display: none" @endif
            @if($controller == 'UserController' && $action =='resetPassword') style="display: none" @endif
            class="banner pc-banner">
        <div>
            <img src="{{ asset('/frontend/assets/a/i/pc-bn1.jpg')}}">
        </div>
        <div>
            <img src="{{ asset('/frontend/assets/a/i/banner_2.png')}}">
        </div>
        <div>
            <img src="{{ asset('/frontend/assets/a/i/banner3.png')}}">
        </div>
        </section>
@endif

@if($isMobile == 1 && $bannerPosition->count() > 0)
    <section class="banner mb-banner">
        @foreach($bannerPosition as $key => $value)
            @if($value->mobile() && $value->mobile()['url'])
                <div>
                    <img
                        src="{{ str_replace(Str::of($value->mobile()['url'])->basename(),Str::of($value->mobile()['url'])->basename(),asset('storage/banner/'.$value->mobile()['url'])) }}"
                        alt="{{ $value->name ?? '' }}">
                </div>
            @endif
        @endforeach
    </section>
@else
    <section class="banner mb-banner">
        <div>
            <img src="{{ asset('/frontend/assets/a/i/mb-b2.png')}}">
        </div>
        <div>
            <img src="{{ asset('/frontend/assets/a/i/mb-b1.png')}}">
        </div>
        <div>
            <img src="{{ asset('/frontend/assets/a/i/mb-b3.png')}}">
        </div>
    </section>
@endif
