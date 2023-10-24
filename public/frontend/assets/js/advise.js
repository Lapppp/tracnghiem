$( document ).ready(function() {

    $(document).on('click','button#sendAdvises',function()
    {
        let full_name = $('#full_name').val();
        let phone = $('#phone').val();
        let description = $('#description').val();
        var phone_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;

        if(full_name.trim().length <= 0) {
            swal("Vui lòng nhập họ tên");
            $('#full_name').focus();
            return false;
        }else if(phone.trim().length <= 0){
            swal("Vui lòng  họ số điện thoại");
            $('#phone').focus();
            return false;
        }else if (phone_regex.test(phone) == false ){
            swal("Số điện thoại của bạn không hợp lệ");
            $('#phone').focus();
            return false;
        }else if (description.trim().length <= 0){
            swal("Vui lòng nhập nội dung thắc mắc của bạn");
            $('#description').focus();
            return false;
        }else {

            let token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: "POST",
                url:baseUrl + '/location/sendAdvise',
                data:{'_token':token,full_name:full_name,phone:phone,description:description},
                dataType: "json",
                success: function(dataJson) {
                    $('#phone').val('')
                    $('#full_name').val('')
                    $('#description').val('')
                    swal("Cảm ơn thắc mắc của bạn. Chúng tôi sẽ gọi lại tư vấn ngay", "", "success");
                }
            });

        }

    });
});
