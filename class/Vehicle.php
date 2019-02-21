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
    public $owner;
    public $vehicle_number;
    public $vehicle_name;
    public $contact_number;
    public $city;
    public $condition;
    public $no_of_passenger;
    public $no_of_baggage;
    public $no_of_door;
    public $driver;
    public $vehicle_image;

//    private $password;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`, `vehicle_type`, `owner`,`vehicle_number`, `vehicle_name`, `contact_number`, `city`, `vehicle_image`, `condition`, `no_of_passenger`, `no_of_baggage`, `no_of_door`, `driver` FROM `vehicle` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->vehicle_type = $result['vehicle_type'];
            $this->owner = $result['owner'];
            $this->vehicle_number = $result['vehicle_number'];
            $this->vehicle_name = $result['vehicle_name'];
            $this->contact_number = $result['contact_number'];
            $this->city = $result['city'];
            $this->vehicle_image = $result['vehicle_image'];
            $this->condition = $result['condition'];
            $this->no_of_passenger = $result['no_of_passenger'];
            $this->no_of_baggage = $result['no_of_baggage'];
            $this->no_of_door = $result['no_of_door'];
            $this->driver = $result['driver'];

            return $result;
  
        }
    }

    public function create() {

        $query = "INSERT INTO `vehicle` (`vehicle_type`, `owner`, `vehicle_number`, `vehicle_name`, `contact_number`, `city`, `condition`, `no_of_passenger`, `no_of_baggage`, `no_of_door`, `driver`) VALUES  ('"
                . $this->vehicle_type . "','"
                . $this->owner . "', '"
                . $this->vehicle_number . "', '"
                . $this->vehicle_name . "', '"
                . $this->contact_number . "', '"
                . $this->city . "', '"
                . $this->condition . "', '"
                . $this->no_of_passenger . "', '"
                . $this->no_of_baggage . "', '"
                . $this->no_of_door . "', '"
                . $this->driver . "')";

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
                . "`owner` ='" . $this->owner . "', "
                . "`vehicle_number` ='" . $this->vehicle_number . "', "
                . "`vehicle_name` ='" . $this->vehicle_name . "', "
                . "`contact_number` ='" . $this->contact_number . "', "
                . "`city` ='" . $this->city . "', "
//                . "`vehicle_image` ='" . $this->vehicle_image . "' ,"
                . "`condition` ='" . $this->condition . "' ,"
                . "`no_of_passenger` ='" . $this->no_of_passenger . "', "
                . "`no_of_baggage` ='" . $this->no_of_baggage . "' ,"
                . "`no_of_door` ='" . $this->no_of_door . "', "
                . "`driver` ='" . $this->driver . "' "
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

    public function getVehicleTypeById($vehicle_type) {

        $query = "SELECT * FROM `vehicle` WHERE `vehicle_type`= $vehicle_type ";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
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
    
    

}
