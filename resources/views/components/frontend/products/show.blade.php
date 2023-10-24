<x-layout.frontend>

    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v15.0&appId=1531421770512458&autoLogAppEvents=1" nonce="O4Mg8uk3"></script>

    <!-- breadcrum -->
    <section id="breadcrum">
        <div class="ctn">
            <h1>{{ $product->name ?? '' }}</h1>
            <div class="bread">
                <ul>
                    <li>
                        <a href="{{ Route('frontend.home.index') }}">Trang chủ</a>
                    </li>
                    <li><a href="{{ Route('frontend.products.all.index') }}">Sản phẩm</a></li>
                    <li><a href="{{ Route('frontend.products.category',['id'=>$product->category->id]) }}">{{ $product->category->name ?? '' }}</a></li>
                    <li><a href="#"> {{ $product->name ?? '' }}</a></li>

                </ul>
            </div>
        </div>
    </section>
    <!-- end breadcrum -->

    <!-- single product -->
    <section id="page-single-product">
        <div class="ctn">
            <div class="cmd12 item-product">
                <div>
                    <div class="top-itprd cmd5 cxs12 csm5">
                        <div class="sl-topprd">
                            @if(count($product->image()->get()) > 0)
                                @foreach($product->image()->get() as $key => $value)
                                    <div class="cxs12 cmd12 ittopprd">

                                        <div>
                                            @if(file_exists(public_path('storage/products').'/'.$value->url))
                                                <img src="{{ str_replace(Str::of($value->url)->basename(),Str::of($value->url)->basename(),asset('storage/products/'.$value->url)) }}" alt="{{ $value->filename ?? '' }}">
                                            @endif
                                            <span class="ic-sale">Hot</span>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>

                        <div class="sl-botprd">
                            @if(count($product->image()->get()) > 0)
                                @foreach($product->image()->get() as  $key => $value)
                                    <div class="cxs3 csm3 cmd3 itbotprd">
                                        <div>
                                            @if(file_exists(public_path('storage/products').'/'.$value->url))
                                                <img src="{{ str_replace(Str::of($value->url)->basename(),'thumb_'.Str::of($value->url)->basename(),asset('storage/products/'.$value->url)) }}" alt="{{ $value->filename ?? '' }}">
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="clear"></div>
                        <ul class="btn-share">
                            <a href="#" class="AddFavourite" data-id="{{ $product->id }}">Yêu thích</a>

                            <div class="fb-share-button" data-href="{{ Route('frontend.product.edit',['slug'=>$product->slug]) }}" data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ Route('frontend.product.edit',['slug'=>$product->slug]) }}" class="fb-xfbml-parse-ignore">Share</a></div>

                            <a style="display: none">Chia sẻ</a>
                        </ul>
                    </div>
                    <div class="bot-itprd cmd7 cxs12 csm7">
                        <div class="item-star">
                            <div class="star"></div>
                            <span>9999 đánh giá</span>
                        </div>
                        <h3>{{ $product->name ?? '' }}</h3>
                        <div class="item-att">
                            <ul class="price">
                                <li>{{ !empty($product->discount) ? number_format($product->discount,0, '.', '.') : number_format($product->price,0, '.', '.')  }} <span>đ</span></li>
                                <li>Giá cũ: {{ !empty($product->discount) ? number_format($product->price,0, '.', '.') : ''}} <span>đ</span></li>
                            </ul>
                            <div>
                                <!--Màu: <img src="{{ asset('/frontend/assets') }}/a/i/color.png" alt="">-->
                                <!--Màu: <div class="color-choose">-->
                                <!--        <input type="radio" class="color-xam" name="color-select" value="Màu xám">-->
                                <!--        <input type="radio" class="color-nau" name="color-select" value="Màu nâu">-->
                                <!--        <input type="radio" class="color-den" name="color-select" value="Màu đen">-->
                                <!--        <input type="radio" class="color-do" name="color-select" value="Màu đỏ">-->

                                <!--    </div>-->
                            </div>
                        </div>



                        @if($product->description_gift)
                            <div class="gif">
                            {!! html_entity_decode($product->description_gift) ?? '' !!}
                            </div>
                        @else
                            <ul class="gif">
                                <li>Quà tặng: 499.000đ</li>
                                <li>Ưu đãi thêm (5%) cho khách hàng thân thiết</li>
                            </ul>
                        @endif

                        <div class="infor-product">
                            <ul>
                                <li><span>Tình trạng:</span> Còn hàng</li>
                                <li><span>Bảo hành:</span> {{ $product->warranty ?? '1' }} năm</li>
                                <li><span>Bảo trị:</span> {{ $product->maintenance ?? 'Trọn đời' }}</li>
                            </ul>
                        </div>
                        <div class="date">
                            <div class="it">
                                <p class="time">01</p>
                                <p class="sec">NGÀY</p>
                            </div>
                            <div class="it">
                                <p class="time time1">12</p>
                                <p class="sec">GIỜ</p>
                            </div>
                            <div class="it">
                                <p class="time time2">51</p>
                                <p class="sec">PHÚT</p>
                            </div>
                            <div class="it">
                                <p class="time time3">57</p>
                                <p class="sec">GIÂY</p>
                            </div>
                        </div>
                        <div class="end-favourite">
                            <div class="quantity">
                                <button type="button" id="sub" class="sub">-</button>
                                <input type="text" id="qlt_{{ $product->id ?? '' }}" value="1" min="0"  max="100">
                                <button type="button" id="add" class="add">+</button>
                            </div>
                            <div>
                                <a href="#" class="add-to-cart" data-id="{{ $product->id ?? '' }}" >Cho vào giỏ</a>
                                <a href="#" class="buy-now" data-id="{{ $product->id ?? '' }}">Mua ngay</a>
                                <a href="#" class="buy-pay" style="display: none">Mua trả góp 0 đồng</a>
                                <a href="#" class="pay-btn" style="display: none">Thanh toán ATM, IB, QR PAY</a>
                            </div>
                        </div>
                        <!--<div class="combo-sale" >-->
                        <!--    <div>-->
                        <!--        <h3>Hàng khuyến mãi kèm theo sản phẩm</h3>-->
                        <!--        <p>Combo bạt + thảm</p>-->
                        <!--    </div>-->
                        <!--</div>-->
                        @if($product->delivery_time)
                            <div class="time-request">
                                <img src="{{ asset('/frontend/assets') }}/a/i/12.png" alt="time request">
                                <div>
                                    <h3>Yêu cầu thời gian giao hàng (toàn quốc)</h3>
                                    <div class="sl-time">
                                        <input type="radio" id="4hours" @if($product->delivery_time == 1) checked="checked"  @endif  readonly="readonly"  name="time-select" value="4hours">
                                        <label for="4 hours">4 Giờ</label><br>
                                        <input type="radio" id="8hours" name="time-select" @if($product->delivery_time == 2) checked="checked"  @endif  readonly="readonly" value="8hours">
                                        <label for="8 hours">8 Giờ</label><br>
                                        <input type="radio" id="12hours" name="time-select" value="12hours" @if($product->delivery_time == 3) checked="checked"    @endif readonly="readonly">
                                        <label for="12 hours">12 Giờ</label><br>
                                        <input type="radio" id="24hours" name="time-select" value="24hours" @if($product->delivery_time == 4)  checked="checked"   @endif readonly="readonly">
                                        <label for="24 hours">24 Giờ</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="note-ship">

                            <label>
                                <input type="checkbox" class="radio" value="1" name="fooby" />
                                <div>
                                    <h4>Yêu cầu nhân viên kỹ thuật giao hàng </h4>
                                    Hỗ trợ lắp đặt, cài đặt, hướng dẫn sử dụng máy mới, giải đáp thắc mắc sản phẩm.
                                </div>

                            </label>
                            <label>
                                <input type="checkbox" class="radio" value="1" name="fooby" />
                                <h4>Yêu cầu dịch vụ gói quà.</h4>
                            </label>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- content single product -->
        <div class="clear"></div>
        <div class="ctn entry-content">
            <div class="cxs12 cmd12">
                <!--<p class="ttsp">thông tin về sản phẩm</p>-->
                <ul class="tab-detail">
                    <a href="#mo-ta-san-pham">Mô tả sản phẩm</a>
                    <a href="#thong-so-ky-thuat">Thông số kĩ thuật</a>
                    <a href="#chinh-sach-dich-vu">chính sách dịch vụ</a>
                    <a href="#tai-sao-chon-kenji">Tại sao nên chọn kenji</a>

                </ul>
            </div>
            <div class="cxs12 cmd12 single-prd">
                <div class="cxs12 csm8 cmd8">

                    <!-- mô tả sản phẩm -->
                    <p class="title-single" id="mo-ta-san-pham">Mô tả sản phẩm</p>
                    <div class="description-prd">
                        <h2>{{ $product->name ?? '' }}</h2>
                       {!! $product->description ?? '' !!}
                    </div>
                    <!-- end mô tả sản phẩm -->

                    <!-- Thông số kĩ thuật -->
                    <p class="title-single" id="thong-so-ky-thuat">Thông số kĩ thuật</p>
                    <div class="tskt-prd">
                        {!! $product->specifications ?? '' !!}
                        @if(empty($product->specifications))
                            <table>
                                <tr>
                                    <th>Model</th>
                                    <th>JP-I10</th>

                                </tr>
                                <tr>
                                    <td>Điện áp</td>
                                    <td>220-240V</td>

                                </tr>
                                <tr>
                                    <td>Công suất</td>
                                    <td>180W</td>
                                </tr>
                                <tr>
                                    <td>Tải trọng</td>
                                    <td>140kg</td>

                                </tr>
                                <tr>
                                    <td>Nhiệt hồng ngoại</td>
                                    <td>40 -45 độ</td>
                                </tr>
                                <tr>
                                    <td>Kết nối Bluetooth</td>
                                    <td>Có</td>

                                </tr>
                                <tr>
                                    <td>Hệ thống túi khí</td>
                                    <td>22</td>
                                </tr>
                                <tr>
                                    <td>Thời gian massage</td>
                                    <td>15 - 30 phút</td>
                                </tr>
                                <tr>
                                    <td>Con lăn</td>
                                    <td>Ôm trọn đầu đến mông</td>
                                </tr>
                                <tr>
                                    <td>Kỹ thuật massage</td>
                                    <td>Xoa bóp, ấn huyệt, day</td>
                                </tr>

                                <tr>
                                    <td>Bảo hành</td>
                                    <td>05 năm tận nhà</td>
                                </tr>
                                <tr>
                                    <td>Bảo trì</td>
                                    <td>Trọn đời</td>
                                </tr>
                            </table>
                        @endif
                    </div>
                    <!-- end thông số kĩ thuật -->

                    <!-- Chính sách dịch vụ -->
                    <p class="title-single" id="chinh-sach-dich-vu">chính sách dịch vụ</p>
                    <div class="csdv-prd">
                        {!! $product->service_policy ?? '' !!}
                        @if(empty($product->service_policy))
                            <div class="cmd6">
                                <div>
                                    <h3>Phân phối độc quyền tại Việt Nam</h3>
                                    <ul>
                                        <li>Dịch vụ bảo hành & Bảo trì tại nhà</li>

                                        <li>Giá bán trực tiếp từ nhà nhập khẩu</li>

                                        <li>TT trả góp lãi suất 0% với ACS</li>

                                        <li>TT trả góp lãi suất 0% với Home Credit</li>

                                        <li>TT trả góp qua thẻ Visa / Master / JCB</li>

                                        <li>Thương hiệu được nhiều sao Việt tin dùng</li>

                                    </ul>
                                </div>
                            </div>
                            <div class="cmd6">
                            <div>
                                <h3>cam kết với khách hàng</h3>
                                <ul>

                                    <li><b>Đổi trả</b>: Trong vòng 10 ngày (lỗi sản xuất)</li>

                                    <li><b>Thanh toán</b>: Sau khi nhận hàng</li>

                                    <li><b>Thương hiệu</b>: Tập Đoàn Thể Thao KenJi</li>

                                    <li><b>Chính hãng</b>: Cam kết 100 % hàng chính hãng</li>

                                    <li><b>Bảo trì</b>: Trọn đời tại nhà</li>

                                    <li><b>Lắp đặt</b>: Giao hàng và lắp đặt tại nhà</li>
                                </ul>
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- end chính sách dịch vụ -->

                    <!--tại sao nên chọn kenji-->
                    <p class="title-single" id="tai-sao-chon-kenji">Tại sao nên chọn kenji</p>
                    <div class="whyselect">
                        {!! $product->choose_kenji ?? '' !!}
                    </div>
                    <!--end tại sao nên chọn kenji-->

                    <!-- Đánh giá bình luận của khách hàng -->
					<p class="title-single">đánh giá bình luận của khách hàng</p>
					<div class="comment-prd">

                        @if($product->commentsActive()->get())
                            @foreach($product->commentsActive()->get() as $key => $value)
                                <div class="card-cm">
                                    <div class="cxs2 cmd1">
                                        <img src="{{ Avatar::create($value->name)->toBase64() }}" width="70" class="rounded-circle mt-2" />
                                    </div>
                                    <div class="cxs10 cmd11">
                                        <div class="star"></div>
                                        <ul>
                                            <li>{{ !empty($value->created_at) ?  \App\Helpers\TimeHelper::timeAgo($value->created_at) : '' }}</li>
                                        </ul>
                                        <h3>{{ $value->name ?? '' }}</h3>
                                        {!! $value->message ?? '' !!}
                                        @if($value->image()->get())
                                            @foreach($value->image()->get() as $k =>$v)
                                                <img src="{{ str_replace(Str::of($v->url)->basename(),'thumb_'.Str::of($v->url)->basename(),asset('storage/products/'.$v->url)) }}" alt="">
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif

						<div class="clear"></div>
						<form action="{{ Route('frontend.product.store') }}" enctype="multipart/form-data" method="post">
                            @csrf
							<div class="comment-box ml-2">
				            	<h3>Để lại đánh giá của bạn</h3>
				            	<p>Thông tin cá nhân của bạn sẽ được bảo mật</p>
				            	<div class="rate-box">
					                <h4>Đánh giá: </h4>
					                <div class="rating">
					                    <input type="radio" name="number_star" value="5" id="5" checked="checked"/><label for="5">☆</label>
					                    <input type="radio" name="number_star" value="4" id="4" /><label for="4">☆</label>
					                    <input type="radio" name="number_star" value="3" id="3" /><label for="3">☆</label>
					                    <input type="radio" name="number_star" value="2" id="2" /><label for="2">☆</label>
					                    <input type="radio" name="number_star" value="1" id="1"  /><label for="1">☆</label>
					                </div>
				                </div>

				            </div>
				            <div class="clear"></div>
							<div class="comment-area">
			                	<div class="cmd6">
                                    @if ($errors->has('email'))
			                		    <span class="error-alert">{{ $errors->first('email') }}</span>
                                    @endif
			                		<input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Nhập email" required>

			                	</div>
			                	<div class="cmd6">
                                    @if ($errors->has('phone'))
                                        <span class="error-alert">{{ $errors->first('phone') }}</span>
                                    @endif
			                		<input type="text" id="phone" name="phone" value="{{ old('phone') }}"  placeholder="Số điện thoại" required>
			                	</div>
			                	<div class="cmd12">
                                    @if ($errors->has('message'))
                                        <span class="error-alert">{{ $errors->first('message') }}</span>
                                    @endif
			                		<textarea class="form-control" placeholder="Viết trải nghiệm, đánh giá của bạn tại đây" rows="4" id="message" name="message" required>{{ old('message') }}</textarea>
			                		<div class="up-image" style="display: none">
										<div id="output_avatar">
									        <span data-img="" class="item-img" onclick=""><img class="clos" src="{{ asset('/frontend/assets') }}/a/i/i10.png"><img src="{{ asset('/frontend/assets') }}/a/i/bc2.jpg" alt="image"></span>
									        <span data-img="" class="item-img" onclick=""><img class="clos" src="{{ asset('/frontend/assets') }}/a/i/i10.png"><img src="{{ asset('/frontend/assets') }}/a/i/bc2.jpg" alt="image"></span>
									        <span data-img="" class="item-img" onclick=""><img class="clos" src="{{ asset('/frontend/assets') }}/a/i/i10.png"><img src="{{ asset('/frontend/assets') }}/a/i/bc2.jpg" alt="image"></span>
									    </div>
{{--										<input class="input-file" accept="image/*" name="file[]" type="file" id="file" multiple="multiple">--}}
			                		</div>
                                        @if ($errors->has('voteImage'))
                                            <span class="error-alert">{{ $errors->first('voteImage') }}</span>
                                        @endif
                                    <input class="input-file" accept="image/*" name="voteImage[]" type="file" id="voteImage" multiple="multiple" required>
                                    <input type="hidden" name="product_id" value="{{ $product->id ?? '' }}">

                                </div>
			                	<button type="submit">Gửi đánh giá</button>
			                </div>

						</form>



					</div>
					<!-- End đánh giá bình luận -->

                </div>

                <div class="cxs12 csm4 cmd4 sidebar-prd">
                    <div class="itemsb-prd">
                        <h3><a href="">{{ $product->name ?? '' }}</a></h3>
                        <div class="item-att">
                            <ul class="price">
                                <li>{{ !empty($product->discount) ? number_format($product->discount,0, '.', '.') : number_format($product->price,0, '.', '.')  }} <span>đ</span></li>
                                <li>Giá cũ: {{ !empty($product->discount) ? number_format($product->price,0, '.', '.') : ''}} <span>đ</span></li>
                            </ul>

                        </div>
                        <div class="infor-product">
                            <!--<div class="att-prd">-->
                            <!--    Màu: <img src="{{ asset('/frontend/assets') }}/a/i/color.png" alt="">-->
                            <!--</div>-->
                            <ul>
                                <li><span>Tình trạng:</span> Còn hàng</li>
                            </ul>
                        </div>
                        <div class="number-prd">
                            <div class="quantity">
                                <button type="button" id="sub" class="sub">-</button>
                                <input type="text" id="qlt_two_{{ $product->id ?? '' }}" value="1" min="0" max="100">
                                <button type="button" id="add" class="add">+</button>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="end-favourite">

                            <div>
                                <a href="#" data-id="{{ $product->id ?? '' }}" class="add-to-cart-two">Cho vào giỏ</a>
                                <a href="#" class="buy-now" data-id="{{ $product->id ?? '' }}">Mua ngay</a>
                                <a href="#" class="buy-pay">Mua trả góp 0 đ</a>
                                <a href="#" class="pay-btn">ATM, IB, QR PAY</a>
                            </div>
                        </div>
                        <ul class="gif">
                            <li>Quà tặng: 499.000đ</li>
                            <li>Ưu đãi thêm (5%) cho khách hàng thân thiết</li>
                        </ul>
                    </div>
                    <!-- Thông số kĩ thuật -->

                    <div class="tskt-sb" style="display: none">
                        <p class="title-single">Thông số kĩ thuật</p>
                        <table>
                            <tr>
                                <th>Model</th>
                                <th>JP-I10</th>

                            </tr>
                            <tr>
                                <td>Điện áp</td>
                                <td>220-240V</td>

                            </tr>
                            <tr>
                                <td>Công suất</td>
                                <td>180W</td>
                            </tr>
                            <tr>
                                <td>Tải trọng</td>
                                <td>140kg</td>

                            </tr>
                            <tr>
                                <td>Nhiệt hồng ngoại</td>
                                <td>40 -45 độ</td>
                            </tr>
                            <tr>
                                <td>Kết nối Bluetooth</td>
                                <td>Có</td>

                            </tr>
                            <tr>
                                <td>Hệ thống túi khí</td>
                                <td>22</td>
                            </tr>
                            <tr>
                                <td>Thời gian massage</td>
                                <td>15 - 30 phút</td>
                            </tr>
                            <tr>
                                <td>Con lăn</td>
                                <td>Ôm trọn đầu đến mông</td>
                            </tr>
                            <tr>
                                <td>Kỹ thuật massage</td>
                                <td>Xoa bóp, ấn huyệt, day</td>
                            </tr>

                            <tr>
                                <td>Bảo hành</td>
                                <td>05 năm tận nhà</td>
                            </tr>
                            <tr>
                                <td>Bảo trì</td>
                                <td>Trọn đời</td>
                            </tr>
                        </table>
                    </div>
                    <!-- end thông số kĩ thuật -->

                    <!-- sản phẩm mua kèm -->
                    <div class="prd-buywith">
                        <p class="title-single">Ưu đãi chung đơn hàng</p>
                        <div class="sl-sbprd">

                            @foreach($productNew as $key=>$post)
                                <div class="cmd12 itprd-diff">
                                    <div>
                                        <div class="top-itprd">
                                            <a href="{{ Route('frontend.product.edit',['slug'=>$post->slug]) }}">
                                                @if($post->default() && $post->default()['url'])
                                                    <img src="{{ asset('frontend') }}/assets/img/spinner.gif" class="lozad" data-src="{{ str_replace(Str::of($post->default()['url'])->basename(),'thumb_'.Str::of($post->default()['url'])->basename(),asset('storage/products/'.$post->default()['url'])) }}" alt="{{ $post->name ?? '' }}">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="bot-itprd">
                                            <h3><a href="{{ Route('frontend.product.edit',['slug'=>$post->slug]) }}">{{ $post->name ?? '' }}</a></h3>
                                            <ul class="price">
                                                <li>{{ !empty($post->discount) ? number_format($post->discount,0, '.', '.') : number_format($post->price,0, '.', '.')  }} <span>đ</span></li>
                                                <li>Giá cũ: {{ !empty($post->discount) ? number_format($post->price,0, '.', '.') : ''}} <span>đ</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <!-- end sản phẩm mua kèm -->
                </div>
            </div>
        </div>
        <!-- end -->
    </section>
    <!-- end single product -->

    <!-- Sản phẩm liên quan -->
    <section class="ctn">
        <div class="cxs12 cmd12" id="recent-prd">
            <p class="ttsp">sản phẩm liên quan</p>

            <div id="sl-recentprd">

                @foreach($productOthers as $key => $post)
                    <div class="cxs12 csm3 cmd3 item-product">
                        <div>
                            <div class="top-itprd">
                                <a href="{{ Route('frontend.product.edit',['slug'=>$post->slug]) }}">
                                    @if($post->default() && $post->default()['url'])
                                        <img src="{{ asset('frontend') }}/assets/img/spinner.gif" class="lozad" data-src="{{ str_replace(Str::of($post->default()['url'])->basename(),Str::of($post->default()['url'])->basename(),asset('storage/products/'.$post->default()['url'])) }}" alt="{{ $post->name ?? '' }}">
                                    @endif
                                </a>
                                <div class="list-button">
                                    <a href="#" class="AddCart" data-id="{{ $post->id }}"  data-qlt="{{ 1 }}"></a>
                                    <a href=""></a>
                                    <a href="{{ Route('frontend.product.edit',['slug'=>$post->slug]) }}"></a>
                                </div>
                            </div>
                            <div class="bot-itprd">
                                <div class="star"></div>
                                <h3><a href="{{ Route('frontend.product.edit',['slug'=>$post->slug]) }}">{{ $post->slug }}</a></h3>
                                <ul class="price">
                                    <li>{{ !empty($post->discount) ? number_format($post->discount,0, '.', '.') : number_format($post->price,0, '.', '.')  }} <span>đ</span></li>
                                    <li>Giá cũ: {{ !empty($post->discount) ? number_format($post->price,0, '.', '.') : ''}} <span>đ</span></li>
                                </ul>
                                <ul class="gif">
                                    <li>Quà tặng: 499.000đ</li>
                                    <li>Ưu đãi thêm (5%) cho khách hàng thân thiết</li>
                                </ul>
                            </div>

                            <span class="ic-sale">Hot</span>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- end sản phẩm liên quan -->

    <div class="clear"></div>
    <div class="line-xam"></div>

</x-layout.frontend>
