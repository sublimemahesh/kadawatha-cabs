<?php
include_once(dirname(__FILE__) . '/../../../class/include.php');

if ($_POST['option'] == 'GETSTARTANDENDDATE') {
    $Dates = Booking::getFirstAndLastBookingDates();
  
    header('Content-Type: application/json');

    echo json_encode($Dates);
    exit();
}
if ($_POST['option'] == 'GETBOOKINGSBYSTARTANDENDDATE') {
    
    $bookings = Booking::getBookingsByDateRange($_POST['from'], $_POST['to']);
    $arr = array();
    $bookingarr = array();
     
    foreach ($bookings as $booking) {
        
        $CUSTOMER = new Customer($booking['customer']);
        $TYPE = new VehicleType($booking['vehicle_type']);
        $VEHICLE = new Vehicle($booking['vehicle']);
        $DRIVER = new Driver($booking['driver']);
        $PACKAGE = new Packages($booking['package']);
        
        $arr['customer'] = $CUSTOMER->fullname;
        $arr['vehicle_type'] = $TYPE->type;
        $arr['vehicle'] = $VEHICLE->vehicle_name;
        $arr['driver'] = $DRIVER->name;
        $arr['package'] = $PACKAGE->name;
        $arr['owner'] = $VEHICLE->owner;
        $arr['created_at'] = $booking['created_at'];
        $arr['id'] = $booking['id'];
       
        array_push($bookingarr, $arr);
    }

    header('Content-Type: application/json');

    echo json_encode($bookingarr);
    exit();
}