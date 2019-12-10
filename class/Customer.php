<?php

/**
 * Description of User
 *
 * @author sublime holdings
 * @web www.sublime.lk
 */
class Customer {

    public $id;
    public $title;
    public $fullname;
    public $address;
    public $nic;
    public $mobile_number;
    public $email;
    public $city;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`title`, `name`, `address`, `nic`, `mobile_number`, `email`, `city` FROM `customer` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->title = $result['title'];
            $this->fullname = $result['name'];
            $this->address = $result['address'];
            $this->nic = $result['nic'];
            $this->mobile_number = $result['mobile_number'];
            $this->email = $result['email'];
            $this->city = $result['city'];

            return $result;
        }
    }

    public function create() {

        $query = "INSERT INTO `customer` (`title` ,`name`, `address`, `nic`, `mobile_number`, `email`, `city`) VALUES  ('"
                . $this->title . "','"
                . $this->fullname . "','"
                . $this->address . "', '"
                . $this->nic . "', '"
                . $this->mobile_number . "', '"
                . $this->email . "', '"
                . $this->city . "')";

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

        $query = "UPDATE  `customer` SET "
                . "`title` ='" . $this->title . "', "
                . "`name` ='" . $this->fullname . "', "
                . "`address` ='" . $this->address . "', "
                . "`nic` ='" . $this->nic . "', "
                . "`mobile_number` ='" . $this->mobile_number . "', "
                . "`email` ='" . $this->email . "', "
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

        $query = "SELECT * FROM `customer`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function delete() {

        $query = 'DELETE FROM `customer` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function allNamesByKeyword($keyword) {

        $query = "SELECT * FROM `customer` WHERE `name` LIKE '{$keyword}%'";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getCudtomerById($id) {

        $query = "SELECT * FROM `customer` WHERE `id`= '" . $id . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {
            return $result;
        }
    }

    public function checkNic($nic) {

        $query = "SELECT `nic` FROM `customer` WHERE `nic`= '" . $nic . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    public function checkMobileNumber($mobile_number) {

        $query = "SELECT `nic` FROM `customer` WHERE `mobile_number`= '" . $mobile_number . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    public function getCustomerByNIC($nic) {

        $query = "SELECT * FROM `customer` WHERE `nic`= '" . $nic . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {
            return $result;
        }
    }
    
    public function getCustomerByPhoneNo($mobile_number) {

        $query = "SELECT * FROM `customer` WHERE `mobile_number`= '" . $mobile_number . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {
            return $result;
        }
    }

}
