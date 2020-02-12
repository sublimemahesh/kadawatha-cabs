<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
$date = '';
$vehicle_type = '';
$vehicle = '';
$driver = '';
$customer = '';
$package = '';
$owner = '';
if (isset($_GET['date'])) {
    $date = $_GET['date'];
}
if (isset($_GET['vehicle_type'])) {
    $vehicle_type = $_GET['vehicle_type'];
}
if (isset($_GET['vehicle'])) {
    $vehicle = $_GET['vehicle'];
}
if (isset($_GET['driver'])) {
    $driver = $_GET['driver'];
}
if (isset($_GET['customer'])) {
    $customer = $_GET['customer'];
}
if (isset($_GET['package'])) {
    $package = $_GET['package'];
}
if (isset($_GET['owner'])) {
    $owner = $_GET['owner'];
}


if (isset($_GET['search'])) {
    $allbookings = Booking::getsearchAll($date, $vehicle_type, $vehicle, $driver, $customer, $package, $owner);
} else {
    $allbookings = Booking::all();
}
$vtype = new VehicleType($vehicle_type);
$vehi = new Vehicle($vehicle);
$driv = new Driver($driver);
$cust = new Customer($customer);
$pack = new Packages($package);
$own = new Vehicle($owner);
?>
<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Manage Report|| WEB SITE CONTROL PANEL </title>
        <!-- Favicon-->
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link href="plugins/node-waves/waves.css" rel="stylesheet" />
        <link href="plugins/animate-css/animate.css" rel="stylesheet" />
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet">
        <link href="css/themes/all-themes.css" rel="stylesheet" />
        <link href="plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
    </head>

    <body class="theme-red">
        <?php
        include './navigation-and-header.php';
        ?>

        <section class="content">
            <div class="container-fluid">  

                <!-- Vertical Layout -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>Sales Report</h2>
                            </div>
                            <?php
                            $vali = new Validator();

                            $vali->show_message();
                            ?>
                            <div class="body">
                                <div class="row clearfix"></div>
                                <hr/>
                                <div class="row clearfix date-section">
                                    <div class="col-lg-6">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">From</label>
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
                                <div>
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable sales-report-table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Create date</th>
                                                <th>Vehicle Type</th>
                                                <th>Vehicle</th>
                                                <th>Driver</th>
                                                <th>Customer</th>
                                                <th>Package</th>
                                                <th>Owner</th>

                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Create date</th>
                                                <th>Vehicle Type</th>
                                                <th>Vehicle</th>
                                                <th>Driver</th>
                                                <th>Customer</th>
                                                <th>Package</th>
                                                <th>Owner</th>


                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            foreach ($allbookings as $key => $booking) {

                                                $key++;
                                                $CUSTOMERNAME = new Customer($booking['customer']);
                                                $DRIVER = new Driver($booking['driver']);
                                                $PACKAGEE = new Packages($booking['package']);
                                                $VEHICLE = new Vehicle($booking['vehicle']);
                                                $VEHICLETYPE = new VehicleType($VEHICLE->vehicle_type);
                                                ?>
                                                <tr id="row_<?php echo $booking['id']; ?>">
                                                    <td><?php echo $booking['id'] ?></td>
                                                    <td><?php echo $booking['created_at']; ?></td>
                                                    <td><?php echo $VEHICLETYPE->type; ?></td>
                                                    <td><?php echo $VEHICLE->vehicle_name; ?></td>
                                                    <td><?php echo $DRIVER->name; ?></td>
                                                    <td><?php echo $CUSTOMERNAME->fullname ?></td>
                                                    <td><?php echo $PACKAGEE->name; ?></td>
                                                    <td><?php echo $VEHICLE->owner; ?></td>

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


                <!-- #END# Vertical Layout -->

            </div>
        </section>

        <!-- Jquery Core Js -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <script src="plugins/bootstrap/js/bootstrap.js"></script> 
        <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="plugins/node-waves/waves.js"></script>
        <script src="js/admin.js"></script>
        <script src="js/demo.js"></script>
        <script src="js/add-new-ad.js" type="text/javascript"></script>
        <script src="plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
        <script src="tinymce/js/tinymce/tinymce.min.js"></script>
        <script src="js/vehicle-suggection.js" type="text/javascript"></script>
        <script src="js/driver-suggection.js" type="text/javascript"></script>
        <script src="js/cus-suggection.js" type="text/javascript"></script>
        <script src="js/package-suggection.js" type="text/javascript"></script>
        <script src="js/owner-suggection.js" type="text/javascript"></script>
        <script src="js/vehicle-type-suggection.js" type="text/javascript"></script>
        <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
        <script src="js/pages/tables/jquery-datatable.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="js/sales-report.js" type="text/javascript"></script>
        <script src="plugins/loader/js/jquery.loading.block.js" type="text/javascript"></script>
        <script>
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