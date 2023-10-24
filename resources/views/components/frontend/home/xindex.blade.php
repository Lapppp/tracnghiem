<x-layout.frontend>
    <div id="containerMain" class="fullWidth">
        <div class="d-lg-none d-md-none" id="bannerMobile">
            <div class="row text-center" style="background: #f2f2f2;padding: 30px 0px 15px">
                <h1 class="col-12" style="font-size: 27px;">Phần mềm quản lý bán hàng<br> đa kênh</h1>
                <p class="col-12" style="font-size: 18px;">Tốt nhất, được sử dụng nhiều nhất</p>
                <p class="col-12" style="font-size: 16px">Hơn 80.000 cửa hàng đã tin dùng</p>
                <a aria-label="Phần mềm quản lý bán hàng đa kênh"><img alt="" src="/img/home/banner/default.svg"></a>
                <a href="/dang-ky-nhanh" id="btnBanner" rel="nofollow" style="width: 255px; margin: 25px auto 0px;">Dùng thử miễn phí</a>
            </div>
        </div>
        <div id="contentMain">
            <div id="box1" class="boxContent d-none d-md-block">
                <div class="row">
                    <!-- <div class="col-md-6 col-sm-5" style="color: rgb(3 38 115); font-weight: bold">
                        <h3>Phần mềm</h3>
                        <h3> Đăng Ký Nhanh và Quản Lý toàn diện</h3>
                        <h1>TÀI SẢN CHÍ TUỆ</h1>
                        <p>Phần mềm chuyên nghiệp và hỗ trợ Đăng Ký Nhanh và Quản lý toàn diện Tài sản trí tuệ Nền tảng công nghệ hiện đại, đội ngũ chuyên gia giỏi và giàu kinh nghiệm Hệ thống văn phòng hỗ trợ tại tất cả khu vực.
                        </p>
                        <br>
                        <button class="btn btn-info">Trải nghiệm ngay</button>
                    </div>
                    <div class="col-md-6 col-sm-7">
                    </div> -->
                    @if($banner->default() && $banner->default()['url'])
    
                        <img title="{{ $banner->name ?? '' }}" style="width: 100% !important;" alt="{{ $banner->name ?? '' }}" src="{{ str_replace(Str::of($banner->default()['url'])->basename(),Str::of($banner->default()['url'])->basename(),asset('storage/banner/'.$banner->default()['url'])) }}">
                    @else
                     <img  style="width: 100% !important;"  src="{{ asset('frontend') }}/assets/img/banner-full.png">
                    @endif

                </div>
            </div>

            <div class="products" style="box-shadow: inset -9px -200px 82px -32px #f0f3f6;padding-bottom: 7%">
                <div class="container">
                    <div class="row">
                        <p class="labelProbox first col-12">
                            Phần mềm iPas đem lại giá trị gì cho người dùng?
                        </p>
                        <div class="pcPanel d-none d-sm-block col-12">
                            <div class="row">
                                @forelse ($itemsOne as $item)
                                    <div class="col-md-3">
                                        <a  href="{{ Route('frontend.news.show',['id'=>$item->id,'name'=>Str::slug($item->name.'', '-').'.html']) }}" class="text-center a-image">
                                            @if($item->default() && $item->default()['url'])
                                                <img title="{{ $item->name ?? '' }}" alt="{{ $item->name ?? '' }}" src="{{ str_replace(Str::of($item->default()['url'])->basename(),'thumb_'.Str::of($item->default()['url'])->basename(),asset('storage/products/'.$item->default()['url'])) }}">
                                            @else
                                                <img src="{{ Avatar::create($item->name)->toBase64() }}" class="" alt=""/>
                                            @endif
                                        </a>
                                        <div class="mg-top">
                                            <h5><a href="{{ Route('frontend.news.show',['id'=>$item->id,'name'=>Str::slug($item->name.'', '-').'.html']) }}">{{ $item->name ?? '' }}</a></h5>
                                                <p>{{ $item->short_description ?? '' }}</p>
                                                <!-- <p><a class="posHover" href="/phan-mem-quan-ly-ban-hang-online"><span>Xem thêm</span><i class="fa fa-arrow-right"></i></a></p> -->
                                        </div>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                        <div class="mobiPanel d-lg-none d-md-none d-sm-none container">
                            <div class="row">
                                <div class="col-12 proItem first">
                                    <div>
                                        <div class="col-12 row pr-0">
                                            <a href="/phan-mem-quan-ly-ban-hang-online" class="text-center col-3 p-0"><img title="Phần mềm quản lý bán hàng" alt="Phần mềm quản lý bán hàng" src="/img/home/iconHome/POS.png"></a>
                                            <div class="col-9 text-left pr-0 pl-1">
                                                <h2><a href="/phan-mem-quan-ly-ban-hang-online">POS</a></h2>
                                                <span><b>Phần mềm quản lý bán hàng</b></span>
                                            </div>
                                        </div>
                                        <p class="col-12"><span>Tính tiền, in hóa đơn, mã vạch, quản lý kho, khuyến mại, kế toán, khách hàng, nhân viên, báo cáo</span></p>
                                        <p class="text-center"><a class="posHover" href="/phan-mem-quan-ly-ban-hang-online"><span>Xem thêm</span><i class="fa fa-arrow-right"></i></a></p>
                                    </div>
                                </div>
                                <div class="col-12 proItem first">
                                    <div>
                                        <div class="col-12 row pr-0">
                                            <a href="/gioi-thieu-tinh-nang-website" class="text-center col-3 p-0"><img title="Thiết kế Website chuyên nghiệp" alt="Thiết kế Website chuyên nghiệp" src="/img/home/iconHome/Website.png"></a>
                                            <div class="col-9 text-left pr-0 pl-1">
                                                <h2><a href="/gioi-thieu-tinh-nang-website">Website</a></h2>
                                                <span><b>Thiết kế Website chuyên nghiệp</b></span>
                                            </div>
                                        </div>
                                        <p class="col-12"><span>Giao diện thân thiện, responsive, chuẩn SEO, tốc độ nhanh, không giới hạn dung lượng băng thông</span></p>
                                        <p class="text-center"><a class="webHover" href="/gioi-thieu-tinh-nang-website"><span>Xem thêm</span><i class="fa fa-arrow-right"></i></a></p>
                                    </div>
                                </div>
                                <div class="col-12 proItem first">
                                    <div>
                                        <div class="col-12 row pr-0">
                                            <a href="//vpage.nhanh.vn/" target="_blank" rel="noopener" class="text-center col-3 p-0"><img title="Phần mềm quản lý bán hàng trên Fanpage Facebook" alt="Phần mềm quản lý bán hàng trên Fanpage Facebook" src="/img/home/iconHome/Vpage.png"></a>
                                            <div class="col-9 text-left pr-0 pl-1">
                                                <h2><a href="//vpage.nhanh.vn/" target="_blank" rel="noopener">Vpage</a></h2>
                                                <span><b>Phần mềm quản lý bán hàng trên Facebook</b></span>
                                            </div>
                                        </div>
                                        <p class="col-12"><span>Quản lý nhiều page, tổng hợp comment, inbox, ẩn bình luận, trả lời nhanh, gắn tag hội thoại</span></p>
                                        <p class="text-center"><a class="vpageHover" href="//vpage.nhanh.vn/"><span>Xem thêm</span><i class="fa fa-arrow-right"></i></a></p>
                                    </div>
                                </div>
                                <div class="col-12 proItem first">
                                    <div>
                                        <div class="col-12 row pr-0">
                                            <a href="/ban-hang-tren-cac-san-thuong-mai-dien-tu" class="text-center col-3 p-0"><img title="Bán hàng trên sàn thương mại điện tử" alt="Bán hàng trên sàn thương mại điện tử" src="/img/home/iconHome/Ecom.png"></a>
                                            <div class="col-9 text-left pr-0 pl-1">
                                                <h2><a href="/ban-hang-tren-cac-san-thuong-mai-dien-tu">Ecom</a></h2>
                                                <span><b>Bán hàng trên sàn thương mại điện tử</b></span>
                                            </div>
                                        </div>
                                        <p class="col-12"><span>Đồng bộ sản phẩm tồn kho, đơn hàng với sàn Shopee, Lazada, Sendo, Tiki</span></p>
                                        <p class="text-center"><a class="ecomHover" href="/ban-hang-tren-cac-san-thuong-mai-dien-tu"><span>Xem thêm</span><i class="fa fa-arrow-right"></i></a></p>
                                    </div>
                                </div>
                                <div class="col-12 proItem first">
                                    <div>
                                        <div class="col-12 row pr-0">
                                            <a href="/dich-vu-van-chuyen" class="text-center col-3 p-0"><img title="Kết nối vận chuyển, thu hộ COD trên toàn quốc" alt="Kết nối vận chuyển, thu hộ COD trên toàn quốc" src="/img/home/iconHome/Shipping.png"></a>
                                            <div class="col-9 text-left pr-0 pl-1">
                                                <h2><a href="/dich-vu-van-chuyen">Shipping</a></h2>
                                                <span><b>Cổng vận chuyển, thu hộ COD toàn quốc</b></span>
                                            </div>
                                        </div>
                                        <p class="col-12"><span>Tích hợp GHN, VietNam Post, EMS, Viettel Post, J&amp;T, Best.<br>Đối soát tự động, chiết khấu cao</span></p>
                                        <p class="text-center"><a class="shipHover" href="/dich-vu-van-chuyen"><span>Xem thêm</span><i class="fa fa-arrow-right"></i></a></p>
                                    </div>
                                </div>
                                <div class="col-12 proItem first">
                                    <div>
                                        <div class="col-12 row pr-0">
                                            <a href="/omnichannel" class="text-center col-3 p-0"><img title="Phần mềm quản lý bán hàng đa kênh" alt="Phần mềm quản lý bán hàng đa kênh" src="/img/home/iconHome/Omnichannel.png"></a>
                                            <div class="col-9 text-left pr-0 pl-1">
                                                <h2><a href="/omnichannel" class="">Omnichannel</a></h2>
                                                <span><b>Quản lý bán hàng đa kênh</b></span>
                                            </div>
                                        </div>
                                        <p class="col-12"><span>Tổng hợp tất cả các dịch vụ của Nhanh.vn bao gồm POS, Website, Vpage, Ecom và cổng vận chuyển</span></p>
                                        <p class="text-center"><a class="omniHover" href="/omnichannel"><span>Xem thêm</span><i class="fa fa-arrow-right"></i></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="products container" style="padding-bottom: 5%">
                <div class="row">
                    <p class="labelProbox first col-12">
                        IPAS ĐƯỢC THIẾT KẾ PHÙ HỢP VỚI:
                    </p>
                    @if($itemsTwo)
                        <div class="col-sm-12 col-md-6 col-lg-4 markItem first">
                                <div class="row">

                                    <div class="col-12">
                                        <h3 class="text-center" style="margin: 0 0 10px 0 !important; font-size: 20px;">DOANH NGHIỆP</h3>
                                    </div>

                                    <div class="col-12">
                                        <a rel="noopener" class="posHover" href="{{ Route('frontend.news.show',['id'=>$itemsTwo->id,'name'=>Str::slug($itemsTwo->name.'', '-').'.html']) }}">
                                        @if($itemsTwo->default() && $itemsTwo->default()['url'])
                                            <img style="width: 100%;" src="{{ str_replace(Str::of($itemsTwo->default()['url'])->basename(),'thumb_'.Str::of($itemsTwo->default()['url'])->basename(),asset('storage/products/'.$itemsTwo->default()['url'])) }}"
                                                 class=""
                                                 alt=""/>
                                        @else
                                            <img src="{{ Avatar::create($itemsTwo->name)->toBase64() }}"
                                                 class=""
                                                 alt="" style="width: 100%;"/>
                                        @endif
                                        </a>

                                    </div>
                                    <div class="col-12">
                                        <p style="text-align: justify;"><span>{{ $itemsTwo->short_description ?? '' }}</span></p>
                                        <p class="btn-view">
                                            <a rel="noopener" class="posHover" href="{{ Route('frontend.news.show',['id'=>$itemsTwo->id,'name'=>Str::slug($itemsTwo->name.'', '-').'.html']) }}"><span>Xem thêm</span> <i class="fa fa-arrow-right"></i></a>
                                        </p>
                                    </div>
                                </div>
                        </div>
                    @endif

                    @if($itemsTwoTwo)
                        <div class="col-sm-12 col-md-6 col-lg-4 markItem first">
                                <div class="row">

                                    <div class="col-12">
                                        <h3 class="text-center" style="margin: 0 0 10px 0 !important; font-size: 20px;">TỔ CHỨC, CÁ NHÂN TƯ VẤN</h3>
                                    </div>
                                    <div class="col-12">
                                        <a rel="noopener" class="posHover" href="{{ Route('frontend.news.show',['id'=>$itemsTwoTwo->id,'name'=>Str::slug($itemsTwoTwo->name.'', '-').'.html']) }}">
                                            @if($itemsTwoTwo->default() && $itemsTwoTwo->default()['url'])
                                                <img style="width: 100%;" src="{{ str_replace(Str::of($itemsTwoTwo->default()['url'])->basename(),'thumb_'.Str::of($itemsTwoTwo->default()['url'])->basename(),asset('storage/products/'.$itemsTwoTwo->default()['url'])) }}"
                                                     class=""
                                                     alt=""/>
                                            @else
                                                <img src="{{ Avatar::create($itemsTwoTwo->name)->toBase64() }}"
                                                     class=""
                                                     alt="" style="width: 100%;"/>
                                            @endif
                                        </a>
                                    </div>
                                    <div class="col-12">
                                        <p style="text-align: justify;"><span>{{ $itemsTwoTwo->short_description ?? '' }}</span></p>
                                        <p class="btn-view"><a rel="noopener" class="posHover" href="{{ Route('frontend.news.show',['id'=>$itemsTwoTwo->id,'name'=>Str::slug($itemsTwoTwo->name.'', '-').'.html']) }}" target="_blank"><span>Xem thêm</span> <i class="fa fa-arrow-right"></i> </a></p>
                                    </div>
                                </div>
                        </div>
                    @endif

                    @if($itemsTwoThree)
                        <div class="col-sm-12 col-md-6 col-lg-4 markItem first">
                            <div class="row">
                                <div class="col-12">
                                    <h3 class="text-center" style="margin: 0 0 10px 0 !important; font-size: 20px;">VĂN PHÒNG LUẬT SƯ</h3>
                                </div>
                                <div class="col-12">
                                    <a rel="noopener" class="posHover" href="{{ Route('frontend.news.show',['id'=>$itemsTwoThree->id,'name'=>Str::slug($itemsTwoThree->name.'', '-').'.html']) }}">
                                        @if($itemsTwoThree->default() && $itemsTwoThree->default()['url'])
                                            <img style="width: 100%;" src="{{ str_replace(Str::of($itemsTwoThree->default()['url'])->basename(),'thumb_'.Str::of($itemsTwoThree->default()['url'])->basename(),asset('storage/products/'.$itemsTwoThree->default()['url'])) }}"
                                                 class=""
                                                 alt=""/>
                                        @else
                                            <img src="{{ Avatar::create($itemsTwoThree->name)->toBase64() }}"
                                                 class=""
                                                 alt="" style="width: 100%;"/>
                                        @endif
                                    </a>
                                </div>
                                <div class="col-12">
                                    <p style="text-align: justify;"><span>{{ $itemsTwoThree->short_description ?? '' }}</span></p>
                                    <p class="btn-view"><a rel="noopener" class="posHover" href="{{ Route('frontend.news.show',['id'=>$itemsTwoThree->id,'name'=>Str::slug($itemsTwoThree->name.'', '-').'.html']) }}" target="_blank"><span>Xem thêm</span> <i class="fa fa-arrow-right"></i> </a></p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if($itemsThree)
        <div class="products container" style="padding-bottom: 5%">
            <div class="row">
                <p class="labelProbox first col-12">
                    Các giải pháp hỗ trợ marketing, bán hàng
                </p>
                @forelse ($itemsThree as $item)
                    <div class="col-sm-12 col-md-6 col-lg-3 markItem first">
                        <div class="row">
                            <div class="col-3 col-md-4">
                                <a  href="{{ Route('frontend.news.show',['id'=>$item->id,'name'=>Str::slug($item->name.'', '-').'.html']) }}" class="text-center a-image">
                                    @if($item->default() && $item->default()['url'])
                                        <img title="{{ $item->name ?? '' }}" alt="{{ $item->name ?? '' }}" src="{{ str_replace(Str::of($item->default()['url'])->basename(),'thumb_50x50_'.Str::of($item->default()['url'])->basename(),asset('storage/products/'.$item->default()['url'])) }}">
                                    @else
                                        <img src="{{ Avatar::create($item->name)->toBase64() }}" class="" alt=""/>
                                    @endif
                                </a>
                            </div>
                            <div class="col-9 col-md-8">
                                <h3>{{ $item->name ?? '' }}</h3>
                            </div>
                            <div class="col-12">
                                <p><span>{{ $item->short_description ?? '' }}</span></p>
                                <p class="btn-view"><a rel="noopener" class="posHover" href="{{ Route('frontend.news.show',['id'=>$item->id,'name'=>Str::slug($item->name.'', '-').'.html']) }}" target="_blank"><span>Xem thêm</span> <i class="fa fa-arrow-right"></i> </a></p>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse

            </div>
        </div>
    @endif
</x-layout.frontend>
