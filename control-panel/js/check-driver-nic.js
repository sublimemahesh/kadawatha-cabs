$(document).ready(function () {
    $("#createDriver").click(function (e) {
        e.preventDefault();
        var nic = $('#nic').val();

        $.ajax({
            url: "js/ajax/check-nic.php",
            type: "POST",
            dataType: "JSON",
            data: {
                nic: nic,
                option: 'CHECKNIC'
            },

            success: function (result) {

                if (result) {
                    swal({
                        title: "Error!",
                        text: "This NIC number already exists in the system.",
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });

                } else {
                    $("#formCreateDriver").submit();

                }
            }

        });

//        e.preventDefault();

    });

});

  