<?php

class Helper {

    public function randamId() {

        $today = time();
        $startDate = date('YmdHi', strtotime('1912-03-14 09:06:00'));
        $range = $today - $startDate;
        $rand = rand(0, $range);
        $randam = $rand . "_" . ($startDate + $rand) . '_' . $today . "_n";
        return $randam;
    }

    public function calImgResize($newHeight, $width, $height) {

        $percent = $newHeight / $height;
        $result1 = $percent * 100;

        $result2 = $width * $result1 / 100;

        return array($result2, $newHeight);
    }

    public function getSitePath() {
//        return substr_replace(dirname(__FILE__), '', 26);
        $path = str_replace('class', '', dirname(__FILE__));
        return $path;
    }

    public function bookingReferenceNo() {

        $last_reference_no = Booking::getLastReferenceNo();
        $last_no = (int) substr($last_reference_no, 6, 11);
        $current_no = $last_no + 1;

        $year = date('y');
        $month = date('m');
        $len = strlen($current_no);

        for ($i = $len; $i < 5; $i++) {
            $current_no = '0' . $current_no;
        }
        $ref_no = 'KC' . $year . $month . $current_no;
        return $ref_no;
    }

}
