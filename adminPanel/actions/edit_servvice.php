<?php
require_once("../class/services.class.php");
$service = new service();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $updateStatus = $service->editService($id, $title, $description);
    if ($updateStatus) {
        $response = array(
            'status' => 'success',
            'message' => 'Service updated successfully'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Failed to update service'
        );
    }
} else {
    $response = array(
        'status' => 'error',
        'message' => 'Error updating service: ' . implode(', ', $uploadErrors)
    );
}

header('Content-Type: application/json');
echo json_encode($response);
