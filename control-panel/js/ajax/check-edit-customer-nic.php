<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'CHECKNIC') {
    if (!empty($_POST["nic"])) {
        $CUSTOMER = new Customer($_POST['id']);

        if ($CUSTOMER->nic == $_POST["nic"]) {
            $result = FALSE;
        } else {
            $CUSTOMER = new Customer(NULL);
            $result = $CUSTOMER->checkNic($_POST["nic"]);
        }
       
        header('Content-type: application/json');
        echo json_encode($result);
        exit();
    }
}
if ($_POST['option'] == 'CHECKPHONENUMBER') {
    if (!empty($_POST["phoneNumber"])) {
        $CUSTOMER = new Customer($_POST['id']);

        if ($CUSTOMER->mobile_number == $_POST["phoneNumber"]) {
            $result = FALSE;
        } else {
            $CUSTOMER = new Customer(NULL);
            $result = $CUSTOMER->checkMobileNumber($_POST["phoneNumber"]);
        }
       
        header('Content-type: application/json');
        echo json_encode($result);
        exit();
    }
}
