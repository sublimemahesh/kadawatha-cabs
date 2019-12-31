<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['action'] == 'GETCATEGORIESBYTYPE') {

    $result = VehicleCategory::GetCategoryByType($_POST["type"]);
    echo json_encode($result);
    header('Content-type: application/json');
    exit();
}
if ($_POST['action'] == 'GETSUBCATEGORIES') {
    $result = VehicleSubCategory::GetSubCategoryByCategory($_POST["category"]);
    echo json_encode($result);
    header('Content-type: application/json');
    exit();
}

