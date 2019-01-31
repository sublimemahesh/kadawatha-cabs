<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$BOOKING = new Booking($id);

$CUSTOMER = new Customer($id);
$customer = $CUSTOMER->all();

$VEHICLETYPE = new VehicleType($id);
$vehicle = $VEHICLETYPE->all();

$DRIVER = new Driver($id);
$driver = $DRIVER->all();

$PACKAGES = new Packages($id);
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
                                        <a href="manage-booking.php">
                                            <i class="material-icons">list</i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <form class="form-horizontal"  method="post" action="post-and-get/booking.php" enctype="multipart/form-data"> 
                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select class="form-control place-select1 show-tick" autocomplete="off" type="text" id="customer" name="customer" required="TRUE">
                                                    <option value=""> -- Please Select Customer -- </option>
                                                    <?php foreach ($customer as $cusname) {
                                                        ?>
                                                        <option value="<?php echo $cusname['id']; ?>" <?php
                                                        if ($CUSTOMER->id === $cusname['id']) {
                                                            echo 'selected';
                                                        }
                                                        ?>>
                                                                    <?php echo $cusname['name']; ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="name" class="form-control input-append date form_datetime"  autocomplete="off" name="start_date" required="true" placeholder="Start Date & Time" value="<?php echo $BOOKING->start_date ?>">
                                          
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="name" class="form-control input-append date form_datetime"  autocomplete="off" name="end_date" required="true" placeholder="End Date & Time" value="<?php echo $BOOKING->end_date ?>">

                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select class="form-control place-select1 show-tick" autocomplete="off" type="text" id="vehicle" name="vehicle" required="TRUE">
                                                    <option value=""> -- Please Select Vehicle -- </option>
                                                    <?php foreach ($vehicle as $vehname) {
                                                        ?>
                                                        <option value="<?php echo $vehname['id']; ?>" <?php
                                                        if ($VEHICLETYPE->id === $vehname['id']) {
                                                            echo 'selected';
                                                        }
                                                        ?>>
                                                                    <?php echo $vehname['type']; ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select class="form-control place-select1 show-tick" autocomplete="off" type="text" id="driver" name="driver" required="TRUE">
                                                    <option value=""> -- Please Select Driver -- </option>
                                                    <?php foreach ($driver as $driname) {
                                                        ?>
                                                        <option value="<?php echo $driname['id']; ?>" <?php
                                                        if ($DRIVER->id === $driname['id']) {
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
                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="total_cost" class="form-control"  autocomplete="off" name="total_cost" required="true" value="<?php echo $BOOKING->total_cost ?>">
                                                <label class="form-label">Total Cost </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select class="form-control place-select1 show-tick" autocomplete="off" type="text" id="package" name="package" required="TRUE">
                                                    <option value=""> -- Please Select Package -- </option>
                                                    <?php foreach ($packages as $pack) {
                                                        ?>
                                                        <option value="<?php echo $pack['id']; ?>" <?php
                                                        if ($PACKAGES->id === $pack['id']) {
                                                            echo 'selected';
                                                        }
                                                        ?>>
                                                                    <?php echo $pack['name']; ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <label class="form-label">Comment</label>
                                            <div class="form-line">
                                                <textarea id="description" name="comment" class="form-control" rows="5" ><?php echo $BOOKING->comment ?></textarea> 
                                                <!--<input type="hidden" value="1" name="active" />-->
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-12">
                                        <div class="form-group">
                                            <input class="filled-in chk-col-pink" type="checkbox" <?php
                                            if ($BOOKING->isActive ==1) {
                                                echo 'checked';
                                            }
                                            ?> name="active" value="1" id="rememberme" />
                                            <label for="rememberme">Activate</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12"> 
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
                format: "yyyy-mm-dd - hh:ii:00 ",
                autoclose: true,
                todayBtn: true
            });

        </script>     
    </body>

</html>