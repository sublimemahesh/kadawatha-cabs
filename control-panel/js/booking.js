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
                    html += '<option value="' + data.id + '">';
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
        $.ajax({
            url: "post-and-get/ajax/booking.php",
            type: "POST",
            data: {
                vehicle: vehicle,
                action: 'GETDRIVERBYVEHICLE'
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
                html += '<input type="text"  class="form-control input-append"  placeholder="Driver Name" value="' + jsonStr.name + '" readonly>';
                html += '<input type="hidden" id="driver"  name="driver"  value="' + jsonStr.id + '" readonly>';
                html += '</div>';
                html += '</div>';
                html += '</div>';

                $('#driver-bar').empty();
                $('#driver-bar').append(html);

            }
        });
    });
    
    $('#package').change(function() {
        var price = $('option:selected', this).attr('price');
        $('#total_cost').val(price);
    });

});

$(document).ajaxStart(function () {
    $('#loading').show();
});

$(document).ajaxComplete(function () {
    $('#loading').hide();
});
