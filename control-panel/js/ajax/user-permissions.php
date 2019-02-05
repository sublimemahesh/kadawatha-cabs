<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'GETUSERPERMISSIONS') {
    $USER = new User($_POST['id']);

    $PERMISSIONS = unserialize($USER->permissions);
   
    header('Content-Type: application/json');

    echo json_encode($PERMISSIONS);
    exit();
}