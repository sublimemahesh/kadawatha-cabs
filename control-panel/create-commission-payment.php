<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
$id = '';
$driver_id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $BOOKING = new Booking($id);
    $DRIVER = new Driver($BOOKING->driver);
    $driver_id = $BOOKING->driver;
}
?>
<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Create Commission Payment || WEB SITE CONTROL PANEL </title>
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
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/flick/jquery-ui.css">
        <link href="plugins/Timepicker/dist/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css"/>
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
                                <h2>Create Commission Payment</h2>
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
                            <div class="body">
                                <form class="form-horizontal"  id="payCommission" method="post" action="post-and-get/commission-payment.php" enctype="multipart/form-data"> 

                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="driver">Driver</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select class="form-control place-select1 show-tick" autocomplete="off" type="text" id="driver" name="driver" required="TRUE">
                                                        <option value=""> -- Please Select -- </option>
                                                        <?php
                                                        $drivers = Driver::all();
                                                        $selected = '';
                                                        if (count($drivers) > 0) {
                                                            foreach (Driver::all() as $driver) {
                                                                if (isset($_GET['id'])) {
                                                                    if ($BOOKING->driver == $driver["id"]) {
                                                                        $selected = "selected";
                                                                    } else {
                                                                        $selected = 'disabled';
                                                                    }
                                                                }
                                                                ?>
                                                                <option value="<?php echo $driver["id"]; ?>" <?php echo $selected; ?>><?php echo $driver["name"]; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix unpaid-bookings-section">

                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Payable Commission (Rs)</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="payable-commission" class="form-control"  autocomplete="off" name="payable-commission" required="true" amount="0" placeholder="0.00" value="0.00" readonly="">
                                                    <!--                                                    <label class="form-label">City</label>-->
                                                </div>
                                            </div>
                                        </div>    
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="paid_at">Paid At</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="paid-at" class="form-control"  autocomplete="off" name="paid-at" required="true" placeholder="Enter paid date" >
                                                </div>
                                            </div>
                                        </div>    
                                    </div>


                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <input type="hidden" name="booking" id ="booking" class="" value="<?php echo $id; ?>"/>
                                        <input type="hidden" name="driver_id" id ="driver_id" class="" value="<?php echo $driver_id; ?>"/>
                                        <input type="submit" name="pay-commission" id ="pay-commission" class="btn btn-primary m-t-15 waves-effect" value="Pay Commission"/>
                                        <button  class="btn btn-info m-t-15 waves-effect" onclick="javascript:history.go(-1)">Back</button>
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
        <script src="plugins/sweetalert/sweetalert.min.js"></script>
        <script src="tinymce/js/tinymce/tinymce.min.js"></script>
        <script src="js/check-customer-nic.js" type="text/javascript"></script>
        <script src="js/commission-payments.js" type="text/javascript"></script>
        <!--<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>-->
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="plugins/Timepicker/dist/jquery-ui-sliderAccess.js" type="text/javascript"></script>
        <script src="plugins/Timepicker/dist/jquery-ui-timepicker-addon.js" type="text/javascript"></script>
        <!-- Optional -->
        <script src="plugins/Timepicker/dist/i18n/jquery-ui-timepicker-addon-i18n.min.js" type="text/javascript"></script>
        <script>
                                            $('#paid-at').datepicker({
                                                dateFormat: 'yy-mm-dd'
                                            });
        </script>
    </body>

</html>