<?php
require_once('DAL.class.php');

class Order extends DAL
{
    public function submitOrder($customerID, $formData, $inventory, $appliedCoupon)
    {
        try {
            // Calculate the total amount
            $totalAmount = $this->calculateTotalAmount($inventory);
            if ($appliedCoupon) {
                $totalAmount *= (1 - $appliedCoupon['discount'] / 100);
            }

            // Insert the order into the 'orders' table
            $orderID = $this->insertOrder($customerID, $totalAmount);

            // Check if the orderID was correctly obtained
            if (!$orderID || $orderID <= 0) {
                throw new Exception("Failed to insert order. CustomerID: $customerID, OrderID: $orderID");
            }

            // Insert the order details into the 'orderdetails' table
            $this->insertOrderDetails($orderID, $inventory, $formData);

            // Update coupon usage if applicable
            if ($appliedCoupon) {
                $this->updateCouponUsage($appliedCoupon['id']);
            }

            return ['success' => true, 'orderID' => $orderID];
        } catch (Exception $e) {
            // Return error message in case of failure
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }
    // In Orders.class.php

    private function insertOrder($customerID, $totalAmount)
    {
        $sql = "INSERT INTO orders (CustomerID, OrderDate, TotalAmount) VALUES (?, CURDATE(), ?)";
        $params = [$customerID, $totalAmount];

        try {
            // Use the DAL method to insert the order and get the last inserted ID
            $orderID = $this->insertAndGetId($sql, $params);

            if ($orderID > 0) {
                return $orderID;
            } else {
                throw new Exception("Order ID could not be retrieved.");
            }
        } catch (Exception $e) {
            error_log("Error inserting order. CustomerID: $customerID. Exception: " . $e->getMessage());
            throw new Exception("Failed to insert order.");
        }
    }
    private function insertOrderDetails($orderID, $inventory, $formData)
    {
        $sql = "INSERT INTO orderdetails (OrderID, CarID, Quantity, Price, color, address, city, country, zip_code, expected_delivery_date, order_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, DATE_ADD(CURDATE(), INTERVAL 7 DAY), 'pending')";

        foreach ($inventory as $carId => $colors) {
            foreach ($colors as $color => $quantity) {
                $price = $this->getCarPrice($carId);
                $params = [
                    $orderID, $carId, $quantity, $price, $color,
                    $formData['address'], $formData['city'], $formData['country'], $formData['zipCode']
                ];

                try {
                    $this->data($sql, $params);
                } catch (Exception $e) {
                    // Log specific errors for order details insertion
                    error_log("Error inserting order details for OrderID $orderID, CarID $carId: " . $e->getMessage());
                    throw new Exception("Failed to insert order details.");
                }
            }
        }
    }

    private function updateCouponUsage($couponId)
    {
        $sql = "UPDATE coupon SET times_used = times_used + 1 WHERE id = ?";
        $this->data($sql, [$couponId]);
    }

    private function calculateTotalAmount($inventory)
    {
        $total = 0;
        foreach ($inventory as $carId => $colors) {
            $carPrice = $this->getCarPrice($carId);
            foreach ($colors as $color => $quantity) {
                $total += $carPrice * $quantity;
            }
        }
        return $total;
    }

    private function getCarPrice($carId)
    {
        $sql = "SELECT Price FROM cars WHERE CarID = ?";
        $result = $this->data($sql, [$carId]);
        return !empty($result) ? $result[0]['Price'] : 0;
    }
    function getAllOrders()
    {
        $sql = "SELECT o.OrderID, u.Name, o.OrderDate, o.TotalAmount, 
                       c.Make, c.Model, od.Quantity, od.order_status
                FROM orders o
                JOIN users u ON o.CustomerID = u.CustomerID
                JOIN orderdetails od ON o.OrderID = od.OrderID
                JOIN cars c ON od.CarID = c.CarID
                ORDER BY o.OrderDate DESC";

        return $this->getdata($sql);
    }
    function getAllOrdersTable()
    {
        $sql = "SELECT * from orders
                ORDER BY OrderDate DESC";

        return $this->getdata($sql);
    }

    function getOrderDetails($orderId)
    {
        $sql = "SELECT o.OrderID, u.Name, o.OrderDate, o.TotalAmount, 
                       c.Make, c.Model, od.Quantity, od.order_status
                FROM orders o
                JOIN users u ON o.CustomerID = u.CustomerID
                JOIN orderdetails od ON o.OrderID = od.OrderID
                JOIN cars c ON od.CarID = c.CarID
                WHERE o.OrderID = " . intval($orderId);

        $result = $this->getdata($sql);
        return $result ? $result[0] : null;
    }

    function updateOrderStatus($orderId, $newStatus)
    {
        $sql = "UPDATE orders SET order_status = '" .
            $this->escapeString($newStatus) .
            "' WHERE OrderID = " . intval($orderId);

        return $this->execute($sql);
    }

    // Assume this method exists in a parent class or trait
    // protected function executeQuery($sql, $params) { ... }
}
