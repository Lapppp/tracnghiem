<x-layout.frontend>
<!-- breadcrum -->
<section id="breadcrum">
    <div class="ctn">
        <h1>Giỏ hàng</h1>
        <div class="bread">
            <ul>
                <li>
                    <a href="{{ Route('frontend.home.index') }}">Trang chủ</a>
                </li>
                <li>Giỏ hàng</li>
            </ul>
        </div>
    </div>
</section>
<!-- end breadcrum -->

<section class="page-cart ctn">
    <!--<table style="width: 100%;">-->
    <!--    <tbody><tr>-->
    <!--        <th colspan="3">Chưa có sản phẩm nào trong giỏ hàng.</th>-->
    <!--    </tr>-->
    <!--    </tbody>-->
    <!--</table>-->
    <div>
        <div class="empty-cart cmd12">
            <h3>Chưa có sản phẩm nào trong giỏ hàng.</h3>
            <a href="{{ Route('frontend.home.index') }}">Về trang chủ</a>
        </div>        
    </div>
</section>

<section class="ctn a5">

    <img src="{{ asset('frontend') }}/assets/a/i/banner2.jpg" alt="banner" class="banner-pc">
    <img src="{{ asset('frontend') }}/assets/a/i/banner2-mb.jpg" alt="banner" class="banner-mobile">
</section>
<div class="space"></div>

    <x-slot name="javascript">
        <script type="text/javascript" src="{{ asset('frontend') }}/assets/js/location.js"></script>
        <script type="text/javascript">
            $( document ).ready(function() {

                $(document).on('keyup paste','#phone',function () {
                    this.value = this.value.replace(/[^0-9]/g, '');
                })

            });
        </script>
    </x-slot>

</x-layout.frontend>
