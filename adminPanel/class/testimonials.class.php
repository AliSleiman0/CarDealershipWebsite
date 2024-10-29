<?php
require_once('DAL.class.php');

class Testimonials extends DAL
{
    function getAllTest()
    {
        $sql = "SELECT * FROM testimonials";


        return $this->getdata($sql);
    }
    function getTestByID($id)
    {
        $sql = "SELECT * FROM testimonials where id=$id";
        return $this->getdata($sql);
    }
    function addTest($client_name, $location, $testimonial_text, $client_image)
    {
        $sql = "INSERT INTO testimonials (client_name, location, testimonial_text, client_image) VALUES ('$client_name', '$location', '$testimonial_text', '$client_image')";

        return $this->execute($sql);
    }

    function updateTest($id, $client_name, $location, $testimonial_text, $client_image)
    {
        $sql = "UPDATE testimonials SET 
       client_name='$client_name', location='$location', testimonial_text= '$testimonial_text'";
        if ($client_image) {
            $sql .= ", client_image = '$client_image'";
        }
        $sql .= " WHERE id = $id";

        return $this->execute($sql);
    }
    function deleteTest($id)
    {
        $sql = "delete from testimonials where id=$id";
        return $this->execute($sql);
    }
}
