<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $couponCode = $_POST['couponCode'];

    // Your coupon validation logic here
    // Example:
    if ($couponCode === 'DISCOUNT10') {
        $_SESSION['appliedCoupon'] = [
            'code' => $couponCode,
            'discount' => 10 // Example discount percentage
        ];
        echo json_encode(['success' => true, 'coupon' => $_SESSION['appliedCoupon']]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid coupon code']);
    }
}
?>
