<?php
require_once '../../adminPanel/class/DAL.class.php';
require_once '../../adminPanel/class/wishinvent.class.php';

session_start();

if (!isset($_SESSION['user_id']) || !isset($_POST['carID'])) {
    // echo 'error';
    // exit();
}

$wishlist = new Wishinvent();

$customerID = $_SESSION['user_id'];
$carID = $_POST['carID'];

if ($wishlist->removeFromWishlist($customerID, $carID)) {
    echo 'success';
} else {
    echo 'error';
}