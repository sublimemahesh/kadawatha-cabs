<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['action'] == 'GETVEHICLESBYTYPE') {

    $VEHICLE = new Vehicle(NULL);

    $result = $VEHICLE->GetVehiclesByType($_POST["type"]);
    echo json_encode($result);
    header('Content-type: application/json');
    exit();
}
