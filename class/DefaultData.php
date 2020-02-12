<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DefaultData
 *
 * @author U s E r ¨
 */
class DefaultData {

    public function getDriverType() {
        return array("1" => "Full Time", "2" => "Part Time");
    }
    public function getDriverCommission() {
        return array("1" => "10%", "2" => "15%");
    }

}
