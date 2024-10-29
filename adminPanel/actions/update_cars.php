<?php
require_once("../class/cars.class.php");
$car = new Car();

if ($_POST) {
    $id = $_POST['id'];
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $isNew = $_POST['condition'];
    $type = $_POST['type'];
    $gear = $_POST['gear'];
    $images = $_FILES['images'] ?? [];

    $existingCar = $car->getCarXOR($make, $model, $year, $price, $description, $isNew, $type,$gear);
    $validExtensions = array("jpg", "jpeg", "png" ,"avif","webp");
    $uploadErrors = array();

    // Iterate through each uploaded image
    foreach ($images['name'] as $i => $value) {
        $extension = strtolower(pathinfo($images["name"][$i], PATHINFO_EXTENSION));

        if (in_array($extension, $validExtensions)) {
            // Move the file and insert into the database
            $image_name = $car->movemultiplefiles($images, $i, "allCars"); // Assuming this handles file moving
            if ($image_name) {
                $car->insertimage($image_name, $id);
            } else {
                $uploadErrors[] = "Failed to move file: " . $images["name"][$i];
            }
        } else {
            $uploadErrors[] = "Invalid file type: " . $images["name"][$i];
        }
    }

    if ($existingCar && empty($uploadErrors)) {
        $response = array(
            'status' => 'error',
            'message' => 'Car already exists, Images added successfully'
        );
    } else {
        $product = $car->updateCar($id, $make, $model, $year, $price, $description, $isNew, $type, $quantity,$gear);
        if (empty($uploadErrors)) {
            $response = array(
                'status' => 'success',
                'message' => 'Car and images updated successfully'
            );
        } else {
            $response = array(
                'status' => 'warning',
                'message' => 'Car updated, but some images failed to upload: ' . implode(', ', $uploadErrors)
            );
        }
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
