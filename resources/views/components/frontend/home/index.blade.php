<x-layout.frontend>

    <section id="a1">
        <section class="ctn">
            <h2 class="title">Các dòng sản phẩm chính hãng</h2>
            <div id="sldm">
                <div class="cmd2 itdm">
                    <div>
                        <img src="{{ asset('/frontend/assets') }}/a/i/ic1.png" alt="">
                        <h3><a href="{{ Route('frontend.product.edit',['slug'=>'ghe-massage']) }}">Ghế massage</a></h3>
                    </div>
                </div>
                <div class="cmd2 itdm">
                    <div>
                        <img src="{{ asset('/frontend/assets') }}/a/i/ic2.png" alt="">
                        <h3><a href="{{ Route('frontend.product.edit',['slug'=>'giuong-massage']) }}">Giường massage</a></h3>
                    </div>
                </div>
                <div class="cmd2 itdm">
                    <div>
                        <img src="{{ asset('/frontend/assets') }}/a/i/ic3.png" alt="">
                        <h3><a href="{{ Route('frontend.product.edit',['slug'=>'xe-dap-tap']) }}">Xe đạp tập</a></h3>
                    </div>
                </div>

                <div class="cmd2 itdm">
                    <div>
                        <img src="{{ asset('/frontend/assets') }}/a/i/ic5.png" alt="">
                        <h3><a href="{{ Route('frontend.product.edit',['slug'=>'hang-trung-bay-thanh-ly']) }}">Hàng trưng bày thanh lý</a></h3>
                    </div>
                </div>
                <div class="cmd2 itdm">
                    <div>
                        <img src="{{ asset('/frontend/assets') }}/a/i/ic7.png" alt="">
                        <h3><a href="{{ Route('frontend.product.edit',['slug'=>'thiet-bi-the-thao']) }}">Thiết bị thể thao</a></h3>
                    </div>
                </div>
                <div class="cmd2 itdm">
                    <div>
                        <img src="{{ asset('/frontend/assets') }}/a/i/ic6.png" alt="">
                        <h3><a href="{{ Route('frontend.product.edit',['slug'=>'san-pham-khac']) }}">Sản phẩm khác</a></h3>
                    </div>
                </div>


            </div>
        </section>
    </section>
    <section id="a2">
        <div class="ctn">
            <div class="title1">
                <h2>giới thiệu chung</h2>
                <!--@if($about)-->
                <!--    {!! $about->description ?? '' !!}-->
                <!--@endif-->
                <p>Sức khỏe là vàng, là điều quý giá nhất với mỗi người, khi có sức khỏe chúng ta sẽ làm được những điều chúng ta muốn và có một cuộc sống thật ý nghĩa.<br>
				Thời hạn của cuộc đời tùy thuộc sức khỏe, còn sức khỏe thì do cách sống quyết định. Sức khỏe là thứ mà ta không nhìn thấy được, là yếu tố sống còn của mỗi con người. Hãy nâng niu quý trọng sức khỏe, đừng để khi mất rồi mới thấy hối tiếc. Một thân thể không bệnh, một tâm hồn không loạn đó là chân hạnh phúc của con người.</p>
            </div>

            <div>
                <div class="cxs12 csm5 cmd5">
                    <img src="{{ asset('/frontend/assets') }}/a/i/kol.png" alt="giới thiệu" class="banner-pc">
                </div>
                <div class="cxs12 csm7 cmd7">
                    <div>
                        @foreach ($videoHome as $video)
                            @if ($loop->first)
                                <a class="play-video" data-video="{{ $video->url ?? '' }}">
                                    @if($video->default() && $video->default()['url'])
                                        <img  src="{{ str_replace(Str::of($video->default()['url'])->basename(),Str::of($video->default()['url'])->basename(),asset('storage/video/'.$video->default()['url'])) }}">
                                    @endif
                                </a>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>

            <div class="clear"></div>

            <div id="slvd">
                @foreach ($videoHome as $key => $video)
                    @if($key > 0)
                        <div class="cxs12 csm4 cmd4 itvd">
                            <div>
                                <a class="play-video" data-video="{{ $video->url ?? '' }}">
                                    @if($video->default() && $video->default()['url'])
                                    <img   src="{{ str_replace(Str::of($video->default()['url'])->basename(),Str::of($video->default()['url'])->basename(),asset('storage/video/'.$video->default()['url'])) }}">
                                    @endif
                                </a>
                            </div>
                        </div>
                    @endif

                @endforeach

            </div>
            <img src="{{ asset('/frontend/assets') }}/a/i/kol.png" alt="giới thiệu" class="banner-mobile">
        </div>
    </section>
    @include('components.frontend.home.productHot',['hotProduct'=>$hotProduct])
    @include('components.frontend.home.messageCategory',['messageCategory'=>$messageCategory])

    @include('components.frontend.shared.banner.position-two')

    @include('components.frontend.home.treadmill',['treadmillCategory'=>$treadmillCategory])
    @include('components.frontend.shared.banner.position-three')

    @include('components.frontend.home.bike',['bikeCategory'=>$bikeCategory])
    @include('components.frontend.home.bed',['bikeCategory'=>$bikeCategory])
    @include('components.frontend.home.otherProduct',['otherProduct'=>$otherProduct])
    <section class="a7 ctn">
        <div class="title1">
            <h2>Trải nghiệm của khách hàng</h2>
        </div>
        <p class="title-utm">Những người nổi tiếng là khách hàng thân thiết của Kenji Sport</p>
        <div id="slkh">
            <div class="itkh cmd4">
                <div>
                    <div class="top-itkh">
                        <img src="{{ asset('/frontend/assets') }}/a/i/kh.png" alt="NGHỆ SĨ bá an">
                    </div>
                    <div class="content-kh">
                        <h3>NGHỆ SĨ bá anh</h3>
                        <p>CÙNG “BẢO BỐI THẦN KỲ” KENJI – YJ – L20 NẠP NĂNG LƯỢNG CHO CƠ THỂ</p>
                    </div>
                </div>
            </div>
            <div class="itkh cmd4">
                <div>
                    <div class="top-itkh">
                        <img src="{{ asset('/frontend/assets') }}/a/i/trannhuong.png" alt="NGHỆ SĨ Nhân Dân Trần Nhượng">
                    </div>
                    <div class="content-kh">
                        <h3>NGHỆ SĨ Nhân Dân Trần Nhượng</h3>
                        <p>TẬU “SIÊU PHẨM” GHẾ MASSAGE AKAWA - BK6 ĐỂ CHĂM SÓC SỨC KHỎE GIA ĐÌNH</p>
                    </div>
                </div>
            </div>
            <div class="itkh cmd4">
                <div>
                    <div class="top-itkh">
                        <img src="{{ asset('/frontend/assets') }}/a/i/trongtrinh.png" alt="NGHỆ SĨ Nhân Dân Trọng Trinh">
                    </div>
                    <div class="content-kh">
                        <h3>NGHỆ SĨ Nhân Dân Trọng Trinh</h3>
                        <p>TRẢI NGHIỆM MASSAGE THÔNG MINH TẠI NHÀ CÙNG GHẾ MASSAGE KENJI - K8</p>
                    </div>
                </div>
            </div>
            <div class="itkh cmd4">
                <div>
                    <div class="top-itkh">
                        <img src="{{ asset('/frontend/assets') }}/a/i/phuthang.png" alt="NGHỆ SĨ ưu tú Phú Thăng">
                    </div>
                    <div class="content-kh">
                        <h3>NGHỆ SĨ ưu tú Phú Thăng</h3>
                        <p>lựa chọn ưu tiên Ghế massage toàn thân đa năng Kenji JC03</p>
                    </div>
                </div>
            </div>
            <div class="itkh cmd4">
                <div>
                    <div class="top-itkh">
                        <img src="{{ asset('/frontend/assets') }}/a/i/lequyen.png" alt="diễn viên Ngô Lệ Quyên">
                    </div>
                    <div class="content-kh">
                        <h3>diễn viên Ngô Lệ Quyên</h3>
                        <p>trải nghiệm Giường ngủ massage đa năng Kenji</p>
                    </div>
                </div>
            </div>
            <div class="itkh cmd4">
                <div>
                    <div class="top-itkh">
                        <img src="{{ asset('/frontend/assets') }}/a/i/viethoa.png" alt="diễn viên Việt Hoa">
                    </div>
                    <div class="content-kh">
                        <h3>diễn viên Việt Hoa</h3>
                        <p>tăng cường sức khỏe với Máy chạy bộ điện đa năng Kenji A7</p>
                    </div>
                </div>
            </div>

        </div>
        <div id="list-customer">
            <div class="cxs6 csm3 cmd3">
                <div>
                    <img src="{{ asset('frontend') }}/assets/img/spinner.gif" class="lozad" data-src="{{ asset('/frontend/assets') }}/a/i/chienthang.jpg" alt="khách hàng 1">
                    <h3>NS Chiến Thắng</h3>
                </div>
            </div>
            <div class="cxs6 csm3 cmd3">
                <div>
                    <img src="{{ asset('frontend') }}/assets/img/spinner.gif" class="lozad" data-src="{{ asset('/frontend/assets') }}/a/i/chitrung.jpg" alt="NSND Chí Trung">
                    <h3>NSND Chí Trung</h3>
                </div>
            </div>
            <div class="cxs6 csm3 cmd3">
                <div>
                    <img src="{{ asset('frontend') }}/assets/img/spinner.gif" class="lozad" data-src="{{ asset('/frontend/assets') }}/a/i/manhcuong.jpg" alt="NSND Mạnh Cường">
                    <h3>NSND Mạnh Cường</h3>
                </div>
            </div>
            <div class="cxs6 csm3 cmd3">
                <div>
                    <img src="{{ asset('frontend') }}/assets/img/spinner.gif" class="lozad" data-src="{{ asset('/frontend/assets') }}/a/i/minhhoa.jpg" alt="NSND MINH Hòa">
                    <h3>NSND MINH Hòa</h3>
                </div>
            </div>
        </div>
    </section>
    <section id="a71">
        <div class="ctn">
            <div class="title1">
                <h2>lý do nên chọn Kenji sport</h2>
            </div>
            <div class="mb-a71">
                <div class="cxs12 csm3 cmd3">
                    <div>
                        Sức khỏe là vàng, khi có sức khỏe chúng ta sẽ làm được những điều mình muốn và có cuộc sống thật ý nghĩa.
                    </div>
                </div>
                <div class="cxs12 csm3 cmd3">
                    <div>
                        Các sản phẩm được nhiều nghệ sĩ nổi tiếng, các đài truyền hình đưa tin về chất lượng cũng như giá thành hợp lý
                    </div>
                </div>
                <div class="cxs12 csm3 cmd3">
                    <div>
                        Kenji Sport tự hào là đơn vị uy tín hàng đầu trong việc phân phối các sản phẩm thể thao và chăm sóc sức khỏe
                    </div>
                </div>
                <div class="cxs12 csm3 cmd3">
                    <div>
                        Cam kết sản phẩm có giá tốt nhất thị trường, giao hàng miễn phí toàn quốc cùng chế độ sau mua cực hấp dẫn
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="a72">
        <div class="ctn">
            <div class="title1">
                <h2>báo chí nói về chúng tôi</h2>
            </div>
            <div class="sl-a72">
                <div class="cxs12 csm3 cmd3">
                    <div>
                        <a href="#" target="_blank"><img src="{{ asset('frontend') }}/assets/img/spinner.gif" class="lozad" data-src="{{ asset('/frontend/assets') }}/a/i/bc1.jpg" alt=""></a>
                    </div>
                </div>
                <div class="cxs12 csm3 cmd3">
                    <div>
                        <a href="#" target="_blank"><img src="{{ asset('frontend') }}/assets/img/spinner.gif" class="lozad" data-src="{{ asset('/frontend/assets') }}/a/i/bc2.jpg" alt=""></a>
                    </div>
                </div>
                <div class="cxs12 csm3 cmd3">
                    <div>
                        <a href="#" target="_blank"><img src="{{ asset('frontend') }}/assets/img/spinner.gif" class="lozad" data-src="{{ asset('/frontend/assets') }}/a/i/bc3.jpg" alt=""></a>
                    </div>
                </div>
                <div class="cxs12 csm3 cmd3">
                    <div>
                        <a href="#" target="_blank"><img src="{{ asset('frontend') }}/assets/img/spinner.gif" class="lozad" data-src="{{ asset('/frontend/assets') }}/a/i/bc4.jpg" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('components.frontend.home.questions',['questions'=>$questions])
    <section id="a8">
        <div class="ctn">
            <div class="title1">
                <h2>Tin tức - hoạt động</h2>
            </div>
            <ul class="pro-tab">
                <li class="active-pro tabl" href="#tabnew1">Tin tức</li>
                <li class="tabl" href="#tabnew2">Chia sẻ kinh nghiệm</li>
            </ul>
            <div class="pro-content">
                @include('components.frontend.home.box.news',['news'=>$news])
                @include('components.frontend.home.box.activity',['activity'=>$activity])

            </div>
            <a href="https://kenjisport.com/tin-tuc" class="seemore">Xem thêm</a>
        </div>
    </section>
   @include('components.frontend.home.seeProduct')

    <x-slot name="javascript">
        @include('components.frontend.shared.success')
    </x-slot>

</x-layout.frontend>
