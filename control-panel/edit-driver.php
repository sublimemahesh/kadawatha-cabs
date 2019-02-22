<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$DRIVER = new Driver($id);
?> 

<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title> Edit Driver || WEB SITE CONTROL PANEL </title>
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
                                    Edit Driver
                                </h2>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="manage-driver.php">
                                            <i class="material-icons">list</i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <form class="form-horizontal" method="post" id="updateDriverDetails" action="post-and-get/driver.php" enctype="multipart/form-data"> 
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Driver Name</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="name" class="form-control"  autocomplete="off" name="driver_name" placeholder="Driver Name" required="true" value="<?php echo $DRIVER->name; ?>">
                                                    <!--<label class="form-label">Driver Name</label>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Licence Number</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="licenceNum" class="form-control"  autocomplete="off" name="licence_num" placeholder="Licence Number" required="true" value="<?php echo $DRIVER->licence_number ?>">
                                                    <!--<label class="form-label">Licence Number</label>-->
                                                </div>    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Mobile Number</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="title" class="form-control"  autocomplete="off" placeholder="Mobile Number" name="phone_numbers" required="true" value="<?php echo $DRIVER->phone_numbers ?>">
                                                    <!--<label class="form-label">Mobile Number</label>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">NIC</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="nic" class="form-control"  autocomplete="off" name="nic" placeholder="NIC" required="true" value="<?php echo $DRIVER->nic ?>">
                                                    <!--<label class="form-label">NIC</label>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Address</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="title" class="form-control"  autocomplete="off" name="address" required="true" placeholder="Address" value="<?php echo $DRIVER->address ?>">
                                                    <!--<label class="form-label">Address</label>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">City</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="title" class="form-control"  autocomplete="off" name="city" placeholder="City" required="true" value="<?php echo $DRIVER->city ?>">
                                                    <!--<label class="form-label">City</label>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Licence</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="col-md-4">  
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <img src="../upload/Driver/front_side/<?php echo $DRIVER->licence_image_front; ?>" id="image" class="view-img-licence img img-responsive img-thumbnail" name="licence_image_front" alt="old image-front side">
                                                        <input type="file" id="image" class="form-control" name="licence_image_front">
                                                    </div>
                                                </div>
                                            </div>    

                                            <div class="col-md-4">  
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <img src="../upload/Driver/back_side/<?php echo $DRIVER->licence_image_back; ?>" id="image" class="view-img-licence img img-responsive img-thumbnail" name="licence_image_back" alt="old image -back side">
                                                        <input type="file" id="image" class="form-control" name="licence_image_back">
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>


                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <input type="hidden" id="oldImageNameFront" value="<?php echo $DRIVER->licence_image_front; ?>" name="oldImageNameFront"/>
                                        <input type="hidden" id="oldImageNameBack" value="<?php echo $DRIVER->licence_image_back; ?>" name="oldImageNameBack"/>
                                        <input type="hidden" id="id" value="<?php echo $DRIVER->id; ?>" name="id"/>
            <!--                                            <input type="hidden" id="authToken" value="<?php echo $_SESSION["authToken"]; ?>" name="authToken"/>-->
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect" id="editDriver" name="update" value="update">Save Changes</button>
                                        <input type="hidden" name="update"/> 
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
        <script src="plugins/sweetalert/sweetalert.min.js"></script>
        <script src="js/check-edit-driver-nic.js" type="text/javascript"></script>
        <!--<script src="js/check-edit-driver-licence.js" type="text/javascript"></script>-->
        
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