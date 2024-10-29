<?php
// Include necessary class files
require_once '../../adminPanel/class/dal.class.php';
require_once "../../adminPanel/class/index.class.php";
require_once '../../adminPanel/class/cars.class.php';

// Create instances of the DAL and Slider classes
$dal = new DAL();
$slider = new sliders(); // Assuming there's a Slider class for fetching images

// Initialize response array
$response = [];

if (isset($_GET['query'])) {
    $query = htmlspecialchars($_GET['query']);

    // Get the current page number from the query parameter, default to 1
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = 10; // Number of cars per page
    $offset = ($page - 1) * $limit;

    // SQL query using LIKE operator with pagination
    $sql = "SELECT CarID, Make, Model, Description, Year, gear, Price FROM cars 
            WHERE Make LIKE ? OR Model LIKE ? OR Description LIKE ? 
            LIMIT ? OFFSET ?";
    $params = ["%$query%", "%$query%", "%$query%", $limit, $offset];

    // Get data using the DAL class
    $results = $dal->executePreparedUPT($sql, $params);

    if (!empty($results)) {
        $response['status'] = 'success';
        $response['data'] = [];

        foreach ($results as $car) {
            // Fetch the image for each car
            $image = $slider->getRandomImagesByID($car['CarID']);
            $car['ImageName'] = $image[0]['ImageName'] ?? 'default.jpg'; // Provide a default image if none is found
            $response['data'][] = $car;
        }

        // Get the total count for pagination
        $countSql = "SELECT COUNT(*) as count FROM cars 
                     WHERE Make LIKE ? OR Model LIKE ? OR Description LIKE ?";
        $countResult = $dal->executePreparedUPT($countSql, ["%$query%", "%$query%", "%$query%"]);
        $totalCars = $countResult[0]['count'];
        $totalPages = ceil($totalCars / $limit);

        $response['totalPages'] = $totalPages;
        $response['currentPage'] = $page;
    } else {
        $response['status'] = 'info';
        $response['message'] = 'No results found.';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Search query is missing.';
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
