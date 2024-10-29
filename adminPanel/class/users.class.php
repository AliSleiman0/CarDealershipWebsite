<?php
require_once('DAL.class.php');

class Users extends DAL
{
    public function getAllUsers()
    {
        $sql = "
        SELECT * 
        FROM users 
        ORDER BY 
            CASE 
                WHEN userType = 'superadmin' THEN 1
                WHEN userType = 'admin' THEN 2
                WHEN userType = 'customer' THEN 3
                ELSE 4
            END
    ";

        //  SELECT *FROM `cars` left join carimages ON cars.CarID=carimages.CarID group by cars.CarID;
        return $this->getdata($sql);
    }

    public function getUserById($userId)
    {
        $sql = "SELECT * FROM users WHERE CustomerID = $userId";
        $result = $this->getdata($sql);
        return $result ? $result[0] : null;
    }

    public function updateUser($userId, $name, $email, $passwordHash, $userType = null)
    {
        $sql = "UPDATE users SET 
                    Name = '$name', 
                    Email = '$email', 
                    PasswordHash = '$passwordHash'";
        if ($userType !== null) {
            $sql .= ", usertype = '$userType'";
        }
        $sql .= " WHERE CustomerID = $userId";

        return $this->execute($sql);
    }

    public function deleteUser($userId)
    {
        $sql = "DELETE FROM users WHERE CustomerID = $userId";
        return $this->execute($sql);
    }

    public function emailExists($email)
    {
        $sql = "SELECT COUNT(*) as count FROM users WHERE Email = '$email'";
        $result = $this->getdata($sql);
        return $result[0]['count'] > 0;
    }

    public function addUser($name, $email, $passwordHash, $userType)
    {
        $sql = "INSERT INTO users (Name, Email, PasswordHash, usertype, DateSignedUp) 
                VALUES ('$name', '$email', '$passwordHash', '$userType', NOW())";
        return $this->execute($sql);
    }
}
