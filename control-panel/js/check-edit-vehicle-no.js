$(document).ready(function () {

    $("#editVehicle").click(function (e) {
        e.preventDefault();
        var id = $('#id').val();
        var vehicle_number = $('#vehicle-no').val();

        $.ajax({
            url: "js/ajax/check-edit-vehicle-no.php",
            type: "POST",
            dataType: "JSON",
            data: {
                id: id,
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


                    $("#updateVehicle").submit();

                }
            }

        });

//        e.preventDefault();

    });

});

  