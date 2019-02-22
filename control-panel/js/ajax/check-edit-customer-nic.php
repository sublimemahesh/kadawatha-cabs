<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'CHECKVEHICLENO') {
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
