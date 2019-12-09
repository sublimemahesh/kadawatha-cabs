$(document).ready(function () {
    var from = $("#from").val();
    var to = $("#to").val();
    var driver = $("#driver").val();

//    callLoader();
    $.ajax({
        type: 'POST',
        url: 'js/ajax/commission-report.php',
        dataType: "json",
        data: {
            from: from,
            to: to,
            driver: driver,
            option: 'GETPAYMENTDETAILSBYSTARTANDENDDATE'
        },
        success: function (bookings) {
            var html = '';
            var html1 = '';
            var tot_commission = 0;
            if (bookings != '') {
                $.each(bookings, function (key, booking) {
                    key++;
                    var vehicle = "";
                    if (booking.vehicle_no == null) {
                        vehicle = booking.vehicle_type;
                    } else {
                        vehicle = booking.vehicle_type + " - " + booking.vehicle_no;
                    }
                    tot_commission += parseFloat(booking.commission);
                    html += '<tr>\n\
                                                    <td>' + key + '</td>\n\
                                                    <td>#' + booking.id + '</td>\n\
                                                    <td>' + vehicle + '</td>\n\
                                                    <td>' + booking.driver + '</td>\n\
                                                    <td  style="text-align: right;">' + parseFloat(booking.total).toFixed(2) + '</td>\n\
                                                    <td>' + booking.rate + '</td>\n\
                                                    <td  style="text-align: right;">' + parseFloat(booking.commission).toFixed(2) + '</td>\n\
                                                    </tr>';



                });
                html1 += '<tr>\n\
                                                    <th colspan="6" style="text-align: right;">Total (Rs)</th>\n\
                                                    <th class="total-commission" style="text-align: right;">' + tot_commission.toFixed(2) + '</th>\n\
                                                    </tr>';

                $(".commission-report-table tbody").empty();
                $(".commission-report-table tbody").append(html);
                $(".commission-report-table tfoot").empty();
                $(".commission-report-table tfoot").append(html1);
            } else {
                html = '<tr><td colspan="7">No any bookings in database</td></tr>';
                $(".commission-report-table tbody").empty();
                $(".commission-report-table tfoot").empty();
                $(".commission-report-table tbody").append(html);
            }
        }

    });


    $("#from").change(function () {
        var from = $("#from").val();
        var to = $("#to").val();
        var driver = $("#driver").val();

//    callLoader();
        $.ajax({
            type: 'POST',
            url: 'js/ajax/commission-report.php',
            dataType: "json",
            data: {
                from: from,
                to: to,
                driver: driver,
                option: 'GETPAYMENTDETAILSBYSTARTANDENDDATE'
            },
            success: function (bookings) {
                var html = '';
                var html1 = '';
                var tot_commission = 0;
                if (bookings != '') {
                    $.each(bookings, function (key, booking) {
                        key++;
                        var vehicle = "";
                        if (booking.vehicle_no == null) {
                            vehicle = booking.vehicle_type;
                        } else {
                            vehicle = booking.vehicle_type + " - " + booking.vehicle_no;
                        }
                        tot_commission += parseFloat(booking.commission);
                        html += '<tr>\n\
                                                    <td>' + key + '</td>\n\
                                                    <td>#' + booking.id + '</td>\n\
                                                    <td>' + vehicle + '</td>\n\
                                                    <td>' + booking.driver + '</td>\n\
                                                    <td style="text-align: right;">' + parseFloat(booking.total).toFixed(2) + '</td>\n\
                                                    <td>' + booking.rate + '</td>\n\
                                                    <td style="text-align: right;">' + parseFloat(booking.commission).toFixed(2) + '</td>\n\
                                                    </tr>';



                    });
                    html1 += '<tr>\n\
                                                    <th colspan="6" style="text-align: right;">Total (Rs)</th>\n\
                                                    <th class="total-commission" style="text-align: right;">' + tot_commission.toFixed(2) + '</th>\n\
                                                    </tr>';

                    $(".commission-report-table tbody").empty();
                    $(".commission-report-table tbody").append(html);
                    $(".commission-report-table tfoot").empty();
                    $(".commission-report-table tfoot").append(html1);
                } else {
                    html = '<tr><td colspan="7">No any bookings in database</td></tr>';
                    $(".commission-report-table tbody").empty();
                    $(".commission-report-table tfoot").empty();
                    $(".commission-report-table tbody").append(html);
                }
            }

        });
    });
    $("#to").change(function () {
        var from = $("#from").val();
        var to = $("#to").val();
        var driver = $("#driver").val();

//    callLoader();
        $.ajax({
            type: 'POST',
            url: 'js/ajax/commission-report.php',
            dataType: "json",
            data: {
                from: from,
                to: to,
                driver: driver,
                option: 'GETPAYMENTDETAILSBYSTARTANDENDDATE'
            },
            success: function (bookings) {
                var html = '';
                var html1 = '';
                var tot_commission = 0;
                if (bookings != '') {
                    $.each(bookings, function (key, booking) {
                        key++;
                        var vehicle = "";
                        if (booking.vehicle_no == null) {
                            vehicle = booking.vehicle_type;
                        } else {
                            vehicle = booking.vehicle_type + " - " + booking.vehicle_no;
                        }
                        tot_commission += parseFloat(booking.commission);
                        html += '<tr>\n\
                                                    <td>' + key + '</td>\n\
                                                    <td>#' + booking.id + '</td>\n\
                                                    <td>' + vehicle + '</td>\n\
                                                    <td>' + booking.driver + '</td>\n\
                                                    <td style="text-align: right;">' + parseFloat(booking.total).toFixed(2) + '</td>\n\
                                                    <td>' + booking.rate + '</td>\n\
                                                    <td style="text-align: right;">' + parseFloat(booking.commission).toFixed(2) + '</td>\n\
                                                    </tr>';



                    });
                    html1 += '<tr>\n\
                                                    <th colspan="6" style="text-align: right;">Total (Rs)</th>\n\
                                                    <th class="total-commission" style="text-align: right;">' + tot_commission.toFixed(2) + '</th>\n\
                                                    </tr>';

                    $(".commission-report-table tbody").empty();
                    $(".commission-report-table tbody").append(html);
                    $(".commission-report-table tfoot").empty();
                    $(".commission-report-table tfoot").append(html1);
                } else {
                    html = '<tr><td colspan="7">No any bookings in database</td></tr>';
                    $(".commission-report-table tbody").empty();
                    $(".commission-report-table tfoot").empty();
                    $(".commission-report-table tbody").append(html);
                }
            }

        });
    });
    $("#driver").change(function () {

        var from = $("#from").val();
        var to = $("#to").val();
        var driver = $("#driver").val();

//    callLoader();
        $.ajax({
            type: 'POST',
            url: 'js/ajax/commission-report.php',
            dataType: "json",
            data: {
                from: from,
                to: to,
                driver: driver,
                option: 'GETPAYMENTDETAILSBYSTARTANDENDDATE'
            },
            success: function (bookings) {
                var html = '';
                var html1 = '';
                var tot_commission = 0;
                if (bookings != '') {
                    $.each(bookings, function (key, booking) {
                        key++;
                        var vehicle = "";
                        if (booking.vehicle_no == null) {
                            vehicle = booking.vehicle_type;
                        } else {
                            vehicle = booking.vehicle_type + " - " + booking.vehicle_no;
                        }
                        tot_commission += parseFloat(booking.commission);
                        html += '<tr>\n\
                                                    <td>' + key + '</td>\n\
                                                    <td>#' + booking.id + '</td>\n\
                                                    <td>' + vehicle + '</td>\n\
                                                    <td>' + booking.driver + '</td>\n\
                                                    <td style="text-align: right;">' + parseFloat(booking.total).toFixed(2) + '</td>\n\
                                                    <td>' + booking.rate + '</td>\n\
                                                    <td style="text-align: right;">' + booking.commission.toFixed(2) + '</td>\n\
                                                    </tr>';



                    });
                    html1 += '<tr>\n\
                                                    <th colspan="6" style="text-align: right;">Total (Rs)</th>\n\
                                                    <th class="total-commission" style="text-align: right;">' + tot_commission.toFixed(2) + '</th>\n\
                                                    </tr>';

                    $(".commission-report-table tbody").empty();
                    $(".commission-report-table tbody").append(html);
                    $(".commission-report-table tfoot").empty();
                    $(".commission-report-table tfoot").append(html1);
                } else {
                    html = '<tr><td colspan="7">No any bookings in database</td></tr>';
                    $(".commission-report-table tbody").empty();
                    $(".commission-report-table tfoot").empty();
                    $(".commission-report-table tbody").append(html);
                }
            }

        });
    });
});