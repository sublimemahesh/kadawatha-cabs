$('#owner').keyup(function (e) {

    var nameId = $('#owner-id').val();
    if (e.which != 38) {
        if (e.which != 40) {
            if (e.which != 13) {
                var keyword = $('#owner').val();
                if (keyword == '') {
                    $('#owner-list-append').empty();
                }
                $.ajax({
                    type: 'POST',
                    url: 'js/ajax/owner-suggestion.php',
                    dataType: "json",
                    data: {keyword: keyword, option: 'GETNAME'},
                    success: function (result) {

                        var html = '';
                        $.each(result, function (key) {
                         
                            if (key < 20) {
                                if (key === 0) {
//                                    html += '<li id="c' + this.id + '" class="name">' + this.name + '</li>';
                                    html += '<li id="c' + this.id + '" class="name selected">' + this.owner + '</li>';
                                } else {
                                    html += '<li id="c' + this.id + '" class="name">' + this.owner + '</li>';
                                }

                            }

                        });
                        $('#owner-list-append').empty();
                        $('#owner-list-append').append(html);
                    }
                });
            }
        }
    }

});
$('#owner-list-append').on('click', '.name', function () {
  
    var consigneeId = this.id;
    var consignee = $(this).text();
    $('#owner-id').val(consigneeId.replace("c", ""));
    $('#owner').val(consignee);
    $('#owner-list-append').empty();
    $('#owner').change(function () {
        $('#owner-id').val("");
    });
});
$('#owner-list-append').on('mouseover', '.name', function () {
    var consigneeId = this.id;
    var consignee = $(this).text();
    $('#owner-id').val(consigneeId.replace("c", ""));
    $('#owner').val(consignee);
    $('#owner').change(function () {
        $('#owner-id').val("");
    });
});


$('#owner').keydown(function (e) {
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
            $('#owner').val(consignee);
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
            $('#owner').val(consignee);
        }

    } else if (e.which === 13) {
        e.preventDefault();
        var selected = $('.selected').attr("id");
//            var consigneename = $('.selected').text();
        var consigneeId = selected.replace("c", "");
        $('#owner-id').val(consigneeId);
        $('#owner').attr('attempt', 1);

        var consigneename = $('li.selected').text();
        $('#owner').val(consigneename);

        $('#owner-list-append').empty();

        $('#owner').change(function (e) {
            $('#owner').attr('attempt', 0);

        });
    }
});
$('#owner').change(function () {
    if ($('#owner').attr('attempt') != 1) {
        $('#owner-id').val("");
    }

});


