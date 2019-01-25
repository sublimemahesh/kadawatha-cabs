<?php

/**
 * Description of User
 *
 * @author sublime holdings
 * @web www.sublime.lk
 */
class VehicleType {

    public $id;
    public $type;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`, `type` FROM `vehicle_type` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->type = $result['type'];


            return $result;
        }
    }

    public function create() {

        $query = "INSERT INTO `vehicle_type` (`type`) VALUES  ('"
                . $this->type . "')";

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

        $query = "UPDATE  `vehicle_type` SET "
                . "`type` ='" . $this->type . "' "
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

        $query = "SELECT * FROM `vehicle_type`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function delete() {

        $query = 'DELETE FROM `vehicle_type` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

}
