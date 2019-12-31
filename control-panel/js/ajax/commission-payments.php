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
                if ($booking["final_cost"] != "0.00") {
                    $total = $booking["final_cost"];
                } else {
                    $total = $booking["total_cost"];
                }
                $payableCommission = ((int) $commission / 100 * $total) + 50;
            }
        }
        $arr_booking["id"] = $booking["id"];
        if ($booking["final_cost"] != "0.00") {
            $arr_booking["total"] = $booking["final_cost"];
        } else {
            $arr_booking["total"] = $booking["total_cost"];
        }

        $arr_booking["commission"] = $payableCommission;
        array_push($arr_all_bookings, $arr_booking);
    }


    header('Content-type: application/json');
    echo json_encode($arr_all_bookings);
    exit();
}
