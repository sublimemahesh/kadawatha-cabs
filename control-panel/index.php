<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$PENDING_BOOKINGS = count(Booking::getBookingsByStatus('pending'));
$CONFIRMED_BOOKINGS = count(Booking::getTodayBookingsByStatus('confirmed'));
$COMPLETED_BOOKINGS = count(Booking::getTodayBookingsByStatus('completed'));
$CANCELED_BOOKINGS = count(Booking::getTodayBookingsByStatus('canceled'));
?> 
<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <!--<meta http-equiv="X-UA-Compatible" content="IE=Edge">-->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Dashbord - www.synotec.lk</title>
        <!-- Favicon-->
        <link rel="icon" href="favicon.ico" type="image/x-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="plugins/node-waves/waves.css" rel="stylesheet" />
        <link href="plugins/animate-css/animate.css" rel="stylesheet" />
        <link href="plugins/morrisjs/morris.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet">
        <link href="css/themes/all-themes.css" rel="stylesheet" />
        <link href="css/fullcalendar.css" rel="stylesheet" type="text/css"/>
        <link href="calendar/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <style>
        .list-group a:hover{
            text-decoration: none;
        }
        .list-group-item{
            text-align: center !important;
        }
    </style>
    <body class="theme-red">
        <?php
        include './navigation-and-header.php';
        ?>
        <section class="content">
            <div class="container-fluid">

                <?php
                if (isset($_GET['message'])) {

                    $MESSAGE = New Message($_GET['message']);
                    ?>
                    <div class="alert alert-<?php echo $MESSAGE->status; ?>" role = "alert">
                        <?php echo $MESSAGE->description; ?>
                    </div>
                    <?php
                }
                ?>


                <div class="block-header">
                    <h2>DASHBOARD</h2>
                </div>


                <!-- Calender -->
                <div id="calander-bar">
                    <div class="row">
                        <div class="col-sm-12" id="calendar">
                            <div class="tab-pane fade active in" id="hotels-tab"> 
                                <div class="row search-avalable-bar" id="result"  align="center"> 
                                </div>
                                <div class="row" align="center" style="margin-top: 6px;">
                                    <button id="back" class="calendar-navigation"> << Back </button>
                                    <button id="next" class="calendar-navigation"> Next >> </button> 
                                    <input type="hidden" id="month" value="<?php echo date('m'); ?>">
                                    <input  type="hidden" id="year" value="<?php echo date('Y'); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Calender -->
                <!-- Widgets -->
                <div class="row clearfix">
                    <a href="manage-bookings.php?status=1">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box bg-pink hover-expand-effect">
                                <div class="icon">
                                    <i class="material-icons">library_books</i>
                                </div>
                                <div class="content">
                                    <div class="text">PENDING BOOKINGS <span>(All)</span></div>
                                    <div class="number count-to" data-from="0" data-to="<?php echo $PENDING_BOOKINGS; ?>" data-speed="1000" data-fresh-interval="20"></div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="manage-bookings.php?status=2&today">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box bg-cyan hover-expand-effect">
                                <div class="icon">
                                    <i class="material-icons">library_books</i>
                                </div>
                                <div class="content">
                                    <div class="text">CONFIRMED BOOKINGS <span>(Today)</span></div>
                                    <div class="number count-to" data-from="0" data-to="<?php echo $CONFIRMED_BOOKINGS; ?>" data-speed="1000" data-fresh-interval="20"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="manage-bookings.php?status=3&today">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box bg-light-green hover-expand-effect">
                                <div class="icon">
                                    <i class="material-icons">library_books</i>
                                </div>
                                <div class="content">
                                    <div class="text">COMPLETED BOOKINGS <span>(Today)</span></div>
                                    <div class="number count-to" data-from="0" data-to=" <?php echo $COMPLETED_BOOKINGS; ?>" data-speed="1500" data-fresh-interval="1"></div>

                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="manage-bookings.php?status=4&today">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box bg-orange hover-expand-effect">
                                <div class="icon">
                                    <i class="material-icons">library_books</i>
                                </div>
                                <div class="content">
                                    <div class="text">CANCELED BOOKINGS <span>(Today)</span></div>
                                    <div class="number count-to" data-from="0" data-to=" <?php echo $CANCELED_BOOKINGS; ?>" data-speed="1500" data-fresh-interval="1"></div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="header bg-blue-grey">
                                <h2>
                                    BOOKINGS
                                </h2>
                                <ul class="header-dropdown m-r--5">
                                    <!--<div class="number count-to" data-from="0" data-to=" <?php echo $COUNT_VEHICLES; ?>" data-speed="1500" data-fresh-interval="1"></div>-->
                                </ul>
                            </div>
                            <div class="body">
                                <div class="list-group">
                                    <a href="create-booking.php"><button type="button" class="list-group-item">Add new</button></a>
                                    <a href="manage-all-bookings.php"><button type="button" class="list-group-item">Manage All</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="header bg-blue-grey">
                                <h2>
                                    REPORTS
                                </h2>
                                <ul class="header-dropdown m-r--5">
                                    <!--<div class="number count-to" data-from="0" data-to=" <?php echo $COUNT_DRIVERS; ?>" data-speed="1500" data-fresh-interval="1"></div>-->
                                </ul>
                            </div>
                            <div class="body">
                                <div class="list-group">
                                    <a href="sales-report.php"><button type="button" class="list-group-item">Sales Report</button></a>
                                    <a href="commission-report.php"><button type="button" class="list-group-item">Commission Report</button></a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="header bg-blue-grey">
                                <h2>
                                    VEHICLES
                                </h2>
                                <ul class="header-dropdown m-r--5">
                                    <!--<div class="number count-to" data-from="0" data-to=" <?php echo $COUNT_PACKAGES; ?>" data-speed="1500" data-fresh-interval="1"></div>-->
                                </ul>
                            </div>
                            <div class="body">
                                <div class="list-group">
                                    <a href="create-vehicle.php"><button type="button" class="list-group-item">Add new</button></a>
                                    <a href="manage-vehicle.php"><button type="button" class="list-group-item">Manage All</button></a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="header bg-blue-grey">
                                <h2>
                                    PACKAGES
                                </h2>
                                <ul class="header-dropdown m-r--5">
                                    <!--<div class="number count-to" data-from="0" data-to=" <?php echo $COUNT_BOOKINGS; ?>" data-speed="1500" data-fresh-interval="1"></div>-->
                                </ul>
                            </div>
                            <div class="body">

                                <div class="list-group">
                                    <a href="create-packages.php"><button type="button" class="list-group-item">Add new</button></a>
                                    <a href="manage-packages.php"><button type="button" class="list-group-item">Manage All</button></a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- #END# Widgets -->

                </div>

        </section>

        <!-- Jquery Core Js -->
        <script src="plugins/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core Js -->
        <script src="plugins/bootstrap/js/bootstrap.js"></script>
        <script src="js/fullcalendar.min.js" type="text/javascript"></script>
        <script src="js/calender.js" type="text/javascript"></script>

        <!-- Select Plugin Js -->
        <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

        <!-- Slimscroll Plugin Js -->
        <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

        <!-- Waves Effect Plugin Js -->
        <script src="plugins/node-waves/waves.js"></script>

        <!-- Jquery CountTo Plugin Js -->
        <script src="plugins/jquery-countto/jquery.countTo.js"></script>

        <!-- Morris Plugin Js -->
        <script src="plugins/raphael/raphael.min.js"></script>
        <script src="plugins/morrisjs/morris.js"></script>

        <!-- ChartJs -->
        <script src="plugins/chartjs/Chart.bundle.js"></script>

        <!-- Flot Charts Plugin Js -->
        <script src="plugins/flot-charts/jquery.flot.js"></script>
        <script src="plugins/flot-charts/jquery.flot.resize.js"></script>
        <script src="plugins/flot-charts/jquery.flot.pie.js"></script>
        <script src="plugins/flot-charts/jquery.flot.categories.js"></script>
        <script src="plugins/flot-charts/jquery.flot.time.js"></script>

        <!-- Sparkline Chart Plugin Js -->
        <script src="plugins/jquery-sparkline/jquery.sparkline.js"></script>

        <!-- Custom Js -->
        <script src="js/admin.js"></script>
        <script src="js/pages/index.js"></script>

        <!-- Demo Js -->
        <script src="js/demo.js"></script>
        <!-- Calender -->

    </body>

</html>