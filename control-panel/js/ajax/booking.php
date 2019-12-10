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