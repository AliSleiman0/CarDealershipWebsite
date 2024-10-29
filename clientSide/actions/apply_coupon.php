<?php
require_once '../../adminPanel/class/DAL.class.php';
require_once '../../adminPanel/class/Coupon.class.php';

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

// Check if the required parameters are set
if (!isset($_POST['couponCode'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit();
}

$coupon = new Coupon();
$customerID = $_SESSION['user_id'];
$couponCode = $_POST['couponCode'];

// Clear any existing coupon before applying the new one
unset($_SESSION['applied_coupon']);

// Apply the new coupon
$result = $coupon->applyCoupon($customerID, $couponCode);

header('Content-Type: application/json'); // Set content type to JSON

if ($result['success']) {
    // Get the applied coupon data
    $appliedCoupon = $result['coupon'];
    $discount = $appliedCoupon['discount'];

    // Calculate the old price (total amount before discount)
    $oldPrice = $coupon->calculateTotalAmount($_SESSION['inventory']);

    // Calculate the new price after applying the coupon
    $newPrice = $oldPrice * (1 - $discount / 100);

    // Store the new coupon in the session
    $_SESSION['applied_coupon'] = $appliedCoupon;

    $response = [
        'success' => true,
        'coupon' => $appliedCoupon,
        'oldPrice' => $oldPrice,
        'newPrice' => $newPrice
    ];
} else {
    $response = ['success' => false, 'message' => $result['message']];
}

// Output the response
echo json_encode($response);
