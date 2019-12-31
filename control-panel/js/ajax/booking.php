<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'confirm') {

    $BOOKING = new Booking($_POST['id']);

    $result = $BOOKING->markAsConfirmed();

    if ($result) {

        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}
if ($_POST['option'] == 'complete') {

    $BOOKING = new Booking($_POST['id']);

    $result = $BOOKING->markAsCompleted();

    if ($result) {

        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}
if ($_POST['option'] == 'cancel') {

    $BOOKING = new Booking($_POST['id']);

    $result = $BOOKING->cancelBooking();

    if ($result) {

        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}

if ($_POST['option'] == 'GETSTARTANDENDDATE') {

    $arr = array();
    $start_date = date("Y-m-d", strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . "-1 month"));
    $arr['start_date'] = $start_date;
    $arr['end_date'] = date("Y-m-d");

    header('Content-Type: application/json');

    echo json_encode($arr);
    exit();
}
if ($_POST['option'] == 'GETBOOKINGSBYSTARTENDDATESANDSTATUS') {

    $bookings = Booking::getBookingsByDateRangeAndStatus($_POST['from'], $_POST['to'], $_POST['status']);
    
    $arr = array();
    $bookingsarr = array();
    $tot_cost = 0;
    foreach ($bookings as $booking) {
        $CUSTOMER = new Customer($booking['customer']);
        $PACKAGE = new Packages($booking['package']);

        $payments = BookingPayment::getPaymentsByBookingID($booking['id']);
        $tot = 0;

        foreach ($payments as $payment) {
            $tot += (float) $payment['advanced_total'];
        }

        $arr['id'] = $booking['id'];
        $arr['ref_no'] = $booking['reference_no'];
        $arr['date'] = $booking['created_at'];
        $arr['customer'] = $CUSTOMER->fullname;
        $arr['nic'] = $CUSTOMER->nic;
        $arr['start_date'] = $booking['start_date'];
        $arr['end_date'] = $booking['end_date'];
        $arr['total_amount'] = number_format($booking['total_cost'], 2);
        $arr['paid_amount'] = number_format($tot, 2);
        $arr['due_amount'] = number_format($booking['total_cost'] - $tot, 2);

        array_push($bookingsarr, $arr);
    }

    header('Content-Type: application/json');

    echo json_encode($bookingsarr);
    exit();
}