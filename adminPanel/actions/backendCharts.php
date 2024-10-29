<?php
require_once '../class/DAL.class.php';
require_once '../class/charts.class.php';


$charts = new Chart();

$chart = $_GET['chart'] ?? '';

header('Content-Type: application/json');

try {
    if ($chart == 'price') {
        echo json_encode($charts->getTopCarsByPrice());
    } elseif ($chart == 'make') {
        echo json_encode($charts->getCarTypeDistribution());
    } else {
        echo json_encode(array("error" => "Invalid chart type"));
    }
} catch (Exception $e) {
    echo json_encode(array("error" => $e->getMessage()));
}
