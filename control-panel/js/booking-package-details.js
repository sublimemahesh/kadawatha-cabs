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

        $.ajax({
            url: "post-and-get/ajax/booking.php",
            type: "POST",
            data: {
                type: type,
                action: 'GETSUBTYPESBYTYPE'
            },
            dataType: "JSON",
            success: function (jsonStr) {
                var html = '';
                html += '<div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">';
                html += '<label for="vehicle-sub-type">Vehicle Sub Type</label>';
                html += '</div>';
                html += '<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">';
                html += '<div class="form-group place-select">';
                html += '<div class="form-line">';
                html += '<select class="form-control" autocomplete="off" type="text" autocomplete="off" name="vehicle-sub-type" id="vehicle-sub-type" required="TRUE">';
                html += '<option value=""> -- Please Select Sub Type -- </option>';
                $.each(jsonStr, function (i, data) {
                    html += '<option value="' + data.id + '" category="' + data.category + '" no_of_seats="' + data.no_of_seats + '">';
                    html += data.name + ' ' + data.no_of_seats + ' seats';
                    html += '</option>';
                });
                html += '</select>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                $('#vehicle-sub-type-bar').empty();
                $('#vehicle-sub-type-bar').append(html);
                $('select[name="data.name"]').val('data.id');
            }
        });
    });
    $('#vehicle-sub-type-bar').on('change', '#vehicle-sub-type', function () {
        var category = $("#vehicle-sub-type :selected").attr('category');
        var passengers = $("#vehicle-sub-type :selected").attr('no_of_seats');

        $('#package-bar').empty();
        var html = '';
        if (category == 1) {
            html += '<div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">';
            html += '<label for="category">Condition</label>';
            html += '</div>';
            html += '<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">';
            html += '<div class="form-group place-select">';
            html += '<div class="form-line">';
            html += '<input type="hidden" id="category" class="form-control input-append"  autocomplete="off" name="category" placeholder="Category" value="' + category + '" readonly="">';
            html += '<select class="form-control place-select1 show-tick" autocomplete="off" type="text" id="subcategory" name="subcategory">';
            html += '<option value="0"> -- Please Select Sub Category -- </option>';
            html += '<option value="1">AC</option>';
            html += '<option value="2">Non AC</option>';
            html += '</select>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
        } else if (category == 2) {
            html += '<input type="hidden" id="category"  value="' + category + '" >';
            html += '<input type="hidden" id="subcategory" name="subcategory"  value="' + 1 + '">';
        } else if (category == 3) {
            html += '<input type="hidden" id="category"  value="' + category + '" >';
            html += '<input type="hidden" id="subcategory" name="subcategory"  value="' + 2 + '">';
        }


        var i;
        var html1 = '';
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
        html1 += '</select>';
        html1 += '</div>';
        html1 += '</div>';
        html1 += '</div>';
        html1 += '<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">';
        html1 += '<label for="no_of_hand_baggage">No of Hard Baggage</label>';
        html1 += '</div>';
        html1 += '<div class="col-md-2">';
        html1 += '<div class="form-group form-float">';
        html1 += '<div class="form-line">';
        html1 += '<input type="number" id="no_of_hard_baggage" class="form-control input-append"  autocomplete="off" name="no_of_hard_baggage" placeholder="No of Hard Baggage" min="0">';
        html1 += '</div>';
        html1 += '</div>';
        html1 += '</div>';
        html1 += '<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">';
        html1 += '<label for="no_of_hand_baggage">No of Hand Baggage</label>';
        html1 += '</div>';
        html1 += '<div class="col-md-2">';
        html1 += '<div class="form-group form-float">';
        html1 += '<div class="form-line">';
        html1 += '<input type="number" id="no_of_hand_baggage" class="form-control input-append"  autocomplete="off" name="no_of_hand_baggage" placeholder="No of Hand Baggage" min="0">';
        html1 += '</div>';
        html1 += '</div>';
        html1 += '</div>';
        $('#category-bar').empty();
        $('#category-bar').append(html);
        $('#seating-capacity-bar').empty();
        $('#seating-capacity-bar').append(html1);
        $('select[name="data.name"]').val('data.id');
    });
//    $('#category-bar').on('change', '#category', function () {
//        var category = $(this).val();
//        $('#package-bar').empty();
//        $.ajax({
//            url: "post-and-get/ajax/booking-package-details.php",
//            type: "POST",
//            data: {
//                category: category,
//                action: 'GETSUBCATEGORIES'
//            },
//            dataType: "JSON",
//            success: function (jsonStr) {
//
//                var html = '';
//                if (jsonStr != "") {
//                    html += '<div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">';
//                    html += '<label for="subcategory">Sub Category</label>';
//                    html += '</div>';
//                    html += '<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">';
//                    html += '<div class="form-group form-float">';
//                    html += '<div class="form-line">';
//                    html += '<select class="form-control place-select1 show-tick" autocomplete="off" type="text" id="subcategory" name="subcategory">';
//                    html += '<option value="0"> -- Please Select Sub Category -- </option>';
//                    $.each(jsonStr, function (i, data) {
//                        html += '<option value="' + data.id + '">';
//                        html += data.name;
//                        html += '</option>';
//                    });
//                    html += '</select>';
//                    html += '</div>';
//                    html += '</div>';
//                    html += '</div>';
//
//                }
//                $('#subcategory-bar').empty();
//                $('#subcategory-bar').append(html);
//
//            }
//        });
//    });
//
//    $('#subcategory-bar').on('change', '#subcategory', function () {
//        var subcategory = $(this).val();
//        var vtype = $("#vehicle_type :selected").val();
//        var category = $("#category :selected").val();
//        var ptype = $("#package_type :selected").val();
//        $.ajax({
//            url: "post-and-get/ajax/booking-package-details.php",
//            type: "POST",
//            data: {
//                ptype: ptype,
//                vtype: vtype,
//                category: category,
//                subcategory: subcategory,
//                action: 'GETPACKAGES'
//            },
//            dataType: "JSON",
//            success: function (jsonStr) {
//                var html = '';
//                html += '<div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">';
//                html += '<label for="package">Package</label>';
//                html += '</div>';
//                html += '<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">';
//                html += '<div class="form-group place-select">';
//                html += '<div class="form-line">';
//                html += '<select class="form-control" name="package" id="package">';
//                html += '<option value=""> -- Please Select Package -- </option>';
//                $.each(jsonStr, function (i, data) {
//                    html += '<option value="' + data.id + '" price="' + data.price + '">';
//                    html += data.name;
//                    html += '</option>';
//                });
//                html += '</select>';
//                html += '</div>';
//                html += '</div>';
//                html += '</div>';
//                $('#package-bar').empty();
//                $('#package-bar').append(html);
//            }
//        });
//    });

    $('#package_type').change(function () {
        var type = $(this).val();
        var vtype = $("#vehicle_type :selected").val();
        var category = $("#category").val();
        if (category == 1) {
            var subcategory = $("#subcategory :selected").val();
        } else {
            var subcategory = $("#subcategory").val();
        }
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
    $('#category-bar').on('change', '#subcategory', function () {
        var category = $("#category").val();
        var vtype = $("#vehicle_type :selected").val();
        var type = $("#package_type").val();
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
