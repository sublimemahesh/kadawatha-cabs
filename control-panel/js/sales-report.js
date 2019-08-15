$(document).ready(function () {

    $.ajax({
        type: 'POST',
        url: 'js/ajax/sales-report.php',
        dataType: "json",
        data: {
            option: 'GETSTARTANDENDDATE'
        },
        success: function (result) {

            $("#from").val(result.min_date);
            $("#to").val(result.max_date);
            $.ajax({
                type: 'POST',
                url: 'js/ajax/sales-report.php',
                dataType: "json",
                data: {
                    from: result.min_date,
                    to: result.max_date,
                    option: 'GETBOOKINGSBYSTARTANDENDDATE'
                },
                success: function (bookings) {
                    var html;
                    if (bookings) {
                        $.each(bookings, function (key, booking) {
                            var vehicle = "";
                            if (booking.vehicle == null) {
                                vehicle = "-";
                            } else {
                                vehicle = booking.vehicle;
                            }
                            var owner = "";
                            if (booking.owner == null) {
                                owner = "-";
                            } else {
                                owner = booking.owner;
                            }

                            html += '<tr>\n\
                                                    <td>' + booking.id + '</td>\n\
                                                    <td>' + booking.created_at + '</td>\n\
                                                    <td>' + booking.vehicle_type + '</td>\n\
                                                    <td>' + vehicle + '</td>\n\
                                                    <td>' + booking.driver + '</td>\n\
                                                    <td>' + booking.customer + '</td>\n\
                                                    <td>' + booking.package + '</td>\n\
                                                    <td>' + owner + '</td>\n\
                                                    </tr>';


                            $(".sales-report-table tbody").empty();
                            $(".sales-report-table tbody").append(html);
                        });
                    } else {
                        html = 'No any bookings in database';
                        $(".sales-report-table tbody").empty();
                        $(".sales-report-table tbody").append(html);
                    }
                }

            });
        }
    });

    $("#from").change(function () {

        var from = $("#from").val();
        var to = $("#to").val();
        callLoader();
        $.ajax({
            type: 'POST',
            url: 'js/ajax/sales-report.php',
            dataType: "json",
            data: {
                from: from,
                to: to,
                option: 'GETBOOKINGSBYSTARTANDENDDATE'
            },
            success: function (bookings) {
                var html;
                if (bookings) {
                    $.each(bookings, function (key, booking) {
                        var vehicle = "";
                        if (booking.vehicle == null) {
                            vehicle = "-";
                        } else {
                            vehicle = booking.vehicle;
                        }
                        var owner = "";
                        if (booking.owner == null) {
                            owner = "-";
                        } else {
                            owner = booking.owner;
                        }

                        html += '<tr>\n\
                                                    <td>' + booking.id + '</td>\n\
                                                    <td>' + booking.created_at + '</td>\n\
                                                    <td>' + booking.vehicle_type + '</td>\n\
                                                    <td>' + vehicle + '</td>\n\
                                                    <td>' + booking.driver + '</td>\n\
                                                    <td>' + booking.customer + '</td>\n\
                                                    <td>' + booking.package + '</td>\n\
                                                    <td>' + owner + '</td>\n\
                                                    </tr>';


                        $(".sales-report-table tbody").empty();
                        $(".sales-report-table tbody").append(html);
                    });
                } else {
                    html = 'No any bookings in database';
                    $(".sales-report-table tbody").empty();
                    $(".sales-report-table tbody").append(html);
                }
            }

        });
    });

    $("#to").change(function () {
        var from = $("#from").val();
        var to = $("#to").val();
        callLoader();
        $.ajax({
            type: 'POST',
            url: 'js/ajax/sales-report.php',
            dataType: "json",
            data: {
                from: from,
                to: to,
                option: 'GETBOOKINGSBYSTARTANDENDDATE'
            },
            success: function (bookings) {
                var html;
                if (bookings) {
                    $.each(bookings, function (key, booking) {
                        var vehicle = "";
                        if (booking.vehicle == null) {
                            vehicle = "-";
                        } else {
                            vehicle = booking.vehicle;
                        }
                        var owner = "";
                        if (booking.owner == null) {
                            owner = "-";
                        } else {
                            owner = booking.owner;
                        }

                        html += '<tr>\n\
                                                    <td>' + booking.id + '</td>\n\
                                                    <td>' + booking.created_at + '</td>\n\
                                                    <td>' + booking.vehicle_type + '</td>\n\
                                                    <td>' + vehicle + '</td>\n\
                                                    <td>' + booking.driver + '</td>\n\
                                                    <td>' + booking.customer + '</td>\n\
                                                    <td>' + booking.package + '</td>\n\
                                                    <td>' + owner + '</td>\n\
                                                    </tr>';


                        $(".sales-report-table tbody").empty();
                        $(".sales-report-table tbody").append(html);
                    });
                } else {
                    html = 'No any bookings in database';
                    $(".sales-report-table tbody").empty();
                    $(".sales-report-table tbody").append(html);
                }
            }

        });
    });

    $("#print-btn").click(function () {
        var from = $("#from").val();
        var to = $("#to").val();
        window.location.replace("report-of-job-register.php?from=" + from + "&to=" + to);
    });

    function callLoader() {
        $.loadingBlockShow({
            imgPath: 'plugins/loader/img/default.svg',
            style: {
                position: 'fixed',
                width: '100%',
                height: '100%',
                background: 'rgba(0, 0, 0, .6)',
                left: 0,
                top: 0,
                zIndex: 10000
            }
        });

        setTimeout($.loadingBlockHide, 5000);
    }
    ;

});


