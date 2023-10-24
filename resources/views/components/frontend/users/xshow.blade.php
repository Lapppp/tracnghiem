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
                            <tr>
                                <td>
                                    <h3>Xe đạp thể dục đa năng X-speed  </h3>
                                </td>
                                <td>
                                    <img width="100px" src="https://kenjivietnam.vn/storage/products/2022/10/24/NyfemCzV22dAH1ICSujbDqeS4Ms4hdOfQTOltseb.jpg" alt="ghế">
                                </td>
                                <td>
                                    1
                                </td>
                                <td class="price_total">
                                    <span>2.990.000</span>đ
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="cmd5">
                <div class="right-thank">
                    <h3>Cảm ơn bạn. Đơn hàng của bạn đã được tiếp nhận.</h3>
                    <ul>
                        <li>» <span>Tên khách hàng: </span>Nguyễn Văn Đức</li>
                        <li>» <span>Số điện thoại: </span>098888888</li>
                        <li>» <span>Email: </span>traisonglam93@gmail.com</li>
                        <li>» <span>Địa chỉ: </span>Ngọc Sơn, Nghệ An</li>
                        <li>» <span>Phương thức thanh toán: </span>Chuyển khoản ngân hàng</li>
                        <li>» <span>Ngày: </span>15/11/2022</li>
                        <li class="sum-price">» <span>Tổng cộng: </span>9.000.000đ</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>


    <!-- page quản lý đơn hàng -->


    <!--<section class="ctn page-qldh">-->
    <!--    <table id="qldh">-->
    <!--        <thead>-->
    <!--        <tr>-->
    <!--            <th>Mã</th>-->
    <!--            <th>Tên khách hàng</th>-->
    <!--            <th>Số điện thoại</th>-->
    <!--            <th>Địa chỉ</th>-->
    <!--            <th>Ngày mua</th>-->
    <!--            <th>Tổng tiền</th>-->
    <!--            <th>Trạng thái</th>-->
    <!--        </tr>-->
    <!--        </thead>-->
    <!--        <tbody>-->
    <!--        @if($orders->count() > 0)-->
    <!--            @foreach($orders as $key =>$order)-->
    <!--                <tr class="shtt" data-order="4580">-->
    <!--                    <td class="ma">#{{ $order->code ?? '' }}</td>-->
    <!--                    <td>{{ $order->full_name ?? '' }}</td>-->
    <!--                    <td>{{ $order->phone ?? '' }}</td>-->
    <!--                    <td>{{ $order->address ?? '' }}</td>-->
    <!--                    <td>{{ !empty($order->created_at) ? date("d/m/Y",strtotime($order->created_at)) : '' }}</td>-->
    <!--                    <td>{{ !empty($order->total) ? number_format($order->total,0, '.', '.') : 0  }}<span>đ</span></td>-->
    <!--                    <td class="tthai">{{ !empty($order->status) ? $status[$order->status] : '' }}</td>-->
    <!--                </tr>-->
    <!--            @endforeach-->
    <!--        @else-->
    <!--            <tr class="shtt" data-order="4580">-->
    <!--                <td class="ma">#</td>-->
    <!--                <td>-</td>-->
    <!--                <td></td>-->
    <!--                <td>-</td>-->
    <!--                <td>-</td>-->
    <!--                <td>-</td>-->
    <!--                <td class="tthai">-</td>-->
    <!--            </tr>-->
    <!--        @endif-->
    <!--        </tbody>-->
    <!--    </table>-->

    <!--    <nav aria-label="Page navigation" class="ctn pagination">-->
    <!--        @if(!empty($pager))-->
    <!--            {!! $pager !!}-->
    <!--        @endif-->
    <!--    </nav>-->

    <!--</section>-->
    <!-- end page quản lý đơn hàng -->



    <!--<section class="page-cart ctn">-->
    <!--    <div class="cart-list">-->

    <!--        <table>-->
    <!--            <tbody><tr>-->
    <!--                <th>Tên Sản phẩm</th>-->
    <!--                <th>Giá</th>-->
    <!--                <th>Số lượng</th>-->
    <!--                <th>Thành tiền</th>-->
    <!--            </tr>-->
    <!--            @if($orders->count() > 0)-->
    <!--                @foreach($orders as $key =>$order)-->
    <!--                    @foreach($order->ordersDetail()->get() as $k => $value)-->
    <!--                        <tr>-->
    <!--                            <td>-->
    <!--                                <div class="img-cartl">-->
    <!--                                    @if($value->product->default() && $value->product->default()['url'])-->
    <!--                                       <a href="{{ Route('frontend.product.edit',['slug'=>$value->product->slug]) }}" target="_blank">-->
    <!--                                            <img src="{{ str_replace(Str::of($value->product->default()['url'])->basename(),Str::of($value->product->default()['url'])->basename(),asset('storage/products/'.$value->product->default()['url'])) }}" alt="{{ $value->product->name ?? '' }}">-->
    <!--                                       </a>-->
    <!--                                    @endif-->

    <!--                                </div>-->
    <!--                                <div class="tt-cartl">-->
    <!--                                    <h3>{{ $value->product_name ?? '' }}</h3>-->
    <!--                                </div>-->
    <!--                            </td>-->
    <!--                            <td class="price-cart">-->
    <!--                                <span>-->
    <!--                                    {{ number_format($value->price,0, '.', '.') }}-->
    <!--                                </span>đ-->
    <!--                            </td>-->
    <!--                            <td style="text-align: center">-->
    <!--                                {{ $value->qty }}-->
    <!--                            </td>-->
    <!--                            <td class="price_total">-->
    <!--                                <span> {{ $value->total }} </span>đ-->
    <!--                            </td>-->
    <!--                        </tr>-->
    <!--                    @endforeach-->
    <!--                @endforeach-->
    <!--            @endif-->

    <!--            </tbody>-->
    <!--        </table>-->
    <!--    </div>-->
    <!--</section>-->


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
