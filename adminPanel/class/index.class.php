<?php
require_once('DAL.class.php');

class sliders extends DAL
{
    function getAllSliders()
    {
        $sql = "SELECT * FROM sliders";

        //  SELECT *FROM `cars` left join carimages ON cars.CarID=carimages.CarID group by cars.CarID;
        return $this->getdata($sql);
    }

    function getNewestCars()
    {
        $sql = "SELECT * FROM cars ORDER BY DateAdded DESC LIMIT 3";

        //  SELECT *FROM `cars` left join carimages ON cars.CarID=carimages.CarID group by cars.CarID;
        return $this->getdata($sql);
    }
    public function getRandomImagesByID($carID)
    {
        $sql = "SELECT ImageName
                FROM carimages
                WHERE CarID = $carID
                ORDER BY RAND()
                LIMIT 1";
        return $this->getdata($sql);
    }
    public function getFeaturedCars()
    {
        $sql = "SELECT *
                FROM cars
                WHERE isNew = 1 AND quantity > 0
                ORDER BY Price DESC, DateAdded DESC
                LIMIT 8;";
        return $this->getdata($sql);
    }
    public function getAllTestimonials()
    {
        $sql = "SELECT *
                FROM testimonials;";
        return $this->getdata($sql);
    }

    public function getAllBrandImages()
    {
        $sql = "SELECT *
                FROM brand_images;";
        return $this->getdata($sql);
    }
    public function updateSlider($id, $title, $description, $banner_name = null)
    {
        // Update query, include banner if provided
        $sql = "UPDATE sliders SET 
                    title = '$title', 
                    description = '$description'";
        if ($banner_name) {
            $sql .= ", banner = '$banner_name'";
        }
        $sql .= " WHERE id = $id";

        return $this->execute($sql);
    }

    public function getAllSlidersImages()
    {
        $sql = "SELECT *
                FROM sliders_images;";
        return $this->getdata($sql);
    }
    public function deleteSliderImage($id)
    {
        $sql = "DELETE FROM sliders_images WHERE sd_imageid = '$id'";
        return $this->execute($sql);
    }
    public function insertimage($image_name)
    {
        $sql = "insert into sliders_images (slider_id,image_path) VALUES (1,'$image_name')";
        return $this->execute($sql);
    }
    function getNewestCaros($limit = 5)
    {
        $sql = "SELECT c.CarID, c.Make, c.Model, c.Year, ci.ImageName
                FROM cars c
                LEFT JOIN (
                    SELECT CarID, MIN(ImageID) as FirstImageID
                    FROM carimages
                    GROUP BY CarID
                ) first_image ON c.CarID = first_image.CarID
                LEFT JOIN carimages ci ON first_image.FirstImageID = ci.ImageID
                ORDER BY c.Year DESC, c.DateAdded DESC
                LIMIT $limit";

        return $this->getData($sql);
    }

    public function getAllLinks()
    {
        $sql = "SELECT instagram, linkedin, twitter, facebook FROM links LIMIT 1";
        return $this->getData($sql);
    }
    public function updateLink($platform, $link)
    {
        // Prepare the SQL query with placeholders
        $sql = "UPDATE links SET $platform = ? ";

        // Call the data method with the SQL query and parameters
        return $this->data($sql, [$link]);
    }
    function getCustomerOrders($customerID)
    {
     
        $sql = "SELECT o.OrderID, o.OrderDate, o.TotalAmount, o.order_status,
                   GROUP_CONCAT(DISTINCT CONCAT_WS('|',
                       od.OrderDetailID,
                       od.Quantity,
                       od.Price,
                       od.color,
                       od.address,
                       od.city,
                       od.country,
                       od.zip_code,
                       od.expected_delivery_date,
                       od.order_status,
                       c.Make,
                       c.Model,
                       c.Year
                   ) SEPARATOR ';;') as order_details
            FROM orders o
            JOIN orderdetails od ON o.OrderID = od.OrderID
            JOIN cars c ON od.CarID = c.CarID
            WHERE o.CustomerID = $customerID
            GROUP BY o.OrderID
            ORDER BY o.OrderDate ";


        return $this->getdata($sql);
    }



    // Get orders for the current user


}
