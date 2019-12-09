<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');

if ($_POST['option'] == 'GETPAYMENTDETAILSBYSTARTANDENDDATE') {

    $from_string = new DateTime($_POST['from'] . " 00:00:00");
    $from = $from_string->format('Y-m-d H:i:s');
    $to_string = new DateTime($_POST['to'] . " 23:59:59");
    $to = $to_string->format('Y-m-d H:i:s');
    $driver = '';
    
    if($_POST['driver'] == 'all') {
        $driver = '';
    } else {
        $driver = $_POST['driver'];
    }
    $bookings = Booking::getBookingsByEndDate($from, $to, $driver);
    $commissions = DefaultData::getDriverCommission();
    $arr = array();
    $bookingarr = array();

    foreach ($bookings as $booking) {
 
        $CUSTOMER = new Customer($booking['customer']);
        $TYPE = new VehicleType($booking['vehicle_type']);
        $VEHICLE = new Vehicle($booking['vehicle']);
        $DRIVER = new Driver($booking['driver']);
        $PACKAGE = new Packages($booking['package']);

        foreach ($commissions as $key => $commission) {
           
            if($key == $DRIVER->type) {
                $rate = $commission;
            }
        }
        
        $arr['id'] = $booking['id'];
        $arr['vehicle_type'] = $TYPE->type;
        $arr['vehicle_no'] = $VEHICLE->vehicle_number;
        $arr['driver'] = $DRIVER->name;
        $arr['total'] = $booking['total_cost'];
        $arr['rate'] = $rate;
        $arr['commission'] = (int) $booking['total_cost'] * (int) $rate/100;


        array_push($bookingarr, $arr);
    }

    header('Content-Type: application/json');

    echo json_encode($bookingarr);
    exit();
}