<?php
include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'GETNAME') {
      if (!empty($_POST["keyword"])) {
        $VEHICLETYPE = new VehicleType(NULL);

        $result = $VEHICLETYPE->allNamesByKeyword($_POST["keyword"]);
           header('Content-Type: application/json');

        echo json_encode($result);
        exit();
    }
}