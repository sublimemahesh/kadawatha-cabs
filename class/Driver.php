<?php

/**
 * Description of User
 *
 * @author sublime holdings
 * @web www.sublime.lk
 */
class Driver {

    public $id;
    public $name;
    public $licence_number;
    public $licence_image_front;
    public $licence_image_back;
    public $nic;
    public $phone_numbers;
    public $address;
    public $city;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`, `name`, `licence_number`, `licence_image_front`,`licence_image_back`, `nic`, `phone_numbers`, `address`, `city` FROM `driver` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->name = $result['name'];
            $this->licence_number = $result['licence_number'];
            $this->licence_image_front = $result['licence_image_front'];
            $this->licence_image_back = $result['licence_image_back'];
            $this->nic = $result['nic'];
            $this->phone_numbers = $result['phone_numbers'];
            $this->address = $result['address'];
            $this->city = $result['city'];

            return $result;
        }
    }

    public function create() {

        $query = "INSERT INTO `driver` (`id`, `name`, `licence_number`, `licence_image_front`,`licence_image_back`, `nic`, `phone_numbers`, `address`, `city`) VALUES  ('"
                . $this->id . "','"
                . $this->name . "','"
                . $this->licence_number . "', '"
                . $this->licence_image_front . "', '"
                . $this->licence_image_back . "', '"
                . $this->nic . "', '"
                . $this->phone_numbers . "', '"
                . $this->address . "', '"
                . $this->city . "' 
                )";

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

        $query = "UPDATE  `driver` SET "
                . "`name` ='" . $this->name . "', "
                . "`licence_number` ='" . $this->licence_number . "', "
                . "`licence_image_front` ='" . $this->licence_image_front . "', "
                . "`licence_image_back` ='" . $this->licence_image_back . "', "
                . "`nic` ='" . $this->nic . "', "
                . "`phone_numbers` ='" . $this->phone_numbers . "', "
                . "`address` ='" . $this->address . "', "
                . "`city` ='" . $this->city . "' "
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

        $query = "SELECT * FROM `driver`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function delete() {
//  unlink(Helper::getSitePath() . "upload/Driver/back_side" . $this->licence_image_back);
        $query = 'DELETE FROM `driver` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function allNamesByKeyword($keyword) {

        $query = "SELECT * FROM `driver` WHERE `name` LIKE '{$keyword}%'";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function checkLicence($licenceNum) {
       
        $query = "SELECT `licence_number` FROM `driver` WHERE `licence_number`= '" . $licenceNum . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    public function checkNic($nic) {
       
        $query = "SELECT `nic` FROM `driver` WHERE `nic`= '" . $nic . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));
       
        if (!$result) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
     
}
