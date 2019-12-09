<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['pay-commission'])) {

    $COMMISSION_PAYMENTS = new CommissionPayment(NULL);
    $VALID = new Validator();
    $COMMISSION_PAYMENTS->driver = $_POST['driver'];
    $COMMISSION_PAYMENTS->amount = $_POST['payable-commission'];
    $COMMISSION_PAYMENTS->paidAt = $_POST['paid-at'];
    $payableBookings = $_POST['payable-bookings'];



    $VALID->check($COMMISSION_PAYMENTS, [
        'driver' => ['required' => TRUE],
        'amount' => ['required' => TRUE],
        'paidAt' => ['required' => TRUE]
    ]);


    if ($VALID->passed()) {
        $result = $COMMISSION_PAYMENTS->create();

        if ($result) {
            foreach ($payableBookings as $booking) {

                $BOOKING = new Booking(NULL);
                $BOOKING->id = $booking;
                $BOOKING->paidCommission = $result->id;

                $res = $BOOKING->updatePaidCommission();
                if ($res) {
                    if (!isset($_SESSION)) {
                        session_start();
                    }
                    $VALID->addError("Your data was saved successfully", 'success');
                    $_SESSION['ERRORS'] = $VALID->errors();

                    if ($_POST['booking']) {
                        header('Location: ../manage-booking.php');
                    } else {
                        header('Location: ' . $_SERVER['HTTP_REFERER']);
                    }
                }
            }
        }
    } else {
        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}