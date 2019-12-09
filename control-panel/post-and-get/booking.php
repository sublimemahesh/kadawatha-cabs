<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['create'])) {

    $BOOKING = new Booking(NULL);
    $VALID = new Validator();
    $BOOKING->customer = $_POST['id'];
    $BOOKING->start_date = $_POST['start_date'];
    $BOOKING->end_date = $_POST['end_date'];
    $BOOKING->vehicleType = $_POST['vehicle_type'];
    $BOOKING->vehicle = $_POST['vehicle'];
    $BOOKING->driver = $_POST['driver'];
    $BOOKING->total_cost = $_POST['total_cost'];
    $BOOKING->package = $_POST['package'];
    $BOOKING->comment = $_POST['comment'];


    $VALID->check($BOOKING, [
        'customer' => ['required' => TRUE],
        'start_date' => ['required' => TRUE],
        'end_date' => ['required' => TRUE],
        'vehicleType' => ['required' => TRUE],
        'total_cost' => ['required' => TRUE],
        'comment' => ['required' => TRUE]
    ]);
  

    if ($VALID->passed()) {
        $BOOKING->create();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your data was saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {


        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}



if (isset($_POST['update'])) {

    $BOOKINGU = new Booking($_POST['id']);

    $BOOKINGU->customer = $_POST['customer'];
    $BOOKINGU->start_date = $_POST['start_date'];
    $BOOKINGU->end_date = $_POST['end_date'];
    $BOOKINGU->vehicleType = $_POST['vehicle_type'];
    $BOOKINGU->vehicle = $_POST['vehicle'];
    $BOOKINGU->driver = $_POST['driver'];
    $BOOKINGU->total_cost = $_POST['total_cost'];
    $BOOKINGU->package = $_POST['package'];
    $BOOKINGU->comment = $_POST['comment'];
    $BOOKINGU->isActive = $_POST['active'];
    

    $VALID = new Validator();
    $VALID->check($BOOKINGU, [
        'customer' => ['required' => TRUE],
        'start_date' => ['required' => TRUE],
        'end_date' => ['required' => TRUE],
        'vehicleType' => ['required' => TRUE],
        'total_cost' => ['required' => TRUE],
        'comment' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $BOOKINGU->update();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your changes saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

//if (isset($_POST['save-data'])) {
//
//    foreach ($_POST['sort'] as $key => $img) {
//        $key = $key + 1;
//
//        $USER = Comments::arrange($key, $img);
//
//        header('Location: ' . $_SERVER['HTTP_REFERER']);
//    }
//}