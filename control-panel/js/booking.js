$(document).ready(function () {

    $('#vehicle_type').change(function () {
        var type = $(this).val();
        $.ajax({
            url: "post-and-get/ajax/booking.php",
            type: "POST",
            data: {
                type: type,
                action: 'GETVEHICLESBYTYPE'
            },
            dataType: "JSON",
            success: function (jsonStr) {
                var html = '';
                html += '<div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">';
                html += '<label for="vehicle">Vehicle</label>';
                html += '</div>';
                html += '<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">';
                html += '<div class="form-group place-select">';
                html += '<div class="form-line">';
                html += '<select class="form-control" autocomplete="off" type="text" autocomplete="off" name="vehicle" id="vehicle" required="TRUE">';
                html += '<option value=""> -- Please Select Vehicle -- </option>';
                $.each(jsonStr, function (i, data) {
                    html += '<option value="' + data.id + '" driver="' + data.driver + '" no_of_passengers="' + data.no_of_passenger + '" no_of_baggage="' + data.no_of_baggage + '">';
                    html += data.vehicle_name;
                    html += '</option>';
                });
                html += '</select>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                $('#vehicle-bar').empty();
                $('#vehicle-bar').append(html);
                $('select[name="data.name"]').val('data.id');
            }
        });
    });
    $('#vehicle-bar').on('change', '#vehicle', function () {
        var driver = $(this).find(':selected').attr('driver');
        var passengers = $(this).find(':selected').attr('no_of_passengers');
        var baggages = $(this).find(':selected').attr('no_of_baggage');
        var vtype = $("#vehicle_type :selected").val();
        $.ajax({
            url: "post-and-get/ajax/booking.php",
            type: "POST",
            data: {
                vtype: vtype,
                action: 'GETDRIVERS'
            },
            dataType: "JSON",
            success: function (jsonStr) {
                var html = '';
                var html1 = '';
                html += '<div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">';
                html += '<label for="driver">Driver</label>';
                html += '</div>';
                html += '<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">';
                html += '<div class="form-group form-float">';
                html += '<div class="form-line">';
                html += '<select class="form-control place-select1 show-tick" autocomplete="off" type="text" id="driver" name="driver">';
                html += '<option value=""> -- Please Select Driver -- </option>';
                $.each(jsonStr, function (i, data) {
                    var selected = '';
                    if (data.id == driver) {
                        selected = 'selected';
                    }
                    html += '<option value="' + data.id + '" ' + selected + '>';
                    html += data.name;
                    html += '</option>';
                });
                html += '</select>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                $('#driver-bar').empty();
                $('#driver-bar').append(html);
                var i;
                var j;
                html1 += '<div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">';
                html1 += '<label for="seating_capacity">Seating Capacity</label>';
                html1 += '</div>';
                html1 += '<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">';
                html1 += '<div class="form-group form-float">';
                html1 += '<div class="form-line">';
                html1 += '<select class="form-control place-select1 show-tick" id="seating_capacity" name="seating_capacity">';
                html1 += '<option value=""> -- Please Select -- </option>';
                for (i = 1; i <= passengers; i++) {
                    html1 += '<option value="' + i + '">';
                    html1 += i;
                    html1 += '</option>';
                }
                html1 += '</select>';
                html1 += '</div>';
                html1 += '</div>';
                html1 += '</div>';
                html1 += '<div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">';
                html1 += '<label for="no_of_hard_baggage">No of Hard Baggage</label>';
                html1 += '</div>';
                html1 += '<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">';
                html1 += '<div class="form-group form-float">';
                html1 += '<div class="form-line">';
                html1 += '<select class="form-control place-select1 show-tick" id="no_of_hard_baggage" name="no_of_hard_baggage">';
                html1 += '<option value=""> -- Please Select -- </option>';
                for (j = 1; j <= baggages; j++) {
                    html1 += '<option value="' + j + '">';
                    html1 += j;
                    html1 += '</option>';
                }
                html1 += '</select>';
                html1 += '</div>';
                html1 += '</div>';
                html1 += '</div>';
                html1 += '<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">';
                html1 += '<label for="no_of_hand_baggage">No of Hand Baggage</label>';
                html1 += '</div>';
                html1 += '<div class="col-md-2">';
                html1 += '<div class="form-group form-float">';
                html1 += '<div class="form-line">';
                html1 += '<input type="number" id="no_of_hand_baggage" class="form-control input-append"  autocomplete="off" name="no_of_hand_baggage" required="true" placeholder="No of Hand Baggage" min="0">';
                html1 += '</div>';
                html1 += '</div>';
                html1 += '</div>';
                $('#seating-capacity-bar').empty();
                $('#seating-capacity-bar').append(html1);
            }
        });
    });
    $('#package').change(function () {
        var price = $('option:selected', this).attr('price');
        $('#total_cost').val(price);
    });
    $('.mark-as-confirmed').click(function () {

        var id = $(this).attr("data-id");
        swal({
            title: "Are you sure?",
            text: "Are you want to mark this booking as confirmed?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, mark it!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "js/ajax/booking.php",
                type: "POST",
                data: {id: id, option: 'confirm'},
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status) {

                        swal({
                            title: "Confirmed!",
                            text: "This booking has been marked as confirmed successfully.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        $('#row_' + id).remove();
                    }
                }
            });
        });
    });

    $('#booking tbody').on('click', '.mark-as-completed', function () {
        var id = $(this).attr("data-id");
        swal({
            title: "Are you sure?",
            text: "Are you want to mark this booking as completed?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, mark it!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "js/ajax/booking.php",
                type: "POST",
                data: {id: id, option: 'complete'},
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status) {

                        swal({
                            title: "Completed!",
                            text: "This booking has been marked as completed successfully.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        $('#row_' + id).remove();
                    }
                }
            });
        });
    });

    $('#booking tbody').on('click', '.cancel-booking', function () {
        var id = $(this).attr("data-id");
        swal({
            title: "Are you sure?",
            text: "Are you want to cancel this booking?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, cancel it!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "js/ajax/booking.php",
                type: "POST",
                data: {id: id, option: 'cancel'},
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status) {

                        swal({
                            title: "Confirmed!",
                            text: "This booking has been canceled successfully.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        $('#row_' + id).remove();
                    }
                }
            });
        });
    });
