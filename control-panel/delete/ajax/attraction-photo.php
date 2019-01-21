<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'delete') {

    $ATTRACTION_PHOTO = new AttractionPhoto($_POST['id']);

    unlink(Helper::getSitePath() . "upload/attraction/gallery/" . $ATTRACTION_PHOTO->image_name);
    unlink(Helper::getSitePath() . "upload/attraction/gallery/thumb/" . $ATTRACTION_PHOTO->image_name);

    $result = $ATTRACTION_PHOTO->delete();

    if ($result) {

        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}