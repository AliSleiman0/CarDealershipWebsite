<?php
require_once("../class/testimonials.class.php"); 
$testo = new Testimonials();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['test_id'] ?? '';

    if (!empty($id)) {
        $testDeleted = $testo->deleteTest($id);

        if ($testDeleted > 0) {
            echo 0; // Image deleted successfully
        } else {
            echo 1; // Failed to delete image
        }
    } else {
        echo 2; // Invalid image ID
    }
}
?>
