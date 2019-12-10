$(document).ready(function () {

    $("#editCustomer").click(function (e) {

        e.preventDefault();
        var id = $('#id').val();
        var nic = $('#nic').val();
        var phoneNumber = $('#mobile_number').val();
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        if (!$('#email').val() || $('#email').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter an email address.",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else if (!re.test($('#email').val())) {
            swal({
                title: "Error!",
                text: "Please enter a valid email address.",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else {
            $.ajax({
                url: "js/ajax/check-edit-customer-nic.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    id: id,
                    nic: nic,
                    option: 'CHECKNIC'
                },
                success: function (result) {

                    if (result) {
                        swal({
                            title: "Error!",
                            text: "This NIC already exist in the system.",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        $.ajax({
                            url: "js/ajax/check-edit-customer-nic.php",
                            type: "POST",
                            dataType: "JSON",
                            data: {
                                id: id,
                                phoneNumber: phoneNumber,
                                option: 'CHECKPHONENUMBER'
                            },
                            success: function (result) {

                                if (result) {

                                    swal({
                                        title: "Error!",
                                        text: "This mobile number already exist in the system.",
                                        type: 'error',
                                        timer: 2000,
                                        showConfirmButton: false
                                    });
                                } else {
                                    $("#updateCustomer").submit();
                                }
                            }
                        });
                    }
                }
            });
        }
    });
});


