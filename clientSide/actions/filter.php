<?php
// Include necessary class files
require_once '../../adminPanel/class/DAL.class.php';
require_once '../../adminPanel/class/cars.class.php';
require_once "../../adminPanel/class/index.class.php";

// Get filter values
$make = $_POST['make'] ?? 'any';
$model = $_POST['model'] ?? 'any';
$year = $_POST['year'] ?? 'any';
$condition = $_POST['condition'] ?? 'any';
$gear = $_POST['gear'] ?? 'any';
$price = $_POST['price'] ?? 'any';

// Pagination settings
$limit = 10; // Number of items per page
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$offset = ($page - 1) * $limit;

// Prepare the SQL query based on filters
$sql = "SELECT * FROM cars WHERE 1=1";
$params = [];

if ($make != 'any') {
    $sql .= " AND Make = ?";
    $params[] = $make;
}
if ($model != 'any') {
    $sql .= " AND Model = ?";
    $params[] = $model;
}
if ($year != 'any') {
    $sql .= " AND Year = ?";
    $params[] = $year;
}
if ($condition != 'any') {
    $sql .= " AND `isNew` = ?";
    $params[] = $condition;
}
if ($gear != 'any') {
    $sql .= " AND gear = ?";
    $params[] = $gear;
}
if ($price != 'any') {
    switch ($price) {
        case 'under-20000':
            $sql .= " AND Price < 20000";
            break;
        case '20000-40000':
            $sql .= " AND Price BETWEEN 20000 AND 40000";
            break;
        case '40000-60000':
            $sql .= " AND Price BETWEEN 40000 AND 60000";
            break;
        case '60000-80000':
            $sql .= " AND Price BETWEEN 60000 AND 80000";
            break;
        case 'over-80000':
            $sql .= " AND Price > 80000";
            break;
    }
}

// Add LIMIT and OFFSET for pagination
$sql .= " LIMIT ? OFFSET ?";
$params[] = $limit;
$params[] = $offset;

// Execute the query
$dal = new DAL();
$results = $dal->executePreparedUPT($sql, $params);

// Fetch images for each car
$carImages = [];
$carIds = array_column($results, 'CarID'); // Get all CarIDs from results

if (!empty($carIds)) {
    $placeholders = implode(',', array_fill(0, count($carIds), '?'));
    $imageSql = "SELECT CarID, ImageName FROM carimages WHERE CarID IN ($placeholders)";
    $imageResults = $dal->executePreparedUPT($imageSql, $carIds);

    foreach ($imageResults as $image) {
        $carImages[$image['CarID']] = $image['ImageName'];
    }
}

// Attach image names to the car results
foreach ($results as &$car) {
    $car['ImageName'] = $carImages[$car['CarID']] ?? 'default.jpg'; // Default image if none found
}

// Count total number of rows for pagination
$countSql = "SELECT COUNT(*) as total FROM cars WHERE 1=1";
$countParams = []; // Parameters for count query

if ($make != 'any') {
    $countSql .= " AND Make = ?";
    $countParams[] = $make;
}
if ($model != 'any') {
    $countSql .= " AND Model = ?";
    $countParams[] = $model;
}
if ($year != 'any') {
    $countSql .= " AND Year = ?";
    $countParams[] = $year;
}
if ($condition != 'any') {
    $countSql .= " AND `isNew` = ?";
    $countParams[] = $condition;
}
if ($gear != 'any') {
    $countSql .= " AND Gear = ?";
    $countParams[] = $gear;
}
if ($price != 'any') {
    switch ($price) {
        case 'under-20000':
            $countSql .= " AND Price < 20000";
            break;
        case '20000-40000':
            $countSql .= " AND Price BETWEEN 20000 AND 40000";
            break;
        case '40000-60000':
            $countSql .= " AND Price BETWEEN 40000 AND 60000";
            break;
        case '60000-80000':
            $countSql .= " AND Price BETWEEN 60000 AND 80000";
            break;
        case 'over-80000':
            $countSql .= " AND Price > 80000";
            break;
    }
}

$countResults = $dal->executePreparedUPT($countSql, $countParams);
$totalRows = $countResults[0]['total'];
$totalPages = ceil($totalRows / $limit);

$response = [];

if (!empty($results)) {
    $response['status'] = 'success';
    $response['data'] = $results;
    $response['totalPages'] = $totalPages;
    $response['currentPage'] = $page;
} else {
    $response['status'] = 'info';
    $response['message'] = 'No cars found matching your criteria.';
}

header('Content-Type: application/json');
echo json_encode($response);
