<?php
require_once("../class/testimonials.class.php");
$testo = new Testimonials();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_name = $_POST['name'];
    $location = $_POST['location'];
    $testimonial_text = $_POST['text'];
    $image = $_FILES['images'] ?? null;

    $validExtensions = array("jpg", "jpeg", "png", "avif", "webp");
    $uploadErrors = array();
    $image_name = '';

    if ($image && $image['error'][0] == 0) {
        $extension = strtolower(pathinfo($image["name"][0], PATHINFO_EXTENSION));

        if (in_array($extension, $validExtensions)) {
            // Move the file and get the file name
            $image_name = $testo->movemultiplefiles($image, 0, "clients");
            if (!$image_name) {
                $uploadErrors[] = "Failed to move file: " . $image["name"][0];
            }
        } else {
            $uploadErrors[] = "Invalid file type: " . $image["name"][0];
        }
    }

    if (empty($uploadErrors)) {
        $updateStatus = $testo->addTest($client_name, $location, $testimonial_text, $image_name);
        if ($updateStatus) {
            $response = array(
                'status' => 'success',
                'message' => 'Testimonial Added successfully'
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Failed to add Testimonial'
            );
        }
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Error Adding Testimonial: ' . implode(', ', $uploadErrors)
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
