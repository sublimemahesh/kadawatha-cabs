<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'delete') {

    $DRIVER = new Driver($_POST['id']);

    unlink('../../../upload/Driver/back_side/' . $DRIVER->licence_image_back);
    unlink('../../../upload/Driver/front_side/' . $DRIVER->licence_image_front);

    $result = $DRIVER->delete();

    if ($result) {

        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}