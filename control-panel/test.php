<?php
include_once(dirname(__FILE__) . '/../class/include.php');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title> Create Vehicle || WEB SITE CONTROL PANEL </title>
        <!-- Favicon-->
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="plugins/node-waves/waves.css" rel="stylesheet" />
        <link href="plugins/animate-css/animate.css" rel="stylesheet" />
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
        <!--<link href="css/style.css" rel="stylesheet">-->
        <!--<link href="css/themes/all-themes.css" rel="stylesheet" />-->
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/flick/jquery-ui.css">
        <link href="plugins/Timepicker/dist/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css"/>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="plugins/Timepicker/dist/jquery-ui-sliderAccess.js" type="text/javascript"></script>
        <script src="plugins/Timepicker/dist/jquery-ui-timepicker-addon.js" type="text/javascript"></script>
        <!-- Optional -->
        <script src="plugins/Timepicker/dist/i18n/jquery-ui-timepicker-addon-i18n.min.js" type="text/javascript"></script>
    </head>


    <body>
        <input type="text" id="datepicker">
        <script>
            $('#datepicker').datetimepicker({
                dateFormat: 'yy-mm-dd',
                timeFormat: "HH:mm:ss",
            });
        </script>
        <!-- Jquery Core Js -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap Core Js -->
        <script src="plugins/bootstrap/js/bootstrap.js"></script>
        <!-- Select Plugin Js -->
        <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>
        <!-- Slimscroll Plugin Js -->
        <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
        <!-- Waves Effect Plugin Js -->
        <script src="plugins/node-waves/waves.js"></script>
        <!-- Jquery DataTable Plugin Js -->

        <script src="plugins/sweetalert/sweetalert.min.js"></script>
        <!-- Custom Js -->
        <script src="js/admin.js"></script>
        <!-- Demo Js -->
        <script src="js/demo.js"></script>
        <script src="js/user-permission.js" type="text/javascript"></script>
    </body>
</html>