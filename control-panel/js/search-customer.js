$(document).ready(function () {
    $('#btnSearchByNIC').click(function () {
        var nic = $('#txtNIC').val();
        $.ajax({
            url: "js/ajax/search-customer.php",
            type: "POST",
            dataType: "JSON",
            data: {
                nic: nic,
                option: 'SEARCHCUSTOMERBYNIC'
            },
            success: function (result) {
                if (result) {
                    $('#name-id').val(result.id);
                    $('#name').val(result.name);
                    $('#txtNIC').val("");
                    $('.customer-nic').text(result.nic);
                    $('.customer-email').text(result.email);
                    $('.customer-phone-number').text(result.mobile_number);
                    $('.customer-address').text(result.address);
                    $('#customer-details-section').removeClass('hidden');

                } else {
                    $('.customer-nic').text("");
                    $('.customer-email').text("");
                    $('.customer-phone-number').text("");
                    $('.customer-address').text("");
                    $('#customer-details-section').addClass('hidden');

                    var html = '';
                    html += '<div class="panel panel-info customer-not-found">';
                    html += '<div class="panel-body">';
                    html += '<div class="col-md-12">';
                    html += '<h6>This NIC is not exist in the system</h6>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';

                    $('#customer-not-found-section').empty();
                    $('#customer-not-found-section').append(html);

                }
            }

        });
    });
    $('#btnSearchByPhoneNo').click(function () {
        var phoneNo = $('#txtPhoneNo').val();
        $.ajax({
            url: "js/ajax/search-customer.php",
            type: "POST",
            dataType: "JSON",
            data: {
                phoneNumber: phoneNo,
                option: 'SEARCHCUSTOMERBYPHONE'
            },
            success: function (result) {
                if (result) {
                    $('#name-id').val(result.id);
                    $('#name').val(result.name);
                    $('#txtPhoneNo').val("");
                    $('.customer-nic').text(result.nic);
                    $('.customer-email').text(result.email);
                    $('.customer-phone-number').text(result.mobile_number);
                    $('.customer-address').text(result.address);
                    $('#customer-details-section').removeClass('hidden');
                } else {
                    $('.customer-nic').text("");
                    $('.customer-email').text("");
                    $('.customer-phone-number').text("");
                    $('.customer-address').text("");
                    $('#customer-details-section').addClass('hidden');

                    var html = '';
                    html += '<div class="panel panel-info customer-not-found">';
                    html += '<div class="panel-body">';
                    html += '<div class="col-md-12">';
                    html += '<h6>This phone number is not exist in the system</h6>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';

                    $('#customer-not-found-section').empty();
                    $('#customer-not-found-section').append(html);
                }
            }

        });
    });

});