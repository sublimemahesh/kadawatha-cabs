<?php
include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'delete') {

    $COMMISSIONPAYMENT = new CommissionPayment($_POST['id']);

    $result = $COMMISSIONPAYMENT->delete();

    if ($result) {
        $BOOKING = new Booking(NULL);
        $BOOKING->paidCommission = $_POST['id'];
        $BOOKING->updatePaidCommissionTo0();

        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}