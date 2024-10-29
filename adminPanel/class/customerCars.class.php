<?php
require_once('DAL.class.php');

class CustomerCar extends DAL
{
    public function getAllCars()
    {
        $sql = "SELECT * FROM cars";
        return $this->getData($sql);
    }

    public function getCarById($id)
    {
        $sql = "SELECT * FROM cars WHERE CarID = $id";
        return $this->getData($sql);
    }

    public function getCarImages($carId)
    {
        $sql = "SELECT ImageName FROM carimages WHERE CarID = $carId";
        return $this->getData($sql);
    }

    public function getCarFeatures($carId)
    {
        $sql = "SELECT * FROM car_features WHERE CarID = $carId";
        return $this->getData($sql);
    }

    public function getCarWarranty($carId)
    {
        $sql = "SELECT * FROM car_warranties WHERE CarID = $carId";
        return $this->getData($sql);
    }

    public function getAllMakes()
    {
        $sql = "SELECT DISTINCT Make FROM cars";
        return $this->getData($sql);
    }

    public function getAllModels()
    {
        $sql = "SELECT DISTINCT Model FROM cars";
        return $this->getData($sql);
    }

    public function getCarsByMake($make)
    {
        $sql = "SELECT * FROM cars WHERE Make = '$make'";
        return $this->getData($sql);
    }

    public function getCarsByYear($year)
    {
        $sql = "SELECT * FROM cars WHERE Year = $year";
        return $this->getData($sql);
    }
    public function getRelatedCars($make, $type, $currentCarId, $limit = 10) {
        // Construct the SQL query directly with parameters
        $sql = "SELECT * FROM cars WHERE (Make = '$make' OR Type = '$type') AND CarID != $currentCarId LIMIT $limit";
    
        // Execute the query and return the results
        return $this->getData($sql);
    }
    
}
