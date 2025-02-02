<x-layout.frontend>

    <!-- Start breadcrumb section -->
    <section class="breadcrumb__section breadcrumb__bg" style="@include('components.frontend.shared.banner.bg_banner')">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="breadcrumb__content text-center">
                        <h1 class="breadcrumb__content--title text-white mb-25">Liên hệ với admin</h1>
                        <ul class="breadcrumb__content--menu d-flex justify-content-center">
                            <li class="breadcrumb__content--menu__items"><a class="text-white" href="{{ Route('frontend.home.index') }}">Trang chủ</a></li>
                            <li class="breadcrumb__content--menu__items"><span class="text-white">Kích hoạt tài khoản</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End breadcrumb section -->

    <!-- Start shop section -->
    <section class="shop__section section--padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-warning" role="alert">
                       Tài khoản chưa Active, Vui lòng chờ admin xem xét và kích hoạt tài khoản
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End shop section -->


</x-layout.frontend>
