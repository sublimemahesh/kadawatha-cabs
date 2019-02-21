<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'CHECKVEHICLENO') {
    if (!empty($_POST["vehicle_number"])) {
        $vehicle = new Vehicle($_POST['id']);

        if ($vehicle->vehicle_number == $_POST["vehicle_number"]) {
            $result = FALSE;
        } else {
            $VEHICLE = new Vehicle(NULL);
            $result = $VEHICLE->checkVehicleNo($_POST["vehicle_number"]);
          }
          
        header('Content-type: application/json');
        echo json_encode($result);
        exit();
    }
}
