$(document).ready(function () {
    $("#driver").change(function () {
        var id = $("#driver").val();
        $.ajax({
            url: "js/ajax/commission-payments.php",
            type: "POST",
            dataType: "JSON",
            data: {
                id: id,
                option: 'GETCOMMISSIONUNPAIDBOOKINGS'
            },
            success: function (bookings) {
                var html = "";
                if (bookings) {
                    html += '<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 col-md-offset-2">';
                    html += '<table border="0" width="70%">';
                    html += '<tr><th></th><th>Booking ID</th><th>Total Cost</th><th>Commission</th></tr>';
                    $.each(bookings, function (key, booking) {
                        html += '<tr><td><input type="checkbox" id="payable-bookings" class=""  name="payable-bookings[]" amount="' + booking.commission + '" value="' + booking.id + '"></td><td>#' + booking.id + ' </td><td> Rs. ' + parseFloat(booking.total) + '/= </td><td> Rs. ' + parseFloat(booking.commission) + '/= </td></tr>';
                    });
                    html += '</table>';
                    html += '</div>';
                    $(".unpaid-bookings-section").empty();
                    $(".unpaid-bookings-section").append(html);

                }
            }

        });
    });

    $(".unpaid-bookings-section").on("click", "#payable-bookings", function () {
        var total, current_total, commission;
        commission = $(this).attr('amount');
        current_total = $("#payable-commission").attr("amount");
        if ($(this).is(':checked') == true) {
            total = parseFloat(current_total) + parseFloat(commission);
        } else {
            total = parseFloat(current_total) - parseFloat(commission);
        }
        $("#payable-commission").attr("amount", total.toFixed(2));
        $("#payable-commission").val(total.toFixed(2));
    });
});
$(window).load(function () {

    var booking_id = $('#booking').val();
    var driver = $('#driver_id').val();

    if ((booking_id == '' || !booking_id) && (driver == '' || !driver)) {
        return true;
    } else {
        $.ajax({
            url: "js/ajax/commission-payments.php",
            type: "POST",
            dataType: "JSON",
            data: {
                id: driver,
                option: 'GETCOMMISSIONUNPAIDBOOKINGS'
            },
            success: function (bookings) {
                var html = "";
                if (bookings) {
                    html += '<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 col-md-offset-2">';
                    html += '<table border="0" width="70%">';
                    html += '<tr><th></th><th>Booking ID</th><th>Total Cost</th><th>Commission</th></tr>';
                    $.each(bookings, function (key, booking) {
                        if (booking.id == booking_id) {
                            html += '<tr><td><input type="checkbox" id="payable-bookings" class=""  name="payable-bookings[]" amount="' + booking.commission + '" value="' + booking.id + '" checked></td><td>#' + booking.id + ' </td><td> Rs. ' + parseFloat(booking.total) + '/= </td><td> Rs. ' + parseFloat(booking.commission) + '/= </td></tr>';
                            $("#payable-commission").attr("amount", booking.commission.toFixed(2));
                            $("#payable-commission").val(booking.commission.toFixed(2));
                        } else {
                            html += '<tr><td><input type="checkbox" id="payable-bookings" class=""  name="payable-bookings[]" amount="' + booking.commission + '" value="' + booking.id + '"></td><td>#' + booking.id + ' </td><td> Rs. ' + parseFloat(booking.total) + '/= </td><td> Rs. ' + parseFloat(booking.commission) + '/= </td></tr>';
                        }

                    });
                    html += '</table>';
                    html += '</div>';
                    $(".unpaid-bookings-section").empty();
                    $(".unpaid-bookings-section").append(html);

                }
            }

        });
    }

});
