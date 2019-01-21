<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Room
 *
 * @author Suharshana DsW
 */
class Room {

    public $id;
    public $title;
    public $image_name;
    public $short_description;
    public $description;
    public $no_of_rooms;
    public $price;
    public $queue;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`title`,`image_name`,`short_description`,`description`,`no_of_rooms`,`price`,`queue` FROM `room` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->title = $result['title'];
            $this->image_name = $result['image_name'];
            $this->short_description = $result['short_description'];
            $this->description = $result['description'];
            $this->no_of_rooms = $result['no_of_rooms'];
            $this->price = $result['price'];
            $this->queue = $result['queue'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `room` (`title`,`image_name`,`short_description`,`description`,`no_of_rooms`,`price`,`queue`) VALUES  ('"
                . $this->title . "','"
                . $this->image_name . "', '"
                . $this->short_description . "', '"
                . $this->description . "', '"
                . $this->no_of_rooms . "', '"
                . $this->price . "', '"
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

        $query = "SELECT * FROM `room` ORDER BY queue ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `room` SET "
                . "`title` ='" . $this->title . "', "
                . "`image_name` ='" . $this->image_name . "', "
                . "`short_description` ='" . $this->short_description . "', "
                . "`description` ='" . $this->description . "', "
                . "`no_of_rooms` ='" . $this->no_of_rooms . "', "
                . "`price` ='" . $this->price . "', "
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

        $this->deletePhotos();

        unlink(Helper::getSitePath() . "upload/room/" . $this->image_name);

        $query = 'DELETE FROM `room` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function deletePhotos() {

        $ROOM_PHOTOS = new RoomPhoto(NULL);

        $allPhotos = $ROOM_PHOTOS->getRoomPhotosById($this->id);

        foreach ($allPhotos as $photo) {

            $IMG = $ROOM_PHOTOS->image_name = $photo["image_name"];
            unlink(Helper::getSitePath() . "upload/room/gallery/" . $IMG);
            unlink(Helper::getSitePath() . "upload/room/gallery/thumb/" . $IMG);

            $ROOM_PHOTOS->id = $photo["id"];
            $ROOM_PHOTOS->delete();
        }
    }

    public function arrange($key, $img) {
        $query = "UPDATE `room` SET `queue` = '" . $key . "'  WHERE id = '" . $img . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        return $result;
    }

}