//Confirmed & Completed Bookings
    var status = $('#booking_status').val();
    var date = $('#today_booking').val();

    if (date == '' && status == 'confirmed' || status == 'completed') {
        $.ajax({
            type: 'POST',
            url: 'js/ajax/booking.php',
            dataType: "json",
            data: {
                option: 'GETSTARTANDENDDATE'
            },
            success: function (result) {
                $("#from").val(result.start_date);
                $("#to").val(result.end_date);
                $.ajax({
                    type: 'POST',
                    url: 'js/ajax/booking.php',
                    dataType: "json",
                    data: {
                        from: result.start_date,
                        to: result.end_date,
                        status: status,
                        option: 'GETBOOKINGSBYSTARTENDDATESANDSTATUS'
                    },
                    success: function (bookings) {
                        var html;
                        var i = 1;
                        if (bookings != '') {
                            $.each(bookings, function (key, booking) {

                                var html1 = '';
                                if (status == 'confirmed') {
                                    html1 += '|';
                                    html1 += '<a href="#"  class="mark-as-completed" data-id="' + booking.id + '">';
                                    html1 += '<button class="glyphicon glyphicon-ok confirmed-btn" title="Mark as Completed"></button>';
                                    html1 += '</a>';
                                    html1 += '|';
                                    html1 += '<a href="#"  class="cancel-booking" data-id="' + booking.id + '">';
                                    html1 += '<button class="glyphicon glyphicon-remove-circle arrange-btn" title="Mark as Canceled"></button>';
                                    html1 += '</a>';
                                }

                                html += '<tr>\n\
                                                    <td>' + i + '</td>\n\
                                                    <td>' + booking.ref_no + '</td>\n\
                                                    <td>' + booking.customer + '</td>\n\
                                                    <td>' + booking.nic + '</td>\n\
                                                    <td>' + booking.date + '</td>\n\
                                                    <td>' + booking.start_date + '</td>\n\
                                                    <td>' + booking.end_date + '</td>\n\
                                                    <td class="text-right">' + booking.total_amount + '</td>\n\
                                                    <td class="text-right">' + booking.paid_amount + '</td>\n\
                                                    <td class="text-right">' + booking.due_amount + '</td>\n\
                                                    <td>\n\
                                                        <a href="edit-booking.php?id=' + booking.id + '"> <button class="glyphicon glyphicon-pencil edit-btn" title="Edit Booking"></button></a>\n\
                                                        ' + html1 + '\n\
                                                    </td>\n\
                                                    </tr>';
                                i++;
                            });
                            $("#booking tbody").empty();
                            $("#booking tbody").append(html);
                        } else {
                            html = '<tr><td colspan="11">No any bookings in database</td></tr>';
                            $("#booking tbody").empty();
                            $("#booking tbody").append(html);
                        }
                    }

                });
            }
        });
    }
    $("#from").change(function () {
        var from = $("#from").val();
        var to = $("#to").val();
        $.ajax({
            type: 'POST',
            url: 'js/ajax/booking.php',
            dataType: "json",
            data: {
                from: from,
                to: to,
                status: status,
                option: 'GETBOOKINGSBYSTARTENDDATESANDSTATUS'
            },
            success: function (bookings) {
                var html;
                var i = 1;
                if (bookings != '') {
                    $.each(bookings, function (key, booking) {

                        var html1 = '';
                        if (status == 'confirmed') {
                            html1 += '|';
                            html1 += '<a href="#"  class="mark-as-completed" data-id="' + booking.id + '">';
                            html1 += '<button class="glyphicon glyphicon-ok confirmed-btn" title="Mark as Completed"></button>';
                            html1 += '</a>';
                            html1 += '|';
                            html1 += '<a href="#"  class="cancel-booking" data-id="' + booking.id + '">';
                            html1 += '<button class="glyphicon glyphicon-remove-circle arrange-btn" title="Mark as Canceled"></button>';
                            html1 += '</a>';
                        }

                        html += '<tr>\n\
                                                    <td>' + i + '</td>\n\
                                                    <td>' + booking.ref_no + '</td>\n\
                                                    <td>' + booking.customer + '</td>\n\
                                                    <td>' + booking.nic + '</td>\n\
                                                    <td>' + booking.date + '</td>\n\
                                                    <td>' + booking.start_date + '</td>\n\
                                                    <td>' + booking.end_date + '</td>\n\
                                                    <td class="text-right">' + booking.total_amount + '</td>\n\
                                                    <td class="text-right">' + booking.paid_amount + '</td>\n\
                                                    <td class="text-right">' + booking.due_amount + '</td>\n\
                                                    <td>\n\
                                                        <a href="edit-booking.php?id=' + booking.id + '"> <button class="glyphicon glyphicon-pencil edit-btn" title="Edit Booking"></button></a>\n\
                                                        ' + html1 + '\n\
                                                    </td>\n\
                                                    </tr>';
                        i++;
                    });
                    $("#booking tbody").empty();
                    $("#booking tbody").append(html);
                } else {
                    html = '<tr><td colspan="11">No any bookings in database</td></tr>';
                    $("#booking tbody").empty();
                    $("#booking tbody").append(html);
                }
            }

        });
    });
    $("#to").change(function () {
        var from = $("#from").val();
        var to = $("#to").val();
        $.ajax({
            type: 'POST',
            url: 'js/ajax/booking.php',
            dataType: "json",
            data: {
                from: from,
                to: to,
                status: status,
                option: 'GETBOOKINGSBYSTARTENDDATESANDSTATUS'
            },
            success: function (bookings) {
                var html;
                var i = 1;
                if (bookings != '') {
                    $.each(bookings, function (key, booking) {

                        var html1 = '';
                        if (status == 'confirmed') {
                            html1 += '|';
                            html1 += '<a href="#"  class="mark-as-completed" data-id="' + booking.id + '">';
                            html1 += '<button class="glyphicon glyphicon-ok confirmed-btn" title="Mark as Completed"></button>';
                            html1 += '</a>';
                            html1 += '|';
                            html1 += '<a href="#"  class="cancel-booking" data-id="' + booking.id + '">';
                            html1 += '<button class="glyphicon glyphicon-remove-circle arrange-btn" title="Mark as Canceled"></button>';
                            html1 += '</a>';
                        }

                        html += '<tr>\n\
                                                    <td>' + i + '</td>\n\
                                                    <td>' + booking.ref_no + '</td>\n\
                                                    <td>' + booking.customer + '</td>\n\
                                                    <td>' + booking.nic + '</td>\n\
                                                    <td>' + booking.date + '</td>\n\
                                                    <td>' + booking.start_date + '</td>\n\
                                                    <td>' + booking.end_date + '</td>\n\
                                                    <td class="text-right">' + booking.total_amount + '</td>\n\
                                                    <td class="text-right">' + booking.paid_amount + '</td>\n\
                                                    <td class="text-right">' + booking.due_amount + '</td>\n\
                                                    <td>\n\
                                                        <a href="edit-booking.php?id=' + booking.id + '"> <button class="glyphicon glyphicon-pencil edit-btn" title="Edit Booking"></button></a>\n\
                                                        ' + html1 + '\n\
                                                    </td>\n\
                                                    </tr>';
                        i++;
                    });
                    $("#booking tbody").empty();
                    $("#booking tbody").append(html);
                } else {
                    html = '<tr><td colspan="11">No any bookings in database</td></tr>';
                    $("#booking tbody").empty();
                    $("#booking tbody").append(html);
                }
            }

        });
    });
});
$(document).ajaxStart(function () {
    $('#loading').show();
});
$(document).ajaxComplete(function () {
    $('#loading').hide();
});
