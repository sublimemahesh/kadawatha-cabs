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
                    html += '<option value="' + data.id + '" driver="' + data.driver + '">';
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
        var vehicle = $(this).val();
        var driver = $(this).find(':selected').attr('driver');
        $.ajax({
            url: "post-and-get/ajax/booking.php",
            type: "POST",
            data: {
                vehicle: vehicle,
                action: 'GETALLDRIVERS'
            },
            dataType: "JSON",
            success: function (jsonStr) {
                var html = '';
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

    $('.mark-as-completed').click(function () {

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

    $('.cancel-booking').click(function () {

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


});

$(document).ajaxStart(function () {
    $('#loading').show();
});

$(document).ajaxComplete(function () {
    $('#loading').hide();
});
