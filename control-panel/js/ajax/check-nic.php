<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'CHECKNIC') {
    if (!empty($_POST["nic"])) {

        $DRIVER = new Driver(NULL);
        $result = $DRIVER::checkNic($_POST["nic"]);

        header('Content-type: application/json');
        echo json_encode($result);
        exit();
    }
}
if ($_POST['option'] == 'CHECKNICFOREDIT') {

    if (!empty($_POST["nic"])) {
        $Driver = new Driver($_POST['id']);

        if ($Driver->nic == $_POST["nic"]) {
            $result = FALSE;
        } else {
            $Driver = new Driver(NULL);
            $result = $Driver->checkNic($_POST["nic"]);
        }
        header('Content-type: application/json');
        echo json_encode($result);
        exit();
    }
}
      
