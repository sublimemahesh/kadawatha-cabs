<?php

/**
 * Description of User
 *
 * @author sublime holdings
 * @web www.sublime.lk
 */
class Packages {

    public $id;
    public $name;
    public $code;
    public $price;
    public $time;
    public $distance;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`, `name`, `code`, `price`, `time`, `distance` FROM `packages` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->name = $result['name'];
            $this->code = $result['code'];
            $this->price = $result['price'];
            $this->time = $result['time'];
            $this->distance = $result['distance'];

            return $result;
        }
    }

    public function create() {

        $query = "INSERT INTO `packages`(`name`, `code`, `price`, `time`, `distance`) VALUES  ('"
                . $this->name . "', '"
                . $this->code . "', '"
                . $this->price . "', '"
                . $this->time . "', '"
                . $this->distance . "')";

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

        $query = "UPDATE  `packages` SET "
                . "`name` ='" . $this->name . "', "
                . "`code` ='" . $this->code . "', "
                . "`price` ='" . $this->price . "', "
                . "`time` ='" . $this->time . "', "
                . "`distance` ='" . $this->distance . "' "
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

        $query = "SELECT * FROM `packages`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function delete() {

        $query = 'DELETE FROM `packages` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }
     public function allNamesByKeyword($keyword) {

        $query = "SELECT * FROM `packages` WHERE `name` LIKE '{$keyword}%'";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }


}
