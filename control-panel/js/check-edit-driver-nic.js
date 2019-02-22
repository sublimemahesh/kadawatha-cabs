$(document).ready(function () {

    $("#editDriver").click(function (e) {

        e.preventDefault();
        var id = $('#id').val();
        var nic = $('#nic').val();
        var licenceNum = $('#licenceNum').val();

        $.ajax({
            url: "js/ajax/check-licence.php",
            type: "POST",
            dataType: "JSON",
            data: {
                id: id,
                licenceNum: licenceNum,
                option: 'CHECKLICENCEFOREDIT'
            },

            success: function (result) {

                if (result) {

                    swal({
                        title: "Error!",
                        text: "This licence number already exists in the system.",
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });

                } else {
                    
                    $.ajax({
                        url: "js/ajax/check-nic.php",
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            id: id,
                            nic: nic,
                            option: 'CHECKNICFOREDIT'
                        },

                        success: function (res) {
                            if (res) {

                                swal({
                                    title: "Error!",
                                    text: "This NIC number already exists in the system.",
                                    type: 'error',
                                    timer: 2000,
                                    showConfirmButton: false
                                });

                            } else {
                                $("#updateDriverDetails").submit();
                            }
                        }

                    });
                }
            }

        });



    });

});

  