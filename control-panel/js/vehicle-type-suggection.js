$('#vehicle_type').keyup(function (e) {
  
    var nameId = $('#vehicle_type-id').val();
    if (e.which != 38) {
        if (e.which != 40) {
            if (e.which != 13) {
                var keyword = $('#vehicle_type').val();
                if (keyword == '') {
                    $('#vehicle_type-list-append').empty();
                }
                $.ajax({
                    type: 'POST',
                    url: 'js/ajax/vehicle-type-suggestion.php',
                    dataType: "json",
                    data: {keyword: keyword, option: 'GETNAME'},
                    success: function (result) {

                        var html = '';
                        $.each(result, function (key) {

                            if (key < 20) {
                                if (key === 0) {
//                                    html += '<li id="c' + this.id + '" class="name">' + this.name + '</li>';
                                    html += '<li id="c' + this.id + '" class="name selected">' + this.type + '</li>';
                                } else {
                                    html += '<li id="c' + this.id + '" class="name">' + this.type + '</li>';
                                }

                            }

                        });
                        $('#vehicle_type-list-append').empty();
                        $('#vehicle_type-list-append').append(html);
                    }
                });
            }
        }
    }

});
$('#vehicle_type-list-append').on('click', '.name', function () {

    var consigneeId = this.id;
    var consignee = $(this).text();
    $('#vehicle_type-id').val(consigneeId.replace("c", ""));
    $('#vehicle_type').val(consignee);
    $('#vehicle_type-list-append').empty();
    $('#vehicle_type').change(function () {
        $('#vehicle_type-id').val("");
    });
});
$('#vehicle_type-list-append').on('mouseover', '.name', function () {
    var consigneeId = this.id;
    var consignee = $(this).text();
    $('#vehicle_type-id').val(consigneeId.replace("c", ""));
    $('#vehicle_type').val(consignee);
    $('#vehicle_type').change(function () {
        $('#vehicle_type-id').val("");
    });
});


$('#vehicle_type').keydown(function (e) {
    var $selected = $('li.selected'), $li = $('li.name');
//    var key_code = e.which || e.keyCode;
    if (e.keyCode == 40) {

        var res = $selected.removeClass('selected').next().addClass('selected');

        if ($selected.next().length == 0) {
            $li.eq(0).addClass('selected');
        }
        if (res) {
//                var consigneeId = $('li.selected').attr('id');
            var consignee = $('li.selected').text();
//                $('#name-id').val(consigneeId.replace("c", ""));
            $('#vehicle_type').val(consignee);
        }

    } else if (e.keyCode === 38) {
        var res = $selected.removeClass('selected').prev().addClass('selected');
        if ($selected.prev().length == 0) {
            $li.eq(-1).addClass('selected');
        }
        if (res) {
//                var consigneeId = $('li.selected').attr('id');
            var consignee = $('li.selected').text();
//                $('#name-id').val(consigneeId.replace("c", ""));
            $('#vehicle_type').val(consignee);
        }

    } else if (e.which === 13) {
        e.preventDefault();
        var selected = $('.selected').attr("id");
//            var consigneename = $('.selected').text();
        var consigneeId = selected.replace("c", "");
        $('#vehicle_type-id').val(consigneeId);
        $('#vehicle_type').attr('attempt', 1);

        var consigneename = $('li.selected').text();
        $('#vehicle_type').val(consigneename);

        $('#vehicle_type-list-append').empty();

        $('#vehicle_type').change(function (e) {
            $('#vehicle_type').attr('attempt', 0);

        });
    }
});
$('#vehicle_type').change(function () {
    if ($('#vehicle_type').attr('attempt') != 1) {
        $('#vehicle_type-id').val("");
    }

});


