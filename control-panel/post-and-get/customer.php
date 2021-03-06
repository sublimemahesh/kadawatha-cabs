<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['create'])) {

    $CUSTOMER = new Customer(NULL);
    $VALID = new Validator();
    $CUSTOMER->title = $_POST['title'];
    $CUSTOMER->fullname = $_POST['fullname'];
    $CUSTOMER->address = $_POST['address'];
    $CUSTOMER->nic = $_POST['nic'];
    $CUSTOMER->mobile_number = $_POST['mobile_number'];
    $CUSTOMER->city = $_POST['city'];
    $CUSTOMER->email = $_POST['email'];


    $VALID->check($CUSTOMER, [
        'title' => ['required' => TRUE],
        'fullname' => ['required' => TRUE],
        'address' => ['required' => TRUE],
        'nic' => ['required' => TRUE],
        'mobile_number' => ['required' => TRUE],
        'city' => ['required' => TRUE],
        'email' => ['required' => TRUE]
        
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
    $CUSTOMER->title = $_POST['title'];
    $CUSTOMER->fullname = $_POST['fullname'];
    $CUSTOMER->address = $_POST['address'];
    $CUSTOMER->nic = $_POST['nic'];
    $CUSTOMER->mobile_number = $_POST['mobile_number'];
    $CUSTOMER->city = $_POST['city'];
    $CUSTOMER->email = $_POST['email'];

    $VALID = new Validator();
    $VALID->check($CUSTOMER, [
        'title' => ['required' => TRUE],
        'fullname' => ['required' => TRUE],
        'address' => ['required' => TRUE],
        'nic' => ['required' => TRUE],
        'mobile_number' => ['required' => TRUE],
        'city' => ['required' => TRUE],
        'email' => ['required' => TRUE]
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