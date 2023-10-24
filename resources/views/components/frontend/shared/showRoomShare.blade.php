<!-- start Showroom -->
<section class="ctn a9">
    <div class="cxs12 csm7 cmd7">
        <h2 class="title">HỆ THỐNG SHOWROOM CỦA KENJI SPORT</h2>
        <p>Chăm sóc sức khỏe hôm nay sẽ cho chúng ta hy vọng tươi sáng vào ngày mai. Mức năng lượng của bạn càng cao, cơ thể bạn càng hoạt động hiệu quả.</p>
        <div class="op-select">
            <div class="cxs5 cmd5">
                <select name="provinceid" id="provinceid">
                    <option value="">Chọn tỉnh, thành phố</option>
                    @foreach($province as $key =>$value)
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="cxs5 cmd5">
                <select name="districtid" id="districtid">
                    <option value="0">Chọn quận, huyện</option>
                </select>
            </div>
            <div class="cxs2 cmd2">
                <button id="searchShowRoom">Tìm kiếm</button>
            </div>
        </div>
        <h3><span id="numberShowRoom">{{ $numberShowRoom }}</span> cửa hàng KENJI SPORT</h3>
        <div class="list-shop" id="listShowRoom">
            @php $i = 1 @endphp
            @foreach($showroom as $k => $showItem)
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
            @endforeach
        </div>
    </div>
    <div class="cxs12 csm5 cmd5 right-a9">
        <div class="form-tuvan">
            <h2 class="title">Tư vấn sản phẩm miễn phí</h2>
            <div>
                <div>
                    <label>Họ tên *</label>
                    <input type="text" placeholder="Nhập họ và tên" id="full_name" name="full_name">
                </div>
                <div>
                    <label>Số điện thoại *</label>
                    <input type="text" placeholder="Nhập số điện thoại *" id="phone" name="phone">
                </div>
                <div>
                    <label>Thắc mắc của bạn</label>
                    <textarea id="description" name="description"></textarea>
                </div>
                <div class="end-form-tuvan">
                    <button id="sendAdvises">Gửi thông tin</button>
                    <p>Chúng tôi sẽ gọi lại tư vấn ngay</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end showroom -->
