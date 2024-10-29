<?php
require_once '../../adminPanel/class/DAL.class.php';
require_once '../../adminPanel/class/Orders.class.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

if (!isset($_SESSION['inventory']) || empty($_SESSION['inventory'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid request or empty cart']);
    exit();
}

$order = new Order();

$customerID = $_SESSION['user_id'];
$formData = $_POST['formData'];
$inventory = $_SESSION['inventory'];
$appliedCoupon = isset($_SESSION['applied_coupon']) ? $_SESSION['applied_coupon'] : null;

$result = $order->submitOrder($customerID, $formData, $inventory, $appliedCoupon);

if ($result['success']) {
    // Clear the cart and applied coupon
    unset($_SESSION['inventory']);
    unset($_SESSION['applied_coupon']);

    echo json_encode([
        'success' => true,
        'message' => 'Order submitted successfully',
        'orderID' => $result['orderID']
    ]);
} else {
    echo json_encode(['success' => false, 'message' => $result['message']]);
}
