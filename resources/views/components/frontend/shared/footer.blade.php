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
                                    <svg  xmlns="http://www.w3.org/2000/svg" width="16.489" height="13.384" viewBox="0 0 16.489 13.384">
                                        <path  data-name="Path 303" d="M966.025,1144.2v.433a9.783,9.783,0,0,1-.621,3.388,10.1,10.1,0,0,1-1.845,3.087,9.153,9.153,0,0,1-3.012,2.259,9.825,9.825,0,0,1-4.122.866,9.632,9.632,0,0,1-2.748-.4,9.346,9.346,0,0,1-2.447-1.11q.4.038.809.038a6.723,6.723,0,0,0,2.24-.376,7.022,7.022,0,0,0,1.958-1.054,3.379,3.379,0,0,1-1.958-.687,3.259,3.259,0,0,1-1.186-1.666,3.364,3.364,0,0,0,.621.056,3.488,3.488,0,0,0,.885-.113,3.267,3.267,0,0,1-1.374-.631,3.356,3.356,0,0,1-.969-1.186,3.524,3.524,0,0,1-.367-1.5v-.057a3.172,3.172,0,0,0,1.544.433,3.407,3.407,0,0,1-1.1-1.214,3.308,3.308,0,0,1-.4-1.609,3.362,3.362,0,0,1,.452-1.694,9.652,9.652,0,0,0,6.964,3.538,3.911,3.911,0,0,1-.075-.772,3.293,3.293,0,0,1,.452-1.694,3.409,3.409,0,0,1,1.233-1.233,3.257,3.257,0,0,1,1.685-.461,3.351,3.351,0,0,1,2.466,1.073,6.572,6.572,0,0,0,2.146-.828,3.272,3.272,0,0,1-.574,1.083,3.477,3.477,0,0,1-.913.8,6.869,6.869,0,0,0,1.958-.546A7.074,7.074,0,0,1,966.025,1144.2Z" transform="translate(-951.23 -1140.849)" fill="currentColor"/>
                                    </svg>
                                    <span class="visually-hidden">Twitter</span>
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
