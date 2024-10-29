<?php
 require_once("../class/cars.class.php"); 
$car = new Car();
if ($_POST) {
    $id = $_POST['carID'];
    $carDeleted = $car->deleteCar($id);
    if ($carDeleted == 0) {
        echo $carDeleted;
     
    }
}
?>