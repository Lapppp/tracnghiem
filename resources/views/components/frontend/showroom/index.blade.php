<x-layout.frontend>


    <!-- breadcrum -->
    <section id="breadcrum">
        <div class="ctn">
            <h1>hệ thống showroom của kenji sport</h1>
            <div class="bread">
                <ul>
                    <li>
                        <a href="/">Trang chủ</a>
                    </li>
                    <li>hệ thống showroom</li>

                </ul>
            </div>
        </div>
    </section>
    <!-- end breadcrum -->
    <section class="ctn page-showroom">
        <ul class="pro-tab">
            <li class="active-pro tabl" href="#tabadd1">Hà Nội</li>
            <li class="tabl" href="#tabadd2">Hồ Chí Minh</li>
            <li class="tabl" href="#tabadd3">Miền Bắc</li>
            <li class="tabl" href="#tabadd4">Miền Trung</li>
            <li class="tabl" href="#tabadd5">Miền Nam</li>

        </ul>
        <div class="pro-content">
            <div class="tab-content tab-show" id="tabadd1">
                @foreach($provinceHaNoi as $province)
                    <div class="cxs12 csm4 cmd4 item-address" data-title="{{ $province->url ?? '' }}">
                        <div>
                            <h3>{{ $province->name ?? '' }}</h3>
                            <p class="a-address">{{ $province->address ?? '' }}</p>
                            <p class="phone-address">Điện thoại: {{ $province->phone ?? '' }}</p>
                            <ul>
                                <a href="#">Xem bản đồ</a>
                                <a>Có chỗ đậu oto</a>
                            </ul>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="tab-content" id="tabadd2">
                @foreach($provinceHoChiMinh as $province)
                    <div class="cxs12 csm4 cmd4 item-address" data-title="{{ $province->url ?? '' }}">
                        <div>
                            <h3>{{ $province->name ?? '' }}</h3>
                            <p class="a-address">{{ $province->address ?? '' }}</p>
                            <p class="phone-address">Điện thoại: {{ $province->phone ?? '' }}</p>
                            <ul>
                                <a href="#">Xem bản đồ</a>
                                <a>Có chỗ đậu oto</a>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="tab-content" id="tabadd3">
                @foreach($provinceMienBac as $province)
                    <div class="cxs12 csm4 cmd4 item-address" data-title="{{ $province->url ?? '' }}">
                        <div>
                            <h3>{{ $province->name ?? '' }}</h3>
                            <p class="a-address">{{ $province->address ?? '' }}</p>
                            <p class="phone-address">Điện thoại: {{ $province->phone ?? '' }}</p>
                            <ul>
                                <a href="#">Xem bản đồ</a>
                                <a>Có chỗ đậu oto</a>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>


            <div class="tab-content" id="tabadd4">
                @foreach($provinceMienTrung as $province)
                    <div class="cxs12 csm4 cmd4 item-address" data-title="{{ $province->url ?? '' }}">
                        <div>
                            <h3>{{ $province->name ?? '' }}</h3>
                            <p class="a-address">{{ $province->address ?? '' }}</p>
                            <p class="phone-address">Điện thoại: {{ $province->phone ?? '' }}</p>
                            <ul>
                                <a href="#">Xem bản đồ</a>
                                <a>Có chỗ đậu oto</a>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>



            <div class="tab-content" id="tabadd5">
                @foreach($provinceMienNam as $province)
                    <div class="cxs12 csm4 cmd4 item-address" data-title="{{ $province->url ?? '' }}">
                        <div>
                            <h3>{{ $province->name ?? '' }}</h3>
                            <p class="a-address">{{ $province->address ?? '' }}</p>
                            <p class="phone-address">Điện thoại: {{ $province->phone ?? '' }}</p>
                            <ul>
                                <a href="#">Xem bản đồ</a>
                                <a>Có chỗ đậu oto</a>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>


        </div>
    </section>
    <section id="map">
        <img src="{{ asset('/frontend/assets') }}/a/i/map.jpg" alt="">
    </section>

</x-layout.frontend>
