<section id="top">
    <div class="ctn">
        <div class="cxs12 csm5 cmd5">
            @if(!Auth::guard('web')->user())
                <ul>
                    <li>Đăng nhập / </li>
                    <li> Đăng ký</li>
                </ul>
            @else
                <div class="info-user">
                    <p>Xin chào <b></ba>{{ Auth::guard('web')->user()->name ?? '' }}</b>!</p>
                    <ul>
                        <a href="{{ Route('frontend.users.index') }}">Xem thông tin cá nhân</a>
                        <a href="{{ Route('frontend.users.orders') }}">Xem quản lý đơn hàng</a>
                        <a href="{{ Route('frontend.user.logout') }}">Đăng xuất</a>
                    </ul>
                </div>
            @endif
        </div>
        <div class="cxs12 csm7 cmd7">
            <div>
                <a class="love-ic" href="{{ Route('frontend.users.favorite')}}">
                    <span id="numberCart">
                        @if(Auth::guard('web')->user())
                            {{ Auth::guard('web')->user()->productsFavourite()->count() }}
                        @else
                            0
                        @endif
                    </span>
                </a>
                <div class="btn-cart-buy">
                    <div class="ic-cart"></div> <label>đã chọn <span id="numberCartChoose">{{ Cart::count() }}</span> sản phẩm</label>

                    <div class="cart-list" id="dropdownShopCart">
                        @include('components.frontend.cart.dropdownCart')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<header class="ctn">
    <div class="cxs12 csm5 cmd5">
        <a href="/">
            <img src="{{ asset('/frontend/assets/a/i/logo.png') }}" alt="Kiwi">
        </a>
    </div>
    <div class="cxs12 csm7 cmd7">
        <ul>
            <li>
                <span>tổng đài</span>
                <a href="tel:18006854">1800 6854</a>
            </li>
            <li>
                <span>Hotline</span>
                <a href="tel:0866081463">0866.081.463 - 0919.631.097</a>
            </li>
        </ul>
    </div>
