<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['action'] == 'GETSUBTYPESBYTYPE') {

    $SUBTYPE = new VehicleSubType(NULL);

    $result = $SUBTYPE->GetSubTypesByType($_POST["type"]);
    echo json_encode($result);
    header('Content-type: application/json');
    exit();
}
if ($_POST['action'] == 'GETVEHICLESBYSUBTYPE') {

    $VEHICLE = new Vehicle(NULL);

    $result = $VEHICLE->GetVehiclesBySubType($_POST["subtype"]);
    echo json_encode($result);
    header('Content-type: application/json');
    exit();
}
if ($_POST['action'] == 'GETDRIVERS') {
    $DRIVER = Driver::getDriversByVehicleType($_POST['vtype']);
    echo json_encode($DRIVER);
    header('Content-type: application/json');
    exit();
}

