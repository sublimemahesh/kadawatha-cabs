<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'CHECKNIC') {
    if (!empty($_POST["nic"])) {
        $CUSTOMER = new Customer(NULL);
        $result = $CUSTOMER::checkNic($_POST["nic"]);
        header('Content-type: application/json');
        echo json_encode($result);
        exit();
    }
}
if ($_POST['option'] == 'CHECKPHONENUMBER') {
    
    if (!empty($_POST["phoneNumber"])) {
        $CUSTOMER = new Customer(NULL);
        $result = $CUSTOMER::checkMobileNumber($_POST["phoneNumber"]);
        header('Content-type: application/json');
        echo json_encode($result);
        exit();
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             