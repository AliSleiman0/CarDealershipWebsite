<?php
require_once("../class/cars.class.php"); 
$car = new Car();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image_id = $_POST['image_id'] ?? '';

    if (!empty($image_id)) {
        $imageDeleted = $car->deleteImage($image_id);

        if ($imageDeleted > 0) {
            echo 0; // Image deleted successfully
        } else {
            echo 1; // Failed to delete image
        }
    } else {
        echo 2; // Invalid image ID
    }
}
?>
