<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['carId']) && isset($_POST['color'])) {
    $carId = $_POST['carId'];
    $color = $_POST['color'];

    if (isset($_SESSION['inventory'][$carId][$color])) {
        unset($_SESSION['inventory'][$carId][$color]);

        // If there are no more colors for this car, remove the car ID from the inventory
        if (empty($_SESSION['inventory'][$carId])) {
            unset($_SESSION['inventory'][$carId]);
        }

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Car or color not found in inventory']);
    }
} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
