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
    public $vehicleType;
    public $vehicle;
    public $driver;
    public $total_cost;
    public $package;
    public $comment;
    public $isActive;
    public $created_at;
    public $paidCommission;
    public $status;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`, `customer`, `start_date`, `end_date`, `vehicle_type`, `vehicle`, `driver`, `total_cost`, `package`,`created_at`, `comment`,`isActive`, `paid_commission`, `status` FROM `booking` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->customer = $result['customer'];
            $this->start_date = $result['start_date'];
            $this->end_date = $result['end_date'];
            $this->vehicleType = $result['vehicle_type'];
            $this->vehicle = $result['vehicle'];
            $this->driver = $result['driver'];
            $this->total_cost = $result['total_cost'];
            $this->package = $result['package'];
            $this->created_at = $result['created_at'];
            $this->comment = $result['comment'];
            $this->isActive = $result['isActive'];
            $this->paidCommission = $result['paid_commission'];
            $this->status = $result['status'];
            return $this;
        }
    }

    public function create() {
        date_default_timezone_set('Asia/Colombo');
        $createdAt = date('Y-m-d');

        $query = "INSERT INTO `booking`(`customer`, `start_date`, `end_date`, `vehicle_type`, `vehicle`, `driver`, `total_cost`, `package`, `created_at`, `comment`,`isActive`,`paid_commission`,`status`) VALUES  ('"
                . $this->customer . "','"
                . $this->start_date . "', '"
                . $this->end_date . "', '"
                . $this->vehicleType . "', '"
                . $this->vehicle . "', '"
                . $this->driver . "', '"
                . $this->total_cost . "', '"
                . $this->package . "', '"
                . $createdAt . "', '"
                . $this->comment . "', '"
                . 1 . "', '"
                . $this->paidCommission . "', '"
                . $this->status . "')";

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

    public function getBookingByPaymentID($id) {

        $query = "SELECT * FROM `booking` WHERE `paid_commission` = $id";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    public function getBookingsByStatus($status) {

        $query = "SELECT * FROM `booking` WHERE `status` LIKE '$status'";
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
                . "`vehicle_type` ='" . $this->vehicleType . "', "
                . "`vehicle` ='" . $this->vehicle . "', "
                . "`driver` ='" . $this->driver . "', "
                . "`total_cost` ='" . $this->total_cost . "' ,"
                . "`package` ='" . $this->package . "' ,"
                . "`comment` ='" . $this->comment . "' ,"
                . "`isActive` ='" . $this->isActive . "', "
                . "`paid_commission` ='" . $this->paidCommission . "', "
                . "`status` ='" . $this->status . "' "
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

    public function getsearchAll($date, $vehicle_type, $vehicle, $driver, $customer, $package, $owner) {

        $w = array();
        $where = '';
        if (!empty($date)) {

            $w[] = "`created_at` LIKE '%" . $date . "%'";
        }
        if (!empty($vehicle_type)) {

            $w[] = "`vehicle` IN (SELECT `id` from  `vehicle`  WHERE `id` = " . $vehicle_type . " )  ";
        }
        if (!empty($vehicle)) {
            $w[] = "`vehicle` IN( SELECT `id` from `vehicle` WHERE `id` = " . $vehicle . ") ";
        }
        if (!empty($driver)) {
            $w[] = " `driver` IN( SELECT `id` from `driver` WHERE `id` = " . $driver . ") ";
        }
        if (!empty($customer)) {
            $w[] = " `customer` IN( SELECT `id` from `customer` WHERE `id` = " . $customer . ") ";
        }
        if (!empty($package)) {
            $w[] = " `package` IN( SELECT `id` from `packages` WHERE `id` = " . $package . ") ";
        }
        if (!empty($owner)) {
            $w[] = "`vehicle` IN (SELECT `id` from  `vehicle`  WHERE `id` = " . $owner . " )  ";
        }


        if (count($w)) {
            $where = 'WHERE ' . implode(' AND ', $w);
        }

        $query = "SELECT * FROM `booking` " . $where . " ORDER BY `id` DESC";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getBookingsByDateRange($from, $to) {

        $query = "SELECT * FROM `booking` WHERE `created_at` BETWEEN '" . $from . "' AND '" . $to . "' ORDER BY `id` ASC";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getBookingsByEndDate($from, $to, $driver) {
        $w = '';
        $where = '';

        if (!empty($driver)) {
            $w = "`driver` = " . $driver . "";
        }
        if ($w == '') {
            $where = "(`end_date` BETWEEN '" . $from . "' AND '" . $to . "')";
        } else {
            $where = "(`end_date` BETWEEN '" . $from . "' AND '" . $to . "') AND " . $w;
        }

        $query = "SELECT * FROM `booking` WHERE " . $where . "  ORDER BY `id` ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getCommissionUnpaidBookingsByID($id) {

        $query = "SELECT * FROM `booking` WHERE `paid_commission` = 0 AND `driver` = $id";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getFirstAndLastBookingDates() {

        $query = "SELECT min(created_at) AS `min_date`, max(created_at) AS `max_date` FROM `booking`";

        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }

    public function updatePaidCommission() {

        $query = "UPDATE  `booking` SET "
                . "`paid_commission` ='" . $this->paidCommission . "' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function updatePaidCommissionTo0() {

        $query = "UPDATE  `booking` SET "
                . "`paid_commission` = 0 "
                . "WHERE `paid_commission` = '" . $this->paidCommission . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function getAllCommissionPaidBookings() {

        $query = "SELECT * FROM `booking` WHERE `paid_commission` != 0";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getAllCommissionUnPaidBookings() {

        $query = "SELECT * FROM `booking` WHERE `paid_commission` = 0";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function markAsConfirmed() {

        $query = "UPDATE  `booking` SET "
                . "`status` = 'confirmed'"
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }
    public function markAsCompleted() {

        $query = "UPDATE  `booking` SET "
                . "`status` = 'completed'"
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }
    public function cancelBooking() {

        $query = "UPDATE  `booking` SET "
                . "`status` = 'canceled'"
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

}
