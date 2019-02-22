<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['create'])) {

    $VEHICLETYPE = new VehicleType(NULL);
    $VALID = new Validator();

    $VEHICLETYPE->type = $_POST['vehicletype'];

    $VALID->check($VEHICLETYPE, [
        'type' => ['required' => TRUE],
    ]);

    if ($VALID->passed()) {
        $VEHICLETYPE->create();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your data was saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();        
        header('Location: ' . $_SERVER['HTTP_REFERER']);

//              header("location: ../create-vehicle.php?id=" . $VEHICLETYPE->id);
    } else {


        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}



if (isset($_POST['update'])) {

    $Vtype = new VehicleType($_POST['id']);

    $Vtype->type = $_POST['vehicletype'];


    $VALID = new Validator();
    $VALID->check($Vtype, [
        'type' => ['required' => TRUE]
  
    ]);

    if ($VALID->passed()) {
        $Vtype->update();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your changes saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

//if (isset($_POST['save-data'])) {
//
//    foreach ($_POST['sort'] as $key => $img) {
//        $key = $key + 1;
//
//        $USER = Comments::arrange($key, $img);
//
//        header('Location: ' . $_SERVER['HTTP_REFERER']);
//    }
//}