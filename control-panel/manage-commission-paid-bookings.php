<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" >
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" >
        <title>Manage Commission Paid Bookings || WEB SITE CONTROL PANEL </title>
        <!-- Favicon-->
        <link rel="icon" href="favicon.ico" type="image/x-icon" >
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css" >
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css" >
        <!-- Bootstrap Core Css -->
        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet" >
        <!-- Waves Effect Css -->
        <link href="plugins/node-waves/waves.css" rel="stylesheet" >
        <!-- Animation Css -->
        <link href="plugins/animate-css/animate.css" rel="stylesheet">
        <!-- JQuery DataTable Css -->
        <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet"  >
        <!-- Custom Css -->
        <link href="css/style.css" rel="stylesheet" >
        <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
        <link href="css/themes/all-themes.css" rel="stylesheet"  >
    </head>
    <body class="theme-red">
        <?php
        include './navigation-and-header.php';
        ?>
        <section class="content">
            <div class="container-fluid">

                <!-- Manage tour -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Manage Commission Paid Bookings
                                </h2>
                            </div>
                            <?php
                            $vali = new Validator();

                            $vali->show_message();
                            ?>
                            <div class="body">
                                <!-- <div class="table-responsive">-->
                                <div>
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Customer</th>
                                                <th>Driver</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Total Cost (Rs)</th>
                                                <th>Commission (Rs)</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Customer</th>
                                                <th>Driver</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Total Cost (Rs)</th>
                                                <th>Commission (Rs)</th>
                                                <th>Options</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            foreach (Booking::getAllCommissionPaidBookings() as $key => $booking) {
                                                $key++;
                                                $CUSTOMERNAME = new Customer($booking['customer']);
                                                $DRIVER = new Driver($booking['driver']);
                                                $rate = 0;
                                                foreach (DefaultData::getDriverCommission() as $key1 => $commission) {
                                                    if ($key1 == $DRIVER->type) {
                                                        $rate = $commission;
                                                    }
                                                };
                                                $tot_commission = (float) $booking['total_cost'] * (float) $rate / 100;
                                                ?>
                                                <tr id="row_<?php echo $booking['id']; ?>">
                                                    <td><?php echo $key ?></td>
                                                    <td><?php echo $CUSTOMERNAME->fullname ?></td>
                                                    <td><?php echo $DRIVER->name ?></td>
                                                    <td><?php echo $booking['start_date']; ?></td>
                                                    <td><?php echo $booking['end_date']; ?></td>
                                                    <td style="text-align: right;"><?php echo number_format($booking['total_cost'], 2); ?></td>
                                                    <td style="text-align: right;"><?php echo number_format($tot_commission, 2); ?></td>

                                                    <td> 
                                                        <a href="view-payment.php?id=<?php echo $booking['paid_commission']; ?>"> <button class="glyphicon glyphicon-eye-open edit-btn" title="Edit Booking"></button></a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>  
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Manage District -->
        </section>
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
        <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
        <script src="plugins/sweetalert/sweetalert.min.js"></script>
        <!-- Custom Js -->
        <script src="js/admin.js"></script>
        <script src="js/pages/tables/jquery-datatable.js"></script>
        <!-- Demo Js -->
        <script src="js/demo.js"></script>
        <script src="delete/js/booking.js" type="text/javascript"></script>
    </body>
</html>

