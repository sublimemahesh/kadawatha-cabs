$(document).ready(function () {
    $("#createCustomer").click(function (e) {
        e.preventDefault();
        var nic = $('#nic').val();

        $.ajax({
            url: "js/ajax/check-customer-nic.php",
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
                        text: "This Customer Already Exists in The System.",
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });



                } else {
             

                    $("#newCustomer").submit();

                }
            }

        });

//        e.preventDefault();

    });

});

  