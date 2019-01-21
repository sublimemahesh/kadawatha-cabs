<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'delete') {

    $ACTIVITY_PHOTO = new ActivitiesPhoto($_POST['id']);

    unlink('../../../upload/activity/gallery/' . $ACTIVITY_PHOTO->image_name);
    unlink('../../../upload/activity/gallery/thumb/' . $ACTIVITY_PHOTO->image_name);

    $result = $ACTIVITY_PHOTO->delete();


    if ($result) {

        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}