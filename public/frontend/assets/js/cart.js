$( document ).ready(function() {

    $(document).on( "click",'a.AddCart', function(event) {
        event.preventDefault();
        let product_id = $(this).data( "id" );
        let qty = $(this).data( "qlt" );
        addCart(product_id,qty);
    })

    $(document).on( "click",'a.buy-now', function(event) {
        event.preventDefault();
        let product_id = $(this).data( "id" );
        let qty = 1;
        addCartPayNow(product_id,qty);
    })



    $(document).on( "click",'a.add-to-cart', function(event) {
        event.preventDefault();
        let product_id = $(this).data( "id" );
        let qty = $('#qlt_'+product_id).val();
        let timeH = $('input[name="time-select"]:checked').val();
        let requestH = $('input[name="fooby"]:checked').val();
        let timeK = timeH != undefined ? timeH : 0;
        let requestK = requestH != undefined ? requestH : 0;
        addCart(product_id,qty,timeK,requestK);
    })

    $(document).on( "click",'a.add-to-cart-two', function(event) {
        event.preventDefault();
        let product_id = $(this).data( "id" );
        let qty = $('#qlt_two_'+product_id).val();
        let timeK =  0;
        let requestK =0;
        addCart(product_id,qty,timeK,requestK);
    })

    $(document).on( "click",'.btn-delete-product', function(event) {
        let id = $(this).data( "id" );
        deleteCart(id);
    });

    $(document).on('click', '.downCart',function (event) {
        let id = $(this).data( "id" );
        let price = $(this).data( "price" );
        let qty = $('#cartQlt_'+id).val();
        if(parseInt(qty) > 1) {
            let qtyNew = parseInt(qty) - 1;
            $('#cartQlt_'+id).val(qtyNew);
            updateCart(id,qtyNew,price);
        }else {
            deleteCart(id);
        }

    })


    $(document).on('click', '.upCart',function (event) {
        let id = $(this).data( "id" );
        let qty = $('#cartQlt_'+id).val();
        let price = $(this).data( "price" );
        let qtyNew = parseInt(qty) + 1;
        $('#cartQlt_'+id).val(qtyNew);
        updateCart(id,qtyNew,price);
    })




    $(document).on('click', '.SubCartPage',function (event) {
        let id = $(this).data( "id" );
        let price = $(this).data( "price" );
        let qty = $('#qty_'+id).val();
        if(parseInt(qty) > 1) {
            let qtyNew = parseInt(qty) - 1;
            $('#qty_'+id).val(qtyNew);
            updateCart(id,qtyNew,price);
        }else {
            deleteCart(id);
        }

    })


    $(document).on('click', '.AddCartPage',function (event) {
        let id = $(this).data( "id" );
        let qty = $('#qty_'+id).val();
        let price = $(this).data( "price" );
        let qtyNew = parseInt(qty) + 1;
        $('#qty_'+id).val(qtyNew);
        updateCart(id,qtyNew,price);
    })

    $(document).on('click', '.ic-cart',function (event) {
        loadCart();
    })



    $(document).on('click','#searchbtnHome',function (event) {
        event.preventDefault();
        let search = $('#searchHome').val();
        window.location.href = baseUrl+'/products?search='+search
    })


    $(document).on('keypress','#searchHome',function (event) {
        if(event.which === 13) {
            event.preventDefault();
            let search = $('#searchHome').val();
            window.location.href = baseUrl+'/products?search='+search
        }
    })


});


function  loadCart() {
    let token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "POST",
        url:baseUrl + '/cart/load',
        dataType: "json",
        data:{'_token':token},
        success:function(dataJson) {
           $('#dropdownShopCart').html(dataJson.data.dataHtml);
        }
    });
}

function  addCart(product_id,qty,time= 0,request = 0) {
    let token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "POST",
        url:baseUrl + '/cart/addCart',
        dataType: "json",
        data:{product_id:product_id,qty:qty,'_token':token,time:time,customer_request:request},
        success:function(dataJson) {
            console.log(dataJson)
            $('#numberCartIcon').html(dataJson.data.total);
            $('#numberCartChoose').html(dataJson.data.total);
            swal("Đã thêm vào giỏ hàng");

        }
    });
}

function  addCartPayNow(product_id,qty,time= 0,request = 0) {
    let token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "POST",
        url:baseUrl + '/cart/addCart',
        dataType: "json",
        data:{product_id:product_id,qty:qty,'_token':token,time:time,customer_request:request},
        success:function(dataJson) {
            window.location.href = baseUrl+'/cart';
        }
    });
}

function  updateCart(id,qty,price) {
    let token = $('meta[name="csrf-token"]').attr('content');
    let priceNew = price.toLocaleString('vi', {style : 'currency', currency : 'VND'});
    let Total = qty * price;
    let subSubTotal = new Intl.NumberFormat('vi-VN').format(Total)
    $('#subTotalPage_'+id).html(subSubTotal);
    $.ajax({
        type: "POST",
        url:baseUrl + '/cart/update/'+id,
        dataType: "json",
        data:{id:id,qty:qty,'_token':token},
        success:function(dataJson) {
            $('#numberCartIcon').html(dataJson.data.total);
            $('#numberCartChoose').html(dataJson.data.total);
            $('#ThanhTien').html(dataJson.data.totalMoney);
            $('#ThanhTien_All').html(dataJson.data.totalMoney);
        }
    });
}

function  deleteCart(id) {
    let token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "POST",
        url:baseUrl + '/cart/destroy',
        dataType: "json",
        data:{id:id,'_token':token},
        success:function(dataJson) {
            $('#numberCartIcon').html(dataJson.data.total);
            $('#numberCartChoose').html(dataJson.data.total);
            $('#cart_row_'+id).hide();
            $('#cart_row_page'+id).hide();
            $('#ThanhTien').html(dataJson.data.total);
            $('#ThanhTien_All').html(dataJson.data.total);
            if(dataJson.data.total == 0) {
                window.location.reload();
            }

        }
    });
}



