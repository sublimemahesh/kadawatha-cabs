<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $SUBTYPE = new VehicleSubType($id);
    $TYPE = new VehicleType($SUBTYPE->type);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" >
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" >
        <title> Manage Vehicle || WEB SITE CONTROL PANEL </title>
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
        <link href="plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>



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
                                <h2>Create Vehicle - (<?php echo $TYPE->type . ' -> ' . $SUBTYPE->name; ?>)</h2>
                            </div>
                            <?php
                            $vali = new Validator();

                            $vali->show_message();
                            ?>
                            <div class="body">
                                <form class="form-horizontal"  method="post" id="newVehicle" action="post-and-get/vehicle.php" enctype="multipart/form-data">
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Vehicle Type</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" value="<?php echo $TYPE->type; ?>" readonly="">
                                                    <input type="hidden" id="type" name="type" value="<?php echo $TYPE->id; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Vehicle Sub Type</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" value="<?php echo $SUBTYPE->name; ?>" readonly="">
                                                    <input type="hidden" id="sub_type" name="sub_type" value="<?php echo $SUBTYPE->id; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Owner Name</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="name" class="form-control"  autocomplete="off" name="owner" required="true" placeholder="Owner Name">
                                                    <!--<label class="form-label">Owner Name</label>-->
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="owner_contact_no_01">Owner Contact Number 01</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="owner_contact_no_01" class="form-control"  autocomplete="off" name="owner_contact_no_01" required="true" placeholder="Owner Contact Number 01">
                                                    <!--<label class="form-label">Contact Number</label>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="owner_contact_no_02">Owner Contact Number 02</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="owner_contact_no_02" class="form-control"  autocomplete="off" name="owner_contact_no_02" placeholder="Owner Contact Number 02">
                                                    <!--<label class="form-label">Contact Number</label>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Vehicle Number</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="vehicle-no" class="form-control"  autocomplete="off" name="vehicle_number" required="true" placeholder="Vehicle Number">
                                                    <!--<label class="form-label">Vehicle Number</label>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Vehicle Name</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="title" class="form-control"  autocomplete="off" name="vehicle_name" required="true" placeholder="Vehicle Name">
                                                    <!--<label class="form-label">Vehicle Name</label>-->
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
                                                    <input type="text" id="title" class="form-control"  autocomplete="off" name="city" required="true" placeholder="City">
                                                    <!--<label class="form-label">City</label>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label ">
                                            <label for="name">Condition Type</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input class="filled-in chk-col-pink" type="radio"  name="condition" value="AC" id="AC" />
                                                    <label for="AC">AC</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input class="filled-in chk-col-pink" type="radio"  name="condition" value="NonAC" id="nonAC" />
                                                    <label for="nonAC">Non AC</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">No Of Passenger</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="number" id="title" class="form-control"  autocomplete="off" name="noofpassenger" min="0" placeholder="No Of Passenger">
                                                    <!--<label class="form-label">No Of Passenger</label>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">No Of Baggage</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="number" id="title" class="form-control"  autocomplete="off" name="noofbaggage" min="0" placeholder="No Of Baggage">
                                                    <!--<label class="form-label">No Of Baggage</label>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">No Of Door</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="number" id="title" class="form-control"  autocomplete="off" name="noofdoor" min="0" placeholder="No Of Door">
                                                    <!--<label class="form-label">No Of Door</label>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Driver</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select class="form-control place-select1 show-tick" name="drivertype">
                                                        <option value=""> -- Please Select Driver -- </option>
                                                        <?php
                                                        foreach (Driver::getDriversByVehicleType($SUBTYPE->type) as $name) {
                                                            ?>
                                                            <option value="<?php echo $name['id']; ?>">
                                                                <?php echo $name['name']; ?>
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
                                            <label for="driver_contact_no_01">Driver Contact Number 01</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="driver_contact_no_01" class="form-control"  autocomplete="off" name="driver_contact_no_01" required="true" placeholder="Driver Contact Number 01">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="driver_contact_no_02">Driver Contact Number 02</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="driver_contact_no_02" class="form-control"  autocomplete="off" name="driver_contact_no_02" placeholder="Driver Contact Number 02">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <input type="submit" name="create" id="createVehicle" class="btn btn-primary m-t-15 waves-effect" value="create"/>
                                        <button  class="btn btn-info m-t-15 waves-effect" onclick="javascript:history.go(-1)">Back</button>
                                        <input type="hidden" name="create"/> 
                                    </div>
                                    <div class="row clearfix">  </div>
                                    <hr/>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Manage Vehicles - <?php echo $TYPE->type; ?>
                                </h2>
                            </div>
                            <div class="body">
                                <!-- <div class="table-responsive">-->
                                <div>
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Owner Name</th>
                                                <th>Vehicle No</th>
                                                <th>Vehicle Name</th>
                                                <th>Condition</th>
                                                <th>No of Passengers</th>
                                                <th>Driver</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Owner Name</th>
                                                <th>Vehicle No</th>
                                                <th>Vehicle Name</th>
                                                <th>Condition</th>
                                                <th>No of Passengers</th>
                                                <th>Driver</th>
                                                <th>Options</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            foreach (vehicle::getVehiclesBySubType($id) as $key => $vehicle) {
                                                $key++;

                                                $VEHICLENAME = new VehicleType($vehicle['vehicle_type']);
                                                $DRIVERENAME = new Driver($vehicle['driver']);
                                                ?>
                                                <tr id="row_<?php echo $vehicle['id']; ?>">
                                                    <td><?php echo $key ?></td>
                                                    <td><?php echo $vehicle['owner']; ?></td>
                                                    <td><?php echo $vehicle['vehicle_number']; ?></td>
                                                    <td><?php echo $vehicle['vehicle_name']; ?></td>
                                                    <td><?php echo $vehicle['condition']; ?></td>
                                                    <td><?php echo $vehicle['no_of_passenger']; ?></td>
                                                    <td><?php echo $DRIVERENAME->name; ?></td>

                                                    <td> 
                                                        <a href="edit-vehicle.php?id=<?php echo $vehicle['id']; ?>"> <button class="glyphicon glyphicon-pencil edit-btn" title ="Edit Vehicle"></button></a>
                                                        |
                                                        <a href="view-vehicle-photos.php?id=<?php echo $vehicle['id']; ?>"> <button class="glyphicon glyphicon-picture user-Details " title ="View Vehicle Photo Album"></button></a>
                                                        |
                                                        <a href="#"  class="delete-vehicle" data-id="<?php echo $vehicle['id']; ?>">
                                                            <button class="glyphicon glyphicon-trash delete-btn delete-user" title ="Delete Vehicle " data-id="<?php echo $user['id']; ?>"></button>
                                                        </a>
                                                        |
                                                        <a href="view-vehicle.php?id=<?php echo $vehicle['id']; ?>"> <button class="fa fa-bars user-Details " title="View Vehicle"></button></a>
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
            <!-- #END# Manage District -->
        </section>
        <!-- Jquery Core Js -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap Core Js -->
        <script src="plugins/bootstrap/js/bootstrap.js"></script>
        <!-- Select Plugin Js -->
        <!--<script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>-->
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
        <script src="delete/js/vehicle.js" type="text/javascript"></script>
    </body>
</html>

