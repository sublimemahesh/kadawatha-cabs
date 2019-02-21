$(document).ready(function () {
    $("#createVehicle").click(function (e) {
        e.preventDefault();
        var vehicle_number = $('#vehicle-no').val();
        $.ajax({
            url: "js/ajax/check-vehicle-no.php",
            type: "POST",
            dataType: "JSON",
            data: {
                vehicle_number: vehicle_number,
                option: 'CHECKVEHICLENO'
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


                    $("#newVehicle").submit();

                }
            }

        });

//        e.preventDefault();

    });

});

  