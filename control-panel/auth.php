<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!User::authenticate()) {
    redirect('login.php');
}

$disabled = 'disabled';
if ($_SESSION['id'] == 1) {
    $disabled = '';
}