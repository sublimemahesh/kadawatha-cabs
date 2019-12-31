$(document).ready(function () {

    $('.calendar-navigation').click(function () {
        var month = parseInt($('#month').val(), 10);
        var year = parseInt($('#year').val(), 10);

        if (this.id == 'next') {
            if (month == 12) {
                month = 0;
                $('#year').val(year + 1);
            }
            $('#month').val(month + 1);
        }

        if (this.id == 'back') {

            if (month == 1) {
                month = 13;
                $('#year').val(year - 1);
            }
            $('#month').val(month - 1);
        }

        var data = {
            "month": $('#month').val(),
            "year": $('#year').val()
        };

//        $.post("http://localhost/kadawatha-cabs/control-panel/calendar/calendar-controller.php", data, function(data) {
//            $("#result").html(data);
//        });
        $.post("https://kadawathacabs.synotec.lk/control-panel/calendar/calendar-controller.php", data, function (data) {
            $("#result").html(data);
        });
    });

    var data = {
        "month": $('#month').val(),
        "year": $('#year').val()
    };

//    $.post("http://localhost/kadawatha-cabs/control-panel/calendar/calendar-controller.php", data, function(data) {
//        $("#result").html(data);
//    });
    $.post("https://kadawathacabs.synotec.lk/control-panel/calendar/calendar-controller.php", data, function (data) {
        $("#result").html(data);
    });
});

