$('#vehicle').keyup(function (e) {

    var nameId = $('#vehicle-id').val();
    if (e.which != 38) {
        if (e.which != 40) {
            if (e.which != 13) {
                var keyword = $('#vehicle').val();
                if (keyword == '') {
                    $('#vehicle-list-append').empty();
                }
                $.ajax({
                    type: 'POST',
                    url: 'js/ajax/vehicle-suggestion.php',
                    dataType: "json",
                    data: {keyword: keyword, option: 'GETNAME'},
                    success: function (result) {

                        var html = '';
                        $.each(result, function (key) {

                            if (key < 20) {
                                if (key === 0) {
//                                    html += '<li id="c' + this.id + '" class="name">' + this.name + '</li>';
                                    html += '<li id="c' + this.id + '" class="name selected">' + this.vehicle_name + '</li>';
                                } else {
                                    html += '<li id="c' + this.id + '" class="name">' + this.vehicle_name + '</li>';
                                }

                            }

                        });
                        $('#vehicle-list-append').empty();
                        $('#vehicle-list-append').append(html);
                    }
                });
            }
        }
    }

});
$('#vehicle-list-append').on('click', '.name', function () {

    var consigneeId = this.id;
    var consignee = $(this).text();
    $('#vehicle-id').val(consigneeId.replace("c", ""));
    $('#vehicle').val(consignee);
    $('#vehicle-list-append').empty();
    $('#vehicle').change(function () {
        $('#vehicle-id').val("");
    });
});
$('#vehicle-list-append').on('mouseover', '.name', function () {
    var consigneeId = this.id;
    var consignee = $(this).text();
    $('#vehicle-id').val(consigneeId.replace("c", ""));
    $('#vehicle').val(consignee);
    $('#vehicle').change(function () {
        $('#vehicle-id').val("");
    });
});


$('#vehicle').keydown(function (e) {
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
            $('#vehicle').val(consignee);
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
            $('#vehicle').val(consignee);
        }

    } else if (e.which === 13) {
        e.preventDefault();
        var selected = $('.selected').attr("id");
//            var consigneename = $('.selected').text();
        var consigneeId = selected.replace("c", "");
        $('#vehicle-id').val(consigneeId);
        $('#vehicle').attr('attempt', 1);

        var consigneename = $('li.selected').text();
        $('#vehicle').val(consigneename);

        $('#vehicle-list-append').empty();

        $('#vehicle').change(function (e) {
            $('#vehicle').attr('attempt', 0);

        });
    }
});
$('#vehicle').change(function () {
    if ($('#vehicle').attr('attempt') != 1) {
        $('#vehicle-id').val("");
    }

});


