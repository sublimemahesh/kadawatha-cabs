$('#package').keyup(function (e) {
 
    var nameId = $('#package-id').val();
    if (e.which != 38) {
        if (e.which != 40) {
            if (e.which != 13) {
                var keyword = $('#package').val();
                if (keyword == '') {
                    $('#package-list-append').empty();
                }
                $.ajax({
                    type: 'POST',
                    url: 'js/ajax/package-suggestion.php',
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
                        $('#package-list-append').empty();
                        $('#package-list-append').append(html);
                    }
                });
            }
        }
    }

});
$('#package-list-append').on('click', '.name', function () {

    var consigneeId = this.id;
    var consignee = $(this).text();
    $('#package-id').val(consigneeId.replace("c", ""));
    $('#package').val(consignee);
    $('#package-list-append').empty();
    $('#package').change(function () {
        $('#package-id').val("");
    });
});
$('#package-list-append').on('mouseover', '.name', function () {
    var consigneeId = this.id;
    var consignee = $(this).text();
    $('#package-id').val(consigneeId.replace("c", ""));
    $('#package').val(consignee);
    $('#package').change(function () {
        $('#package-id').val("");
    });
});


$('#package').keydown(function (e) {
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
            $('#package').val(consignee);
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
            $('#package').val(consignee);
        }

    } else if (e.which === 13) {
        e.preventDefault();
        var selected = $('.selected').attr("id");
//            var consigneename = $('.selected').text();
        var consigneeId = selected.replace("c", "");
        $('#package-id').val(consigneeId);
        $('#package').attr('attempt', 1);

        var consigneename = $('li.selected').text();
        $('#package').val(consigneename);

        $('#package-list-append').empty();

        $('#package').change(function (e) {
            $('#package').attr('attempt', 0);

        });
    }
});
$('#package').change(function () {
    if ($('#package').attr('attempt') != 1) {
        $('#package-id').val("");
    }

});


