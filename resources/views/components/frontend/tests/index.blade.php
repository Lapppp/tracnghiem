<x-layout.frontend>

    <!-- Start breadcrumb section -->
    <section class="breadcrumb__section breadcrumb__bg" style="@include('components.frontend.shared.banner.bg_banner')">
        <div class="container">
            <div class="row row-cols-1">
                <div class="col">
                    <div class="breadcrumb__content text-center">
                        <h1 class="breadcrumb__content--title text-white mb-25">Danh mục kiến thúc chung</h1>
                        <ul class="breadcrumb__content--menu d-flex justify-content-center">
                            <li class="breadcrumb__content--menu__items"><a class="text-white" href="{{ Route('frontend.home.index') }}">Trang chủ</a></li>
                            <li class="breadcrumb__content--menu__items"><span class="text-white">Danh mục kiến thúc chung</span></li>
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
                    <div class="shop__product--wrapper">
                        <div class="tab_content">
                            <div id="product_grid" class="tab_pane active show">
                                <div class="product__section--inner product__grid--inner">
                                    <div class="row row-cols-lg-4 row-cols-md-3 row-cols-2 mb--n30">
                                        @include('components.frontend.tests.showindex',['tests' => $tests])
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pagination__area bg__gray--color">
                            <nav class="pagination justify-content-center">
                                @if(!empty($pager))
                                    {!! $pager !!}
                                @endif
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End shop section -->


</x-layout.frontend>
