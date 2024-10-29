<?php 
require_once "../class/brandimg.class.php";
$brand = new Brand();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['test_id'] ?? '';

    if (!empty($id)) {
        $testDeleted = $brand->deleteBrand($id);

        if ($testDeleted > 0) {
            echo 0; // Image deleted successfully
        } else {
            echo 1; // Failed to delete image
        }
    } else {
        echo 2; // Invalid image ID
    }
}
