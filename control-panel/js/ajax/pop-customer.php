<?php
include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'createCus') {
    
    $CUSTOMER = new Customer(null);
    $CUSTOMER->fullname = $_POST['fullname'];
    $CUSTOMER->address = $_POST['address'];
    $CUSTOMER->nic = $_POST['nic'];
    $CUSTOMER->mobile_number = $_POST['mobile_number'];
    $CUSTOMER->city = $_POST['city'];
    $result = $CUSTOMER->create();
   
    if ($result) {
       
        $data = array("status" => TRUE);
            header('Content-type: application/json');
        echo json_encode($data);
        exit();
    }
    
//     header('Content-type: application/json');
//       echo json_encode($result);
//       
}
