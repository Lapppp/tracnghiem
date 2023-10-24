$( document ).ready(function() {

    function validateEmail(email) {
        return email.match(
            /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
    };

    $(document).on('click', 'button#HomeLogin',function(event) {
        event.preventDefault();
        let emailLogin = $('#emailLogin').val();
        let passwordLogin = $('#passwordLogin').val();

        if(emailLogin.trim().length <= 0) {
            $('#emailLogin').focus();
            $('#showErrorLogin').show();
            $('#showErrorLogin').html('Vui lòng nhập email');
            $('#emailLogin').attr('placeholder','Vui lòng nhập email');
            return false;
        }else if(passwordLogin.trim().length <= 0) {
            $('#passwordLogin').focus();
            $('#passwordLogin').attr('placeholder','Vui lòng nhập mật khẩu');
            $('#showErrorLogin').show();
            $('#showErrorLogin').html('Vui lòng nhập mật khẩu');
            return false;
        }else {
            $('#showErrorLogin').hide();
            let token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: "POST",
                url:baseUrl + '/login.html',
                dataType: "json",
                data:{email:emailLogin,password:passwordLogin,'_token':token},
                success:function(dataJson) {
                    if(dataJson.status == 'success') {
                        window.location.reload();
                    }else {
                        $('#showErrorLogin').show();
                        $('#showErrorLogin').html(dataJson.message);
                    }
                }
            });
            return  false;

        }

    });

    $(document).on('click', '#registerLogin', function(event){
        let username = $('#rusername').val();
        let email = $('#remail').val();
        let phone = $('#rphone').val();
        let password = $('#rpassword').val();
        let repassword = $('#rrpassword').val();
        let agree = $('#agree').val();
        var phone_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
        //if (phone_regex.test(mobile) == false)
        if(username.trim().length <= 0) {
            $('#showErrorRegister').show();
            $('#showErrorRegister').html('Vui lòng nhập tên đăng nhập');
            $('#rusername').focus();
            return false;
        }else if(email.trim().length <= 0) {
            $('#showErrorRegister').show();
            $('#showErrorRegister').html('Vui lòng nhập Email');
            $('#remail').focus();
        }else if(!validateEmail(email)) {
            $('#showErrorRegister').show();
            $('#showErrorRegister').html('Email không hợp lệ');
            $('#remail').focus();
        }else if(phone.trim().length <= 0) {
            $('#showErrorRegister').show();
            $('#showErrorRegister').html('Vui lòng nhập số điện thoại');
            $('#rphone').focus();
        }else if (phone_regex.test(phone) == false) {
            $('#showErrorRegister').show();
            $('#showErrorRegister').html('Số điện thoại không hợp lệ');
            $('#rphone').focus();
        }else if (password.trim().length <= 0) {
            $('#showErrorRegister').show();
            $('#showErrorRegister').html('Vui lòng nhập mật khẩu');
            $('#rpassword').focus();
        }else if (repassword.trim().length <= 0) {
            $('#showErrorRegister').show();
            $('#showErrorRegister').html('Vui lòng nhập lại mật khẩu');
            $('#rrpassword').focus();
        }else if (password != repassword) {
            $('#showErrorRegister').show();
            $('#showErrorRegister').html('Mật khẩu và nhập lại mật khẩu không giống nhau');
            $('#rrpassword').focus();
        }else {

            let token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: "POST",
                url:baseUrl + '/store',
                dataType: "json",
                data:{
                    email:email,
                    password:password,
                    phone:phone,
                    '_token':token,
                    username:username
                },
                success:function(dataJson) {
                    if(dataJson.status == 'success') {
                        window.location.reload();
                    }else {
                        $('#showErrorRegister').show();
                        $('#showErrorRegister').html(dataJson.message);
                        return false;
                    }
                }
            });

        }


    });


    $(document).on('click', '#showFormRegister', function(event){
        event.preventDefault();

        $('#pop-register').show(10);
        $('.model').addClass('active-regis');

        $('#pop-login').hide();
        $('.model-login').removeClass('active-login');
    })


    $(document).on('click', '#showFormSignIn', function(event){
        event.preventDefault();

        $('#pop-login').show(10);
        $('.model-login').addClass('active-login');

        $('#pop-register').hide();
        $('.model').removeClass('active-regis');
    })

    $(document).on('click', '#sendPassword', function(event){
        let email = $('#email').val();
        if(email.trim().length <= 0) {
            swal("Vui lòng nhập email");
            return false;
        }else if(!validateEmail(email)) {
            swal("Email không hợp lệ");
            return false;
        }else {
            let token = $('meta[name="csrf-token"]').attr('content');
            $('#loadingSendPassword').show();
            $.ajax({
                type: 'POST',
                url: baseUrl+'/storeForgotPassword',
                dataType: 'json',
                data: {email: email,'_token':token},
                success: function(dataJson) {
                    $('#loadingSendPassword').hide();
                   if(dataJson.status == 'success') {
                       swal("Đã gởi email tới mail "+email+". Vui lòng đăng nhập để đổi lại mật khẩu");
                       setTimeout(() => {
                           window.location.href = baseUrl;
                       }, 2000)

                   }else {
                       swal(dataJson.message);
                       return false;
                   }
                }
            });

        }
    });

    $(document).on('click', 'a#reLogin',function (event) {
        event.preventDefault();
        $('#pop-login').show(10);
        $('.model-login').addClass('active-login');
    })

    $(document).on('click', 'button#updatePassword',function (event) {
        let password = $('#password').val();
        let rePassword = $('#rePassword').val();
        let user_id = $('#user_id').val();
        let key_id = $('#key_id').val();
        if(password.trim().length <= 0) {
            swal('Vui lòng nhập mật khẩu mới');
            return false;
        }else if(rePassword.trim().length <= 0) {
            swal('Vui lòng nhập lại mật khẩu mới');
            return false;
        }else if(password != rePassword) {
            swal('Mật khẩu mới phải trùng với nhập lại mật khẩu');
            return false;
        }else {
            let token = $('meta[name="csrf-token"]').attr('content');
            $('#loadingSendPassword').show();
            $.ajax({
                type: 'POST',
                url: baseUrl+'/storeResetPassword',
                dataType: 'json',
                data: {password: password,'_token':token,user_id:user_id,key_id:key_id},
                success: function(dataJson) {
                    $('#loadingSendPassword').hide();
                    if(dataJson.status == 'success') {
                        swal("Đã cập nhật mật khẩu thành công");
                        setTimeout(() => {
                            window.location.href = baseUrl;
                        }, 2000)

                    }else {
                        swal(dataJson.message);
                        return false;
                    }
                }
            });
        }
    });






});
