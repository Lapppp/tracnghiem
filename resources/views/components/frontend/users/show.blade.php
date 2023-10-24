<x-layout.frontend>
    <!-- breadcrum -->
    <section id="breadcrum">
        <div class="ctn">
            <h1>Chi tiết đơn hàng</h1>
            <div class="bread">
                <ul>
                    <li>
                        <a href="{{ Route('frontend.home.index') }}">Trang chủ</a>
                    </li>
                    <li>Chi tiết đơn hàng</li>

                </ul>
            </div>
        </div>
    </section>
    <!-- end breadcrum -->

    <section class="ctn page-thank">

        <div>
            <div class="cmd7">
                <h3>Chi tiết đơn hàng</h3>
                <div>
                    <table>
                        <tbody>
                            <tr>
                                <th>Tên Sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>

                            @if($orders->count() > 0)
                                @foreach($orders as $key =>$order)
                                    @foreach($order->ordersDetail()->get() as $k => $value)
                                        <tr>
                                            <td>
                                                <h3>{{ $value->product_name ?? '' }}</h3>
                                            </td>
                                            <td>
                                                @if($value->product->default() && $value->product->default()['url'])
                                                     <a href="{{ Route('frontend.product.edit',['slug'=>$value->product->slug]) }}" target="_blank">
                                                        <img width="100px" src="{{ str_replace(Str::of($value->product->default()['url'])->basename(),Str::of($value->product->default()['url'])->basename(),asset('storage/products/'.$value->product->default()['url'])) }}" alt="{{ $value->product->name ?? '' }}">
                                                     </a>
                                                @endif
                                            </td>
                                            <td style="text-align: center">
                                                {{ $value->qty }}
                                            </td>
                                            <td class="price_total">
                                                <span>{{ number_format($value->total,0, '.', '.') }}</span>đ
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @else
                                <tr>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>

            @if($orders->count() > 0)
                <div class="cmd5">
                    <div class="right-thank">
                        <h3>Cảm ơn bạn. Đơn hàng của bạn đã được tiếp nhận.</h3>
                        <ul>
                            @foreach($orders as $key =>$order)
                                <li>» <span>Tên khách hàng: </span>{{ $order->full_name ?? '' }}</li>
                                <li>» <span>Số điện thoại: </span>{{ $order->phone ?? '' }}</li>
                                <li>» <span>Email: </span>{{ $order->email ?? '' }}</li>
                                <li>» <span>Địa chỉ: </span>N{{ $order->address ?? '' }}</li>
                                <li>» <span>Phương thức thanh toán: </span>{{ !empty($order->paymentMethod) ? $paymentMethod[$order->paymentMethod] : '' }}</li>
                                <li>» <span>Ngày: </span>{{ !empty($order->created_at) ? date("d/m/Y",strtotime($order->created_at)) : '' }}</li>
                                <li class="sum-price">» <span>Tổng cộng: </span>{{ !empty($order->total) ? number_format($order->total,0, '.', '.') : 0  }}đ</li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            @endif

        </div>
    </section>


    <section class="ctn a5">
        @if($bannerPositionTwo)
            @if($bannerPositionTwo->default() && $bannerPositionTwo->default()['url'])
                <img src="{{ str_replace(Str::of($bannerPositionTwo->default()['url'])->basename(),Str::of($bannerPositionTwo->default()['url'])->basename(),asset('storage/banner/'.$bannerPositionTwo->default()['url'])) }}" alt="{{ $bannerPositionTwo->name ?? '' }}" class="banner-pc">
                <img src="{{ str_replace(Str::of($bannerPositionTwo->default()['url'])->basename(),Str::of($bannerPositionTwo->default()['url'])->basename(),asset('storage/banner/'.$bannerPositionTwo->default()['url'])) }}" alt="{{ $bannerPositionTwo->name ?? '' }}" class="banner-mobile">
            @endif
        @else
            <img src="{{ asset('/frontend/assets') }}/a/i/banner1.jpg')}}" alt="banner" class="banner-pc">
            <img src="{{ asset('/frontend/assets') }}/a/i/banner1-mb.jpg')}}" alt="banner" class="banner-mobile">
        @endif
    </section>
    <div class="space"></div>

</x-layout.frontend>
