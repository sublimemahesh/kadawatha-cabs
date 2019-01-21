<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'delete') {

    $ALBUM_PHOTO = new AlbumPhoto($_POST['id']);

    unlink('../../../upload/photo-album/gallery/' . $ALBUM_PHOTO->image_name);
    unlink('../../../upload/photo-album/gallery/thumb/' . $ALBUM_PHOTO->image_name);

    $result = $ALBUM_PHOTO->delete();


    if ($result) {

        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}