$( document ).ready(function() {

    $(document).on('click', '#SignIn',function (event) {

        event.preventDefault();
        let emailLogin = $('#emailLogin').val();
        let passwordLogin = $('#passwordLogin').val();

        if(emailLogin.trim().length <=0) {
            $('#emailLogin').attr('placeholder','Vui lòng nhập email');
            $('#emailLogin').focus();
            return false;
        }else if(passwordLogin.trim().length <=0) {
            $('#passwordLogin').attr('placeholder','Vui lòng nhập mật khẩu');
            $('#passwordLogin').focus();
            return false;
        }else {
            let token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: 'POST',
                url: baseUrl+'/login.html',
                dataType: "json",
                data: {'email':emailLogin,'password':passwordLogin,'_token':token},
                success: function(dataJson) {
                    console.log(dataJson);
                }

            });
            return false;
        }

    })

})
