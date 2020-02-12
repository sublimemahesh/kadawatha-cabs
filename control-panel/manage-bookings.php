<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$status1 = '';
if (isset($_GET['status'])) {
    $status1 = $_GET['status'];
    if ($status1 == 1) {
        $status = 'pending';
    } elseif ($status1 == 2) {
        $status = 'confirmed';
    } elseif ($status1 == 3) {
        $status = 'completed';
    } elseif ($status1 == 4) {
        $status = 'canceled';
    }
}
$date = '';
if (isset($_GET['today'])) {
    date_default_timezone_set('Asia/Colombo');
    $date = ' - ' . date('Y-m-d');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" >
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" >
        <title>Manage <?php echo ucfirst($status); ?> Bookings || WEB SITE CONTROL PANEL </title>
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
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/flick/jquery-ui.css">
        <style>
            .btn-m-b-5 {
                margin-bottom: 5px;
            }
        </style>
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
                                    Manage <?php
                                    if ($status == 'completed') {
                                        echo 'Completed Hires' . $date;
                                    } else {
                                        echo ucfirst($status) . ' Bookings' . $date;
                                    }
                                    ?>
                                </h2>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="create-booking.php">
                                            <i class="material-icons">add</i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <?php
                            $vali = new Validator();

                            $vali->show_message();
                            ?>
                            <div class="body">
                                <?php
                                if (($status1 == 2 && !isset($_GET['today'])) || ($status1 == 3 && !isset($_GET['today']))) {
                                    ?>
                                    <div class="row clearfix"></div>
                                    <div class="row clearfix date-section">
                                        <div class="col-lg-6">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="from">From</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" id="from" class="form-control"  autocomplete="off" name="from" placeholder="Enter Date">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="to">To</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" id="to" class="form-control"  autocomplete="off" name="to" placeholder="Enter Date">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div>
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="booking">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Reference No</th>
                                                <th>Customer</th>
                                                <th>NIC</th>
                                                <th>Created At</th>
                                                <th>Start Date</th>
                                                <th>Total Amount (Rs)</th>
                                                <?php
                                                if ($status1 == 2 || $status1 == 3) {
                                                    ?>
                                                    <th>Paid Amount (Rs)</th>
                                                    <th>Due Amount (Rs)</th>
                                                    <?php
                                                }
                                                ?>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Reference No</th>
                                                <th>Customer</th>
                                                <th>NIC</th>
                                                <th>Created At</th>
                                                <th>Start Date</th>
                                                <th>Total Amount (Rs)</th>
                                                <?php
                                                if ($status1 == 2 || $status1 == 3) {
                                                    ?>
                                                    <th>Paid Amount (Rs)</th>
                                                    <th>Due Amount (Rs)</th>
                                                    <?php
                                                }
                                                ?>
                                                <th>Options</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            if (isset($_GET['today'])) {
                                                $bookings = Booking::getTodayBookingsByStatus($status);
                                            } else {
                                                $bookings = Booking::getBookingsByStatus($status);
                                            }
                                            foreach ($bookings as $key => $booking) {
                                                $key++;
                                                $CUSTOMER = new Customer($booking['customer']);
                                                ?>
                                                <tr id="row_<?php echo $booking['id']; ?>">
                                                    <td><?php echo $key ?></td>
                                                    <td><?php echo $booking['reference_no']; ?></td>
                                                    <td><?php echo $CUSTOMER->fullname; ?></td>
                                                    <td><?php echo $CUSTOMER->nic; ?></td>
                                                    <td><?php echo $booking['created_at']; ?></td>
                                                    <td><?php echo $booking['start_date']; ?></td>
                                                    <td class="text-right"><?php echo $booking['total_cost']; ?></td>
                                                    <?php
                                                    if ($status1 == 2 || $status1 == 3) {
                                                        $payments = BookingPayment::getPaymentsByBookingID($booking['id']);
                                                        $tot = 0;

                                                        foreach ($payments as $payment) {
                                                            $tot += (float) $payment['advanced_total'];
                                                        }
                                                        ?>
                                                        <td><?php echo number_format($tot, 2); ?></td>
                                                        <td><?php echo number_format($booking['total_cost'] - $tot, 2); ?></td>
                                                        <?php
                                                    }
                                                    ?>
                                                    <td> 
                                                        <a href="edit-booking.php?id=<?php echo $booking['id']; ?>"> <button class="glyphicon glyphicon-pencil edit-btn" title="Edit Booking"></button></a>

                                                        <?php
                                                        if ($booking['status'] == 'pending') {
                                                            ?>
                                                            |
                                                            <a href="#"  class="do-payment"  data-id="<?php echo $booking['id']; ?>" total-cost="<?php echo $booking['total_cost']; ?>">
                                                                <button class="glyphicon glyphicon-usd confirmed-btn" data-toggle="modal" data-target="#payment-modal"  title="Advanced Payment"></button>
                                                            </a>
                                                            |
                                                            <a href="#"  class="cancel-booking" data-id="<?php echo $booking['id']; ?>">
                                                                <button class="glyphicon glyphicon-remove-circle arrange-btn" title="Mark as Canceled"></button>
                                                            </a>
                                                            <?php
                                                        } elseif ($booking['status'] == 'confirmed') {
                                                            ?>
                                                            |
                                                            <a href="#"  class="do-payment"  data-id="<?php echo $booking['id']; ?>" total-cost="<?php echo $booking['total_cost']; ?>">
                                                                <button class="glyphicon glyphicon-usd confirmed-btn" data-toggle="modal" data-target="#payment-modal"  title="Advanced Payment"></button>
                                                            </a>
                                                            |
                                                            <a href="#"  class="mark-as-completed" data-id="<?php echo $booking['id']; ?>">
                                                                <button class="glyphicon glyphicon-ok confirmed-btn" title="Mark as Completed"></button>
                                                            </a>
                                                            |
                                                            <a href="#"  class="cancel-booking" data-id="<?php echo $booking['id']; ?>">
                                                                <button class="glyphicon glyphicon-remove-circle arrange-btn" title="Mark as Canceled"></button>
                                                            </a>
                                                            <?php
                                                        } elseif ($booking['status'] == 'completed') {
                                                            ?>

                                                            <?php
                                                        } elseif ($booking['status'] == 'canceled') {
                                                            ?>
                                                            <a href="#"  class="delete-booking" data-id="<?php echo $booking['id']; ?>">
                                                                <button class="glyphicon glyphicon-trash delete-btn delete-booking" title="Delete Booking" data-id="<?php echo $booking['id']; ?>"></button>
                                                            </a>
                                                            <?php
                                                        }
                                                        ?>

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

            <div class="modal fade" id="payment-modal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" id="exampleModalLabel">Advanced Payment</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="receipt_no">Receipt No.</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="receipt_no" class="form-control"  autocomplete="off" name="receipt_no" required="true" placeholder="Receipt No">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="receipt_date">Receipt Date</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="receipt_date" class="form-control"  autocomplete="off" name="receipt_date" placeholder="Receipt Date" >
                                        </div>
                                    </div>  
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="total_amount">Total Amount (Rs)</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="total_amount" class="form-control" value="" readonly="">
                                        </div>
                                    </div>
                                </div>    
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="paid_amount">Paid Amount (Rs)</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="paid_amount" class="form-control" readonly="">
                                        </div>
                                    </div>
                                </div>    
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="due_amount">Due Amount (Rs)</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="due_amount" class="form-control" readonly="">
                                        </div>
                                    </div>
                                </div>    
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="payment">Payment (Rs)</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="payment" class="form-control"  autocomplete="off" name="payment" placeholder="payment">
                                        </div>
                                    </div>
                                </div>    
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                                    <label for="received_by">Received By</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="received_by" class="form-control"  autocomplete="off" name="received_by" placeholder="Received By">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                <button type="button" class="btn btn-primary" id="payment-btn" booking="" total-amount="">Save</button>
                            </div>
                            <div class="row clearfix">  </div>
                            <hr/>
                            <!--</form>-->
                        </div>

                    </div>
                </div>
            </div>
            <input type="hidden" id="booking_status" value="<?php echo $status; ?>">
            <input type="hidden" id="today_booking" value="<?php echo $date; ?>">
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
        <script src="js/booking.js" type="text/javascript"></script>
        <script src="js/advanced-payment.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script>
            $('#receipt_date').datepicker({
                dateFormat: 'yy-mm-dd'
            });
            $(function () {
                $("#from").datepicker({dateFormat: 'yy-mm-dd'});
                $("#to").datepicker({dateFormat: 'yy-mm-dd'});
            });
            $("#from").change(function () {
                var new_date = new Date($('#from').val());
                new_date.setDate(new_date.getDate());

                var minDate = $(this).datepicker('getDate');
                minDate.setDate(minDate.getDate()); //add two days
                $("#to").datepicker("option", "minDate", minDate);
            });
        </script>
    </body>
</html>

