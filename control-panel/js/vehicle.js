$(document).ready(function () {

    $('#vehicle_type').change(function () {
        var type = $(this).val();
        $.ajax({
            url: "post-and-get/ajax/vehicle.php",
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
                html += '<select class="form-control" autocomplete="off" type="text" autocomplete="off" name="vehicle" required="TRUE">';
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

});

$(document).ajaxStart(function () {
    $('#loading').show();
});

$(document).ajaxComplete(function () {
    $('#loading').hide();
});
