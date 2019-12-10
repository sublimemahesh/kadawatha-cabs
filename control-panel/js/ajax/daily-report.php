<?php
include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'GETSTARTANDENDDATE') {

    $arr = array();
    $arr['start_date'] = date("Y-m-d");
    $arr['end_date'] = date("Y-m-d");

    header('Content-Type: application/json');

    echo json_encode($arr);
    exit();
}
if ($_POST['option'] == 'GETBOOKINGSBYSTARTANDENDDATE') {

    $bookings = Booking::getBookingsByDateRange($_POST['from'], $_POST['to']);

    $arr = array();
    $bookingsarr = array();
    $finalarr = array();
    $tot_cost = 0;
    foreach ($bookings as $booking) {

        $VTYPE = new VehicleType($booking['vehicle_type']);
        $VEHICLE = new Vehicle($booking['vehicle']);
        $DRIVER = new Driver($booking['driver']);
        $CUSTOMER = new Customer($booking['customer']);
        $PACKAGE = new Packages($booking['package']);
        
        $arr['date'] = $booking['created_at'];
        $arr['customer'] = $CUSTOMER->fullname;
        $arr['vehicle_type'] = $VTYPE->type;
        $arr['vehicle'] = $VEHICLE->vehicle_name;
        $arr['driver'] = $DRIVER->name;
        $arr['package'] = $PACKAGE->name;
        $arr['cost'] = number_format($booking['total_cost'],2);
        $tot_cost += (float) $booking['total_cost'];
        array_push($bookingsarr, $arr);
    }
    $finalarr['details'] = $bookingsarr;
    $finalarr['tot_cost'] = number_format($tot_cost,2);

    header('Content-Type: application/json');

    echo json_encode($finalarr);
    exit();
}