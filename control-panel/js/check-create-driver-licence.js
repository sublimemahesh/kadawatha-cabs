$(document).ready(function () {
    $("#createDriver").click(function (e) {
        e.preventDefault();
        var licenceNum = $('#licenceNum').val();
           $.ajax({
            url: "js/ajax/check-create-driver-licence.php",
            type: "POST",
            dataType: "JSON",
            data: {
                licenceNum: licenceNum,
                option: 'CHECKLICENCE'
            },

            success: function (result) {

                if (result) {

                    swal({
                        title: "Error!",
                        text: "This Licence Already Exists In The System.",
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

  