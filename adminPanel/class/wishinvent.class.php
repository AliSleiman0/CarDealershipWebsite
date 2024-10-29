<?php require_once('DAL.class.php');

class Wishinvent extends DAL
{
    public function addToWishlist($customerID, $carID)
    {
        $sql = "INSERT INTO wishlist (CustomerID, CarID, DateAdded) 
                VALUES ($customerID, $carID, CURDATE())
                ON DUPLICATE KEY UPDATE DateAdded = CURDATE()";
        return $this->execute($sql);
    }
    public function countRowsInTable($id)
    {
        // Prepare the SQL query with proper string formatting
        $sql = "SELECT COUNT(*) AS rowCount FROM wishlist WHERE CustomerID = $id";
    
        // Get the results using the getdata method
        $results = $this->getdata($sql);
    
        // Check if results are returned and fetch the count
        if (isset($results[0]['rowCount'])) {
            return (int)$results[0]['rowCount'];
        }
    
        // Return 0 if the result is not as expected
        return 0;
    }
    



    public function getWishlist($customerID)
    {
        $sql = "SELECT c.*, w.WishlistID, w.DateAdded
                FROM wishlist w
                JOIN cars c ON w.CarID = c.CarID
                WHERE w.CustomerID = $customerID
                ORDER BY w.DateAdded DESC";
        return $this->getdata($sql);
    }

    public function removeFromWishlist($customerID, $carID)
    {
        $sql = "DELETE FROM wishlist 
                WHERE CustomerID = $customerID AND CarID = $carID";
        return $this->execute($sql);
    }
    public function isInWishlist($customerID, $carID)
    {
        $sql = "SELECT COUNT(*) as count FROM wishlist 
                WHERE CustomerID = $customerID AND CarID = $carID";
        $result = $this->getdata($sql);
        return $result[0]['count'] > 0;
    }
    public function getUserWishlist($customerID)
    {
        $sql = "SELECT CarID FROM wishlist WHERE CustomerID = $customerID";
        $result = $this->getdata($sql);
        return array_column($result, 'CarID');
    }
}
