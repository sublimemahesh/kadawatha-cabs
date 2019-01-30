<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['create'])) {

    $PACKAGES = new Packages(NULL);
    $VALID = new Validator();

    $PACKAGES->name = $_POST['name'];
    $PACKAGES->code = $_POST['code'];
    $PACKAGES->price = $_POST['price'];
    $PACKAGES->time = $_POST['time'];
    $PACKAGES->distance = $_POST['distance'];

    $VALID->check($PACKAGES, [
        'name' => ['required' => TRUE],
        'code' => ['required' => TRUE],
        'price' => ['required' => TRUE],
        'time' => ['required' => TRUE],
        'distance' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $PACKAGES->create();

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

    $PACKAGES = new Packages($_POST['id']);

    $PACKAGES->name = $_POST['name'];
    $PACKAGES->code = $_POST['code'];
    $PACKAGES->price = $_POST['price'];
    $PACKAGES->time = $_POST['time'];
    $PACKAGES->distance = $_POST['distance'];

    $VALID = new Validator();
    $VALID->check($PACKAGES, [
        'name' => ['required' => TRUE],
        'code' => ['required' => TRUE],
        'price' => ['required' => TRUE],
        'time' => ['required' => TRUE],
        'distance' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $PACKAGES->update();

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