</header>
<section id="menu-pc">
    <nav class="ctn">
        <div class="cxs12 csm3 cmd3" id="ic-dmsp">
            <label>Danh mục sản phẩm</label>
            <div id="list-catemenu">
                <!--<img src="{{ asset('/frontend/assets/a/i/menu.png') }}" alt="">-->
                <span class="closemenu"></span>
                <ul class="vertical-menu">
                    <li>
                        <img src="{{ asset('/frontend/assets/a/i/ichome.png') }}">
                        <a href="{{ Route('frontend.home.index') }}">Trang chủ</a>
                    </li>
                    @foreach($menuCategory as $key => $item)
                        @if(count($item->childrenCategories) > 0)
                            <li class="has-child">
                                @if($item->default() && $item->default()['url'])
                                    <img alt="{{ $item->name ?? '' }}"  src="{{ str_replace(Str::of($item->default()['url'])->basename(),'thumb_50x50_'.Str::of($item->default()['url'])->basename(),asset('storage/category/'.$item->default()['url'])) }}">
                                @else
                                    <img src="{{ Avatar::create($item->name)->toBase64() }}"  alt="{{ $item->name ?? '' }}"/>
                                @endif

                                <a href="{{ Route('frontend.product.edit',['slug'=>$item->slug]) }}">{{ $item->name ?? '' }}</a>
                                <ul class="vertical-submenu">
                                    @foreach($item->childrenCategories as $k =>$v)
                                        <li>
                                            <a href="{{ Route('frontend.product.edit',['slug'=>$v->slug]) }}">{{ $v->name ?? '' }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li>
                                @if($item->default() && $item->default()['url'])
                                    <img alt="{{ $item->name ?? '' }}"  src="{{ str_replace(Str::of($item->default()['url'])->basename(),'thumb_50x50_'.Str::of($item->default()['url'])->basename(),asset('storage/category/'.$item->default()['url'])) }}">
                                @else
                                    <img src="{{ Avatar::create($item->name)->toBase64() }}"  alt="{{ $item->name ?? '' }}"/>
                                @endif
                                <a href="{{ Route('frontend.product.edit',['slug'=>$item->slug]) }}">{{ $item->name ?? '' }}</a>
                            </li>
                        @endif

                    @endforeach
                    <li>
                        <img src="{{ asset('/frontend/assets/a/i/icshow.png') }}">
                        <a href="{{ Route('frontend.showroom.index') }}">Liên hệ</a>
                    </li>

                </ul>
            </div>
        </div>
        <div class="cxs12 csm9 cmd9 pc-mnright">
            <ul>
                <li @if($controller =='HomeController') class="active-menu" @endif>
                    <a href="{{ Route('frontend.home.index') }}">Trang chủ</a>
                </li>
                @foreach($menuHome as $key => $value)
                    @if($value->childrenCategories()->count() > 0)
                        <li class="has-child">
                            <a href="{{ Route('frontend.product.edit',['slug'=>$value->slug]) }}">{{ $value->name ?? '' }}</a>
                            <ul class="sub-menu">
                                @foreach($value->childrenCategories as $k => $val)
                                    <li><a href="{{ Route('frontend.product.edit',['slug'=>$val->slug]) }}">{{ $val->name ?? ''}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li>
                            <a href="{{ Route('frontend.product.edit',['slug'=>$value->slug]) }}">{{ $value->name ?? '' }}</a>
                        </li>
                    @endif
                @endforeach
                <!--<li @if($controller =='AboutController') class="active-menu" @endif>-->
                <!--    <a href="{{ Route('frontend.about.index') }}">Giới thiệu</a>-->
                <!--</li>-->
                <!--<li @if($controller =='NewsController') class="active-menu" @endif>-->
                <!--    <a href="{{ Route('frontend.news.index') }}">Tin tức</a>-->
                <!--</li>-->
                <!--<li @if($controller =='TermsController') class="active-menu" @endif>-->
                <!--    <a href="{{ Route('frontend.terms.index') }}">Chính sách</a>-->
                <!--</li>-->
                <li @if($controller =='ShowRoomController') class="active-menu" @endif>
                    <a href="{{ Route('frontend.showroom.index') }}">Liên hệ</a>
                </li>
            </ul>
            <a href="/" class="btn-home"></a>
            <form>
                <input type="text" id="searchHome" placeholder="Tìm kiếm sản phẩm">
                <button type="button" name="search" id="searchbtnHome"></button>
            </form>
            <a href="{{ Route('frontend.cart.index') }}" class="cart-icon">

            </a>
            <button class="icon-menumb">

            </button>
        </div>
        <div class="cxs12 csm9 cmd9 pc-fixright">
            <a href="/" class="btn-home"></a>
            <form action="{{ Route('frontend.products.all.index') }}" method="get">
                <select name="category_id" id="category_id">
                    <option value="">Tất cả</option>
                    @foreach($searchCategory as $key => $value)
                        <option value="{{ $value->slug ?? '' }}">{{ $value->name ?? '' }}</option>
                    @endforeach
                </select>

                <input type="search" name="search" id="search" placeholder="Tìm kiếm sản phẩm">
                <button type="button" id="SearchHomeClick"></button>
            </form>
            <a href="{{ Route('frontend.cart.index') }}" class="cart-icon">
                <span id="numberCartIcon">{{ Cart::count() }}</span>
            </a>
            <a href="#" class="account">Tài khoản</a>
        </div>
    </nav>
</section>


<section id="av1" class="ctn"
@if($controller == 'ProductController' && $action =='show') style="display: none" @endif
@if($controller == 'CartController' && $action =='index') style="display: none" @endif
@if($controller == 'OrderController' && $action =='show') style="display: none" @endif
@if($controller == 'UserController' && $action =='forgotPassword') style="display: none" @endif
@if($controller == 'UserController' && $action =='resetPassword') style="display: none" @endif
    >
    <section class="ctn sologan">
		<div class="cxs3 cmd3">
			<div>
				<h3>Thương hiệu uy tín</h3>
				<p>sản phẩm chất lượng</p>
			</div>
		</div>
		<div class="cxs3 cmd3">
			<div>
				<h3>Bảo hành 6 năm</h3>
				<p>tất cả sản phẩm</p>
			</div>
		</div>
		<div class="cxs3 cmd3">
			<div>
				<h3>Tiết kiệm chi phí</h3>
				<p>thanh toán tại nhà</p>
			</div>
		</div>
		<div class="cxs3 cmd3">
			<div>
				<h3>miễn phí vận chuyển</h3>
				<p>giao hàng toàn quốc</p>
			</div>
		</div>
	</section>
</section>
@include('components.frontend.shared.banner.position')
