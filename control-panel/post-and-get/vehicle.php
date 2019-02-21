<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['create'])) {

    $VEHICLE = new Vehicle(NULL);
    $VALID = new Validator();

    $VEHICLE->vehicle_type = $_POST['type'];
    $VEHICLE->owner = $_POST['owner'];
    $VEHICLE->vehicle_number = $_POST['vehicle_number'];
    $VEHICLE->vehicle_name = $_POST['vehicle_name'];
    $VEHICLE->contact_number = $_POST['contactnum'];
    $VEHICLE->city = $_POST['city'];
    $VEHICLE->condition = $_POST['condition'];
    $VEHICLE->no_of_passenger = $_POST['noofpassenger'];
    $VEHICLE->no_of_baggage = $_POST['noofbaggage'];
    $VEHICLE->no_of_door = $_POST['noofdoor'];
    $VEHICLE->driver = $_POST['drivertype'];


    $dir_dest = '../../upload/vehicle/';

    $handle = new Upload($_FILES['vehicle_image']);

    $imgName = null;

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_ext = 'jpg';
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = Helper::randamId();
        $handle->image_x = 300;
        $handle->image_y = 300;

        $handle->Process($dir_dest);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }
    }

    $VEHICLE->vehicle_image = $imgName;

    $VALID->check($VEHICLE, [
        'vehicle_type' => ['required' => TRUE],
        'owner' => ['required' => TRUE],
        'vehicle_number' => ['required' => TRUE],
        'vehicle_name' => ['required' => TRUE],
        'contact_number' => ['required' => TRUE],
        'city' => ['required' => TRUE],
        'condition' => ['required' => TRUE],
        'no_of_passenger' => ['required' => TRUE],
        'no_of_baggage' => ['required' => TRUE],
        'no_of_door' => ['required' => TRUE]
//        ,
//        'vehicle_image' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $VEHICLE->create();

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
    $dir_dest = '../../upload/vehicle/';

//    $handle = new Upload($_FILES['vehicle_image']);

    $imgName = null;

//    if ($handle->uploaded) {
//        $handle->image_resize = true;
//        $handle->file_new_name_body = TRUE;
//        $handle->file_overwrite = TRUE;
//        $handle->file_new_name_ext = FALSE;
//        $handle->image_ratio_crop = 'C';
//        $handle->file_new_name_body = $_POST ["oldImageName"];
//        $handle->image_x = 300;
//        $handle->image_y = 300;
//
//        $handle->Process($dir_dest);
//
//        if ($handle->processed) {
//            $info = getimagesize($handle->file_dst_pathname);
//            $imgName = $handle->file_dst_name;
//        }
//    }

    $VEHICLE = new vehicle($_POST['id']);

//    $VEHICLE->vehicle_image = $_POST['oldImageName'];
    $VEHICLE->vehicle_type = $_POST['type'];
    $VEHICLE->owner = $_POST['owner'];
    $VEHICLE->vehicle_number = $_POST['vehicle_number'];
    $VEHICLE->vehicle_name = $_POST['vehicle_name'];
    $VEHICLE->contact_number = $_POST['contactnum'];
    $VEHICLE->city = $_POST['city'];
    $VEHICLE->condition = $_POST['condition'];
    $VEHICLE->no_of_passenger = $_POST['noofpassenger'];
    $VEHICLE->no_of_baggage = $_POST['noofbaggage'];
    $VEHICLE->no_of_door = $_POST['noofdoor'];
    $VEHICLE->driver = $_POST['drivertype'];


    $VALID = new Validator();
    $VALID->check($VEHICLE, [
        'vehicle_type' => ['required' => TRUE],
        'owner' => ['required' => TRUE],
        'vehicle_number' => ['required' => TRUE],
        'vehicle_name' => ['required' => TRUE],
        'contact_number' => ['required' => TRUE],
        'city' => ['required' => TRUE],
        'condition' => ['required' => TRUE],
        'no_of_passenger' => ['required' => TRUE],
        'no_of_baggage' => ['required' => TRUE],
        'no_of_door' => ['required' => TRUE],
        'driver' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $VEHICLE->update();

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

if (isset($_POST['save-data'])) {

    foreach ($_POST['sort'] as $key => $img) {
        $key = $key + 1;

        $USER = Comments::arrange($key, $img);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}