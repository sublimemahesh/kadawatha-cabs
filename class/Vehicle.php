<?php

/**
 * Description of User
 *
 * @author sublime holdings
 * @web www.sublime.lk
 */
class Vehicle {

    public $id;
    public $vehicle_type;
    public $vehicle_sub_type;
    public $owner;
    public $owner_contact_no_01;
    public $owner_contact_no_02;
    public $vehicle_number;
    public $vehicle_name;
    public $city;
    public $condition;
    public $no_of_passenger;
    public $no_of_baggage;
    public $no_of_door;
    public $driver;
    public $driver_contact_no_01;
    public $driver_contact_no_02;
    public $vehicle_image;

//    private $password;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`, `vehicle_type`, `vehicle_sub_type`, `owner`, `owner_contact_no_01`, `owner_contact_no_02`,`vehicle_number`, `vehicle_name`, `city`, `condition`, `no_of_passenger`, `no_of_baggage`, `no_of_door`, `driver`, `driver_contact_no_01`, `driver_contact_no_02` FROM `vehicle` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->vehicle_type = $result['vehicle_type'];
            $this->vehicle_sub_type = $result['vehicle_sub_type'];
            $this->owner = $result['owner'];
            $this->owner_contact_no_01 = $result['owner_contact_no_01'];
            $this->owner_contact_no_02 = $result['owner_contact_no_02'];
            $this->vehicle_number = $result['vehicle_number'];
            $this->vehicle_name = $result['vehicle_name'];
            $this->city = $result['city'];
            $this->condition = $result['condition'];
            $this->no_of_passenger = $result['no_of_passenger'];
            $this->no_of_baggage = $result['no_of_baggage'];
            $this->no_of_door = $result['no_of_door'];
            $this->driver = $result['driver'];
            $this->driver_contact_no_01 = $result['driver_contact_no_01'];
            $this->driver_contact_no_02 = $result['driver_contact_no_02'];

            return $result;
  
        }
    }

    public function create() {

        $query = "INSERT INTO `vehicle` (`vehicle_type`, `vehicle_sub_type`, `owner`, `owner_contact_no_01`, `owner_contact_no_02`, `vehicle_number`, `vehicle_name`, `city`, `condition`, `no_of_passenger`, `no_of_baggage`, `no_of_door`, `driver`, `driver_contact_no_01`, `driver_contact_no_02`) VALUES  ('"
                . $this->vehicle_type . "','"
                . $this->vehicle_sub_type . "','"
                . $this->owner . "', '"
                . $this->owner_contact_no_01 . "', '"
                . $this->owner_contact_no_02 . "', '"
                . $this->vehicle_number . "', '"
                . $this->vehicle_name . "', '"
                . $this->city . "', '"
                . $this->condition . "', '"
                . $this->no_of_passenger . "', '"
                . $this->no_of_baggage . "', '"
                . $this->no_of_door . "', '"
                . $this->driver . "', '"
                . $this->owner_contact_no_01 . "', '"
                . $this->owner_contact_no_02 . "')";

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

        $query = "UPDATE  `vehicle` SET "
                . "`vehicle_type` ='" . $this->vehicle_type . "', "
                . "`vehicle_sub_type` ='" . $this->vehicle_sub_type . "', "
                . "`owner` ='" . $this->owner . "', "
                . "`owner_contact_no_01` ='" . $this->owner_contact_no_01 . "', "
                . "`owner_contact_no_02` ='" . $this->owner_contact_no_02 . "', "
                . "`vehicle_number` ='" . $this->vehicle_number . "', "
                . "`vehicle_name` ='" . $this->vehicle_name . "', "
                . "`city` ='" . $this->city . "', "
//                . "`vehicle_image` ='" . $this->vehicle_image . "' ,"
                . "`condition` ='" . $this->condition . "' ,"
                . "`no_of_passenger` ='" . $this->no_of_passenger . "', "
                . "`no_of_baggage` ='" . $this->no_of_baggage . "' ,"
                . "`no_of_door` ='" . $this->no_of_door . "', "
                . "`driver` ='" . $this->driver . "', "
                . "`driver_contact_no_01` ='" . $this->driver_contact_no_01 . "', "
                . "`driver_contact_no_02` ='" . $this->driver_contact_no_02 . "' "
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

        $query = "SELECT * FROM `vehicle`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function delete() {

        $query = 'DELETE FROM `vehicle` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }
    public function allNamesByKeyword($keyword) {

        $query = "SELECT * FROM `vehicle` WHERE `vehicle_name` LIKE '{$keyword}%'";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
     public function allOwnersByKeyword($keyword) {

        $query = "SELECT * FROM `vehicle` WHERE `owner` LIKE '{$keyword}%'";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    public function checkVehicleNo($vehicle_number) {

        $query = "SELECT `vehicle_number` FROM `vehicle` WHERE `vehicle_number`= '" . $vehicle_number . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    public function GetVehiclesByType($vehicle) {

        $query = "SELECT * FROM `vehicle` WHERE `vehicle_type` = '" . $vehicle . "'";
    
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    public function GetVehiclesBySubType($stype) {

        $query = "SELECT * FROM `vehicle` WHERE `vehicle_sub_type` = '" . $stype . "'";
    
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
    

}
