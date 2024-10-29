<?php
require_once("../class/cars.class.php");
$car = new Car();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['featureId'];
    $transmission = $_POST['transmission'];
    $fuelEconomy = $_POST['fuelEconomy'];
    $engine = $_POST['engine'];
    $driveType = $_POST['driveType'];
    $passengerCapacity = $_POST['passengerCapacity'];
    $discountPrice = $_POST['discountPrice'];

    $updateStatus = $car->editFeature($id, $transmission, $fuelEconomy, $engine, $driveType, $passengerCapacity, $discountPrice);

    if ($updateStatus) {
        $response = array(
            'status' => 'success',
            'message' => 'Feature updated successfully'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Failed to update feature'
        );
    }
} else {
    $response = array(
        'status' => 'error',
        'message' => 'Invalid request method'
    );
}

header('Content-Type: application/json');
echo json_encode($response);
