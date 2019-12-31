<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['create'])) {

    $BOOKING = new Booking(NULL);
    $VALID = new Validator();
    $BOOKING->referenceNo = $_POST['reference_no'];
    $BOOKING->customer = $_POST['id'];
    $BOOKING->start_date = $_POST['start_date'];
    $BOOKING->start_time = $_POST['start_time'];
    $BOOKING->end_date = $_POST['end_date'];
    $BOOKING->end_time = $_POST['end_time'];
    $BOOKING->no_of_days = $_POST['no_of_days'];
    $BOOKING->start_from = $_POST['start_from'];
    $BOOKING->end_from = $_POST['end_from'];
    $BOOKING->vehicleType = $_POST['vehicle_type'];
    $BOOKING->vehicle = $_POST['vehicle'];
    $BOOKING->driver = $_POST['driver'];
    $BOOKING->total_cost = $_POST['total_cost'];
    $BOOKING->package = $_POST['package'];
    $BOOKING->no_of_adults = $_POST['no_of_adults'];
    $BOOKING->no_of_children = $_POST['no_of_children'];
    $BOOKING->seating_capacity = $_POST['seating_capacity'];
    $BOOKING->no_of_hard_baggage = $_POST['no_of_hard_baggage'];
    $BOOKING->no_of_hand_baggage = $_POST['no_of_hand_baggage'];
    $BOOKING->comment = $_POST['comment'];
    $BOOKING->status = 'pending';


    $VALID->check($BOOKING, [
        'customer' => ['required' => TRUE],
        'start_date' => ['required' => TRUE],
        'start_time' => ['required' => TRUE],
        'end_date' => ['required' => TRUE],
        'end_time' => ['required' => TRUE],
        'no_of_days' => ['required' => TRUE],
        'start_from' => ['required' => TRUE],
        'end_from' => ['required' => TRUE],
        'vehicleType' => ['required' => TRUE],
        'total_cost' => ['required' => TRUE],
        'no_of_adults' => ['required' => TRUE],
        'no_of_children' => ['required' => TRUE],
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

    date_default_timezone_set('Asia/Colombo');
    $date = date('Y-m-d');

    $BOOKING = new Booking($_POST['id']);

    $BOOKING->customer = $_POST['customer'];
    $BOOKING->start_date = $_POST['start_date'];
    $BOOKING->start_time = $_POST['start_time'];
    $BOOKING->end_date = $_POST['end_date'];
    $BOOKING->end_time = $_POST['end_time'];
    $BOOKING->no_of_days = $_POST['no_of_days'];
    $BOOKING->start_from = $_POST['start_from'];
    $BOOKING->end_from = $_POST['end_from'];
    $BOOKING->vehicleType = $_POST['vehicle_type'];
    $BOOKING->vehicle = $_POST['vehicle'];
    $BOOKING->driver = $_POST['driver'];
    $BOOKING->total_cost = $_POST['total_cost'];
    $BOOKING->package = $_POST['package'];
    $BOOKING->no_of_adults = $_POST['no_of_adults'];
    $BOOKING->no_of_children = $_POST['no_of_children'];
    $BOOKING->seating_capacity = $_POST['seating_capacity'];
    $BOOKING->no_of_hard_baggage = $_POST['no_of_hard_baggage'];
    $BOOKING->no_of_hand_baggage = $_POST['no_of_hand_baggage'];
    $BOOKING->comment = $_POST['comment'];
//    $BOOKING->isActive = $_POST['active'];
    if (isset($_POST['confirmed'])) {
        $BOOKING->status = 'confirmed';
        $BOOKING->confirmedAt = $date;
    } elseif (isset($_POST['completed'])) {
        $BOOKING->status = 'completed';
        $BOOKING->completedAt = $date;
    }
    if ($_POST['status'] === 'completed') {
        $BOOKING->feedbackComment = $_POST['feedback'];
        $BOOKING->finalCost = $_POST['final_cost'];
    }

    $VALID = new Validator();
    $VALID->check($BOOKING, [
        'customer' => ['required' => TRUE],
        'start_date' => ['required' => TRUE],
        'start_time' => ['required' => TRUE],
        'end_date' => ['required' => TRUE],
        'end_time' => ['required' => TRUE],
        'no_of_days' => ['required' => TRUE],
        'start_from' => ['required' => TRUE],
        'end_from' => ['required' => TRUE],
        'vehicleType' => ['required' => TRUE],
        'total_cost' => ['required' => TRUE],
        'no_of_adults' => ['required' => TRUE],
        'no_of_children' => ['required' => TRUE],
        'total_cost' => ['required' => TRUE],
        'comment' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $RESULT = $BOOKING->update();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your changes saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();

        if ($RESULT->status === 'pending') {
            header("location: ../manage-bookings.php?status=1");
        } elseif ($RESULT->status === 'confirmed') {
            header("location: ../manage-bookings.php?status=2");
        } elseif ($RESULT->status === 'completed') {
            header("location: ../manage-bookings.php?status=3");
        } else {
            header("location: ../manage-bookings.php?status=4");
        }
    } else {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}