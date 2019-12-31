<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VehicleSubCategory
 *
 * @author U s E r ¨
 */
class VehicleSubCategory {
    public $id;
    public $category;
    public $name;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`category`,`name` FROM `vehicle_sub_category` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->category = $result['category'];
            $this->name = $result['name'];


            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `vehicle_sub_category` (`category`,`name`) VALUES  ('"
                . $this->category . "','"
                . $this->name . "')";


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

        $query = "SELECT * FROM `vehicle_sub_category`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `vehicle_sub_category` SET "
                . "`category` ='" . $this->category . "', "
                . "`name` ='" . $this->name . "' "
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

        $query = 'DELETE FROM `vehicle_sub_category` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }
    public function GetSubCategoryByCategory($category) {

        $query = "SELECT * FROM `vehicle_sub_category` WHERE `category` = '" . $category . "'";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
}
