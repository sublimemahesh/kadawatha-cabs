$(document).ready(function () {
    $.ajax({
        type: 'POST',
        url: 'js/ajax/daily-report.php',
        dataType: "json",
        data: {
            option: 'GETSTARTANDENDDATE'
        },
        success: function (result) {
            $("#from").val(result.start_date);
            $("#to").val(result.end_date);
            $.ajax({
                type: 'POST',
                url: 'js/ajax/daily-report.php',
                dataType: "json",
                data: {
                    from: result.start_date,
                    to: result.end_date,
                    option: 'GETBOOKINGSBYSTARTANDENDDATE'
                },
                success: function (bookings) {
                    callLoader();
                    var html;
                    var i = 1;
                    if (bookings != '') {
                        $.each(bookings.details, function (key, booking) {

                            html += '<tr>\n\
                                                    <td>' + i + '</td>\n\
                                                    <td>' + booking.date + '</td>\n\
                                                    <td>' + booking.customer + '</td>\n\
                                                    <td>' + booking.vehicle_type + '</td>\n\
                                                    <td>' + booking.vehicle + '</td>\n\
                                                    <td>' + booking.driver + '</td>\n\
                                                    <td>' + booking.package + '</td>\n\
                                                    <td class="text-right">' + booking.cost + '</td>\n\
                                                    </tr>';
                            i++;
                        });
                        $("#daily-report tbody").empty();
                        $("#daily-report tbody").append(html);
                        $("#total-cost").empty();
                        $("#total-cost").append(bookings.tot_cost);

                    } else {
                        html = 'No any bookings in database';
                        $("#balance tbody").empty();
                        $("#balance tbody").append(html);
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
            url: 'js/ajax/daily-report.php',
            dataType: "json",
            data: {
                from: from,
                to: to,
                option: 'GETBOOKINGSBYSTARTANDENDDATE'
            },
            success: function (bookings) {
                callLoader();
                var html;
                var i = 1;
                if (bookings != '') {
                    $.each(bookings.details, function (key, booking) {

                        html += '<tr>\n\
                                                    <td>' + i + '</td>\n\
                                                    <td>' + booking.date + '</td>\n\
                                                    <td>' + booking.customer + '</td>\n\
                                                    <td>' + booking.vehicle_type + '</td>\n\
                                                    <td>' + booking.vehicle + '</td>\n\
                                                    <td>' + booking.driver + '</td>\n\
                                                    <td>' + booking.package + '</td>\n\
                                                    <td class="text-right">' + booking.cost + '</td>\n\
                                                    </tr>';
                        i++;

                    });
                    $("#daily-report tbody").empty();
                    $("#daily-report tbody").append(html);
                    $("#total-cost").empty();
                    $("#total-cost").append(bookings.tot_cost);

                } else {
                    html = 'No any bookings in database';
                    $("#balance tbody").empty();
                    $("#balance tbody").append(html);
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
            url: 'js/ajax/daily-report.php',
            dataType: "json",
            data: {
                from: from,
                to: to,
                option: 'GETBOOKINGSBYSTARTANDENDDATE'
            },
            success: function (bookings) {
                callLoader();
                var html;
                var i = 1;
                if (bookings != '') {
                    $.each(bookings.details, function (key, booking) {

                        html += '<tr>\n\
                                                    <td>' + i + '</td>\n\
                                                    <td>' + booking.date + '</td>\n\
                                                    <td>' + booking.customer + '</td>\n\
                                                    <td>' + booking.vehicle_type + '</td>\n\
                                                    <td>' + booking.vehicle + '</td>\n\
                                                    <td>' + booking.driver + '</td>\n\
                                                    <td>' + booking.package + '</td>\n\
                                                    <td class="text-right">' + booking.cost + '</td>\n\
                                                    </tr>';
                        i++;
                    });
                    $("#daily-report tbody").empty();
                    $("#daily-report tbody").append(html);
                    $("#total-cost").empty();
                    $("#total-cost").append(bookings.tot_cost);

                } else {
                    html = 'No any bookings in database';
                    $("#balance tbody").empty();
                    $("#balance tbody").append(html);
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