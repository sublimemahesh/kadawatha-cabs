$(document).ready(function () {

    $('#vehicle_type').change(function () {
        var type = $(this).val();
        $.ajax({
            url: "post-and-get/ajax/package-details.php",
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
                html += '<select class="form-control" autocomplete="off" type="text" autocomplete="off" name="category" id="category" required="TRUE">';
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
        $.ajax({
            url: "post-and-get/ajax/package-details.php",
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
                    html += '<option value=""> -- Please Select Sub Category -- </option>';
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
});
