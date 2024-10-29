<?php
require_once("../class/cars.class.php");
$car = new Car();
$response = array();

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $make = $_POST['make'] ?? '';
        $model = $_POST['model'] ?? '';
        $year = $_POST['year'] ?? '';
        $price = $_POST['price'] ?? '';
        $description = $_POST['description'] ?? '';
        $isNew = $_POST['condition'] ?? '';
        $type = $_POST['type'] ?? '';
        $quantity = $_POST['quantity'] ?? '';
        $images = $_FILES['images'] ?? [];
        $gear = $_POST['gear'] ?? '';

        // Check if the car already exists
        $carExists = $car->getCarXOR($make, $model, $year, $price, $description, $isNew, $type ,$gear);

        if ($carExists) {
            $response = array(
                'status' => 'error',
                'message' => 'Car already exists!'
            );
        } else {
            // Insert the car only if it doesn't already exist
            $carID = $car->insertCar($make, $model, $year, $price, $description, $isNew, $type, $quantity, $gear);
            
            if ($carID > 0) {
                // Handle file uploads if car insertion was successful
                $validExtensions = array("jpg", "jpeg", "png");
                $uploadErrors = array();

                // Iterate through each uploaded image
                foreach ($images['name'] as $i => $value) {
                    $extension = strtolower(pathinfo($images["name"][$i], PATHINFO_EXTENSION));

                    if (in_array($extension, $validExtensions)) {
                        // Move the file and insert into the database
                        $image_name = $car->movemultiplefiles($images, $i,"allCars"); // Assuming this handles file moving
                        if ($image_name) {
                            $car->insertimage($image_name, $carID);
                        } else {
                            $uploadErrors[] = "Failed to move file: " . $images["name"][$i];
                        }
                    } else {
                        $uploadErrors[] = "Invalid file type: " . $images["name"][$i];
                    }
                }

                if (empty($uploadErrors)) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Car and images added successfully'
                    );
                } else {
                    $response = array(
                        'status' => 'warning',
                        'message' => 'Car added, but some images failed to upload: ' . implode(', ', $uploadErrors)
                    );
                }
            } else {
                throw new Exception('Failed to insert car');
            }
        }
    } else {
        throw new Exception('Invalid request');
    }
} catch (Exception $e) {
    $response = array(
        'status' => 'error',
        'message' => $e->getMessage()
    );
}

header('Content-Type: application/json');
echo json_encode($response);
?>