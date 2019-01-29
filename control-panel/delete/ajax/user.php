<img src="../../../upload/user/-12304688_191190836218_1548069771_n.jpg" alt=""/>
<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'delete') {

    $USER = new User($_POST['id']);
    
  unlink('../../../upload/user/' . $USER->profile_picture);
    
    $result = $USER->delete();

    if ($result) {

        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}