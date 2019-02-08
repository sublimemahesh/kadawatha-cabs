$(document).ready(function () {
    $("#createCustomer").click(function (e) {
//        e.preventDefault();
        if (!$('#fullname').val() || $('#fullname').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please add new customer",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else {
            var fullname = $('#fullname').val();
            var address = $('#address').val();
            var nic = $('#nic').val();
            var mobile_number = $('#mobile_number').val();
            var city = $('#city').val();

            document.getElementById("name").value = $('#fullname').val();

            $.ajax({
                url: "js/ajax/create-customer.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    fullname: fullname,
                    address: address,
                    nic: nic,
                    mobile_number: mobile_number,
                    city: city,
                    option: 'createCus'
                },

                success: function (customer) {

                    if (customer) {

                        swal({
                            title: "Successfully Added!",
                            text: "Customer has been Added.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        $('#exampleModal').hide();
                        $('.modal-backdrop').addClass('modal-backdrop1');
                        $('.modal-backdrop1').removeClass('modal-backdrop');
                        $('.modal-backdrop1').removeClass('fade');
                        $('.modal-backdrop1').removeClass('in');

                        $('.form-line').addClass('form-line focused');
                        $('.form-line focused').removeClass('form-line');

                        $('#name').val(customer.name);
                        $('#name-id').val(customer.id);


                    }
                }

            });
        }
    });


});
