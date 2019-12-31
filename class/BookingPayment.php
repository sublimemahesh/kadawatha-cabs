<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BookingPayment
 *
 * @author U s E r ¨
 */
class BookingPayment {

    public $id;
    public $booking;
    public $receiptDate;
    public $receiptNumber;
    public $advancedTotal;
    public $receivedDate;
    public $paidBy;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`booking`,`receipt_date`,`receipt_number`,`advanced_total`,`received_date`,`paid_by` FROM `booking_payments` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->booking = $result['booking'];
            $this->receiptDate = $result['receipt_date'];
            $this->receiptNumber = $result['receipt_number'];
            $this->advancedTotal = $result['advanced_total'];
            $this->receivedDate = $result['received_date'];
            $this->paidBy = $result['paid_by'];

            return $this;
        }
    }

    public function create() {
        date_default_timezone_set('Asia/Colombo');
        $date = date('Y-m-d');

        $query = "INSERT INTO `booking_payments` (`booking`,`receipt_date`,`receipt_number`,`advanced_total`,`received_date`,`paid_by`) VALUES  ('"
                . $this->booking . "','"
                . $this->receiptDate . "', '"
                . $this->receiptNumber . "', '"
                . $this->advancedTotal . "', '"
                . $date . "', '"
                . $this->paidBy . "')";

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

        $query = "SELECT * FROM `booking_payments`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `booking_payments` SET "
                . "`booking` ='" . $this->booking . "', "
                . "`receipt_date` ='" . $this->receiptDate . "', "
                . "`receipt_number` ='" . $this->receiptNumber . "', "
                . "`advanced_total` ='" . $this->advancedTotal . "', "
                . "`received_date` ='" . $this->receivedDate . "', "
                . "`paid_by` ='" . $this->paidBy . "' "
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
        $query = 'DELETE FROM `booking_payments` WHERE id="' . $this->id . '"';
        $db = new Database();
        return $db->readQuery($query);
    }
    
    public function getPaymentsByBookingID($id) {

        $query = "SELECT * FROM `booking_payments` WHERE `booking` = $id";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

}
