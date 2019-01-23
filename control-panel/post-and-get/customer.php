<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['create'])) {

    $CUSTOMER = new Customer(NULL);
    $VALID = new Validator();

    $CUSTOMER->fullname = $_POST['fullname'];
    $CUSTOMER->address = $_POST['address'];
    $CUSTOMER->nic = $_POST['nic'];
    $CUSTOMER->mobile_number = $_POST['mobile_number'];
    $CUSTOMER->city = $_POST['city'];





    $VALID->check($CUSTOMER, [
        'fullname' => ['required' => TRUE],
        'address' => ['required' => TRUE],
        'nic' => ['required' => TRUE],
        'mobile_number' => ['required' => TRUE],
        'city' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $CUSTOMER->create();

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

    $CUSTOMER = new Customer($_POST['id']);

    $CUSTOMER->fullname = $_POST['fullname'];
    $CUSTOMER->address = $_POST['address'];
    $CUSTOMER->nic = $_POST['nic'];
    $CUSTOMER->mobile_number = $_POST['mobile_number'];
    $CUSTOMER->city = $_POST['city'];

    $VALID = new Validator();
    $VALID->check($CUSTOMER, [
        'fullname' => ['required' => TRUE],
        'address' => ['required' => TRUE],
        'nic' => ['required' => TRUE],
        'mobile_number' => ['required' => TRUE],
        'city' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $CUSTOMER->update();

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