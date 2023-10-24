$( document ).ready(function() {

    $(document).on('change','#color,#price,#sort_id',function (event) {
        let color = $('#color').val();
        let price = $('#price').val();
        let sort_id = $('#sort_id').val();
        window.location.href = baseUrl+'/products?color='+color+'&price='+price+'&sort_id='+sort_id
    })


});
