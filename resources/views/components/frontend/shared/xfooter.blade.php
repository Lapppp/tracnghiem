<div id="footerMain">

    <div id="footerStore" class="footerNews">
        <div class="container store1">
            <div class="row">
                <div class="col-12 col-md-5">
                    <div class="row">
                        <h3 class="col-12 no-padding ftTitlebox">Hướng dẫn nghiệp vụ</h3>
                        <div class="col-12 col-sm-5 col-md-6 no-padding">
                            <ul class="list-unstyled">

                                @forelse ($moduleGuide as $key => $item)
                                    @if($key <= 7)
                                        <li>
                                            <a  title="{{ $item->name ?? '' }}" href="{{ Route('frontend.guide.show',['id'=>$item->id,'name'=>Str::slug($item->name.'', '-').'.html']) }}">
                                                <i class="fa fa-caret-right"></i> {{ $item->name ?? '' }}
                                            </a>
                                        </li>
                                    @endif
                                @empty
                                @endforelse

                            </ul>
                        </div>
                        <div class="col-12 col-sm-5 col-md-6 listPadding">
                            <ul class="list-unstyled">
                                @forelse ($moduleGuide as $key => $item)
                                    @if($key >= 8)
                                        <li>
                                            <a  title="{{ $item->name ?? '' }}" href="{{ Route('frontend.guide.show',['id'=>$item->id,'name'=>Str::slug($item->name.'', '-').'.html']) }}">
                                                <i class="fa fa-caret-right"></i> {{ $item->name ?? '' }}
                                            </a>
                                        </li>
                                    @endif
                                @empty
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-7">
                    <div class="row">
                        <div class="col-12 col-sm-5 col-md-7 footerNews no-padding">
                            <h3 class="ftTitlebox">Tin tức mới</h3>
                            <ul class="list-unstyled">
                                @forelse ($moduleNews as $item)
                                    <li>
                                        <a  href="{{ Route('frontend.news.show',['id'=>$item->id,'name'=>Str::slug($item->name.'', '-').'.html']) }}">
                                            <i class="fa fa-caret-right"></i> {{ $item->name ?? '' }}
                                        </a>
                                    </li>
                                @empty
                                @endforelse
                            </ul>
                        </div>
                        <div class="col-12 col-sm-6 col-md-5">
                            <h3 class="ftTitlebox">Nghiên cứu - Trao đổi</h3>
                            <ul class="list-unstyled">

                                @forelse ($moduleResearch as $key => $item)
                                        <li>
                                            <a  title="{{ $item->name ?? '' }}" href="{{ Route('frontend.research.show',['id'=>$item->id,'name'=>Str::slug($item->name.'', '-').'.html']) }}">
                                                <i class="fa fa-caret-right"></i> {{ $item->name ?? '' }}
                                            </a>
                                        </li>
                                @empty
                                @endforelse

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="footerStore2" class="footerNews">
        <div class="container store3">
            <div class="row no-padding">
                <div class="col-12 col-sm-5">
                    <h3 class="ftTitlebox">Tổng đài hỗ trợ</h3>
                    <p><a href="tel:19002812"><i class="fa fa-phone-alt"></i> <b style="font-size: 16px"> 1900.XXXX</b></a></p>
                    <p><i class="fa fa-envelope"></i> Email: contact@dangkynhanh.vn</p>
                    <p id="ftSocial">
                        <a href="https://www.facebook.com/nhanh.vn" target="_blank" rel="noopener" aria-label="Liên kết với facebook"><i class="fab fa-facebook-f" style="background: #547bbd"></i></a>
                        <a href="https://twitter.com/nhanh_vn" target="_blank" rel="noopener" aria-label="Liên kết với Twitter"><i class="fab fa-twitter" style="background: #65ccef"></i></a>
                        <a href="https://www.youtube.com/channel/UCygUZCwRtm9mqcijF9phxkQ" target="_blank" rel="noopener" aria-label="Liên kết với YouTube"><i class="fab fa-youtube" style="background: #df574a"></i></a>
                    </p>
                </div>
                <div class="col-12 col-sm-4">
                    <a href="{{ Route('frontend.terms.index') }}" class="ftTitlebox ftTerms">Chính sách và điều khoản sử dụng</a>
                    <a target="_blank" rel="noopener" href="http://online.gov.vn/Home/WebDetails/60375">
                        <img class="lazyautosizes ls-is-cached lazyloaded" data-sizes="auto" alt="Phần mềm quản lý bán hàng" title="Phần mềm quản lý bán hàng" style="width: 150px;height: 60px;margin-left: -5px" sizes="150px" src="{{ asset('/frontend/assets/img/dathongbaobct.png') }}">
                    </a>
                    <a target="_blank" rel="noopener" href="http://online.gov.vn/Home/WebDetails/59708">
                        <img class="lazyautosizes ls-is-cached lazyloaded" data-sizes="auto" alt="Phần mềm quản lý bán hàng" title="Phần mềm quản lý bán hàng" style="width: 150px;height: 60px;" sizes="150px" src="{{ asset('/frontend/assets/img/dadangkybct.png') }}">
                    </a>
                </div>
                <div class="col-12 col-sm-3">
                    <h3 class="ftTitlebox" style="margin-bottom: 20px;">Tài liệu cho developer</h3>
                    <a style="padding: 8px;font-size: 12px;" class="develop" href="https://developers.nhanh.vn" target="_blank" rel="noopener">
                        <i class="fa fa-code"></i> API Documentation
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div id="footerStore2" class="footerNews">
        <div class="container store3">
            <div class="row no-padding">
                <div class="col-12 col-sm-5">
                    <h3 class="ftTitlebox">CÔNG TY TNHH DANGKYNHANH</h3>
                    <p>VP1: 99 Nguyễn Thị Minh Khai, Quận Ba Đình, TP Hà Nội</p>
                    <p>VP2: 100 Nguyễn Thị Minh Khai, Quận Ba Đình, TP Hà Nội</p>
                    <p>VP2: 101 Nguyễn Thị Minh Khai, Quận Ba Đình, TP Hà Nội</p>
                </div>
                <div class="col-12 col-sm-4">
                    <p><strong>Quy định dành cho Website TMĐT bán hàng – PMQLBH và Thiết kế website</strong></p>
                    <ul class="list-unstyled">
                        @forelse ($moduleTerms as $key => $item)
                            <li>
                                <a  title="{{ $item->name ?? '' }}" href="{{ Route('frontend.terms.show',['id'=>$item->id,'name'=>Str::slug($item->name.'', '-').'.html']) }}">
                                    <i class="fa fa-caret-right"></i> {{ $item->name ?? '' }}
                                </a>
                            </li>
                        @empty
                        @endforelse
                    </ul>
                </div>
                
            </div>
        </div>
    </div>
</div>
