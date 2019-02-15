<?php
include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'GETNAME') {
      if (!empty($_POST["keyword"])) {
        $DRIVER = new Driver(NULL);

        $result = $DRIVER->allNamesByKeyword($_POST["keyword"]);
           header('Content-Type: application/json');

        echo json_encode($result);
        exit();
    }
}