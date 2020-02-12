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

$SUBTYPE = new VehicleSubType($BOOKING->vehicleSubType);
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

                <!-- Vertical Layout -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>Edit <?php
                                    if ($BOOKING->status === 'completed') {
                                        echo 'Completed';
                                    } elseif ($BOOKING->status === 'confirmed') {
                                        echo 'Confirmed';
                                    } elseif ($BOOKING->status === 'pending') {
                                        echo 'Pending';
                                    } elseif ($BOOKING->status === 'canceled') {
                                        echo 'Canceled';
                                    }
                                    ?>  Booking - <?php echo $BOOKING->referenceNo; ?></h2>
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
                            <?php
                            $vali = new Validator();

                            $vali->show_message();
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
                                            <label for="created_at">Created At</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control input-append"  autocomplete="off" value="<?php echo $BOOKING->created_at; ?>" disabled="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    if ($BOOKING->status === 'confirmed') {
                                        ?>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="confirmed_at">Confirmed At</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control input-append"  autocomplete="off" value="<?php echo $BOOKING->confirmedAt; ?>" disabled="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    } elseif ($BOOKING->status === 'completed') {
                                        ?>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="confirmed_at">Confirmed At</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control input-append"  autocomplete="off" value="<?php echo $BOOKING->confirmedAt; ?>" disabled="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="completed_at">Completed At</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control input-append"  autocomplete="off" value="<?php echo $BOOKING->completedAt; ?>" disabled="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    } elseif ($BOOKING->status === 'canceled') {
                                        ?>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="canceled_at">Canceled At</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control input-append"  autocomplete="off" value="<?php echo $BOOKING->canceledAt; ?>" disabled="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="name">Start Date</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="start_date" class="form-control input-append date form_datetime"  autocomplete="off" name="start_date" required="true" placeholder="Start Date" value="<?php echo $BOOKING->start_date; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="start_time">Start Time</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="start_time" class="form-control input-append"  autocomplete="off" name="start_time" placeholder="Strat Time" value="<?php echo date("g:i a", strtotime($BOOKING->start_time)); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="end_date">End Date</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="end_date" class="form-control input-append date"  autocomplete="off" name="end_date" required="true" placeholder="End Date" value="<?php echo $BOOKING->end_date; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="end_time">End Time</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="end_time" class="form-control input-append date form_datetime"  autocomplete="off" name="end_time" placeholder="End Time" value="<?php echo date("g:i a", strtotime($BOOKING->end_time)); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="no_of_days">No of Days</label>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="number" id="no_of_days" class="form-control input-append"  autocomplete="off" name="no_of_days" required="true" placeholder="No of Days" value="<?php echo $BOOKING->no_of_days; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="start_from">Start From</label>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="start_from" class="form-control input-append"  autocomplete="off" name="start_from" placeholder="Start From"  value="<?php echo $BOOKING->start_from; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="end_from">End From</label>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="end_from" class="form-control input-append"  autocomplete="off" name="end_from" placeholder="End From" value="<?php echo $BOOKING->end_from; ?>">
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
                                    <div class="row clearfix" id="vehicle-sub-type-bar">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="vehicle-sub-type">Vehicle Sub Type</label>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select class="form-control place-select1 show-tick" autocomplete="off" type="text" id="vehicle-sub-type" name="vehicle-sub-type" required="TRUE">
                                                        <option value=""> -- Please Select Vehicle Sub Type -- </option>
                                                        <?php foreach (VehicleSubType::getSubTypesByType($BOOKING->vehicleType) as $type) {
                                                            ?>
                                                            <option value="<?php echo $type['id']; ?>" 
                                                            <?php
                                                            if ($BOOKING->vehicleSubType === $type['id']) {
                                                                echo 'selected';
                                                            }
                                                            ?> category="<?php echo $type['category']; ?>" no_of_seats="<?php echo $type['no_of_seats']; ?>">
                                                                        <?php echo $type['name'] . ' ' . $type['no_of_seats']; ?>
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
                                                    <select class="form-control place-select1 show-tick" autocomplete="off" type="text" id="vehicle" name="vehicle">
                                                        <option value=""> -- Please Select Vehicle -- </option>
                                                        <?php foreach (Vehicle::GetVehiclesByType($BOOKING->vehicleType) as $vehicle) {
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
                                                    <select class="form-control place-select1 show-tick" autocomplete="off" type="text" id="driver" name="driver">
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

                                    <?php
                                    if ($BOOKING->package != 0) {
                                        $PACKAGE = new Packages($BOOKING->package);
                                        $CATEGORY = new VehicleCategory($PACKAGE->category);
                                        $SUBCATEGORY = new VehicleSubCategory($PACKAGE->subCategory);
                                        $TYPE = new PackageType($PACKAGE->packageType);
                                        if ($CATEGORY->id == 1) {
                                            ?>
                                            <div class="row clearfix" id="category-bar">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label for="category">Condition</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="hidden" id="category" name="category" value="<?php echo $PACKAGE->category; ?>">
                                                            <select class="form-control place-select1 show-tick" id="category" name="category" required="TRUE">
                                                                <option value=""> -- Please Select Condition -- </option>
                                                                <option value="1" <?php
                                                                if ($PACKAGE->subCategory == 1) {
                                                                    echo 'selected';
                                                                }
                                                                ?>>
                                                                    AC
                                                                </option>
                                                                <option value="2" <?php
                                                                if ($PACKAGE->subCategory == 2) {
                                                                    echo 'selected';
                                                                }
                                                                ?>>
                                                                    Non AC
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Vehicle Sub Category-->
                                            <?php
                                        } elseif ($CATEGORY->id == 2) {
                                            ?>
                                            <input type="hidden" id="category"  value="<?php echo $PACKAGE->category; ?>" >
                                            <input type="hidden" id="subcategory" name="subcategory"  value="1">
                                            <?php
                                        } elseif ($CATEGORY->id == 3) {
                                            ?>
                                            <input type="hidden" id="category"  value="<?php echo $PACKAGE->category; ?>" >
                                            <input type="hidden" id="subcategory" name="subcategory"  value="2">
                                            <?php
                                        }
                                        ?>
                                        <div class="row clearfix" >
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="package_type">Type</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select class="form-control place-select1 show-tick" id="package_type" name="package_type">
                                                            <option value=""> -- Please Select Package Type -- </option>
                                                            <?php foreach (PackageType::all() as $pack) {
                                                                ?>
                                                                <option value="<?php echo $pack['id']; ?>" <?php
                                                                if ($PACKAGE->packageType === $pack['id']) {
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
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="row clearfix" id="package-bar">
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
                                    <?php
                                    if ($BOOKING->status === 'completed') {
                                        $title = 'Gross Amount';
                                    } else {
                                        $title = 'Total Amount';
                                    }
                                    ?>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="total_cost"><?php echo $title; ?> (Rs)</label>
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
                                            <label for="no_of_adults">No of Adults</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="number" id="no_of_adults" class="form-control input-append"  autocomplete="off" name="no_of_adults" required="true" placeholder="No of Adults" min="0" value="<?php echo $BOOKING->no_of_adults; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="no_of_children">No of Children</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="number" id="no_of_children" class="form-control input-append"  autocomplete="off" name="no_of_children" required="true" placeholder="No of Children" min="0" value="<?php echo $BOOKING->no_of_children; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix" id="seating-capacity-bar">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="seating_capacity">Seating Capacity</label>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="number" id="seating_capacity" class="form-control input-append"  autocomplete="off" name="seating_capacity" required="true" placeholder="Seating Capacity" min="0" value="<?php echo $BOOKING->seating_capacity; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="no_of_hard_baggage">No of Hard Baggage</label>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="number" id="no_of_hard_baggage" class="form-control input-append"  autocomplete="off" name="no_of_hard_baggage" required="true" placeholder="No of Hard Baggage" min="0" value="<?php echo $BOOKING->no_of_hard_baggage; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="no_of_hand_baggage">No of Hand Baggage</label>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="number" id="no_of_hand_baggage" class="form-control input-append"  autocomplete="off" name="no_of_hand_baggage" required="true" placeholder="No of Hand Baggage" min="0" value="<?php echo $BOOKING->no_of_hand_baggage; ?>">
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
                                                <?php
                                                if ($BOOKING->status === 'pending') {
                                                    ?>
                                                    <input class="filled-in chk-col-pink" type="checkbox" name="confirmed" value="1" id="rememberme" />
                                                    <label for="rememberme">Confirmed</label>
                                                    <?php
                                                } elseif ($BOOKING->status === 'confirmed') {
                                                    ?>
                                                    <input class="filled-in chk-col-pink" type="checkbox" name="completed" value="1" id="rememberme" />
                                                    <label for="rememberme">Completed</label>
                                                    <?php
                                                }
                                                ?>

                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    if ($BOOKING->status === 'completed') {
                                        ?>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="name">Feedback Comment</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group form-float">
                                                    <label class="form-label"></label>
                                                    <div class="form-line">
                                                        <textarea id="feedback" name="feedback" class="form-control" rows="5" ><?php echo $BOOKING->feedbackComment; ?></textarea> 
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
                                                        <input type="text" id="final_cost" class="form-control"  autocomplete="off" name="final_cost" required="true" placeholder="Final Cost" value="<?php echo $BOOKING->finalCost; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <input type="hidden" id="id" value="<?php echo $BOOKING->id; ?>" name="id"/>
                                        <input type="hidden" id="status" value="<?php echo $BOOKING->status; ?>" name="status"/>
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect" name="update" value="update" <?php echo $disabled; ?>>Save Changes</button>
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
        <script src="js/booking-package-details.js" type="text/javascript"></script>
        <script>
            $('#start_date').datepicker({
                dateFormat: 'yy-mm-dd'
            });
            $('#end_date').datepicker({
                dateFormat: 'yy-mm-dd'
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
        <script>
            tinymce.init({
                selector: "#feedback",
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