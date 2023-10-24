$( document ).ready(function() {

    $(document).on( "click",'.AddFavourite', function(event) {
        event.preventDefault();
        let product_id = $(this).data( "id" );
        addFavourite(product_id);
    });

    $(document).on( "click",'.removeFavorite', function(event) {
        event.preventDefault();
        let product_id = $(this).data( "id" );
        removeFavorite(product_id);
    });

    function  addFavourite(product_id) {
        let token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url:baseUrl + '/users/addFavorite',
            dataType: "json",
            data:{product_id:product_id,'_token':token},
            success:function(dataJson) {
                if(dataJson.code == 403) {
                    $('#pop-login').show(10);
                    $('.model-login').addClass('active-login');
                }else {
                    $('#numberCart').html(dataJson.data.total);
                    swal("Đã thêm vào yêu thích của bạn");
                }
            }
        });
    }

    function  removeFavorite(product_id) {
        let token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url:baseUrl + '/users/removeFavorite',
            dataType: "json",
            data:{product_id:product_id,'_token':token},
            success:function(dataJson) {
                $('#removeFavorite_'+product_id).hide();
                $('#numberCart').html(dataJson.data.total);
                swal("Đã xóa thành công");
            }
        });
    }


})
