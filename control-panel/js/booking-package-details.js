$(document).ready(function () {
    var id = $('#id').val();
    var total = $('#total_cost').val();
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

    $('#vehicle_type').change(function () {
        var type = $(this).val();
        $('#package-bar').empty();
        $('#subcategory-bar').empty();

        $.ajax({
            url: "post-and-get/ajax/booking-package-details.php",
            type: "POST",
            data: {
                type: type,
                action: 'GETCATEGORIESBYTYPE'
            },
            dataType: "JSON",
            success: function (jsonStr) {
                var html = '';
                html += '<div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">';
                html += '<label for="category">Vehicle Category</label>';
                html += '</div>';
                html += '<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">';
                html += '<div class="form-group place-select">';
                html += '<div class="form-line">';
                html += '<select class="form-control" autocomplete="off" type="text" autocomplete="off" name="category" id="category">';
                html += '<option value=""> -- Please Select Category -- </option>';
                $.each(jsonStr, function (i, data) {
                    html += '<option value="' + data.id + '">';
                    html += data.name;
                    html += '</option>';
                });
                html += '</select>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                $('#category-bar').empty();
                $('#category-bar').append(html);
                $('select[name="data.name"]').val('data.id');
            }
        });
    });
    $('#category-bar').on('change', '#category', function () {
        var category = $(this).val();
        $('#package-bar').empty();
        $.ajax({
            url: "post-and-get/ajax/booking-package-details.php",
            type: "POST",
            data: {
                category: category,
                action: 'GETSUBCATEGORIES'
            },
            dataType: "JSON",
            success: function (jsonStr) {

                var html = '';
                if (jsonStr != "") {
                    html += '<div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">';
                    html += '<label for="subcategory">Sub Category</label>';
                    html += '</div>';
                    html += '<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">';
                    html += '<div class="form-group form-float">';
                    html += '<div class="form-line">';
                    html += '<select class="form-control place-select1 show-tick" autocomplete="off" type="text" id="subcategory" name="subcategory">';
                    html += '<option value="0"> -- Please Select Sub Category -- </option>';
                    $.each(jsonStr, function (i, data) {
                        html += '<option value="' + data.id + '">';
                        html += data.name;
                        html += '</option>';
                    });
                    html += '</select>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';

                }
                $('#subcategory-bar').empty();
                $('#subcategory-bar').append(html);

            }
        });
    });

    $('#subcategory-bar').on('change', '#subcategory', function () {
        var subcategory = $(this).val();
        var vtype = $("#vehicle_type :selected").val();
        var category = $("#category :selected").val();
        var ptype = $("#package_type :selected").val();
        $.ajax({
            url: "post-and-get/ajax/booking-package-details.php",
            type: "POST",
            data: {
                ptype: ptype,
                vtype: vtype,
                category: category,
                subcategory: subcategory,
                action: 'GETPACKAGES'
            },
            dataType: "JSON",
            success: function (jsonStr) {
                var html = '';
                html += '<div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">';
                html += '<label for="package">Package</label>';
                html += '</div>';
                html += '<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">';
                html += '<div class="form-group place-select">';
                html += '<div class="form-line">';
                html += '<select class="form-control" name="package" id="package">';
                html += '<option value=""> -- Please Select Package -- </option>';
                $.each(jsonStr, function (i, data) {
                    html += '<option value="' + data.id + '" price="' + data.price + '">';
                    html += data.name;
                    html += '</option>';
                });
                html += '</select>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                $('#package-bar').empty();
                $('#package-bar').append(html);
            }
        });
    });

    $('#package_type').change(function () {
        var type = $(this).val();
        var vtype = $("#vehicle_type :selected").val();
        var category = $("#category :selected").val();
        var subcategory = $("#subcategory :selected").val();
        if (!subcategory) {
            subcategory = 0;
        }
        $.ajax({
            url: "post-and-get/ajax/booking-package-details.php",
            type: "POST",
            data: {
                ptype: type,
                vtype: vtype,
                category: category,
                subcategory: subcategory,
                action: 'GETPACKAGES'
            },
            dataType: "JSON",
            success: function (jsonStr) {
                var html = '';
                html += '<div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">';
                html += '<label for="package">Package</label>';
                html += '</div>';
                html += '<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">';
                html += '<div class="form-group place-select">';
                html += '<div class="form-line">';
                html += '<select class="form-control" name="package" id="package">';
                html += '<option value=""> -- Please Select Package -- </option>';
                $.each(jsonStr, function (i, data) {
                    html += '<option value="' + data.id + '" price="' + data.price + '">';
                    html += data.name;
                    html += '</option>';
                });
                html += '</select>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                $('#package-bar').empty();
                $('#package-bar').append(html);
            }
        });
    });

    $('#package-bar').on('change', '#package', function () {
        var price = $("#package :selected").attr('price');
        $('#total_cost').val(price);
    });
});
