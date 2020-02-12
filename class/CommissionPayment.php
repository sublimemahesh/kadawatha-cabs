<?php

/**
 * Description of CommissionPayment
 *
 * @author U s E r ¨
 */
class CommissionPayment {

    public $id;
    public $createdAt;
    public $driver;
    public $amount;
    public $paidAt;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`created_at`,`driver`,`amount`, `paid_at` FROM `commission_payment` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->createdAt = $result['created_at'];
            $this->driver = $result['driver'];
            $this->amount = $result['amount'];
            $this->paidAt = $result['paid_at'];


            return $this;
        }
    }

    public function create() {
        date_default_timezone_set('Asia/Colombo');
        $createdAt = date('Y-m-d H:i:s');
        
        $query = "INSERT INTO `commission_payment` (`created_at`,`driver`,`amount`, `paid_at`) VALUES  ('"
                . $createdAt . "','"
                . $this->driver . "', '"
                . $this->amount . "', '"
                . $this->paidAt . "')";


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

        $query = "SELECT * FROM `commission_payment`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `commission_payment` SET "
                . "`created_at` ='" . $this->createdAt . "', "
                . "`driver` ='" . $this->driver . "', "
                . "`amount` ='" . $this->amount . "', "
                . "`paid_at` ='" . $this->paidAt . "' "
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

        $query = 'DELETE FROM `commission_payment` WHERE id="' . $this->id . '"';
        $db = new Database();

        return $db->readQuery($query);
    }
    

}
