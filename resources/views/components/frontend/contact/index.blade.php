<x-layout.frontend>
    <!-- Start breadcrumb section -->
    <section class="breadcrumb__section breadcrumb__bg">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="breadcrumb__content text-center">
                        <h1 class="breadcrumb__content--title text-white mb-25">Liên hệ</h1>
                        <ul class="breadcrumb__content--menu d-flex justify-content-center">
                            <li class="breadcrumb__content--menu__items"><a class="text-white"
                                                                            href="{{ Route('frontend.home.index') }}">Trang
                                    chủ</a></li>
                            <li class="breadcrumb__content--menu__items"><span class="text-white">Liên hệ</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumb section -->

    <!-- Start contact section -->
    <section class="contact__section section--padding">
        <div class="container">
            <div class="section__heading text-center mb-40">
                <h2 class="section__heading--maintitle">Thông tin liên hệ</h2>
            </div>
            <div class="main__contact--area position__relative">

                <div class="contact__form">
                    <h3 class="contact__form--title mb-40">Vui lòng nhập thông tin của bạn</h3>
                    <form class="contact__form--inner" action="{{ Route('frontend.contact.store') }}">
                        @if($errors->any())
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first() }}
                            </div>
                        @endif
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="contact__form--list mb-20">
                                    <label class="contact__form--label" for="input1">Tên <span
                                            class="contact__form--label__star">*</span></label>
                                    <input class="contact__form--input" name="firstname" id="input1"
                                           placeholder="Nhập tên của bạn" type="text">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="contact__form--list mb-20">
                                    <label class="contact__form--label" for="input2">Họ & chữ lót <span
                                            class="contact__form--label__star">*</span></label>
                                    <input class="contact__form--input" name="lastname" id="input2"
                                           placeholder="Nhập họ của bạn" type="text">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="contact__form--list mb-20">
                                    <label class="contact__form--label" for="input3">Số điện thoại <span
                                            class="contact__form--label__star">*</span></label>
                                    <input class="contact__form--input" name="phone" id="input3"
                                           placeholder="Nhập số điện thoại" type="text">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="contact__form--list mb-20">
                                    <label class="contact__form--label" for="input4">Email <span
                                            class="contact__form--label__star">*</span></label>
                                    <input class="contact__form--input" name="email" id="input4"
                                           placeholder="Nhập địa chỉ email" type="email">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="contact__form--list mb-15">
                                    <label class="contact__form--label" for="input5">Nội dung <span
                                            class="contact__form--label__star">*</span></label>
                                    <textarea class="contact__form--textarea" name="message" id="input5"
                                              placeholder="Viết nội dung yêu cầu"></textarea>
                                </div>
                            </div>
                        </div>
                        <button class="contact__form--btn primary__btn" type="submit">Gửi ngay bây giờ</button>
                    </form>
                </div>
                <div class="contact__info border-radius-5">
                    <div class="contact__info--items">
                        <h3 class="contact__info--content__title text-white mb-15">Liên hệ</h3>
                        <div class="contact__info--items__inner d-flex">
                            <div class="contact__info--icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="31.568" height="31.128"
                                     viewBox="0 0 31.568 31.128">
                                    <path id="ic_phone_forwarded_24px"
                                          d="M26.676,16.564l7.892-7.782L26.676,1V5.669H20.362v6.226h6.314Zm3.157,7a18.162,18.162,0,0,1-5.635-.887,1.627,1.627,0,0,0-1.61.374l-3.472,3.424a23.585,23.585,0,0,1-10.4-10.257l3.472-3.44a1.48,1.48,0,0,0,.395-1.556,17.457,17.457,0,0,1-.9-5.556A1.572,1.572,0,0,0,10.1,4.113H4.578A1.572,1.572,0,0,0,3,5.669,26.645,26.645,0,0,0,29.832,32.128a1.572,1.572,0,0,0,1.578-1.556V25.124A1.572,1.572,0,0,0,29.832,23.568Z"
                                          transform="translate(-3 -1)" fill="currentColor"/>
                                </svg>
                            </div>
                            <div class="contact__info--content">
                                <p class="contact__info--content__desc text-white">Liên hệ chúng tôi qua Zalo<br>
                                    @if($contact->hotline)
                                         <a href="https://zalo.me/{{ $contact->hotline ?? '' }}" target="_blank">{{ $contact->hotline ?? '' }}</a>
                                    @endif
                                    @if($contact->advise)
                                        <br><a href="https://zalo.me/{{ $contact->advise ?? '' }}" target="_blank">{{ $contact->advise ?? '' }}</a>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="contact__info--items">
                        <h3 class="contact__info--content__title text-white mb-15">Email Address</h3>
                        <div class="contact__info--items__inner d-flex">
                            <div class="contact__info--icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="31.57" height="31.13"
                                     viewBox="0 0 31.57 31.13">
                                    <path id="ic_email_24px"
                                          d="M30.413,4H5.157C3.421,4,2.016,5.751,2.016,7.891L2,31.239c0,2.14,1.421,3.891,3.157,3.891H30.413c1.736,0,3.157-1.751,3.157-3.891V7.891C33.57,5.751,32.149,4,30.413,4Zm0,7.783L17.785,21.511,5.157,11.783V7.891l12.628,9.728L30.413,7.891Z"
                                          transform="translate(-2 -4)" fill="currentColor"/>
                                </svg>
                            </div>
                            <div class="contact__info--content">
                                <p class="contact__info--content__desc text-white">
                                    <a href="mailto:{{ $contact->insurance }}">{{ $contact->insurance }}</a>
                                    <br> <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="contact__info--items" style="display: none">
                        <h3 class="contact__info--content__title text-white mb-15">Địa chỉ</h3>
                        <div class="contact__info--items__inner d-flex">
                            <div class="contact__info--icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="31.57" height="31.13"
                                     viewBox="0 0 31.57 31.13">
                                    <path id="ic_account_balance_24px"
                                          d="M5.323,14.341V24.718h4.985V14.341Zm9.969,0V24.718h4.985V14.341ZM2,32.13H33.57V27.683H2ZM25.262,14.341V24.718h4.985V14.341ZM17.785,1,2,8.412v2.965H33.57V8.412Z"
                                          transform="translate(-2 -1)" fill="currentColor"/>
                                </svg>
                            </div>
                            <div class="contact__info--content">
                                <p class="contact__info--content__desc text-white"> {{ $contact->product_consultation ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="contact__info--items">
                        <h3 class="contact__info--content__title text-white mb-15">Follow Us</h3>
                        <ul class="contact__info--social d-flex">
                            <li class="contact__info--social__list">
                                <a class="contact__info--social__icon" target="_blank" href="{{ $contact->technical_assistance ?? '' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="7.667" height="16.524"
                                         viewBox="0 0 7.667 16.524">
                                        <path data-name="Path 237"
                                              d="M967.495,353.678h-2.3v8.253h-3.437v-8.253H960.13V350.77h1.624v-1.888a4.087,4.087,0,0,1,.264-1.492,2.9,2.9,0,0,1,1.039-1.379,3.626,3.626,0,0,1,2.153-.6l2.549.019v2.833h-1.851a.732.732,0,0,0-.472.151.8.8,0,0,0-.246.642v1.719H967.8Z"
                                              transform="translate(-960.13 -345.407)" fill="currentColor"></path>
                                    </svg>
                                    <span class="visually-hidden">Facebook</span>
                                </a>
                            </li>
                            <li class="contact__info--social__list">
                                <a class="contact__info--social__icon" target="_blank" href="{{ $contact->zalo ?? '' }}">
                                    <img src="{{ asset('/frontend/assets/img/Icon_of_Zalo.svg') }}">
                                    <span class="visually-hidden">Zalo</span>
                                </a>
                            </li>
                            <li class="contact__info--social__list">
                                <a class="contact__info--social__icon" target="_blank" href="{{ $contact->free_call_center ?? '' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16.49" height="11.582" viewBox="0 0 16.49 11.582">
                                        <path data-name="Path 321" d="M967.759,1365.592q0,1.377-.019,1.717-.076,1.114-.151,1.622a3.981,3.981,0,0,1-.245.925,1.847,1.847,0,0,1-.453.717,2.171,2.171,0,0,1-1.151.6q-3.585.265-7.641.189-2.377-.038-3.387-.085a11.337,11.337,0,0,1-1.5-.142,2.206,2.206,0,0,1-1.113-.585,2.562,2.562,0,0,1-.528-1.037,3.523,3.523,0,0,1-.141-.585c-.032-.2-.06-.5-.085-.906a38.894,38.894,0,0,1,0-4.867l.113-.925a4.382,4.382,0,0,1,.208-.906,2.069,2.069,0,0,1,.491-.755,2.409,2.409,0,0,1,1.113-.566,19.2,19.2,0,0,1,2.292-.151q1.82-.056,3.953-.056t3.952.066q1.821.067,2.311.142a2.3,2.3,0,0,1,.726.283,1.865,1.865,0,0,1,.557.49,3.425,3.425,0,0,1,.434,1.019,5.72,5.72,0,0,1,.189,1.075q0,.095.057,1C967.752,1364.1,967.759,1364.677,967.759,1365.592Zm-7.6.925q1.49-.754,2.113-1.094l-4.434-2.339v4.66Q958.609,1367.311,960.156,1366.517Z" transform="translate(-951.269 -1359.8)" fill="currentColor"></path>
                                    </svg>
                                    <span class="visually-hidden">Twitter</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End contact section -->


</x-layout.frontend>

