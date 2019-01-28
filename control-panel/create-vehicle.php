<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$VEHICLETYPE = new VehicleType(NULL);
$vehicleType = $VEHICLETYPE->all();

$DRIVER = new Driver(NULL);
$driver = $DRIVER->all();
?>
<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>User</title>
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
                                <h2>Add Vehicle</h2>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="manage-vehicle.php">
                                            <i class="material-icons">list</i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <form class="form-horizontal"  method="post" action="post-and-get/vehicle.php" enctype="multipart/form-data"> 
                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select class="form-control place-select1 show-tick" autocomplete="off" type="text" id="type" name="type" required="TRUE">
                                                    <option value="">Please Select Vehicle Type</option>
                                                    <?php foreach ($vehicleType as $type) {
                                                        ?>
                                                        <option value="<?php echo $type['id']; ?>"><?php echo $type['type']; ?></option>
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
                                                <input type="text" id="name" class="form-control"  autocomplete="off" name="owner" required="true">
                                                <label class="form-label">Owner Name</label>
                                            </div>

                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="name" class="form-control"  autocomplete="off" name="vehicle_number" required="true">
                                                <label class="form-label">Vehicle Number</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="title" class="form-control"  autocomplete="off" name="vehicle_name" required="true">
                                                <label class="form-label">Vehicle Name</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="title" class="form-control"  autocomplete="off" name="contactnum" required="true">
                                                <label class="form-label">Contact Number</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="title" class="form-control"  autocomplete="off" name="city" required="true">
                                                <label class="form-label">City</label>
                                            </div>
                                        </div>
                                    </div>


                                    <label class="form-label">Condition Type</label>
                                    <div class="col-md-12">

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input class="filled-in chk-col-pink" type="radio"  name="condition" value="DAc" id="DAc" />
                                                <label for="DAc">D/Ac</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input class="filled-in chk-col-pink" type="radio"  name="condition" value="NonAc" id="nonAc" />
                                                <label for="nonAc">Non Ac</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="number" id="title" class="form-control"  autocomplete="off" name="noofpassenger" required="true">
                                                <label class="form-label">No Of Passenger</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="number" id="title" class="form-control"  autocomplete="off" name="noofbaggage" required="true">
                                                <label class="form-label">No Of Baggage</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="number" id="title" class="form-control"  autocomplete="off" name="noofdoor" required="true">
                                                <label class="form-label">No Of Door</label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select class="form-control place-select1 show-tick" autocomplete="off" type="text" id="type" name="drivertype" required="TRUE">
                                                    <option value="">Please Select Driver</option>
                                                    <?php foreach ($driver as $name) {
                                                        ?>
                                                        <option value="<?php echo $name['id']; ?>"><?php echo $name['name']; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-12">                                       
                                        <div class="form-group form-float">
                                            <label class="form-label">vehicle Image</label>
                                            <div class="form-line">
                                                <input type="file" id="image" class="form-control" name="vehicle_image"  required="true">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12"> 
                                        <input type="submit" name="create" class="btn btn-primary m-t-15 waves-effect" value="create"/>
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
    </body>

</html>