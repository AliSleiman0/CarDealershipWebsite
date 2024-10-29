<?php
// Include your DAL class
require_once('../class/Orders.class.php'); // Adjust the path as necessary

// Create an instance of the DAL class
$order = new Order();

// Check if request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve order_id and status from POST request
    $orderId = isset($_POST['order_id']) ? intval($_POST['order_id']) : 0;
    $status = isset($_POST['status']) ? trim($_POST['status']) : '';

    // Validate inputs
    if ($orderId <= 0 || empty($status) || !in_array($status, ['pending', 'approved', 'shipped'])) {
        echo json_encode(['success' => false, 'message' => 'Invalid input']);
        exit;
    }

    // Prepare SQL statement to update the status
   

    try {
        // Execute the SQL statement
        $affectedRows = $order->updateOrderStatus( $orderId, $status );

        // Check if the update was successful
        if ($affectedRows > 0) {
            echo json_encode(['success' => true, 'message' => 'Order status updated successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'No changes made to the order']);
        }
    } catch (Exception $e) {
        // Handle errors
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    // Not a POST request
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
