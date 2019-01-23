<?php

/**
 * Description of User
 *
 * @author sublime holdings
 * @web www.sublime.lk
 */
class Customer {

    public $id;
    public $fullname;
    public $address;
    public $nic;
    public $mobile_number;
    public $city;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`, `name`, `address`, `nic`, `mobile_number`, `city` FROM `customer` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->fullname = $result['name'];
            $this->address = $result['address'];
            $this->nic = $result['nic'];
            $this->mobile_number = $result['mobile_number'];
            $this->city = $result['city'];

            return $result;
        }
    }

    public function create() {

        $query = "INSERT INTO `customer` (`name`, `address`, `nic`, `mobile_number`, `city`) VALUES  ('"
                . $this->fullname . "','"
                . $this->address . "', '"
                . $this->nic . "', '"
                . $this->mobile_number . "', '"
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
                . "`name` ='" . $this->fullname . "', "
                . "`address` ='" . $this->address . "', "
                . "`nic` ='" . $this->nic . "', "
                . "`mobile_number` ='" . $this->mobile_number . "', "
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

}
