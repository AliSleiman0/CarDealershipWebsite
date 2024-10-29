<?php
require_once "../class/Orders.class.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = intval($_POST['order_id']);
    $new_status = $_POST['status'];

    $orderObj = new Order();
    $result = $orderObj->updateOrderStatus($order_id, $new_status);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Status updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update status']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}