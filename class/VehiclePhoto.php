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
class VehiclePhoto {

    public $id;
    public $vehicle_id;
    public $caption;
    public $image;
    public $queue;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`, `vehicle_id`, `caption`, `image`, `queue` FROM `vehicle_photos` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->vehicle_id = $result['vehicle_id'];
            $this->caption = $result['caption'];
            $this->image = $result['image'];
            $this->queue = $result['queue'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `vehicle_photos`(`vehicle_id`, `caption`, `image`, `queue`) VALUES  ('"
                . $this->vehicle_id . "','"
                . $this->caption . "', '"
                . $this->image . "', '"
                . $this->queue . "')";
   
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

        $query = "SELECT * FROM `offer_photo` ORDER BY queue ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `vehicle_photos` SET "
                . "`vehicle_id` ='" . $this->vehicle_id . "', "
                . "`caption` ='" . $this->caption . "', "
                . "`image` ='" . $this->image . "', "
                . "`queue` ='" . $this->queue . "' "
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

        $query = 'DELETE FROM `offer_photo` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getVehiclePhotosById($vehicle_id) {

        $query = "SELECT * FROM `vehicle_photos` WHERE `vehicle_id`= $vehicle_id ORDER BY queue ASC";
      
        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function arrange($key, $img) {
        $query = "UPDATE `vehicle_photos` SET `queue` = '" . $key . "'  WHERE id = '" . $img . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        return $result;
    }

}
