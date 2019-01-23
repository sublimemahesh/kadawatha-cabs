<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['create'])) {

    $USER = new User(NULL);
    $VALID = new Validator();

    $USER->fullname = $_POST['fullname'];
    $USER->email = $_POST['email'];
    $USER->mobile_number = $_POST['mobile_number'];
    $USER->username = $_POST['username'];
    $USER->password = $_POST['password'];

    $dir_dest = '../../upload/user/';

    $handle = new Upload($_FILES['profileimage']);

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

    $USER->profile_picture = $imgName;

    $VALID->check($USER, [
        'fullname' => ['required' => TRUE],
        'email' => ['required' => TRUE],
        'mobile_number' => ['required' => TRUE],
        'username' => ['required' => TRUE],
        'password' => ['required' => TRUE]
        ,
        'profile_picture' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $USER->create();

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
    $dir_dest = '../../upload/user/';

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

    $USER = new User($_POST['id']);

    $USER->profile_picture = $_POST['oldImageName'];
    $USER->fullname = $_POST['fullname'];
    $USER->email = $_POST['email'];
    $USER->mobile_number = $_POST['mobile_number'];
    $USER->username = $_POST['username'];
    $USER->password = $_POST['password'];
    $USER->isActive = $_POST['active'];

    $VALID = new Validator();
    $VALID->check($USER, [
        'fullname' => ['required' => TRUE],
        'email' => ['required' => TRUE],
        'mobile_number' => ['required' => TRUE],
        'username' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $USER->update();

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