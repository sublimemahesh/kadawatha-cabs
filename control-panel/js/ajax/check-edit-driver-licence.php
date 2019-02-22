<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'CHECKLICENCE') {
    if (!empty($_POST["licenceNum"])) {
        $Driver = new Driver($_POST['id']);

        if ($Driver->licence_number == $_POST["licenceNum"]) {
            $result = FALSE;
        } else {
            $Driver = new Driver(NULL);
            $result = $Driver->checkLicence($_POST["licenceNum"]);
          }
   
        header('Content-type: application/json');
        echo json_encode($result);
        exit();
    }
}
