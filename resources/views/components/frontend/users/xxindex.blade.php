<x-layout.frontend>

    <!-- breadcrum -->
    <section id="breadcrum">
        <div class="ctn">
            <h1>Thông tin cá nhân</h1>
            <div class="bread">
                <ul>
                    <li>
                        <a href="{{ Route('frontend.home.index') }}">Trang chủ</a>
                    </li>
                    <li><a href="{{ Route('frontend.users.index') }}">Thông tin cá nhân</a></li>

                </ul>
            </div>
        </div>
    </section>
    <!-- end breadcrum -->

    <!-- page quản lý thông tin cá nhân -->

    <section class="ctn page-ttcn">
        <div>
            <div class="cmd5">
                @if($user->default() && $user->default()['url'])
                    <img src="{{ str_replace(Str::of($user->default()['url'])->basename(),Str::of($user->default()['url'])->basename(),asset('storage/avatar/'.$user->default()['url'])) }}" alt="{{ $user->name ?? '' }}">
                @else
                    <img src="https://mychi.com.vn/wp-content/uploads/2022/07/3fcbccae5fe89fb6c6f9.jpg" alt="">
                @endif
                <a href="{{ Route('frontend.users.orders') }}" class="link-qldh">Quản lý đơn hàng</a>
            </div>
            <div class="cmd7">
                <div class="right-ttcn">
                    <ul>
                        <li>» <span>Họ & tên: </span>{{ $user->name ?? $user->username  }}</li>
                        <li>» <span>Số điện thoại: </span>{{ $user->phone ?? '' }}</li>
                        <li>» <span>Email: </span>{{ $user->email ?? ''}}</li>
                        <li>» <span>Địa chỉ: </span>{{ $user->address ?? '' }}</li>
                    </ul>
                </div>
                <span class="btn-ttcn" id="changeInfo">Thay đổi thông tin</span>
            </div>
        </div>
    </section>
    <div id="pop-ud1">
        <div class="model1">
            <span class="close-ud"></span>
            <h3>Thay đổi thông tin cá nhân</h3>
            <form action="{{ Route('frontend.users.update') }}" class="frm-ttcn" method="post" enctype="multipart/form-data" id="UpdateInfo">
                <div style="color:yellow;display: none" id="showError"></div>
                @csrf
                <input type="text" name="name" id="name" placeholder="Họ và tên" value="{{ $user->name ?? '' }}">
                <input type="text" id="phone" name="phone" placeholder="Số điện thoại" value="{{ $user->phone ?? '' }}">
                <input type="text" id="email" name="email" placeholder="Email" value="{{ $user->email ?? '' }}">
                <input type="text" placeholder="Địa chỉ" id="address" name="address" value="{{ $user->address ?? '' }}">
                <input type="file"  id="voteImage" name="voteImage" accept="image/*">
                <button type="submit" class="btn-updatecn">Cập nhật</button>
            </form>
        </div>
    </div>
    <!-- end page quản lý đơn hàng -->


    <section class="ctn a5">
        @if($bannerPositionTwo)
            @if($bannerPositionTwo->default() && $bannerPositionTwo->default()['url'])
                <img src="{{ str_replace(Str::of($bannerPositionTwo->default()['url'])->basename(),Str::of($bannerPositionTwo->default()['url'])->basename(),asset('storage/banner/'.$bannerPositionTwo->default()['url'])) }}" alt="{{ $bannerPositionTwo->name ?? '' }}" class="banner-pc">
                <img src="{{ str_replace(Str::of($bannerPositionTwo->default()['url'])->basename(),Str::of($bannerPositionTwo->default()['url'])->basename(),asset('storage/banner/'.$bannerPositionTwo->default()['url'])) }}" alt="{{ $bannerPositionTwo->name ?? '' }}" class="banner-mobile">
            @endif
        @else
            <img src="{{ asset('/frontend/assets') }}/a/i/banner1.jpg')}}" alt="banner" class="banner-pc">
            <img src="{{ asset('/frontend/assets') }}/a/i/banner1-mb.jpg')}}" alt="banner" class="banner-mobile">
        @endif
    </section>
    <div class="space"></div>


    <x-slot name="javascript">
        <script type="text/javascript">
            $( document ).ready(function() {


                $(document).on('click', '#changeInfo',function (event) {
                    event.preventDefault();
                    $('#pop-ud1').show();

                });

                $(document).on('click', '.close-ud',function (event) {
                    $('#pop-ud1').hide();
                });


                $( "#UpdateInfo" ).submit(function( event ) {
                    event.preventDefault();

                    let  name = $('#name').val();
                    let  phone = $('#phone').val();
                    let  email = $('#email').val();
                    let  address = $('#address').val();
                    if(name.trim().length <= 0) {
                        $('#showError').show()
                        $('#name').focus();
                        $('#showError').html('Vui lòng nhập họ tên');
                        return false;
                    }else if(phone.trim().length <= 0) {
                        $('#showError').show()
                        $('#phone').focus();
                        $('#showError').html('Vui lòng nhập điện thoại');
                        return false;
                    }else if(email.trim().length <= 0) {
                        $('#showError').show()
                        $('#email').focus();
                        $('#showError').html('Vui lòng nhập Email');
                        return false;
                    }else if(address.trim().length <= 0) {
                        $('#showError').show()
                        $('#address').focus();
                        $('#showError').html('Vui lòng nhập địa chỉ');
                        return false;
                    }else {

                        $.ajax({
                            url: "{{ Route('frontend.users.update') }}",
                            type: "POST",
                            data: new FormData(this),
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function (jsonResult) {
                                if(jsonResult.status =='success') {
                                    window.location.reload();
                                }else {
                                    $('#showError').show()
                                    $('#showError').html(jsonResult.message);
                                    return false;
                                }
                            }
                        });
                        return false;
                    }

                });




            });
        </script>
    </x-slot>
</x-layout.frontend>
