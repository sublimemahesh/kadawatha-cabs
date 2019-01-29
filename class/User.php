<?php

/**
 * Description of User
 *
 * @author sublime holdings
 * @web www.sublime.lk
 */
class User {

    public $id;
    public $fullname;
    public $email;
    public $createdAt;
    public $isActive;
    public $authToken;
    public $lastLogin;
    public $profile_picture;
    public $mobile_number;
    public $username;
    public $resetCode;
    public $password;

//    private $password;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`name`,`email`,`createdAt`,`isActive`,`authToken`,`profile_picture`,`mobile_number`,`lastLogin`,`username`,`resetcode` FROM `user` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->fullname = $result['name'];
            $this->email = $result['email'];
            $this->profile_picture = $result['profile_picture'];
            $this->mobile_number = $result['mobile_number'];
            $this->createdAt = $result['createdAt'];
            $this->isActive = $result['isActive'];
            $this->lastLogin = $result['lastLogin'];
            $this->username = $result['username'];
            $this->authToken = $result['authToken'];
            $this->resetCode = $result['resetcode'];

            return $result;
        }
    }

    public function create() {

        $enPass = md5($this->password);

        date_default_timezone_set('Asia/Colombo');

        $createdAt = date('Y-m-d H:i:s');

//        $query = "INSERT INTO `user` (name, email, createdAt, mobile_number, profile_picture, isActive, username, password) VALUES  ('" . $name . "', '" . $email . "', '" . $createdAt . "','" . $profile_picture . "','" . $mobile_number . "', '" . 1 . "', '" . $username . "', '" . $enPass . "')";

        $query = "INSERT INTO `user` (`name`, `email`, `createdAt`,`mobile_number`, `profile_picture`, `isActive`, `username`, `password`) VALUES  ('"
                . $this->fullname . "','"
                . $this->email . "', '"
                . $createdAt . "', '"
                . $this->mobile_number . "', '"
                . $this->profile_picture . "', '"
                . 1 . "', '"
                . $this->username . "', '"
                . $enPass . "')";

        $db = new Database();

        $result = $db->readQuery($query);
        if ($result) {
            $last_id = mysql_insert_id();
            return $this->__construct($last_id);
        } else {
            return FALSE;
        }
    }

    public function login($username, $password) {

        $enPass = md5($password);
        $query = "SELECT `id`,`name`,`email`,`createdAt`,`isActive`,`lastLogin`,`username` FROM `user` WHERE `username`= '" . $username . "' AND `password`= '" . $enPass . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));


        if (!$result) {
            return FALSE;
        } else {
            $this->id = $result['id'];
            $this->setAuthToken($result['id']);
            $this->setLastLogin($this->id);

            $user = $this->__construct($this->id);

            $this->setUserSession($user);

            return $user;
        }
    }

    public function checkOldPass($id, $password) {

        $enPass = md5($password);

        $query = "SELECT `id` FROM `user` WHERE `id`= '" . $id . "' AND `password`= '" . $enPass . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function changePassword($id, $password) {

        $enPass = md5($password);

        $query = "UPDATE  `user` SET "
                . "`password` ='" . $enPass . "' "
                . "WHERE `id` = '" . $id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function authenticate() {

        if (!isset($_SESSION)) {
            session_start();
        }

        $id = NULL;
        $authToken = NULL;

        if (isset($_SESSION["id"])) {
            $id = $_SESSION["id"];
        }

        if (isset($_SESSION["authToken"])) {
            $authToken = $_SESSION["authToken"];
        }

        $query = "SELECT `id` FROM `user` WHERE `id`= '" . $id . "' AND `authToken`= '" . $authToken . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {

            return TRUE;
        }
    }

    public function logOut() {

        if (!isset($_SESSION)) {
            session_start();
        }

        unset($_SESSION["id"]);
        unset($_SESSION["fullname"]);
        unset($_SESSION["email"]);
        unset($_SESSION["isActive"]);
        unset($_SESSION["authToken"]);
        unset($_SESSION["lastLogin"]);
        unset($_SESSION["username"]);
        unset($_SESSION["profile_picture"]);
        return TRUE;
    }

    public function update() {

        $query = "UPDATE  `user` SET "
                . "`name` ='" . $this->fullname . "', "
                . "`profile_picture` ='" . $this->profile_picture . "', "
                . "`username` ='" . $this->username . "', "
                . "`mobile_number` ='" . $this->mobile_number . "', "
                . "`email` ='" . $this->email . "', "
                . "`isActive` ='" . $this->isActive . "' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    private function setUserSession($user) {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION["id"] = $user['id'];
        $_SESSION["fullname"] = $user['name'];
        $_SESSION["email"] = $user['email'];
        $_SESSION["isActive"] = $user['isActive'];
        $_SESSION["authToken"] = $user['authToken'];
        $_SESSION["lastLogin"] = $user['lastLogin'];
        $_SESSION["username"] = $user['username'];
        $_SESSION["profile_picture"] = $user['profile_picture'];
        $_SESSION["mobile_number"] = $user['mobile_number'];
    }

    private function setAuthToken($id) {

        $authToken = md5(uniqid(rand(), true));

        $query = "UPDATE `user` SET `authToken` ='" . $authToken . "' WHERE `id`='" . $id . "'";

        $db = new Database();

        if ($db->readQuery($query)) {

            return $authToken;
        } else {
            return FALSE;
        }
    }

    private function setLastLogin($id) {

        date_default_timezone_set('Asia/Colombo');

        $now = date('Y-m-d H:i:s');

        $query = "UPDATE `user` SET `lastLogin` ='" . $now . "' WHERE `id`='" . $id . "'";

        $db = new Database();

        if ($db->readQuery($query)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function checkEmail($email) {

        $query = "SELECT `email`,`username` FROM `user` WHERE `email`= '" . $email . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {
            return $result;
        }
    }

    public function GenarateCode($email) {

        $rand = rand(10000, 99999);

        $query = "UPDATE  `user` SET "
                . "`resetcode` ='" . $rand . "' "
                . "WHERE `email` = '" . $email . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function SelectForgetUser($email) {

        if ($email) {

            $query = "SELECT `email`,`username`,`resetcode` FROM `user` WHERE `email`= '" . $email . "'";

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->username = $result['username'];
            $this->email = $result['email'];
            $this->restCode = $result['resetcode'];

            return $result;
        }
    }

    public function SelectResetCode($code) {

        $query = "SELECT `id` FROM `user` WHERE `resetcode`= '" . $code . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {

            return TRUE;
        }
    }

    public function updatePassword($password, $code) {

        $enPass = md5($password);

        $query = "UPDATE  `user` SET "
                . "`password` ='" . $enPass . "' "
                . "WHERE `resetcode` = '" . $code . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function all() {

        $query = "SELECT * FROM `user`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function delete() {

        $query = 'DELETE FROM `user` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

}
