<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['create'])) {

    $DRIVER = new Driver(NULL);
    $VALID = new Validator();

    $DRIVER->name = $_POST['driver_name'];
    $DRIVER->licence_number = $_POST['licence_num'];
    $DRIVER->nic = $_POST['nic'];
    $DRIVER->phone_numbers = $_POST['phone_numbers'];
    $DRIVER->address = $_POST['address'];
    $DRIVER->city = $_POST['city'];

    $dir_dest = '../../upload/Driver/';

    $handle = new Upload($_FILES['licence_image']);

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

    $DRIVER->licence_image = $imgName;

    $VALID->check($DRIVER, [
        'name' => ['required' => TRUE],
        'licence_number' => ['required' => TRUE],
        'nic' => ['required' => TRUE],
        'address' => ['required' => TRUE],
        'phone_numbers' => ['required' => TRUE],
        'city' => ['required' => TRUE],
        'licence_image' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $DRIVER->create();

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
     $dir_dest = '../../upload/Driver/';

    $handle = new Upload($_FILES['profileimage']);

    $imgName = null;

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_body = TRUE;
        $handle->file_overwrite = TRUE;
        $handle->file_new_name_ext = FALSE;
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $_POST ["oldImageName"];
        $handle->image_x = 300;
        $handle->image_y = 300;

        $handle->Process($dir_dest);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }
    }

    $DRIVER = new Driver($_POST['id']);

    $DRIVER->name = $_POST['driver_name'];
    $DRIVER->licence_number = $_POST['licence_num'];
    $DRIVER->nic = $_POST['nic'];
    $DRIVER->phone_numbers = $_POST['phone_numbers'];
    $DRIVER->address = $_POST['address'];
    $DRIVER->city = $_POST['city'];
   $DRIVER->licence_image = $_POST['city'];

    $VALID = new Validator();
    $VALID->check($DRIVER, [
        'name' => ['required' => TRUE],
        'licence_number' => ['required' => TRUE],
        'nic' => ['required' => TRUE],
        'phone_numbers' => ['required' => TRUE],
        'address' => ['required' => TRUE],
        'licence_image' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $DRIVER->update();

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