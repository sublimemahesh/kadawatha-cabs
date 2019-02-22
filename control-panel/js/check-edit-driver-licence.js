$(document).ready(function () {

    $("#editDriver").click(function (e) {

        e.preventDefault();
        var id = $('#id').val();
        var licenceNum = $('#licenceNum').val();

        $.ajax({
            url: "js/ajax/check-edit-driver-licence.php",
            type: "POST",
            dataType: "JSON",
            data: {
                id: id,
                licenceNum: licenceNum,
                option: 'CHECKLICENCE'
            },

            success: function (result) {

                if (result) {
                    swal({
                        title: "Error!",
                        text: "This Vehicle Already Exists in The System.",
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });

                } else {
                    $("#updateDriverDetails").submit();

                }
            }

        });

//        e.preventDefault();

    });

});

  