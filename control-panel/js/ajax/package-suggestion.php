<?php
include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'GETNAME') {
      if (!empty($_POST["keyword"])) {
        $PACKAGE = new Packages(NULL);

        $result = $PACKAGE->allNamesByKeyword($_POST["keyword"]);
           header('Content-Type: application/json');

        echo json_encode($result);
        exit();
    }
}