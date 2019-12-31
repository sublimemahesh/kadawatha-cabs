<?php

include_once(dirname(__FILE__) . '/Setting.php');
include_once(dirname(__FILE__) . '/Helper.php');
include_once(dirname(__FILE__) . '/Upload.php');
include_once(dirname(__FILE__) . '/Database.php');
include_once(dirname(__FILE__) . '/User.php');
include_once(dirname(__FILE__) . '/Message.php');
include_once(dirname(__FILE__) . '/Validator.php');
include_once(dirname(__FILE__) . '/Offer.php');
include_once(dirname(__FILE__) . '/Slider.php');
include_once(dirname(__FILE__) . '/Page.php');
include_once(dirname(__FILE__) . '/Customer.php');
include_once(dirname(__FILE__) . '/VehicleType.php');
include_once(dirname(__FILE__) . '/Vehicle.php');
include_once(dirname(__FILE__) . '/Driver.php');
include_once(dirname(__FILE__) . '/VehiclePhoto.php');
include_once(dirname(__FILE__) . '/Packages.php');
include_once(dirname(__FILE__) . '/Booking.php');
include_once(dirname(__FILE__) . '/Permission.php');
include_once(dirname(__FILE__) . '/DefaultData.php');
include_once(dirname(__FILE__) . '/CommissionPayment.php');
include_once(dirname(__FILE__) . '/VehicleCategory.php');
include_once(dirname(__FILE__) . '/VehicleSubCategory.php');
include_once(dirname(__FILE__) . '/PackageType.php');
include_once(dirname(__FILE__) . '/BookingPayment.php');


function dd($data) {
    var_dump($data);
    exit();
}
function redirect($url) {
    $string = '<script type="text/javascript">';
    $string .= 'window.location = "' . $url . '"';
    $string .= '</script>';

    echo $string;
    exit();
}
