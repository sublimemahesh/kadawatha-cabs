<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$BOOKING = new Booking($id);

$CUSTOMER = new Customer($id);
$CUSTOMERNAME = new Customer($BOOKING->customer);

$VEHICLE = new Vehicle(NULL);
$vehicle = $VEHICLE->all();

$DRIVER = new Driver(NULL);
$driver = $DRIVER->all();

$PACKAGES = new Packages(NULL);
$packages = $PACKAGES->all();
?>
<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Edit Booking || WEB SITE CONTROL PANEL </title>
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
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/flick/jquery-ui.css">
        <link href="plugins/Timepicker/dist/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css"/>

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
                                <h2>Edit Booking </h2>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="manage-all-bookings.php">
                                            <i class="material-icons">list</i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <?php
                            include './new-customer-model.php';
                            ?>
                            <div class="body">
                                <form class="form-horizontal"  method="post" action="post-and-get/booking.php" enctype="multipart/form-data"> 
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Customer</label>
                                        </div>


                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="name" autocomplete="off" name="customer" value="<?php echo $CUSTOMERNAME->fullname ?>" attempt="" placeholder="Enter Customer name">
                                                    <input type="hidden" name="customer" value="<?php echo $CUSTOMERNAME->id ?>" id="name-id"  />
                                                    <!--<label class="form-label">Enter Customer name </label>-->
                                                    <div id="suggesstion-box">
                                                        <ul id="name-list-append" class="name-list col-sm-offset-3"></ul>
                                                    </div>

                                                </div>

                                                <div class="newcus">
                                                    <button type="button" id="btnNewCustomer" class="glyphicon glyphicon-floppy-disk user-Details" data-toggle="modal" data-target="#exampleModal" data-whatever="" title="create customer"></button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Start Date</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="start_date" class="form-control input-append date form_datetime"  autocomplete="off" name="start_date" required="true" placeholder="Start Date & Time" value="<?php echo $BOOKING->start_date ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">End Date</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="end_date" class="form-control input-append date form_datetime"  autocomplete="off" name="end_date" required="true" placeholder="End Date & Time" value="<?php echo $BOOKING->end_date ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="vehicle_type">Vehicle Type</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select class="form-control place-select1 show-tick" autocomplete="off" type="text" id="vehicle_type" name="vehicle_type" required="TRUE">
                                                        <option value=""> -- Please Select Vehicle Type -- </option>
                                                        <?php foreach (VehicleType::all() as $type) {
                                                            ?>
                                                            <option value="<?php echo $type['id']; ?>" 
                                                            <?php
                                                            if ($BOOKING->vehicleType === $type['id']) {
                                                                echo 'selected';
                                                            }
                                                            ?>>
                                                                        <?php echo $type['type']; ?>
                                                            </option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix" id="vehicle-bar">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Vehicle</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select class="form-control place-select1 show-tick" autocomplete="off" type="text" id="vehicle" name="vehicle" required="TRUE">
                                                        <option value=""> -- Please Select Vehicle -- </option>
                                                        <?php foreach (Vehicle::all() as $vehicle) {
                                                            ?>
                                                            <option value="<?php echo $vehicle['id']; ?>" driver="<?php echo $vehicle['driver']; ?>" <?php
                                                            if ($BOOKING->vehicle === $vehicle['id']) {
                                                                echo 'selected';
                                                            }
                                                            ?>>
                                                                        <?php echo $vehicle['vehicle_name']; ?>
                                                            </option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix" id="driver-bar">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Driver</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select class="form-control place-select1 show-tick" autocomplete="off" type="text" id="driver" name="driver" required="TRUE">
                                                        <option value=""> -- Please Select Driver -- </option>
                                                        <?php foreach ($driver as $driname) {
                                                            ?>
                                                            <option value="<?php echo $driname['id']; ?>" <?php
                                                            if ($BOOKING->driver === $driname['id']) {
                                                                echo 'selected';
                                                            }
                                                            ?>>
                                                                        <?php echo $driname['name']; ?>
                                                            </option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Package</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select class="form-control place-select1 show-tick" autocomplete="off" type="text" id="package" name="package">
                                                        <option value=""> -- Please Select Package -- </option>
                                                        <?php foreach ($packages as $pack) {
                                                            ?>
                                                            <option value="<?php echo $pack['id']; ?>" <?php
                                                            if ($BOOKING->package === $pack['id']) {
                                                                echo 'selected';
                                                            }
                                                            ?>  price="<?php echo $pack['price']; ?>">
                                                                        <?php echo $pack['name']; ?>
                                                            </option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Total Cost</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="total_cost" class="form-control"  autocomplete="off" name="total_cost" required="true" placeholder="Total Cost" value="<?php echo $BOOKING->total_cost ?>">
                                                    <!--<label class="form-label">Total Cost </label>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Comment </label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <label class="form-label"></label>
                                                <div class="form-line">
                                                    <textarea id="description" name="comment" class="form-control" rows="5" ><?php echo $BOOKING->comment ?></textarea> 
                                                    <!--<input type="hidden" value="1" name="active" />-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">

                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <input class="filled-in chk-col-pink" type="checkbox" <?php
                                                if ($BOOKING->isActive == 1) {
                                                    echo 'checked';
                                                }
                                                ?> name="active" value="1" id="rememberme" />
                                                <label for="rememberme">Activate</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <input type="hidden" id="id" value="<?php echo $BOOKING->id; ?>" name="id"/>
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect" name="update" value="update">Save Changes</button>
                                    </div>
                                    <div class="row clearfix">  </div>
                                    <hr/>
                                </form>
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
        <script src="plugins/sweetalert/sweetalert.min.js"></script>
        <script src="js/customer-suggection.js"></script>
        <script src="js/create-customer.js"></script>
        <script src="js/booking.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="plugins/Timepicker/dist/jquery-ui-sliderAccess.js" type="text/javascript"></script>
        <script src="plugins/Timepicker/dist/jquery-ui-timepicker-addon.js" type="text/javascript"></script>
        <!-- Optional -->
        <script src="plugins/Timepicker/dist/i18n/jquery-ui-timepicker-addon-i18n.min.js" type="text/javascript"></script>
        <script>
            $('#start_date').datetimepicker({
                dateFormat: 'yy-mm-dd',
                timeFormat: "HH:mm:ss",
            });
            $('#end_date').datetimepicker({
                dateFormat: 'yy-mm-dd',
                timeFormat: "HH:mm:ss",
            });
        </script>

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
    </body>

</html>