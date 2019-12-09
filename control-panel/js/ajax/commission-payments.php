<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'GETCOMMISSIONS') {
    $result = DefaultData::getDriverCommission();

    header('Content-type: application/json');
    echo json_encode($result);
    exit();
}
if ($_POST['option'] == 'GETCOMMISSIONUNPAIDBOOKINGS') {
    $bookings = Booking::getCommissionUnpaidBookingsByID($_POST["id"]);
    
    $commissions = DefaultData::getDriverCommission();

    $arr_booking = array();
    $arr_all_bookings = array();

    foreach ($bookings as $booking) {
        $DRIVER = new Driver($booking['driver']);
        foreach ($commissions as $key => $commission) {
            if ($key == $DRIVER->type) {
                $payableCommission = (int)$commission/100 * $booking['total_cost'];
                
            }
        }
        $arr_booking["id"] = $booking["id"];
        $arr_booking["total"] = $booking["total_cost"];
        $arr_booking["commission"] = $payableCommission;
        array_push($arr_all_bookings, $arr_booking);
    }
    

    header('Content-type: application/json');
    echo json_encode($arr_all_bookings);
    exit();
}
