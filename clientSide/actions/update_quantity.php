<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['carId']) && isset($_POST['color']) && isset($_POST['quantity'])) {
    $carId = $_POST['carId'];
    $color = $_POST['color'];
    $quantity = $_POST['quantity'];

    if (isset($_SESSION['inventory'][$carId][$color])) {
        $_SESSION['inventory'][$carId][$color] = $quantity;
    }

    echo json_encode(['success' => true]);
} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
