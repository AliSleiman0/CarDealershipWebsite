<?php
// Include your DAL class
require_once('../class/Orders.class.php'); // Adjust the path as necessary

// Create an instance of the DAL class
$order = new Order();

// Check if 'id' parameter is set and is a valid integer
if (isset($_GET['id']) && intval($_GET['id']) > 0) {
    $orderId = intval($_GET['id']);

    try {
        // Fetch order details from the database
        $sql = "SELECT o.OrderID, u.Name, o.OrderDate, o.TotalAmount, 
                       od.Quantity, od.Price, od.color, od.address, od.city, 
                       od.country, od.zip_code, od.expected_delivery_date, 
                       od.order_status, c.Make, c.Model
                FROM orders o
                JOIN orderdetails od ON o.OrderID = od.OrderID
                JOIN users u ON o.CustomerID = u.CustomerID
                JOIN cars c ON od.CarID = c.CarID
                WHERE o.OrderID = ?";
        $params = [$orderId];
        $orderDetails = $order->data($sql, $params);

        if ($orderDetails) {
            // Return order details as JSON
            header('Content-Type: application/json');
            echo json_encode($orderDetails);
        } else {
            // Handle case when no order is found
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Order not found']);
        }
    } catch (Exception $e) {
        // Handle exceptions and errors
        header('Content-Type: application/json');
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    // Handle invalid 'id' parameter
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Invalid order ID']);
}
