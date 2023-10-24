$( document ).ready(function() {


    $(document).on('change','select#provinceid',function(){
        let city_id = $(this).val();
        changeProvince(city_id);
    });

    $(document).on('click','button#searchShowRoom',function(){
        let provinceid = $('#provinceid').val();
        let districtid = $('#districtid').val();
        changeShowRoom(districtid,provinceid);
    });



});

function changeProvince(city_id) {
    let token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "POST",
        url:baseUrl + '/location/changeDistrict',
        data:{'_token':token,city_id:city_id},
        dataType: "json",
        success: function(dataJson) {
            console.log(dataJson.data.jsonHTML);
            $('#districtid').html(dataJson.data.jsonHTML);
        }
    });
}

function changeShowRoom(district_id,province_id) {
    let token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "POST",
        url:baseUrl + '/location/changeShowRoom',
        data:{'_token':token,district_id:district_id,province_id:province_id},
        dataType: "json",
        success: function(dataJson) {
            $('#numberShowRoom').html(dataJson.data.totalShowRoom);
            $('#listShowRoom').html(dataJson.data.dataHtml);
        }
    });
}
