
<?php
include_once(dirname(__FILE__) . '/../../class/include.php');

include_once(dirname(__FILE__) . '/../auth.php');


if (isset($_POST['updatePermission'])) {
    
      $USER = new User(NULL);
       $serialized_array = serialize($_POST['permission']);
    
    $USER->permissions = $serialized_array;
    $USER->id = filter_input(INPUT_POST, 'id');
    $VALID = new Validator();

    $result = $USER->updatePermission();
 
    if (!isset($_SESSION)) {
        session_start();
    }
    $VALID->addError("Your data was saved successfully", 'success');
    $_SESSION['ERRORS'] = $VALID->errors();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

