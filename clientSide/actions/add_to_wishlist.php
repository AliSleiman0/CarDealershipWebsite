<?php
require_once '../../adminPanel/class/DAL.class.php';
require_once '../../adminPanel/class/wishinvent.class.php';

session_start();



$wishlist = new Wishinvent();



if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
} else {
    $customerID = $_SESSION['user_id'];
    $carID = $_POST['carID'];
}


    // Check if the item is already in the wishlist
    $isInWishlist = $wishlist->isInWishlist($customerID, $carID);

    if ($isInWishlist) {
        // Remove from wishlist
        if ($wishlist->removeFromWishlist($customerID, $carID)) {
            $_SESSION['user_wishlist'] = array_diff($_SESSION['user_wishlist'], [$carID]);
            echo json_encode(['status' => 'success', 'message' => 'Removed from wishlist', 'action' => 'removed']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to remove from wishlist']);
        }
    } else {
        // Add to wishlist
        if ($wishlist->addToWishlist($customerID, $carID)) {
            $_SESSION['user_wishlist'][] = $carID;
            echo json_encode(['status' => 'success', 'message' => 'Added to wishlist', 'action' => 'added']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add to wishlist']);
        }
    }

