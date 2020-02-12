<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['create'])) {

    $VEHICLESUBTYPE = new VehicleSubType(NULL);
    $VALID = new Validator();

    $VEHICLESUBTYPE->type = $_POST['type'];
    $VEHICLESUBTYPE->name = $_POST['name'];
    $VEHICLESUBTYPE->noOfSeats = $_POST['no_of_seats'];
    $VEHICLESUBTYPE->category = $_POST['category'];

    $VALID->check($VEHICLESUBTYPE, [
        'type' => ['required' => TRUE],
        'name' => ['required' => TRUE],
        'noOfSeats' => ['required' => TRUE],
        'category' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $VEHICLESUBTYPE->create();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your data was saved successfully", 'success');
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



if (isset($_POST['update'])) {

    $VEHICLESUBTYPE = new VehicleSubType($_POST['id']);

    $VEHICLESUBTYPE->type = $_POST['type'];
    $VEHICLESUBTYPE->name = $_POST['name'];
    $VEHICLESUBTYPE->noOfSeats = $_POST['no_of_seats'];
    $VEHICLESUBTYPE->category = $_POST['category'];


    $VALID = new Validator();
    $VALID->check($VEHICLESUBTYPE, [
        'type' => ['required' => TRUE],
        'name' => ['required' => TRUE],
        'noOfSeats' => ['required' => TRUE],
        'category' => ['required' => TRUE]
  
    ]);

    if ($VALID->passed()) {
        $VEHICLESUBTYPE->update();

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