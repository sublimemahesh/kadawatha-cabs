<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OfferPhoto
 *
 * @author Suharshana DsW
 */
class Booking {

    public $id;
    public $customer;
    public $start_date;
    public $end_date;
    public $vehicle;
    public $driver;
    public $total_cost;
    public $package;
    public $comment;
    public $isActive;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`, `customer`, `start_date`, `end_date`, `vehicle`, `driver`, `total_cost`, `package`, `comment`,`isActive` FROM `booking` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->customer = $result['customer'];
            $this->start_date = $result['start_date'];
            $this->end_date = $result['end_date'];
            $this->vehicle = $result['vehicle'];
            $this->driver = $result['driver'];
            $this->total_cost = $result['total_cost'];
            $this->package = $result['package'];
            $this->comment = $result['comment'];
            $this->isActive = $result['isActive'];
            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `booking`(`customer`, `start_date`, `end_date`, `vehicle`, `driver`, `total_cost`, `package`, `comment`,`isActive`) VALUES  ('"
                . $this->customer . "','"
                . $this->start_date . "', '"
                . $this->end_date . "', '"
                . $this->vehicle . "', '"
                . $this->driver . "', '"
                . $this->total_cost . "', '"
                . $this->package . "', '"
                . $this->comment . "', '"
                . 1 . "')";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            $last_id = mysql_insert_id();

            return $this->__construct($last_id);
        } else {
            return FALSE;
        }
    }

    public function all() {

        $query = "SELECT * FROM `booking`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {
   
        $query = "UPDATE  `booking` SET "
                . "`customer` ='" . $this->customer . "', "
                . "`start_date` ='" . $this->start_date . "', "
                . "`end_date` ='" . $this->end_date . "', "
                . "`vehicle` ='" . $this->vehicle . "', "
                . "`driver` ='" . $this->driver . "', "
                . "`total_cost` ='" . $this->total_cost . "' ,"
                . "`package` ='" . $this->package . "' ,"
                . "`comment` ='" . $this->comment . "' ,"
                . "`isActive` ='" . $this->isActive . "' "
                . "WHERE `id` = '" . $this->id . "'";
      
        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function delete() {

        $query = 'DELETE FROM `booking` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

}
