$('#driver').keyup(function (e) {

    var nameId = $('#driver-id').val();
    if (e.which != 38) {
        if (e.which != 40) {
            if (e.which != 13) {
                var keyword = $('#driver').val();
                if (keyword == '') {
                    $('#driver-list-append').empty();
                }
                $.ajax({
                    type: 'POST',
                    url: 'js/ajax/driver-suggestion.php',
                    dataType: "json",
                    data: {keyword: keyword, option: 'GETNAME'},
                    success: function (result) {

                        var html = '';
                        $.each(result, function (key) {

                            if (key < 20) {
                                if (key === 0) {
//                                    html += '<li id="c' + this.id + '" class="name">' + this.name + '</li>';
                                    html += '<li id="c' + this.id + '" class="name selected">' + this.name + '</li>';
                                } else {
                                    html += '<li id="c' + this.id + '" class="name">' + this.name + '</li>';
                                }

                            }

                        });
                        $('#driver-list-append').empty();
                        $('#driver-list-append').append(html);
                    }
                });
            }
        }
    }

});
$('#driver-list-append').on('click', '.name', function () {

    var consigneeId = this.id;
    var consignee = $(this).text();
    $('#driver-id').val(consigneeId.replace("c", ""));
    $('#driver').val(consignee);
    $('#driver-list-append').empty();
    $('#driver').change(function () {
        $('#driver-id').val("");
    });
});
$('#driver-list-append').on('mouseover', '.name', function () {
    var consigneeId = this.id;
    var consignee = $(this).text();
    $('#driver-id').val(consigneeId.replace("c", ""));
    $('#driver').val(consignee);
    $('#driver').change(function () {
        $('#driver-id').val("");
    });
});


$('#driver').keydown(function (e) {
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
            $('#driver').val(consignee);
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
            $('#driver').val(consignee);
        }

    } else if (e.which === 13) {
        e.preventDefault();
        var selected = $('.selected').attr("id");
//            var consigneename = $('.selected').text();
        var consigneeId = selected.replace("c", "");
        $('#driver-id').val(consigneeId);
        $('#driver').attr('attempt', 1);

        var consigneename = $('li.selected').text();
        $('#driver').val(consigneename);

        $('#driver-list-append').empty();

        $('#driver').change(function (e) {
            $('#driver').attr('attempt', 0);

        });
    }
});
$('#driver').change(function () {
    if ($('#driver').attr('attempt') != 1) {
        $('#driver-id').val("");
    }

});


