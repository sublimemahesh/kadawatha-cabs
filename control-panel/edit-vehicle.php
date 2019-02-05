<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$VEHICLE = new vehicle($id);
$VEHICLETYPE = new VehicleType(NULL);
$types = $VEHICLETYPE->all();

$DRIVER = new Driver($id);
$Drivername = $DRIVER->all();
?> 

<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
            <title> Edit Vehicle Type || WEB SITE CONTROL PANEL </title>
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
                                <h2>
                                    Edit Vehicle
                                </h2>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="manage-vehicle.php">
                                            <i class="material-icons">list</i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <form class="form-horizontal" method="post" action="post-and-get/vehicle.php" enctype="multipart/form-data"> 
                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">


                                                <select class="form-control place-select1 show-tick" autocomplete="off" type="text" id="type" name="type" required="TRUE">
                                                    <option value=""> -- Please Select -- </option>
                                                    <?php foreach ($types as $type) {
                                                        ?>
                                                        <option value="<?php echo $type['id']; ?>" <?php
                                                    if ($VEHICLE->vehicle_type === $type['id']) {
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
                                    <div class="col-md-12">
                                        <div class="form-group form-float">

                                            <div class="form-line">
                                                <input type="text" id="name" class="form-control"  autocomplete="off" name="owner" required="true" value="<?php echo $VEHICLE->owner; ?>">
                                                <label class="form-label">Owner Name</label>
                                            </div>

                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group form-float">

                                            <div class="form-line">
                                                <input type="text" id="name" class="form-control"  autocomplete="off" name="vehicle_number" required="true" value="<?php echo $VEHICLE->vehicle_number; ?>">
                                                <label class="form-label">Vehicle Number</label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="title" class="form-control"  autocomplete="off" name="vehicle_name" required="true" value="<?php echo $VEHICLE->vehicle_name; ?>">
                                                <label class="form-label">Vehicle Name</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="title" class="form-control"  autocomplete="off" name="contactnum" required="true" value="<?php echo $VEHICLE->vehicle_number ?>">
                                                <label class="form-label">Contact Number</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="title" class="form-control"  autocomplete="off" name="city" required="true" value="<?php echo $VEHICLE->city ?>">
                                                <label class="form-label">City</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-float">

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input class="filled-in chk-col-pink" type="radio" 
                                                    <?php
                                                    if ($VEHICLE->condition == 'DAc') {
                                                        echo 'checked';
                                                    }
                                                    ?> 

                                                           name="condition" value="DAc" id="DAc" />
                                                    <label for="DAc">Ac</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input class="filled-in chk-col-pink" type="radio"  
                                                    <?php
                                                    if ($VEHICLE->condition == 'nonAc') {
                                                        echo 'checked';
                                                    }
                                                    ?> 
                                                           name="condition" value="NonAc" id="nonAc" />
                                                    <label for="nonAc">Non Ac</label>
                                                </div>
                                            </div>



                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">

                                                <input type="number" id="title" class="form-control"  autocomplete="off" name="noofpassenger" required="true" value="<?php echo $VEHICLE->no_of_passenger ?>">
                                                <label class="form-label">No Of Passenger</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="number" id="title" class="form-control"  autocomplete="off" name="noofbaggage" required="true" value="<?php echo $VEHICLE->no_of_baggage ?>">
                                                <label class="form-label">No Of Baggage</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="number" id="title" class="form-control"  autocomplete="off" name="noofdoor" required="true" value="<?php echo $VEHICLE->no_of_door ?>">
                                                <label class="form-label">No Of Door</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select class="form-control place-select1 show-tick" autocomplete="off" type="text" id="type" name="drivertype" required="TRUE">
                                                    <option value=""> -- Please Select Driver -- </option>
                                                    <?php foreach ($Drivername as $name) {
                                                        ?>
                                                        <option value="<?php echo $name['id']; ?>" <?php
                                                    if ($DRIVER->id === $name['id']) {
                                                        echo 'selected';
                                                    }
                                                        ?>>
                                                                <?php  echo $name['name']; ?>
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
                                                <input type="file" id="image" class="form-control" name="vehicle_image">
                                                <img src="../upload/vehicle/<?php echo $VEHICLE->vehicle_image; ?>" id="image" class="view-edit-img-comments img img-responsive img-thumbnail" name="profileimage" alt="old image">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <input type="hidden" id="oldImageName" value="<?php echo $VEHICLE->vehicle_image; ?>" name="oldImageName"/>
                                        <input type="hidden" id="id" value="<?php echo $VEHICLE->id; ?>" name="id"/>
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