<?php
//this is get_original_content.php to undo search
// Include the necessary class files
require_once '../../adminPanel/class/DAL.class.php';
require_once '../../adminPanel/class/cars.class.php';
 require_once "../../adminPanel/class/index.class.php"; 
// Create an instance of the Car class
$car = new Car();

// Fetch all car data
$allCars = $car->getAllCars();

// Initialize an empty content variable
$content = '';
$slider = new sliders();

$allCars = $car->getAllCars();


// Check if there are any cars returned
if (!empty($allCars)) {
    foreach ($allCars as $car) {
        $image = $slider->getRandomImagesByID($car['CarID']);
        $price = number_format($car['Price'], 2);
        $content .= "<div class='grid-item'>
                        <div class='panel panel-default custom-card'>
                            <div class='custom-card-img'>
                                <img src='../adminPanel/assets/img/allCars/{$image[0]['ImageName']}' class='imgg img-responsive' alt='{$car['Make']}-{$car['Model']}'>
                            </div>
                            <div class='custom-card-body'>
                                <div class='panel-body'>
                                    <small>{$car['Year']} | {$car['gear']}</small>
                                    <h4>{$car['Make']} {$car['Model']}</h4>
                                    <p>{$car['Description']}</p>
                                    <div class='custom-card-footer'>
                                        <div class='price-mpg'>
                                            <span class='price'>\${$price}</span>
                                        </div>
                                        <div class='btn-group btn-group-justified' role='group'>
                                            <div class='btn-group' role='group'>
                                                <button type='button' class='explore'>Explore</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>";
    }
} else {
    $content = "<p>No cars available.</p>";
}

// Output the HTML content
echo $content;
