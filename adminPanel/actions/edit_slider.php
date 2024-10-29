<?php
require_once("../class/index.class.php");
$slider = new sliders();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $banners = $_FILES['images'] ?? null;

    $validExtensions = array("jpg", "jpeg", "png", "avif", "webp");
    $uploadErrors = array();
    $banner_name = '';

    if ($banners && $banners['error'][0] == 0) {
        $extension = strtolower(pathinfo($banners["name"][0], PATHINFO_EXTENSION));

        if (in_array($extension, $validExtensions)) {
            // Move the file and get the file name
            $banner_name = $slider->movemultiplefiles($banners, 0, "welcome-hero");
            if (!$banner_name) {
                $uploadErrors[] = "Failed to move file: " . $banners["name"][0];
            }
        } else {
            $uploadErrors[] = "Invalid file type: " . $banners["name"][0];
        }
    }

    if (empty($uploadErrors)) {
        $updateStatus = $slider->updateSlider($id, $title, $description, $banner_name);
        if ($updateStatus) {
            $response = array(
                'status' => 'success',
                'message' => 'Slider updated successfully'
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Failed to update slider'
            );
        }
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Error updating slider: ' . implode(', ', $uploadErrors)
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
