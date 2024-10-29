<?php
require_once "../class/brandimg.class.php";
$brand = new Brand();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image = $_FILES['images'] ?? null;

    $validExtensions = array("jpg", "jpeg", "png", "avif", "webp");
    $uploadErrors = array();
    $image_name = '';

    if ($image && $image['error'][0] == 0) {
        $extension = strtolower(pathinfo($image["name"][0], PATHINFO_EXTENSION));

        if (in_array($extension, $validExtensions)) {
            // Move the file and get the file name
            $image_name = $brand->movemultiplefiles($image, 0, "brand");
            if (!$image_name) {
                $uploadErrors[] = "Failed to move file: " . $image["name"][0];
            }
        } else {
            $uploadErrors[] = "Invalid file type: " . $image["name"][0];
        }
    }

    if (empty($uploadErrors)) {
        $updateStatus = $brand->addBrand($image_name);
        if ($updateStatus) {
            $response = array(
                'status' => 'success',
                'message' => 'Brand Added successfully'
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Failed to add Brand'
            );
        }
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Error Adding Brand: ' . implode(', ', $uploadErrors)
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
