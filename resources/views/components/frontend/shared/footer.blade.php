<!-- Start footer section -->
<footer class="footer__section bg__black">
    <div class="container-fluid">
        <div class="main__footer d-flex justify-content-between">
            <div class="footer__widget footer__widget--width">
                <h2 class="footer__widget--title text-ofwhite h3">About Us
                    <button class="footer__widget--button" aria-label="footer widget button">
                        <svg class="footer__widget--title__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394" viewBox="0 0 10.355 6.394">
                            <path  d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z" transform="translate(-6 -8.59)" fill="currentColor"></path>
                        </svg>
                    </button>
                </h2>
                <div class="footer__widget--inner">
                    {!! $footerCompany->textCate ?? '' !!}
                    <div class="footer__social">
                        <h3 class="social__title text-ofwhite h4 mb-15">Follow Us</h3>
                        <ul class="social__shear d-flex">
                            <li class="social__shear--list">
                                <a class="social__shear--list__icon" target="_blank" href="{{ $menuSupport->technical_assistance ?? '' }}">
                                    <svg  xmlns="http://www.w3.org/2000/svg" width="7.667" height="16.524" viewBox="0 0 7.667 16.524">
                                        <path  data-name="Path 237" d="M967.495,353.678h-2.3v8.253h-3.437v-8.253H960.13V350.77h1.624v-1.888a4.087,4.087,0,0,1,.264-1.492,2.9,2.9,0,0,1,1.039-1.379,3.626,3.626,0,0,1,2.153-.6l2.549.019v2.833h-1.851a.732.732,0,0,0-.472.151.8.8,0,0,0-.246.642v1.719H967.8Z" transform="translate(-960.13 -345.407)" fill="currentColor"/>
                                    </svg>
                                    <span class="visually-hidden">Facebook</span>
                                </a>
                            </li>
                            <li class="social__shear--list">
                                <a class="social__shear--list__icon" target="_blank" href="{{ $menuSupport->zalo ?? '' }}">
                                   <img src="{{ asset('/frontend/assets/img/Icon_of_Zalo.svg') }}" style="height: 16px !important;">
                                    <span class="visually-hidden">Zalo</span>
                                </a>
                            </li>
                            <li class="social__shear--list">
                                <a class="social__shear--list__icon" target="_blank" href="{{ $menuSupport->free_call_center ?? '' }}">
                                    <svg  xmlns="http://www.w3.org/2000/svg" width="16.49" height="11.582" viewBox="0 0 16.49 11.582">
                                        <path  data-name="Path 321" d="M967.759,1365.592q0,1.377-.019,1.717-.076,1.114-.151,1.622a3.981,3.981,0,0,1-.245.925,1.847,1.847,0,0,1-.453.717,2.171,2.171,0,0,1-1.151.6q-3.585.265-7.641.189-2.377-.038-3.387-.085a11.337,11.337,0,0,1-1.5-.142,2.206,2.206,0,0,1-1.113-.585,2.562,2.562,0,0,1-.528-1.037,3.523,3.523,0,0,1-.141-.585c-.032-.2-.06-.5-.085-.906a38.894,38.894,0,0,1,0-4.867l.113-.925a4.382,4.382,0,0,1,.208-.906,2.069,2.069,0,0,1,.491-.755,2.409,2.409,0,0,1,1.113-.566,19.2,19.2,0,0,1,2.292-.151q1.82-.056,3.953-.056t3.952.066q1.821.067,2.311.142a2.3,2.3,0,0,1,.726.283,1.865,1.865,0,0,1,.557.49,3.425,3.425,0,0,1,.434,1.019,5.72,5.72,0,0,1,.189,1.075q0,.095.057,1C967.752,1364.1,967.759,1364.677,967.759,1365.592Zm-7.6.925q1.49-.754,2.113-1.094l-4.434-2.339v4.66Q958.609,1367.311,960.156,1366.517Z" transform="translate(-951.269 -1359.8)" fill="currentColor"/>
                                    </svg>
                                    <span class="visually-hidden">Youtube</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer__widget--menu__wrapper d-flex footer__widget--width">
                <div class="footer__widget">
                    <h2 class="footer__widget--title text-ofwhite h3">My Account
                        <button class="footer__widget--button" aria-label="footer widget button">
                            <svg class="footer__widget--title__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394" viewBox="0 0 10.355 6.394">
                                <path  d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z" transform="translate(-6 -8.59)" fill="currentColor"></path>
                            </svg>
                        </button>
                    </h2>
                    <ul class="footer__widget--menu footer__widget--inner">
                        <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="{{ Route('frontend.users.index') }}">Tài khoản</a></li>
                        <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="{{ Route('frontend.auth.login') }}">Đăng nhập</a></li>
                        <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="{{ Route('frontend.auth.login') }}">Đăng Ký</a></li>
                    </ul>
                </div>
                <div class="footer__widget">
                    <h2 class="footer__widget--title text-ofwhite h3">Danh mục
                        <button class="footer__widget--button" aria-label="footer widget button">
                            <svg class="footer__widget--title__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394" viewBox="0 0 10.355 6.394">
                                <path  d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z" transform="translate(-6 -8.59)" fill="currentColor"></path>
                            </svg>
                        </button>
                    </h2>
                    <ul class="footer__widget--menu footer__widget--inner">
                        <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="{{ Route('frontend.contact.index') }}">Liên hệ</a></li>
                        <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="{{ Route('frontend.news.index') }}">Tin tức</a></li>
                        <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="{{ Route('frontend.tests.index') }}">Bài kiểm tra</a></li>
                        <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="/tin-tuc/danh-muc/9-kien-thuc-chung.html">Kiến thức chung</a></li>
                        <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="tin-tuc/danh-muc/3-tai-lieu-va-meo-hay.html">Tài liệu và mẹo hay</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer__widget footer__widget--width"></div>
            <div class="footer__widget footer__widget--width"></div>
            <div class="footer__widget footer__widget--width" style="display: none">
                <h2 class="footer__widget--title text-ofwhite h3">Instagram
                    <button class="footer__widget--button" aria-label="footer widget button">
                        <svg class="footer__widget--title__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394" viewBox="0 0 10.355 6.394">
                            <path  d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z" transform="translate(-6 -8.59)" fill="currentColor"></path>
                        </svg>
                    </button>
                </h2>
                <div class="footer__instagram footer__widget--inner">
                    <div class="footer__instagram--list d-flex">
                        <div class="instagram__thumbnail">
                            <a class="instagram__thumbnail--img" target="_blank" href="https://www.instagram.com/p/CZkF3TLBTT7"><img src="{{ asset('/frontend/') }}/assets/img/other/instagram1.webp" alt="instagram"></a>
                        </div>
                        <div class="instagram__thumbnail">
                            <a class="instagram__thumbnail--img" target="_blank" href="https://www.instagram.com/p/CZkF60sBxhN"><img src="{{ asset('/frontend/') }}/assets/img/other/instagram2.webp" alt="instagram"></a>
                        </div>
                        <div class="instagram__thumbnail">
                            <a class="instagram__thumbnail--img" target="_blank" href="https://www.instagram.com/p/CZkF90ZB6HG"><img src="{{ asset('/frontend/') }}/assets/img/other/instagram3.webp" alt="instagram"></a>
                        </div>
                    </div>
                    <div class="footer__instagram--list d-flex">
                        <div class="instagram__thumbnail">
                            <a class="instagram__thumbnail--img" target="_blank" href="https://www.instagram.com/p/CZkGAe6BQeu"><img src="{{ asset('/frontend/') }}/assets/img/other/instagram4.webp" alt="instagram"></a>
                        </div>
                        <div class="instagram__thumbnail">
                            <a class="instagram__thumbnail--img" target="_blank" href="https://www.instagram.com/p/CZkGCWcBbv9"><img src="{{ asset('/frontend/') }}/assets/img/other/instagram5.webp" alt="instagram"></a>
                        </div>
                        <div class="instagram__thumbnail">
                            <a class="instagram__thumbnail--img" target="_blank" href="https://www.instagram.com/p/CZkGFDMhoid"><img src="{{ asset('/frontend/') }}/assets/img/other/instagram6.webp" alt="instagram"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__widget footer__widget--width" style="display: none">
                <h2 class="footer__widget--title text-ofwhite h3">Đăng ký nhận bài kiểm tra
                    <button class="footer__widget--button" aria-label="footer widget button">
                        <svg class="footer__widget--title__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394" viewBox="0 0 10.355 6.394">
                            <path  d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z" transform="translate(-6 -8.59)" fill="currentColor"></path>
                        </svg>
                    </button>
                </h2>
                <div class="footer__widget--inner">
                    <p class="footer__widget--desc text-ofwhite m-0">Fill their seed open meat. Sea you <br> great Saw image stl</p>
                    <div class="newsletter__subscribe">
                        <form class="newsletter__subscribe--form" action="#">
                            <label>
                                <input class="newsletter__subscribe--input" placeholder="Email Address" type="email" id="homeEmail">
                            </label>
                            <button class="newsletter__subscribe--button" type="button" id="homeRegister">Đăng ký</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__bottom d-flex justify-content-between align-items-center">
            <p class="copyright__content text-ofwhite m-0">Copyright © {{ date('Y') }} <a class="copyright__content--link" href="{{ Route('frontend.home.index') }}">Luyện thi công chức</a></p>
        </div>
    </div>
</footer>
<!-- End footer section -->
