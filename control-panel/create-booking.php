<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');


$CUSTOMER = new Customer(NULL);
$customer = $CUSTOMER->all();

$TYPE = new VehicleType(NULL);
$types = $TYPE->all();

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
        <title>Create Booking || WEB SITE CONTROL PANEL </title>
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
        <style>
            .modal {
                overflow-y:scroll !important;
            }
            /*            .modal {
              overflow-y:scroll !important;
            }*/
        </style>

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
                                <h2>Create Booking </h2>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="manage-booking.php">
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

                                                    <input type="text" class="form-control" id="name" autocomplete="off" name="customer" value="" attempt="" placeholder="Enter Customer name">
                                                    <input type="hidden" name="id" value="" id="name-id"  />

                                                    <div id="suggesstion-box">
                                                        <ul id="name-list-append" class="name-list col-sm-offset-3"></ul>
                                                    </div>
                                                </div>

                                                <div class="newcus">
                                                    <button type="button" id="btnNewCustomer" class="glyphicon glyphicon-floppy-disk user-Details" data-toggle="modal" data-target="#exampleModal" title="create customer"></button>
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
                                                    <input type="datetime" id="start_date" class="form-control input-append date form_datetime"  autocomplete="off" name="start_date" required="true" placeholder="Start Date & Time">
                                                    <!--<span class="add-on"><i class="icon-th"></i></span>-->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">End Date</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="end_date" class="form-control input-append date form_datetime"  autocomplete="off" name="end_date" required="true" placeholder="End Date & Time">
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
                                                        <?php foreach ($types as $type) {
                                                            ?>
                                                            <option value="<?php echo $type['id']; ?>">
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
                                    <!--Vehicle-->
                                    <div class="row clearfix" id="vehicle-bar">

                                    </div>
                                    <!--Driver-->
                                    <div class="row clearfix" id="driver-bar">
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
                                                            <option value="<?php echo $pack['id']; ?>" price="<?php echo $pack['price']; ?>">
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
                                            <label for="name">Total Cost (Rs)</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="total_cost" class="form-control"  autocomplete="off" name="total_cost" required="true" placeholder="Total Cost">
                                                    <!--<label class="form-label">Total Cost </label>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Comment</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <textarea id="description" name="comment" class="form-control" rows="5"></textarea> 
                                                    <input type="hidden" value="1" name="active" />

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <input type="submit" name="create" id="create" class="btn btn-primary m-t-15 waves-effect" value="create"/>
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
        <!--<script src="js/add-new-ad.js" type="text/javascript"></script>-->
        <script src="plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
        <script src="tinymce/js/tinymce/tinymce.min.js"></script>
        <script src="plugins/sweetalert/sweetalert.min.js"></script>
        <script src="js/customer-suggection.js"></script>
        <script src="js/create-customer.js"></script>
        <script src="js/booking.js" type="text/javascript"></script><script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
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