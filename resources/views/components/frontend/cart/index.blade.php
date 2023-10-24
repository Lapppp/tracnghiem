<x-layout.frontend>
<!-- breadcrum -->
<section id="breadcrum">
    <div class="ctn">
        <h1>Giỏ hàng</h1>
        <div class="bread">
            <ul>
                <li>
                    <a href="{{ Route('frontend.home.index') }}">Trang chủ</a>
                </li>
                <li>Giỏ hàng</li>
            </ul>
        </div>
    </div>
</section>
<!-- end breadcrum -->

<section class="page-cart ctn">
    <form action="{{ Route('frontend.orders.store') }}" method="post">
        <input type="hidden" name="cartNumberTotal" value="{{ Cart::count() }}">
        @csrf
        <div class="it-ttcart">
            <div class="cmd9">
                <div class="cart-list">

                    <table>
                        <tbody><tr>
                            <th>sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                        @foreach(Cart::content() as $row)
                            <tr id="cart_row_page{{ $row->rowId ?? ''  }}">
                                <td>
                                    <span data-id="{{ $row->rowId }}" class="btn-delete-product"></span>
                                    <div class="img-cartl">
                                        <!--<a href="{{ $row->options->has('slug') ? Route('frontend.product.edit',['slug'=>$row->options->slug]) : '#' }}">-->
                                            <img src="{{ $row->options->has('image') ? $row->options->image : '' }}" alt="ghế">
                                        <!--</a>-->
                                    </div>
                                    <div class="tt-cartl">
                                        <h3>{{ $row->name ?? ''  }}  </h3>
                                        <div class="att-pro" style="display: none">
                                            Màu
                                        </div>
                                    </div>
                                </td>
                                <td class="price-cart"><span id="price-cart_{{ $row->rowId ?? ''  }}">{{ !empty($row->price) ? number_format($row->price,0, '.', '.') : '' }}</span>đ</td>
                                <td>
                                    <div class="quantity">
                                        <button type="button" id="sub{{ $row->rowId ?? ''  }}" data-id="{{ $row->rowId ?? ''  }}" class="SubCartPage" data-price="{{ $row->price }}">-</button>
                                        <input type="text" id="qty_{{ $row->rowId ?? ''  }}" value="{{ $row->qty ?? 1 }}" min="0" max="100">
                                        <button type="button" id="add{{ $row->rowId ?? ''  }}" data-id="{{ $row->rowId ?? ''  }}" class="AddCartPage" data-price="{{ $row->price }}">+</button>
                                    </div>
                                </td>
                                <td class="price_total">
                                    <span id="subTotalPage_{{ $row->rowId ?? ''  }}">{{ number_format((int)$row->total,0, '.', '.') }}</span>đ
                                </td>
                            </tr>
                        @endforeach

                        </tbody></table>
                    <ul style="display: none">
                        <div class="input-wrapper">
                            <input type="text" id="discount_code" name="discount_code" value="" autocomplete="nope" placeholder="Mã giảm giá">
                        </div>
                        <a href="#">Áp mã giảm giá</a>
                        <a href="#">Cập nhật giỏ hàng</a>
                    </ul>

                </div>
            </div>
            <div class="cmd3">
                <ul class="cart-info">
                    <li>Tổng chi phí</li>
                    <li><span>Thành tiền</span> <span id="ThanhTien">{{ Cart::total() }}đ</span></li>

                    @if($cartFreeShip)
                        <li><span>Vận chuyển</span>
                            <div>
                                <div>
                                    <img src="{{ asset('frontend') }}/assets/a/i/ic10.png" alt="thành tiền">Miền phí vận chuyển
                                </div>
                                <div>
                                    <img src="{{ asset('frontend') }}/assets/a/i/ic10.png" alt="thành tiền">Miễn phí lắp đặt
                                </div>
                                <u>Tính phí:</u> 0</div>
                        </li>
                    @endif

                    <li><span>Thanh toán</span> <b><span id="ThanhTien_All">{{ Cart::total() }}đ</span></b>
                    </li>
                    <li style="display: none;"><a class="check-confirm">Kiểm tra và xác nhận</a></li>

                </ul>
            </div>
        </div>
        <div class="it-ttcart">
            <div class="cmd9">
                <div class="card">

                    <div class="card-body">

                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <label class="styled-radio" style="color: red">
                                    {{$error}}
                                    <span class="radiobtn"></span>
                                </label>
                            @endforeach
                        @endif

                        <div>
                            <div class="cmd4">
                                <div class="form-group">
                                    <input type="text" name="full_name" id="full_name" value="{{ old('full_name') }}" class="form-control" placeholder="Tên người mua">
                                    <div class="name-error-list error-list"></div>
                                </div>
                            </div>
                            <div class="cmd4">
                                <div class="form-group">
                                    <input type="text" name="phone" id="phone" pattern="[0-9]*" value="{{ old('phone') }}" class="form-control" placeholder="Số điện thoại *" onkeyup="inputInt(this)" minlength="10">
                                    <div class="phone-error-list error-list"></div>
                                </div>
                            </div>

                            <div class="cmd4">
                                <div class="form-group">
                                    <input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="cmd4">
                                <div class="form-group">
                                    <input type="text" name="address" id="address" value="{{ old('address') }}" class="form-control" placeholder="Địa chỉ">
                                    <div class="address-error-list error-list"></div>
                                    <input type="hidden" name="addressfull" id="addressfull" value="">
                                </div>
                            </div>
                            <div class="cmd4">
                                <div class="form-group">
                                    <select class="form-control" name="provinceid" id="provinceid">
                                        <option value="">-- [ Chọn Tỉnh ] --</option>
                                        @foreach($provinces as $province)
                                            <option value="{{ $province->id }}" @if(old('provinceid') ==$province->id) selected="selected" @endif>{{ $province->name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    <div class="provinceid-error-list error-list"></div>
                                </div>
                            </div>
                            <div class="cmd4">
                                <div class="form-group">
                                    <select class="form-control" name="districtid" id="districtid">
                                        <option value="">-- [ Chọn Quận ] --</option>
                                    </select>
                                    <div class="districtid-error-list error-list"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cmd3">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0">Phương thức thanh toán</h6>
                    </div>
                    <div class="card-body">
                        <label class="styled-radio">
                            Thanh toán bằng tiền mặt khi nhận hàng
                            <input type="radio" checked="checked" name="paymentMethod" value="COD">
                            <span class="radiobtn"></span>
                        </label>
                        <label class="styled-radio">
                            Thanh toán qua hình thức chuyển khoản
                            <input type="radio" name="paymentMethod" value="ATM">
                            <span class="radiobtn"></span>
                        </label>
                        <label class="styled-radio">
                            Thanh toán cà thẻ VISA / MASTER card
                            <input type="radio" name="paymentMethod" value="VISA_MASTER">
                            <span class="radiobtn"></span>
                        </label>
                        <label class="styled-radio">
                            Thanh toán qua hình thức trả góp (ACS, Home Credit)
                            <input type="radio" name="paymentMethod" value="ACS_HOMECREDIT">
                            <span class="radiobtn"></span>
                        </label>
                        <label class="styled-radio disabled" style="opacity: .5;">
                            Thanh toán qua MOMO (Coming soon)
                            <input  type="radio" name="paymentMethod" value="MOMO">
                            <span class="radiobtn"></span>
                        </label>
                    </div>
                </div>
                <button class="btn-pay">Tiến hành thanh toán</button>
            </div>
        </div>
    </form>
</section>

<section class="ctn a5">

    <img src="{{ asset('frontend') }}/assets/a/i/banner2.jpg" alt="banner" class="banner-pc">
    <img src="{{ asset('frontend') }}/assets/a/i/banner2-mb.jpg" alt="banner" class="banner-mobile">
</section>
<div class="space"></div>

    <x-slot name="javascript">
        <script type="text/javascript" src="{{ asset('frontend') }}/assets/js/location.js"></script>
        <script type="text/javascript">
            $( document ).ready(function() {

                $(document).on('keyup paste','#phone',function () {
                    this.value = this.value.replace(/[^0-9]/g, '');
                })

            });
        </script>
    </x-slot>

</x-layout.frontend>
