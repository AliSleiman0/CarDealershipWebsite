<?php
session_start();
require_once '../../adminPanel/class/DAL.class.php';
require_once '../../adminPanel/class/wishinvent.class.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

$dal = new DAL();
$wishlist = new Wishinvent();

$customerID = $_SESSION['user_id'];
$wishlistItems = $wishlist->getUserWishlist($customerID);

$_SESSION['user_wishlist'] = $wishlistItems;

echo json_encode(['status' => 'success', 'wishlist' => $wishlistItems]);