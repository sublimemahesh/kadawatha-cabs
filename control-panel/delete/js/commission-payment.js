$(document).ready(function () {
    $('.delete-payment').click(function () {

        var id = $(this).attr("data-id");

        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this Payment!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "delete/ajax/commission-payment.php",
                type: "POST",
                data: {id: id, option: 'delete'},
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status) {
                        swal({
                            title: "Deleted!",
                            text: "Payment has been deleted.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        $('#row_' + id).remove();

                    }
                }
            });
        });
    });
});