$('#customer').keyup(function (e) {

    var nameId = $('#customer-id').val();
    if (e.which != 38) {
        if (e.which != 40) {
            if (e.which != 13) {
                var keyword = $('#customer').val();
                if (keyword == '') {
                    $('#customer-list-append').empty();
                }
                $.ajax({
                    type: 'POST',
                    url: 'js/ajax/cus-suggestion.php',
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
                        $('#customer-list-append').empty();
                        $('#customer-list-append').append(html);
                    }
                });
            }
        }
    }

});
$('#customer-list-append').on('click', '.name', function () {

    var consigneeId = this.id;
    var consignee = $(this).text();
    $('#customer-id').val(consigneeId.replace("c", ""));
    $('#customer').val(consignee);
    $('#customer-list-append').empty();
    $('#customer').change(function () {
        $('#customer-id').val("");
    });
});
$('#customer-list-append').on('mouseover', '.name', function () {
    var consigneeId = this.id;
    var consignee = $(this).text();
    $('#customer-id').val(consigneeId.replace("c", ""));
    $('#customer').val(consignee);
    $('#customer').change(function () {
        $('#customer-id').val("");
    });
});


$('#customer').keydown(function (e) {
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
            $('#customer').val(consignee);
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
            $('#customer').val(consignee);
        }

    } else if (e.which === 13) {
        e.preventDefault();
        var selected = $('.selected').attr("id");
//            var consigneename = $('.selected').text();
        var consigneeId = selected.replace("c", "");
        $('#customer-id').val(consigneeId);
        $('#customer').attr('attempt', 1);

        var consigneename = $('li.selected').text();
        $('#customer').val(consigneename);

        $('#customer-list-append').empty();

        $('#customer').change(function (e) {
            $('#customer').attr('attempt', 0);

        });
    }
});
$('#customer').change(function () {
    if ($('#customer').attr('attempt') != 1) {
        $('#customer-id').val("");
    }

});


