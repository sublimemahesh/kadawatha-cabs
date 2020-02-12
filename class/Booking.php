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
    public $referenceNo;
    public $customer;
    public $start_date;
    public $start_time;
    public $end_date;
    public $end_time;
    public $no_of_days;
    public $start_from;
    public $end_from;
    public $vehicleType;
    public $vehicleSubType;
    public $vehicle;
    public $driver;
    public $total_cost;
    public $package;
    public $no_of_adults;
    public $no_of_children;
    public $seating_capacity;
    public $no_of_hard_baggage;
    public $no_of_hand_baggage;
    public $comment;
    public $isActive;
    public $created_at;
    public $paidCommission;
    public $status;
    public $confirmedAt;
    public $completedAt;
    public $canceledAt;
    public $feedbackComment;
    public $finalCost;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT "
                    . "`id`, "
                    . "`reference_no`, "
                    . "`customer`, "
                    . "`start_date`, "
                    . "`start_time`, "
                    . "`end_date`, "
                    . "`end_time`, "
                    . "`no_of_days`, "
                    . "`start_from`, "
                    . "`end_from`, "
                    . "`vehicle_type`, "
                    . "`vehicle_sub_type`, "
                    . "`vehicle`, "
                    . "`driver`, "
                    . "`total_cost`, "
                    . "`package`, "
                    . "`no_of_adults`, "
                    . "`no_of_children`, "
                    . "`seating_capacity`, "
                    . "`no_of_hard_baggage`, "
                    . "`no_of_hand_baggage`, "
                    . "`created_at`, "
                    . "`comment`, "
                    . "`isActive`, "
                    . "`paid_commission`, "
                    . "`status`, "
                    . "`confirmed_at`, "
                    . "`completed_at`, "
                    . "`canceled_at`, "
                    . "`feedback_comment`, "
                    . "`final_cost` "
                    . "FROM `booking` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->referenceNo = $result['reference_no'];
            $this->customer = $result['customer'];
            $this->start_date = $result['start_date'];
            $this->start_time = $result['start_time'];
            $this->end_date = $result['end_date'];
            $this->end_time = $result['end_time'];
            $this->no_of_days = $result['no_of_days'];
            $this->start_from = $result['start_from'];
            $this->end_from = $result['end_from'];
            $this->vehicleType = $result['vehicle_type'];
            $this->vehicleSubType = $result['vehicle_sub_type'];
            $this->vehicle = $result['vehicle'];
            $this->driver = $result['driver'];
            $this->total_cost = $result['total_cost'];
            $this->package = $result['package'];
            $this->no_of_adults = $result['no_of_adults'];
            $this->no_of_children = $result['no_of_children'];
            $this->seating_capacity = $result['seating_capacity'];
            $this->no_of_hard_baggage = $result['no_of_hard_baggage'];
            $this->no_of_hand_baggage = $result['no_of_hand_baggage'];
            $this->created_at = $result['created_at'];
            $this->comment = $result['comment'];
            $this->isActive = $result['isActive'];
            $this->paidCommission = $result['paid_commission'];
            $this->status = $result['status'];
            $this->confirmedAt = $result['confirmed_at'];
            $this->completedAt = $result['completed_at'];
            $this->canceledAt = $result['canceled_at'];
            $this->feedbackComment = $result['feedback_comment'];
            $this->finalCost = $result['final_cost'];
            return $this;
        }
    }

    public function create() {
        date_default_timezone_set('Asia/Colombo');
        $createdAt = date('Y-m-d');

        $query = "INSERT INTO `booking`("
                . "`reference_no`, "
                . "`customer`, "
                . "`start_date`, "
                . "`start_time`, "
                . "`end_date`, "
                . "`end_time`, "
                . "`no_of_days`, "
                . "`start_from`, "
                . "`end_from`, "
                . "`vehicle_type`, "
                . "`vehicle_sub_type`, "
                . "`vehicle`, "
                . "`driver`, "
                . "`total_cost`, "
                . "`package`, "
                . "`no_of_adults`, "
                . "`no_of_children`, "
                . "`seating_capacity`, "
                . "`no_of_hard_baggage`, "
                . "`no_of_hand_baggage`, "
                . "`created_at`, "
                . "`comment`, "
                . "`isActive`,"
                . "`paid_commission`,"
                . "`status`"
                . ") VALUES  ('"
                . $this->referenceNo . "','"
                . $this->customer . "','"
                . $this->start_date . "', '"
                . $this->start_time . "', '"
                . $this->end_date . "', '"
                . $this->end_time . "', '"
                . $this->no_of_days . "', '"
                . $this->start_from . "', '"
                . $this->end_from . "', '"
                . $this->vehicleType . "', '"
                . $this->vehicleSubType . "', '"
                . $this->vehicle . "', '"
                . $this->driver . "', '"
                . $this->total_cost . "', '"
                . $this->package . "', '"
                . $this->no_of_adults . "', '"
                . $this->no_of_children . "', '"
                . $this->seating_capacity . "', '"
                . $this->no_of_hard_baggage . "', '"
                . $this->no_of_hand_baggage . "', '"
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

    public function getBookingsByStartDate($date) {

        $query = "SELECT * FROM `booking` WHERE `start_date` = '".$date."'  AND (`status` LIKE 'confirmed' OR `status` LIKE 'completed') ORDER BY CASE WHEN `status` LIKE 'confirmed' THEN 1 ELSE 2 END, `start_time` ASC";
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

    public function getTodayBookingsByStatus($status) {

        date_default_timezone_set('Asia/Colombo');
        $today = date('Y-m-d');

        $query = "SELECT * FROM `booking` WHERE `status` LIKE '$status' AND `" . $status . "_at` = '$today'";

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
                . "`start_time` ='" . $this->start_time . "', "
                . "`end_date` ='" . $this->end_date . "', "
                . "`end_time` ='" . $this->end_time . "', "
                . "`no_of_days` ='" . $this->no_of_days . "', "
                . "`start_from` ='" . $this->start_from . "', "
                . "`end_from` ='" . $this->end_from . "', "
                . "`vehicle_type` ='" . $this->vehicleType . "', "
                . "`vehicle_sub_type` ='" . $this->vehicleSubType . "', "
                . "`vehicle` ='" . $this->vehicle . "', "
                . "`driver` ='" . $this->driver . "', "
                . "`total_cost` ='" . $this->total_cost . "' ,"
                . "`package` ='" . $this->package . "' ,"
                . "`no_of_adults` ='" . $this->no_of_adults . "' ,"
                . "`no_of_children` ='" . $this->no_of_children . "' ,"
                . "`seating_capacity` ='" . $this->seating_capacity . "' ,"
                . "`no_of_hard_baggage` ='" . $this->no_of_hard_baggage . "' ,"
                . "`no_of_hand_baggage` ='" . $this->no_of_hand_baggage . "' ,"
                . "`comment` ='" . $this->comment . "' ,"
                . "`isActive` ='" . $this->isActive . "', "
                . "`paid_commission` ='" . $this->paidCommission . "', "
                . "`status` ='" . $this->status . "', "
                . "`confirmed_at` ='" . $this->confirmedAt . "', "
                . "`completed_at` ='" . $this->completedAt . "', "
                . "`feedback_comment` ='" . $this->feedbackComment . "', "
                . "`final_cost` ='" . $this->finalCost . "' "
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

    public function getBookingsByDateRangeAndStatus($from, $to, $status) {

        $query = "SELECT * FROM `booking` WHERE `created_at` BETWEEN '" . $from . "' AND '" . $to . "' AND `status` LIKE '" . $status . "' ORDER BY `id` ASC";

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
        date_default_timezone_set('Asia/Colombo');
        $confirmedAt = date('Y-m-d');
        $query = "UPDATE  `booking` SET "
                . "`status` = 'confirmed', "
                . "`confirmed_at` = '$confirmedAt' "
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

        date_default_timezone_set('Asia/Colombo');
        $completedAt = date('Y-m-d');

        $query = "UPDATE  `booking` SET "
                . "`status` = 'completed', "
                . "`completed_at` = '$completedAt' "
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

        date_default_timezone_set('Asia/Colombo');
        $canceledAt = date('Y-m-d');

        $query = "UPDATE  `booking` SET "
                . "`status` = 'canceled', "
                . "`canceled_at` = '$canceledAt' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function getLastReferenceNo() {

        $query = "SELECT `reference_no` FROM `booking` ORDER BY `id` DESC";

        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));
        return $result['reference_no'];
    }

}
