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
if ($_POST['action'] == 'GETDRIVERBYVEHICLE') {

    $VEHICLE = new Vehicle($_POST["vehicle"]);
    $DRIVER = new Driver($VEHICLE->driver);
    echo json_encode($DRIVER);
    header('Content-type: application/json');
    exit();
}

