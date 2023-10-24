$( document ).ready(function() {

    $(document).on('click','button#SearchHomeClick',function()
    {
        let category_id = $('#category_id').val();
        let search = $('#search').val();
        window.location.href = baseUrl+'/'+category_id+'?search='+search

    });

    $(document).on('keypress', '#search',function (e) {
        e.preventDefault();
        if(e.which === 13){
            let category_id = $('#category_id').val();
            let search = $('#search').val();
            window.location.href = baseUrl+'/'+category_id+'?search='+search
        }
    });


});
