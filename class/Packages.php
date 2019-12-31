<?php

/**
 * Description of User
 *
 * @author sublime holdings
 * @web www.sublime.lk
 */
class Packages {

    public $id;
    public $name;
    public $code;
    public $vehicleType;
    public $category;
    public $subCategory;
    public $packageType;
    public $noOfDays;
    public $price;
    public $time;
    public $distance;
    public $extraPrice1km;
    public $extraPrice1h;
    public $description;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`, `name`, `code`, `vehicle_type`, `category`, `sub_category`, `package_type`, `no_of_days`, `price`, `time`, `distance`, `extra_price_1km`, `extra_price_1h`,`description` FROM `packages` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->name = $result['name'];
            $this->code = $result['code'];
            $this->vehicleType = $result['vehicle_type'];
            $this->category = $result['category'];
            $this->subCategory = $result['sub_category'];
            $this->packageType = $result['package_type'];
            $this->noOfDays = $result['no_of_days'];
            $this->price = $result['price'];
            $this->time = $result['time'];
            $this->distance = $result['distance'];
            $this->extraPrice1km = $result['extra_price_1km'];
            $this->extraPrice1h = $result['extra_price_1h'];
            $this->description = $result['description'];

            return $result;
        }
    }

    public function create() {

        $query = "INSERT INTO `packages`(`name`, `code`, `vehicle_type`, `category`, `sub_category`, `package_type`, `no_of_days`, `price`, `time`, `distance`, `extra_price_1km`, `extra_price_1h`,`description`) VALUES  ('"
                . $this->name . "', '"
                . $this->code . "', '"
                . $this->vehicleType . "', '"
                . $this->category . "', '"
                . $this->subCategory . "', '"
                . $this->packageType . "', '"
                . $this->noOfDays . "', '"
                . $this->price . "', '"
                . $this->time . "', '"
                . $this->distance . "', '"
                . $this->extraPrice1km . "', '"
                . $this->extraPrice1h . "', '"
                . $this->description . "')";

        $db = new Database();

        $result = $db->readQuery($query);
        if ($result) {
            $last_id = mysql_insert_id();
            return $this->__construct($last_id);
        } else {
            return FALSE;
        }
    }

    public function update() {

        $query = "UPDATE  `packages` SET "
                . "`name` ='" . $this->name . "', "
                . "`code` ='" . $this->code . "', "
                . "`vehicle_type` ='" . $this->vehicleType . "', "
                . "`category` ='" . $this->category . "', "
                . "`sub_category` ='" . $this->subCategory . "', "
                . "`package_type` ='" . $this->packageType . "', "
                . "`no_of_days` ='" . $this->noOfDays . "', "
                . "`price` ='" . $this->price . "', "
                . "`time` ='" . $this->time . "', "
                . "`distance` ='" . $this->distance . "', "
                . "`extra_price_1km` ='" . $this->extraPrice1km . "', "
                . "`extra_price_1h` ='" . $this->extraPrice1h . "', "
                . "`description` ='" . $this->description . "' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();

        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function all() {

        $query = "SELECT * FROM `packages`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function delete() {

        $query = 'DELETE FROM `packages` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function allNamesByKeyword($keyword) {

        $query = "SELECT * FROM `packages` WHERE `name` LIKE '{$keyword}%'";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    public function GetPackagesByOptions($type, $category, $subcategory, $package_type) {

        $query = "SELECT * FROM `packages` WHERE `vehicle_type` = $type AND `category` = $category AND `sub_category` = $subcategory AND `package_type` = $package_type";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    public function GetPackagesByVehicleType($type) {

        $query = "SELECT * FROM `packages` WHERE `vehicle_type` = $type";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

}
