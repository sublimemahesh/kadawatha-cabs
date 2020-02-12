<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VehicleSubType
 *
 * @author U s E r ¨
 */
class VehicleSubType {

    public $id;
    public $type;
    public $name;
    public $noOfSeats;
    public $category;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`, `type`, `name`, `no_of_seats`, `category` FROM `vehicle_sub_type` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->type = $result['type'];
            $this->name = $result['name'];
            $this->noOfSeats = $result['no_of_seats'];
            $this->category = $result['category'];


            return $result;
        }
    }

    public function create() {

        $query = "INSERT INTO `vehicle_sub_type` (`type`, `name`, `no_of_seats`, `category`) VALUES  ('"
                . $this->type . "','"
                . $this->name . "','"
                . $this->noOfSeats . "','"
                . $this->category . "'
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

        $query = "UPDATE  `vehicle_sub_type` SET "
                . "`type` ='" . $this->type . "', "
                . "`name` ='" . $this->name . "', "
                . "`no_of_seats` ='" . $this->noOfSeats . "', "
                . "`category` ='" . $this->category . "' "
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

        $query = "SELECT * FROM `vehicle_sub_type`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function delete() {

        $query = 'DELETE FROM `vehicle_sub_type` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function allNamesByKeyword($keyword) {

        $query = "SELECT * FROM `vehicle_sub_type` WHERE `type` LIKE '{$keyword}%'";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    public function getSubTypesByType($type) {

        $query = "SELECT * FROM `vehicle_sub_type` WHERE `type` = $type";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

}
