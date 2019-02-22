<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'CHECKLICENCE') {
    if (!empty($_POST["licenceNum"])) {

        $DRIVER = new Driver(NULL);
        $result = $DRIVER->checkLicence($_POST["licenceNum"]);
      
        header('Content-type: application/json');
        echo json_encode($result);
        exit();


//     header('Content-type: application/json');
//       echo json_encode($result);
//   
    }
}
