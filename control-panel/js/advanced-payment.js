$(document).ready(function () {
//    $('.do-payment').click(function () {
        $('#booking tbody').on('click', '.do-payment', function () {
        $('#paid_amount').val('');
        $('#due_amount').val('');
        $('#total_amount').val('');

        var id = $(this).attr("data-id");
        var total = $(this).attr("total-cost");
        $('#payment-btn').attr("booking", id);
        $('#total_amount').val(total);

        $.ajax({
            url: "js/ajax/advanced-payment.php",
            type: "POST",
            dataType: "JSON",
            data: {
                booking: id,
                option: 'GETDUEAMOUNT'
            },

            success: function (amount) {

                if (amount) {
                    $('#paid_amount').val(amount);
                    var due = total - amount;
                    $('#due_amount').val(due);
                } else {
                    $('#paid_amount').val(0);
                    $('#due_amount').val(total);
                }
            }

        });
    })
    $('#payment-btn').click(function () {
        if (!$('#receipt_no').val() || $('#receipt_no').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the receipt number.",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#receipt_date').val() || $('#receipt_date').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the receipt date.",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#payment').val() || $('#payment').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the amount.",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#received_by').val() || $('#received_by').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the name who received the paymnet",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else {
            var receipt_no = $('#receipt_no').val();
            var receipt_date = $('#receipt_date').val();
            var paid_amount = $('#payment').val();
            var received_by = $('#received_by').val();
            var booking = $('#payment-btn').attr("booking");

//            document.getElementById("#fullname").value = $('#name').val();

            $.ajax({
                url: "js/ajax/advanced-payment.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    receipt_no: receipt_no,
                    receipt_date: receipt_date,
                    paid_amount: paid_amount,
                    received_by: received_by,
                    booking: booking,
                    option: 'ADDADVANCEDPAYMENT'
                },

                success: function (result) {

                    if (result) {

                        swal({
                            title: "Booking Confirmed!",
                            text: "Your booking confirmed successfully.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        $('#payment-modal').modal('hide');
                        $('#row_' + booking).remove();
                    }
                }

            });
        }
    });
});


