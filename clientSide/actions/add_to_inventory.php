<?php
session_start();

header('Content-Type: application/json');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize input
    $carId = isset($_POST['carId']) ? htmlspecialchars($_POST['carId']) : '';
    $color = isset($_POST['color']) ? htmlspecialchars($_POST['color']) : '';

    if (empty($carId) || empty($color)) {
        echo json_encode(['success' => false, 'message' => 'Invalid input.']);
        exit();
    }

    // Ensure the inventory session is initialized
    if (!isset($_SESSION['inventory'])) {
        $_SESSION['inventory'] = [];
    }

    // Initialize the car's inventory if it doesn't exist
    if (!isset($_SESSION['inventory'][$carId])) {
        $_SESSION['inventory'][$carId] = [];
    }

    // Ensure the inventory for the specific car is an array
    if (!is_array($_SESSION['inventory'][$carId])) {
        echo json_encode(['success' => false, 'message' => 'Inventory data is corrupted.']);
        exit();
    }

    $inventory = $_SESSION['inventory'][$carId];

    // Check if the color already exists in the inventory
    if (isset($inventory[$color])) {
        echo json_encode(['success' => false, 'message' => 'This color is already added to inventory.']);
        exit();
    }

    // Add the color to the inventory with a quantity of 1
    $inventory[$color] = 1;
    $_SESSION['inventory'][$carId] = $inventory;

    echo json_encode(['success' => true]);
    exit();
}
