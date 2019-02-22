$(document).ready(function () {

    $("#editCustomer").click(function (e) {

        e.preventDefault();
        var id = $('#id').val();
        var nic = $('#nic').val();

        $.ajax({
            url: "js/ajax/check-edit-customer-nic.php",
            type: "POST",
            dataType: "JSON",
            data: {
                id: id,
                nic: nic,
                option: 'CHECKVEHICLENO'
            },

            success: function (result) {

                if (result) {
                    swal({
                        title: "Error!",
                        text: "This Customer Already Exists in The System.",
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });

                } else {
                    $("#updateCustomer").submit();

                }
            }

        });

//        e.preventDefault();

    });

});

  