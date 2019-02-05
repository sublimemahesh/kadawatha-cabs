<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'delete') {

    $VEHICLE = new VehiclePhoto($_POST['id']);
    
    $result = $VEHICLE->delete();
//  unlink('../../../upload/user/' . $VEHICLE->image);
    if ($result) {

        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}