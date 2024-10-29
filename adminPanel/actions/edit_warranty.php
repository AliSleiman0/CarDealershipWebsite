<?php
require_once("../class/cars.class.php");
$warranty = new Car();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['warrantyId'];
    $bumperToBumper = $_POST['bumperToBumper'];
    $majorComponents = $_POST['majorComponents'];
    $includedMaintenance = $_POST['includedMaintenance'];
    $roadsideAssistance = $_POST['roadsideAssistance'];
    $corrosionPerforation = $_POST['corrosionPerforation'];
    $accessories = $_POST['accessories'];

    $updateStatus = $warranty->editWarranty($id, $bumperToBumper, $majorComponents, $includedMaintenance, $roadsideAssistance, $corrosionPerforation, $accessories);

    if ($updateStatus) {
        $response = array(
            'status' => 'success',
            'message' => 'Warranty updated successfully'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Failed to update warranty'
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
