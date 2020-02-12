<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $COMMISSIONPAYMENT = new CommissionPayment($id);

    $DRIVER = new Driver($COMMISSIONPAYMENT->driver);
    $bookings = Booking::getBookingByPaymentID($id);
    $count = count($bookings);

    $commissions = DefaultData::getDriverCommission();
    foreach ($commissions as $key => $commission) {
        if ($key == $DRIVER->type) {
            $commission_rate = $commission;
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" >
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" >
        <title>View Commission Payment || WEB SITE CONTROL PANEL</title>
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
        <link href="plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
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
                                    View Commission Payment
                                </h2>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="manage-commission-payments.php">
                                            <i class="material-icons">list</i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <?php
                            $vali = new Validator();

                            $vali->show_message();
                            ?>
                            <div class="body tablebody1">
                                <!-- <div class="table-responsive">-->
                                <table class="table table-bordered table-striped table-hover" width="100%">
                                    <tr>
                                        <th>Payment ID </th>
                                        <td colspan="3"><?php echo '#' . $COMMISSIONPAYMENT->id; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Paid At</th>
                                        <td colspan="3"><?php echo $COMMISSIONPAYMENT->paidAt; ?></td>
                                    </tr>
                                    <tr>
                                        <th rowspan="<?php echo $count + 1; ?>">Booking Details</th>
                                        <td>ID</td>
                                        <td>Amount (Rs)</td>
                                        <td>Commission (Rs)</td>
                                    </tr>
                                    <?php
                                    foreach ($bookings as $booking) {
                                        ?>
                                        <tr>
                                            <td><?php echo '#' . $booking['id']; ?></td>
                                            <td class="text-right"><?php echo number_format($booking['total_cost'], 2); ?></td>
                                            <td class="text-right"><?php echo number_format($booking['total_cost'] * (int) $commission_rate / 100, 2); ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <th>Driver</th>
                                        <td colspan="3"><?php echo $DRIVER->name; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Total Commission (Rs)</th>
                                        <td colspan="3"><?php echo number_format($COMMISSIONPAYMENT->amount, 2); ?></td>
                                    </tr>
                                </table>
                                <button  class="btn btn-info m-t-15 waves-effect" onclick="javascript:history.go(-1)">Back</button>
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
        <script src="delete/js/user.js" type="text/javascript"></script>
    </body>
</html>

