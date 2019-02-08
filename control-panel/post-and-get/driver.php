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

    $dir_dest_front = '../../upload/Driver/front_side';
    $dir_dest_back = '../../upload/Driver/back_side';

    $handle = new Upload($_FILES['licence_image_front']);
    $handle1 = new Upload($_FILES['licence_image_back']);
    $img = Helper::randamId();
    $imgName = null;
    $imgName1 = null;
    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_ext = 'jpg';
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $img;
        $handle->image_x = 400;
        $handle->image_y = 247;

        $handle->Process($dir_dest_front);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }

        $handle1->image_resize = true;
        $handle1->file_new_name_ext = 'jpg';
        $handle1->image_ratio_crop = 'C';
        $handle1->file_new_name_body = $img;
        $handle1->image_x = 400;
        $handle1->image_y = 247;

        $handle1->Process($dir_dest_back);

        if ($handle1->processed) {
            $info = getimagesize($handle1->file_dst_pathname);
            $imgName1 = $handle1->file_dst_name;
        }
    }

    $DRIVER->licence_image_front = $imgName;
    $DRIVER->licence_image_back = $imgName1;
    $VALID->check($DRIVER, [
        'name' => ['required' => TRUE],
        'licence_number' => ['required' => TRUE],
        'nic' => ['required' => TRUE],
        'address' => ['required' => TRUE],
        'phone_numbers' => ['required' => TRUE],
        'city' => ['required' => TRUE],
        'licence_image_front' => ['required' => TRUE],
        'licence_image_back' => ['required' => TRUE]
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

    $dir_dest_front = '../../upload/Driver/front_side';
    $dir_dest_back = '../../upload/Driver/back_side';
    $img = Helper::randamId();
    $handle = new Upload($_FILES['licence_image_front']);
    $handle1 = new Upload($_FILES['licence_image_back']);

    $imgName = null;
    $imgName1 = null;
    $oldimgFront = $_POST ["oldImageNameFront"];
    $oldimgBack = $_POST ["oldImageNameBack"];

//    if (isset($_POST['oldImageNameFront']) == NULL) {
//        $handle->file_new_name_ext = 'jpg';
//        $handle->file_new_name_body = $img;
//        $imgName=$handle->file_dst_name;
//    }
//    else{
       
//         $handle->file_new_name_body =$oldimgFront;
//    }
    
    
    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_body = TRUE;
        $handle->file_overwrite = TRUE;
        $handle->file_new_name_ext = FALSE;
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $_POST ["oldImageNameFront"];
        $handle->image_x = 400;
        $handle->image_y = 247;

        $handle->Process($dir_dest_front);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }
    }


    if ($handle1->uploaded) {
        $handle1->image_resize = true;
        $handle1->file_new_name_body = TRUE;
        $handle1->file_overwrite = TRUE;
        $handle1->file_new_name_ext = FALSE;
        $handle1->image_ratio_crop = 'C';
        $handle1->file_new_name_body = $_POST ["oldImageNameBack"];
        $handle1->image_x = 400;
        $handle1->image_y = 247;

        $handle1->Process($dir_dest_back);

        if ($handle1->processed) {
            $info = getimagesize($handle1->file_dst_pathname);
            $imgName1 = $handle1->file_dst_name;
        }
    }

    

    $DRIVER = new Driver($_POST['id']);
    $DRIVER->licence_image_front = $_POST ["oldImageNameFront"];
    $DRIVER->licence_image_back = $_POST ["oldImageNameBack"];
    $DRIVER->name = $_POST['driver_name'];
    $DRIVER->licence_number = $_POST['licence_num'];
    $DRIVER->nic = $_POST['nic'];
    $DRIVER->phone_numbers = $_POST['phone_numbers'];
    $DRIVER->address = $_POST['address'];
    $DRIVER->city = $_POST['city'];
//
//   dd($_POST['city']);
    $VALID = new Validator();
    $VALID->check($DRIVER, [
        'name' => ['required' => TRUE],
        'licence_number' => ['required' => TRUE],
        'nic' => ['required' => TRUE],
        'phone_numbers' => ['required' => TRUE],
        'address' => ['required' => TRUE],
        'city' => ['required' => TRUE]
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