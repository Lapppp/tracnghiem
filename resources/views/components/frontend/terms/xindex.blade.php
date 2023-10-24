<x-layout.frontend>
    <div id="containerMain" class="fullWidth">
        <style>
            /**
        * Cho font chữ to lên Google SEO quét trên mobile mới đạt chuẩn
        */

            @media screen and (max-width: 736px) {
                * {
                    font-size: 16px !important;
                }
            }

            @media (min-width: 769px) {
                #cate-full-content img {
                    height: 150px;
                    width: 100%;
                    object-fit: cover;
                }
                #category-content .cate-content-1 {
                    margin-bottom: 1.5rem;
                }
            }

            .article-intro {
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
            }

            @media (max-width: 768px) {
                #cate-full-content img {
                    max-height: 250px;
                    width: 100%;
                    object-fit: cover;
                }
                #category-content .cate-content-1 {
                    margin-bottom: 1.5rem;
                    border-bottom: 1px dashed #cccccc63;
                    padding-bottom: 1rem;
                }
                #category-content .cate-content-1 .titleCA {
                    margin-top: .5rem;
                }
            }
        </style>
        <div class="container">
            <div id="cate-full-content" class="row m-0">
                <div class="col-12 col-md-8 p-0">
                    <div id="headCate" class="mt-4 mb-5">
                        <h1>{{ $title ?? '' }}</h1>
                    </div>
                    <div id="category-content">

                        @forelse ($items as $key => $item)

                            <div class="cate-content-1">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <a  href="{{ Route('frontend.news.show',['id'=>$item->id,'name'=>Str::slug($item->name.'', '-').'.html']) }}">
                                            @if($item->default() && $item->default()['url'])
                                                <img alt="{{ $item->name ?? '' }}" class="img-responsive" src="{{ str_replace(Str::of($item->default()['url'])->basename(),'thumb_'.Str::of($item->default()['url'])->basename(),asset('storage/products/'.$item->default()['url'])) }}">
                                            @else
                                                <img src="{{ Avatar::create($item->name)->toBase64() }}" class="i" alt="{{ $item->name ?? '' }}"/>
                                            @endif

                                        </a>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <h3 class="titleCA col-12 container-fluid"><a  href="{{ Route('frontend.news.show',['id'=>$item->id,'name'=>Str::slug($item->name.'', '-').'.html']) }}">{{ $item->name ?? '' }}</a></h3>
                                        <p class="timeArticle mb-1"><i class="far fa-clock"></i> {{ !empty($item->created_at) ? date('d/m/Y',strtotime($item->created_at)) : '' }}</p>
                                        <div class="article-intro">{{ $item->short_description }} </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            Đang cập nhật thông tin
                        @endforelse

                    </div>
                </div>
                <div class="col-12 col-md-4 category-sidebar" id="sidebarCate">
                    <div class="row" id="category-sidebar-cate">
                        <ul class="w-100">
                            <li class="cate-noneSub">
                                <a  href="{{ Route('frontend.guide.index') }}">
                                    <i class="fal fa-file-alt mr-2"></i> <span>Hướng dẫn sử dụng</span>
                                </a>
                            </li>
                            <!-- <li class="cate-noneSub">
                                <a target="_blank" href="/thong-bao-nc2.html">
                                    <i class="fas fa-bullhorn mr-2"></i><span>Thông báo</span></a>
                            </li> -->
                            <!-- <li class="cate-noneSub">
                                <a target="_blank" href="/kinh-nghiem-quan-ly-nc245.html">
                                    <i class="fas fa-users mr-2"></i> <span>Kinh nghiệm quản lý</span></a>
                            </li> -->
                            <!-- <li class="cate-submenu">
                                <a target="_blank" href="/kinh-nghiem-ban-hang-online-nc251.html">
                                    <i class="far fa-dot-circle"></i> <span>Kinh nghiệm bán hàng online</span></a>
                            </li> -->
                            <!-- <li class="cate-submenu">
                                <a target="_blank" href="/kinh-nghiem-quan-ly-kho-nc250.html">
                                    <i class="far fa-dot-circle"></i> <span>Kinh nghiệm quản lý kho</span></a>
                            </li> -->
                        {{--                            <li class="cate-submenu">--}}
                        {{--                                <a target="_blank" href="/kinh-nghiem-quan-ly-website-nc252.html">--}}
                        {{--                                    <i class="far fa-arrow"></i> <span>Kinh nghiệm quản lý website</span></a>--}}
                        {{--                            </li>--}}
                        <!-- <li class="cate-submenu">
                                <a target="_blank" href="/kinh-nghiem-giao-hang-xu-ly-don-hang-online-nc4549.html ">
                                    <i class="far fa-dot-circle"></i> <span>Kinh nghiệm xử lý đơn hàng online</span></a>
                            </li> -->
                            <!-- <li class="cate-noneSub">
                                <a href="/chien-luoc-kinh-doanh-nc2093.html">
                                    <i class="fa fa-bar-chart"></i> <span>Chiến lược kinh doanh</span></a>
                            </li> -->
                            <li class="cate-noneSub">
                                <a  href="{{ Route('frontend.research.index') }}">
                                    <i class="fa fa-users"></i> <span>Mua bán trao đổi</span></a>
                            </li>
                            <li class="cate-noneSub">
                                <a  href="{{ Route('frontend.wisdom.index') }}">
                                    <i class="fa fa-suitcase"></i> <span>Quản trị tài sản trí tuệ</span></a>
                            </li>

                            <li class="cate-noneSub">
                                <a  href="{{ Route('frontend.news.index') }}">
                                    <i class="fa fa-newspaper"></i> <span>Tin tức</span></a>
                            </li>
                        </ul>
                    </div>
                    <!--
                    <div class="row p-3" id="category-sidebar-views">
                        <h5>Tin khác</h5>
                        <div class="cate-hotnews-sidebar">
                            <div id="cate-views-left">
                                <a><img alt="image hot news" class="img-responsive" src="https://cdn.nhanh.vn/cdn/store/26/art/article_1616472444_23.png"></a>
                            </div>
                            <div id="cate-views-right">
                                <p><a style="color: #000;" target="_blank" href="/huong-dan-cach-tat-tinh-nang-ban-hang-tren-facebook-ca-nhan-cap-nhat-moi-nhat-2021-n82154.html">Hướng dẫn cách tắt tính năng bán hàng trên Facebook cá nhân cập nhật mới ...</a>
                                </p>
                                <p id="timeArticle" style="font-size: 12px;">
                                    <span><i class="fa fa-clock-o"></i> 23/03/2021</span>
                                </p>
                            </div>
                        </div>
                        <div class="cate-hotnews-sidebar">
                            <div id="cate-views-left">
                                <a><img alt="image hot news" class="img-responsive" src="https://cdn.nhanh.vn/cdn/store/26/art/article_1611497827_212.png"></a>
                            </div>
                            <div id="cate-views-right">
                                <p><a style="color: #000;" target="_blank" href="/cach-thiet-ke-giao-dien-trang-web-ban-hang-tao-an-tuong-cho-nguoi-moi-bat-dau-n78881.html">Cách thiết kế giao diện trang web bán hàng tạo ấn tượng cho người mới bắt ...</a>
                                </p>
                                <p id="timeArticle" style="font-size: 12px;">
                                    <span><i class="fa fa-clock-o"></i> 24/01/2021</span>
                                </p>
                            </div>
                        </div>
                        <div class="cate-hotnews-sidebar">
                            <div id="cate-views-left">
                                <a><img alt="image hot news" class="img-responsive" src="https://cdn.nhanh.vn/cdn/store/26/art/article_1611032057_963.png"></a>
                            </div>
                            <div id="cate-views-right">
                                <p><a style="color: #000;" target="_blank" href="/top-5-phan-mem-tao-web-ban-hang-mien-phi-ban-da-biet-chua-n78472.html">Top 5 phần mềm tạo web bán hàng miễn phí, bạn đã biết chưa?</a>
                                </p>
                                <p id="timeArticle" style="font-size: 12px;">
                                    <span><i class="fa fa-clock-o"></i> 19/01/2021</span>
                                </p>
                            </div>
                        </div>
                        <div class="cate-hotnews-sidebar">
                            <div id="cate-views-left">
                                <a><img alt="image hot news" class="img-responsive" src="https://cdn.nhanh.vn/cdn/store/26/art/article_1605858905_949.png"></a>
                            </div>
                            <div id="cate-views-right">
                                <p><a style="color: #000;" target="_blank" href="/huong-dan-cach-goi-dien-cham-soc-khach-hang-hieu-qua-nhat-n74573.html">Hướng dẫn cách gọi điện chăm sóc khách hàng hiệu quả nhất</a>
                                </p>
                                <p id="timeArticle" style="font-size: 12px;">
                                    <span><i class="fa fa-clock-o"></i> 17/11/2020</span>
                                </p>
                            </div>
                        </div>
                        <div class="cate-hotnews-sidebar">
                            <div id="cate-views-left">
                                <a><img alt="image hot news" class="img-responsive" src="https://cdn.nhanh.vn/cdn/store/26/art/article_1597891979_466.jpg"></a>
                            </div>
                            <div id="cate-views-right">
                                <p><a style="color: #000;" target="_blank" href="/phai-lam-gi-khi-ten-mien-.com-cua-ban-da-duoc-nguoi-khac-dang-ky-n69814.html">Phải làm gì khi tên miền .COM của bạn đã được người khác đăng ký?</a>
                                </p>
                                <p id="timeArticle" style="font-size: 12px;">
                                    <span><i class="fa fa-clock-o"></i> 18/08/2020</span>
                                </p>
                            </div>
                        </div>
                        <div class="cate-hotnews-sidebar">
                            <div id="cate-views-left">
                                <a><img alt="image hot news" class="img-responsive" src="https://cdn.nhanh.vn/cdn/store/26/art/article_1597902691_332.jpg"></a>
                            </div>
                            <div id="cate-views-right">
                                <p><a style="color: #000;" target="_blank" href="/dropped-domain-va-cach-de-ban-tan-dung-hieu-qua-tu-chung-n69720.html">Dropped Domain và cách để bạn tận dụng hiệu quả từ chúng</a>
                                </p>
                                <p id="timeArticle" style="font-size: 12px;">
                                    <span><i class="fa fa-clock-o"></i> 18/08/2020</span>
                                </p>
                            </div>
                        </div>
                        <div class="cate-hotnews-sidebar">
                            <div id="cate-views-left">
                                <a><img alt="image hot news" class="img-responsive" src="https://cdn.nhanh.vn/cdn/store/26/art/article_1597887381_638.png"></a>
                            </div>
                            <div id="cate-views-right">
                                <p><a style="color: #000;" target="_blank" href="/domain-parking-la-gi-va-no-co-the-giup-ban-kiem-tien-nhu-the-nao-n69707.html">Domain Parking là gì và nó có thể giúp bạn kiếm tiền như thế nào?</a>
                                </p>
                                <p id="timeArticle" style="font-size: 12px;">
                                    <span><i class="fa fa-clock-o"></i> 17/08/2020</span>
                                </p>
                            </div>
                        </div>
                        <div class="cate-hotnews-sidebar">
                            <div id="cate-views-left">
                                <a><img alt="image hot news" class="img-responsive" src="https://cdn.nhanh.vn/cdn/store/26/art/article_1597636692_753.png"></a>
                            </div>
                            <div id="cate-views-right">
                                <p><a style="color: #000;" target="_blank" href="/ban-nen-lam-gi-sau-khi-dang-ky-thanh-cong-mot-ten-mien-hoan-hao-n69660.html">Bạn nên làm gì sau khi đăng ký thành công một tên miền hoàn hảo?</a>
                                </p>
                                <p id="timeArticle" style="font-size: 12px;">
                                    <span><i class="fa fa-clock-o"></i> 16/08/2020</span>
                                </p>
                            </div>
                        </div>
                    </div> -->

                @include('components.frontend.shared.news-sort',['newsSort'=>$newsSort])


                <!-- <div class="row blog-side-facebook justify-content-center w-100">
                        <div class="fb-page" data-href="https://www.facebook.com/nhanh.vn/" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="false">
                            <div class="fb-xfbml-parse-ignore">
                                <blockquote cite="https://www.facebook.com/nhanh.vn/">
                                    <a href="https://www.facebook.com/nhanh.vn/">Nhanh.vn</a>
                                </blockquote>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="row" id="cate-regis">
                        <h3>Bắt đầu công việc kinh doanh với Nhanh.vn</h3>
                        <a href="/dang-ky-nhanh">Dùng thử miễn phí</a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</x-layout.frontend>
