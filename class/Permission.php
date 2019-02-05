<?php

/**
 * Description of User
 *
 * @author sublime holdings
 * @web www.sublime.lk
 */
class Permission {

    public $id;
    public $permission;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`, `permission` FROM `permission` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->permission = $result['permission'];


            return $result;
        }
    }


    public function all() {

        $query = "SELECT * FROM `permission`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

   
}
