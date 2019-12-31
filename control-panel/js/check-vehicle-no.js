$(document).ready(function () {
    $("#createVehicle").click(function (e) {
        e.preventDefault();
        var vehicle_number = $('#vehicle-no').val();
        $.ajax({
            url: "js/ajax/check-vehicle-no.php",
            type: "POST",
            dataType: "JSON",
            data: {
                vehicle_number: vehicle_number,
                option: 'CHECKVEHICLENO'
            },

            success: function (result) {

                if (result) {

                    swal({
                        title: "Error!",
                        text: "This Vehicle Already Exists in The System.",
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });



                } else {


                    $("#newVehicle").submit();

                }
            }

        });

//        e.preventDefault();

    });

    $('#type').change(function () {
        var type = $(this).val();
        $.ajax({
            url: "post-and-get/ajax/booking.php",
            type: "POST",
            data: {
                vtype: type,
                action: 'GETDRIVERS'
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
                    html += '<option value="' + data.id + '">';
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

});

