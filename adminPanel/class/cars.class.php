<?php
require_once('DAL.class.php');

class Car extends DAL
{
    function getAllCars()
    {
        $sql = "SELECT * FROM cars";

        //  SELECT *FROM `cars` left join carimages ON cars.CarID=carimages.CarID group by cars.CarID;
        return $this->getdata($sql);
    }

    function insertCar($make, $model, $year, $price, $description, $isNew, $type, $quantity, $gear)
    {
        $sql = "INSERT INTO cars (Make, Model, Year, Price, Description, isNew, type, quantity, gear) 
                VALUES ('$make', '$model', $year, $price, '$description', $isNew, '$type', $quantity, '$gear')";
        return $this->execute($sql);
    }

    function getCar($carID)
    {
        $sql = "SELECT * FROM cars WHERE CarID=$carID";
        return $this->getdata($sql);
    }
    function getCarXOR($make, $model, $year, $price, $description, $isNew, $type, $gear)
    {
        $sql = "SELECT * FROM cars WHERE 
            Make = '$make' AND 
            Model = '$model' AND 
            Year = $year AND 
            Price = $price AND 
            Description = '$description' AND 
            isNew = $isNew AND 
            type = '$type' 
            LIMIT 1";

        return $this->getdata($sql);
    }



    function deleteCar($carID)
    {
        $sql = "DELETE FROM cars where CarID= $carID";
        return $this->execute($sql);
    }
    function updateCar($id, $make, $model, $year, $price, $description, $isNew, $type, $quantity, $gear)
    {
        $sql = "UPDATE cars SET 
                    Make = '$make', 
                    Model = '$model', 
                    Year = $year, 
                    Price = $price, 
                    Description = '$description', 
                    isNew = $isNew, 
                    type = '$type', 
                    quantity = $quantity ,
                    gear = '$gear'
                WHERE CarID = $id";

        return $this->execute($sql);
    }

    public function insertimage($image_name, $carID)
    {
        $sql = "insert into carimages (ImageName,CarID) VALUES ('$image_name', $carID)";
        return $this->execute($sql);
    }
    public function getAllImagesByID($carID)
    {
        $sql = "select * from carimages where CarID=$carID";
        return $this->getdata($sql);
    }
    public function getRandomImagesByID($carID)
    {
        $sql = "select * from carimages where CarID =$carID ";
        return $this->getdata($sql);
    }

    public function deleteImage($imageID)
    {
        $sql = "DELETE FROM carimages WHERE ImageID = $imageID";
        return $this->execute($sql);
    }


    public function getAllMake()
    {

        $sql = "select Make from cars";
        return $this->getdata($sql);
    }
    public function getAllModel()
    {

        $sql = "select Model from cars";
        return $this->getdata($sql);
    }
    public function getAllYears()
    {
        $sql = "select Year from cars order by Year DESC";
        return $this->getdata($sql);
    }
    public function getFeatures()
    {
        $sql = "SELECT 
 
    c.Make,
    c.Model, 
    c.Year, 
     cf.FeatureID,
    cf.Transmission, 
    cf.FuelEconomy, 
    cf.Engine, 
    cf.DriveType, 
    cf.PassengerCapacity, 
    cf.DiscountPrice
        FROM 
            cars c
        LEFT JOIN 
            car_features cf ON c.CarID = cf.CarID;";
        return $this->getdata($sql);
    }
    public function getWarranties()
    {
        $sql = "SELECT 
            c.Make, 
            c.Model, 
            c.Year,
            cw.WarrantyID,
            cw.BumperToBumperMonthsMiles, 
            cw.MajorComponentsMonths, 
            cw.IncludedMaintenanceMonths, 
            cw.RoadsideAssistanceMonths, 
            cw.CorrosionPerforation, 
            cw.AccessoriesMonths
        FROM 
            cars c
        LEFT JOIN 
            car_warranties cw ON c.CarID = cw.CarID;";
        return $this->getdata($sql);
    }
    public static function editFeature($id, $transmission, $fuelEconomy, $engine, $driveType, $passengerCapacity, $discountPrice)
    {
        $dal = new DAL();
        $sql = "UPDATE car_features SET 
                Transmission = ?, 
                FuelEconomy = ?, 
                Engine = ?, 
                DriveType = ?, 
                PassengerCapacity = ?, 
                DiscountPrice = ? 
                WHERE FeatureID = ?";

        $params = [
            $transmission,
            $fuelEconomy,
            $engine,
            $driveType,
            $passengerCapacity,
            $discountPrice,
            $id
        ];

        // Debugging: Log the SQL and parameters
        error_log("Executing SQL: $sql");
        error_log("With Parameters: " . print_r($params, true));

        try {
            $result = $dal->executePrepared($sql, $params);
            if ($result) {
                return "Feature updated successfully.";
            } else {
                return "Failed to update feature. No rows were affected.";
            }
        } catch (Exception $e) {
            return "Failed to update feature: " . $e->getMessage();
        }
    }

    public static function editWarranty($id, $bumperToBumper, $majorComponents, $includedMaintenance, $roadsideAssistance, $corrosionPerforation, $accessories)
    {
        $dal = new DAL();
        $sql = "UPDATE car_warranties SET 
                BumperToBumperMonthsMiles = ?, 
                MajorComponentsMonths = ?, 
                IncludedMaintenanceMonths = ?, 
                RoadsideAssistanceMonths = ?, 
                CorrosionPerforation = ?, 
                AccessoriesMonths = ? 
                WHERE WarrantyID = ?";

        $params = [
            $bumperToBumper,
            $majorComponents,
            $includedMaintenance,
            $roadsideAssistance,
            $corrosionPerforation,
            $accessories,
            $id
        ];

        try {
            $result = $dal->executePreparedUPT($sql, $params);
            if ($result) {
                return "Warranty updated successfully.";
            } else {
                return "Failed to update warranty. No rows were affected.";
            }
        } catch (Exception $e) {
            return "Failed to update warranty: " . $e->getMessage();
        }
    }
    public function getAllCarsUPT($limit = 10, $offset = 0)
    {
        $sql = "SELECT * FROM cars LIMIT ? OFFSET ?";
        $params = [$limit, $offset];
        return $this->executePreparedUPT($sql, $params);
    }
    
    public function getTotalCarsCount()
    {
        $sql = "SELECT COUNT(*) as count FROM cars";
        $result = $this->getdata($sql);
        return $result[0]['count'];
    }
}
