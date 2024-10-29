<?php require_once('DAL.class.php');

class Chart extends DAL
{
    public function getTopCarsByPrice()
    {
        $sql = "SELECT Make, Model, Price FROM cars ORDER BY Price DESC LIMIT 5";
        return $this->getdata($sql);
    }

    public function getCarTypeDistribution()
    {
        $sql = "SELECT Make, COUNT(*) as count 
                FROM cars 
                GROUP BY Make 
                ORDER BY count DESC;";
        return $this->getdata($sql);
    }

    public function mostPopularCarMake()
    {
        $sql = "SELECT c.Make, COUNT(*) as OrderCount
                        FROM orderdetails od
                        JOIN cars c ON od.CarID = c.CarID
                        GROUP BY c.Make
                        ORDER BY OrderCount DESC
                        LIMIT 1;";
        return $this->getData($sql);
    }

    public function highestAverageDiscount()
    {
        $sql = "SELECT c.type, 
                               AVG((c.Price - cf.DiscountPrice) / c.Price * 100) as AvgDiscountPercentage
                        FROM cars c
                        JOIN car_features cf ON c.CarID = cf.CarID
                        WHERE cf.DiscountPrice IS NOT NULL
                        GROUP BY c.type
                        ORDER BY AvgDiscountPercentage DESC
                        LIMIT 1;";
        return $this->getData($sql);
    }

    public function totalRevenue()
    {
        $sql = "SELECT SUM(od.Quantity * od.Price) as TotalRevenue
                        FROM orderdetails od;";
        return $this->getData($sql);
    }

    
    public function totalCustomers()
    {
        $sql = "SELECT COUNT(DISTINCT CustomerID) as TotalCustomers
                FROM users
                WHERE usertype = 'customer';";
        return $this->getData($sql);
    }
}
