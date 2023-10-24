
    <form action="">
        <table id="showContentCartMenu" style="width: 100%;">
            <tr>
                <th>sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
            </tr>
            @forelse(Cart::content() as $row)
                <tr id="cart_row_{{ $row->rowId ?? ''  }}">
                    <td>
                        <span class="btn-delete-product" data-id="{{ $row->rowId }}"></span>
                        <div class="img-cartl">
                            <img src="{{ $row->options->has('image') ? $row->options->image : '' }}" alt="{{ $row->name ?? ''  }}">
                        </div>
                        <div class="tt-cartl">
                            <h3>{{ $row->name ?? ''  }}</h3>
                            <div class="att-pro" style="display: none">
                                Màu
                            </div>
                        </div>
                    </td>
                    <td class="price-cart"><span id="subTotalHome_{{ $row->rowId }}">{{ !empty($row->price) ? number_format($row->price,0, '.', '.') : '' }}</span>đ</td>
                    <td>
                        <div class="quantity">
                            <button type="button" id="sub" class="sub downCart" data-id="{{ $row->rowId }}" data-price="{{ $row->price }}">-</button>
                            <input type="text" id="cartQlt_{{ $row->rowId ?? ''  }}" value="{{ $row->qty ?? 1 }}" min="0" max="100" />
                            <button type="button" id="add" class="add upCart" data-id="{{ $row->rowId }}" data-price="{{ $row->price }}">+</button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td>Bạn chưa chọn sản phẩm</td>
                </tr>
            @endforelse

        </table>
        @if(Cart::count() > 0)
        <ul>
            <a href="{{ Route('frontend.cart.index') }}">Thanh toán</a>
            <a href="#" style="display: none">Cập nhật giỏ hàng</a>
        </ul>
        @endif
    </form>

