<script type="text/javascript">
    $(document).ready(function() {

        $(document).on('click','.deleteImageAction',function(event)
        {
            event.preventDefault();
            Swal.fire({
                title: 'Bạn có chắc là muốn xóa không?',
                showDenyButton: true,
                confirmButtonText: 'Đồng ý',
                denyButtonText: `Không`,
                customClass: {
                    confirmButton: "btn btn-primary btn-sm",
                    denyButton: "btn btn-danger btn-sm"
                }
            }).then((result) => {
                if (result.isConfirmed)
                {
                    var id = $(this).data("id");
                    let token = $("meta[name='csrf-token']").attr("content");
                    $.ajax(
                        {
                            url: baseUrl+"/images/destroy/"+id,
                            type: 'DELETE',
                            data: {
                                "id": id,
                                "_token": token,
                            },
                            success: function (json) {
                                if(json.status == 'success'){

                                    let timerInterval;
                                    Swal.fire({
                                        title: 'Vui lòng đợi...',
                                        html: '',
                                        timer: 1000,
                                        timerProgressBar: true,
                                        didOpen: () => {
                                            Swal.showLoading()
                                            timerInterval = setInterval(() => {
                                            }, 100)
                                        },
                                        willClose: () => {
                                            clearInterval(timerInterval)
                                        }
                                    }).then((result) => {
                                        if (result.dismiss === Swal.DismissReason.timer) {
                                            $('#deleteImage_'+id).hide();
                                        }
                                    })

                                }else {
                                    Swal.fire(json.message, '', 'danger')
                                }
                            }
                        });

                    //Swal.fire('Saved!', '', 'success')
                }
            })
        });

    });
</script>
