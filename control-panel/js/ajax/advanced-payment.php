<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'ADDADVANCEDPAYMENT') {
    $PAYMENT = new BookingPayment(NULL);

    $PAYMENT->booking = $_POST['booking'];
    $PAYMENT->receiptDate = $_POST['receipt_date'];
    $PAYMENT->receiptNumber = $_POST['receipt_no'];
    $PAYMENT->advancedTotal = $_POST['paid_amount'];
    $PAYMENT->receivedBy = $_POST['received_by'];
    $result = $PAYMENT->create();

    if ($result) {
        $BOOKING = new Booking($_POST['booking']);
        if ($BOOKING->status == 'pending') {
            $BOOKING->markAsConfirmed();
        }
    }

    header('Content-type: application/json');
    echo json_encode($result);
    exit();
}
if ($_POST['option'] == 'GETDUEAMOUNT') {
    $payments = BookingPayment::getPaymentsByBookingID($_POST['booking']);

    $tot = 0;

    foreach ($payments as $payment) {
        $tot += (float) $payment['advanced_total'];
    }

    header('Content-type: application/json');
    echo json_encode($tot);
    exit();
}
