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
        <link href="plugins/node-waves/waves.css" rel="stylesheet" />
        <link href="plugins/animate-css/animate.css" rel="stylesheet" />
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet">
        <link href="css/themes/all-themes.css" rel="stylesheet" />
        <link href="plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>

    </head>

    <body class="theme-red">
        <?php
        include './navigation-and-header.php';
        ?>

        <section class="content">
            <div class="container-fluid">  
                <?php
                $vali = new Validator();

                $vali->show_message();
                ?>
                <!-- Vertical Layout -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>Manage Reports</h2>
                                <!--                                <ul class="header-dropdown">
                                                                    <li class="">
                                                                        <a href="manage-vehicle-type.php">
                                                                            <i class="material-icons">list</i> 
                                                                        </a>
                                                                    </li>
                                                                </ul>-->
                            </div>
                            <div class="body">
                                <form class="form-horizontal"  method="" action="view-report.php" enctype="multipart/form-data"> 
                                    <div class="row clearfix">
                                        <div class="col-lg-1 col-md-2 col-sm-4 col-xs-5">
                                            <label for="name" class="lblSerachAtt" >Date</label>
                                        </div>
                                        <div class="col-lg-1 col-md-10 col-sm-8 col-xs-7 filterby">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="datetime" id="name" class="form-control input-append date form_datetime" value="<?php echo $date ?>" autocomplete="off" name="date"  placeholder="Date">                                            
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-2 col-sm-4 col-xs-5 ">
                                            <label for="name" class="lblVtype">Vehicle Type</label>
                                        </div>
                                        <div class="col-lg-1 col-md-10 col-sm-8 col-xs-7 filterby">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="vehicle_type" class="form-control"  autocomplete="off"  value="<?php echo $vtype->type; ?>" attempt=""  placeholder="Vehicle Type">
                                                    <input type="hidden" name="vehicle_type" value="<?php echo $vtype->id; ?>" id="vehicle_type-id"  /> 
                                                    <div id="suggesstion-box">
                                                        <ul id="vehicle_type-list-append" class="name-list vty-list col-sm-offset-11"></ul>                                   
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-2 col-sm-4 col-xs-5 ">
                                            <label for="name" class="lblSerachAtt">Vehicle</label>
                                        </div>
                                        <div class="col-lg-1 col-md-10 col-sm-8 col-xs-7 filterby">
                                            <div class="form-group form-float">
                                                <div class="form-line">

                                                    <input type="text" id="vehicle" class="form-control"  autocomplete="off"  value="<?php echo $vehi->vehicle_name ?>" attempt=""  placeholder="Vehicle">
                                                    <input type="hidden" name="vehicle" value="<?php echo $vehi->id ?>" id="vehicle-id"  /> 
                                                    <div id="suggesstion-box">
                                                        <ul id="vehicle-list-append" class="name-list col-sm-offset-2"></ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-2 col-sm-4 col-xs-5 ">
                                            <label for="name" class="lblSerachAtt">Driver</label>
                                        </div>
                                        <div class="col-lg-1 col-md-10 col-sm-8 col-xs-7 filterby">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="driver" class="form-control"  autocomplete="off"  value="<?php echo $driv->name ?>" attempt=""  placeholder="Driver"> 
                                                    <input type="hidden" name="driver"  value="<?php echo $driv->id ?>" id="driver-id"  /> 
                                                    <div id="suggesstion-box">
                                                        <ul id="driver-list-append" class="name-list col-sm-offset-2"></ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-2 col-sm-4 col-xs-5 ">
                                            <label for="name" class="lblSerachAtt">Customer</label>
                                        </div>
                                        <div class="col-lg-1 col-md-10 col-sm-8 col-xs-7 filterby">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="customer" autocomplete="off"  value="<?php echo $cust->fullname ?>" attempt="" placeholder="Customer">
                                                    <input type="hidden" name="customer" value="<?php echo $cust->id ?>" id="customer-id"  />
                                                    <div id="suggesstion-box">
                                                        <ul id="customer-list-append" class="name-list col-sm-offset-3"></ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-2 col-sm-4 col-xs-5 ">
                                            <label for="name" class="lblSerachAtt">Package</label>
                                        </div>
                                        <div class="col-lg-1 col-md-10 col-sm-8 col-xs-7 filterby">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="package" autocomplete="off"  value="<?php echo $pack->name ?>" attempt="" placeholder="Packages">
                                                    <input type="hidden" name="package" value="<?php echo $pack->id ?>" id="package-id"  />
                                                    <div id="suggesstion-box">
                                                        <ul id="package-list-append" class="name-list col-sm-offset-3"></ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-2 col-sm-4 col-xs-5 ">
                                            <label for="name" class="lblSerachAtt">Owner</label>
                                        </div>
                                        <div class="col-lg-1 col-md-10 col-sm-8 col-xs-7 filterby">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="owner" autocomplete="off"  value="<?php echo $own->owner ?>" attempt="" placeholder="Owner">
                                                    <input type="hidden" name="owner" value="<?php echo $own->id ?>" id="owner-id"/>
                                                    <div id="suggesstion-box">
                                                        <ul id="owner-list-append" class="name-list col-sm-offset-3"></ul>
                                                    </div>                                          
                                                </div>
                                            </div>
                                        </div>   
                                        <div class="col-lg-offset-10 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                            <button type="submit" class="btn btn-primary m-t-15 waves-effect btnSearch" name="search" value="search">Search</button>
                                            <a href="view-report.php"><button type="button" class="btn btn-success m-t-15 waves-effect btnClear" name="cl" value="cl">Clear</button></a>
                                        </div>
                                    </div> 
                                </form>
                                <div class="row clearfix">  </div>
                                <hr/>

                                <div>
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
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
                                                <tr id="row_<?php echo $booking['start_date']; ?>">
                                                    <td><?php echo $key ?></td>
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
        <script>
            tinymce.init({
                selector: "#description",
                // ===========================================
                // INCLUDE THE PLUGIN
                // ===========================================

                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste"
                ],
                // ===========================================
                // PUT PLUGIN'S BUTTON on the toolbar
                // ===========================================

                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
                // ===========================================
                // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
                // ===========================================

                relative_urls: false

            });


        </script>
        <script type="text/javascript">
            $(".form_datetime").datetimepicker({
                format: "yyyy-mm-dd",
                autoclose: true,
                todayBtn: true,
                pickTime: false
//                data: "2010-01-24"
            });

        </script>  
    </body>

</html>