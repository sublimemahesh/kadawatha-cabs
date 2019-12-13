<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'SEARCHCUSTOMERBYNIC') {
    if (!empty($_POST["nic"])) {
        $result = Customer::getCustomerByNIC($_POST["nic"]);
        header('Content-type: application/json');
        echo json_encode($result);
        exit();
    }
}
if ($_POST['option'] == 'SEARCHCUSTOMERBYPHONE') {
    
    if (!empty($_POST["phoneNumber"])) {
        $result = Customer::getCustomerByPhoneNo($_POST["phoneNumber"]);
        header('Content-type: application/json');
        echo json_encode($result);
        exit();
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             