<?php
require_once "../class/index.class.php";
header('Content-Type: application/json');
 $slider = new sliders();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $platform = $_POST['platform'];
    $link = $_POST['link'];

   
    $result = $slider->updateLink($platform, $link);
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Link updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update link']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
